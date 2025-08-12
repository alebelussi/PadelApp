<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function showBookingForm(Court $court){

        //=> Prende le prenotazioni future
        $bookings = Booking::where('court_id', $court->id)
                            ->whereDate('start_time', ">=", now())
                            ->get(['start_time', 'end_time']); 

        return view('pages.booking.addBooking', ['court' => $court, 'bookings' => $bookings]);
    }

    public function store(Request $request, Court $court){
        $validate = $request->validate([
            'day' => 'required|date|after_or_equal:today',
            'startTime' => 'required|date_format:H:i',
            'numberOfPlayer' => 'required|in:2,4',
            'selectedRacketNeeded' => 'required|in:0,1',
            'racket_count' => 'nullable|integer|min:0|max:4'
        ]);

        /** @var User $user */
        $user = Auth::user(); //=> Recupera l'utente

        $startDateTime = \Carbon\Carbon::parse($validate['day'] . ' ' . $validate['startTime']);    //=> Crea la data

        $endDateTime = $startDateTime->copy()->addMinutes(90);

        //=> CONTROLLO: orario passato
        if($startDateTime->lessThan((now())))
            return back()->withErrors(['title' => 'Errore durante la prenotazione', 'message' => "L'orario selezionato è già passato..."]);

        //=> CONTROLLO: sovrapposizioni
        if($this->hasOverlap($court->id, $startDateTime, $endDateTime))
            return back()->withErrors(['title' => 'Errore durante la prenotazione', 'messsage' => "La prenotazione è già stata effettuata..."]);

        //=> CONTROLLO: struttura chiusa
        if($this->isClosedDay($court, $startDateTime))
            return back()->withErrors(['title' => 'Errore durante la prenotazione', 'message' => "La struttura è chiusa in questo giorno..."]);
    
        Booking::create([
            'user_id' => $user->id,
            'court_id' => $court->id,
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
            'number_of_players' => $validate['numberOfPlayer'],
            'racket_needed' => $validate['selectedRacketNeeded'],
            'racket_count' => $validate['selectedRacketNeeded'] ? ($validate['racket_count'] ?? 0) : 0,
            'status' => Booking::STATUS_PENDING,
        ]);

        return redirect()->route('booking.show')->with(['title' => 'Operazione Riuscita', 'message' => 'Prenotazione realizzata con successo!']);
    }

    //=> Metodo per verificare la presenza di sovrapposizioni
    private function hasOverlap(int $courtId, $start, $end): bool {

        //start1 < end2 AND start2 < end1
        //=> L'inizio della prenotazione esistente è prima della fine della nuova
        //=> L'inizio della nuova prenotazione è prima della fine della prenotazione esistente

        return Booking::where('court_id', $courtId)
            ->where('start_time', '<', $end)
            ->where('end_time', '>', $start)
            ->exists();
    }

    //=> Metodo per verificare se il giorno corrisponde ad un giorno di chiusura per la struttura
    private function isClosedDay($court, $startDateTime): bool {
        $openingHours = $court->complex->opening_hours;

        $closedDays = array_filter(array_keys($openingHours), function($day) use ($openingHours) {
            return strtolower($openingHours[$day]) === 'closed';
        });

        $dayName = strtolower($startDateTime->format('l'));

        return in_array($dayName, $closedDays);
    }

    public function show(Request $request) {
        $startWeek = now()->startOfWeek();
        return view('pages.booking.viewBooking', ['startWeek' => $startWeek]);
    }
    

    public function events(Request $request) {
        $start = $request->query('start');
        $end = $request->query('end');

        $query = Booking::with('court')
            ->whereBetween('start_time', [$start, $end]);

        /** @var User $user */
        $user = Auth::user();

        if($user->hasRole('user'))
            $query->where('user_id', $user->id);

        $bookings = $query->get();

        return response()->json($bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->court->name,
                'start' => $booking->start_time->format('Y-m-d\TH:i:s'),
                'end' => $booking->end_time->format('Y-m-d\TH:i:s'),
                'color' => '#28a745',
                'players' => $booking->number_of_players,
                'racket_needed' => $booking->racket_needed,
                'racket_count' => $booking->racket_count
            ];
        }));
    }

    public function delete(Request $request, $bookingId = null) {
        try {
            $booking = Booking::findOrFail($bookingId);
            $booking->delete();
        } catch (\Exception $e) {
            return redirect()->route('booking.show')->with(['title' => 'Operazione Fallita', 'message' => 'Si sono verificati degli errori durante la rimozione...' . $e]);
        }

        return redirect()->route('booking.show')->with(['title'=> 'Operazione Riuscita', 'message' => 'Rimozione effettuata con successo!']);
    }

}
