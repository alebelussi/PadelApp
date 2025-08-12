<?php

namespace App\Http\Controllers;

use App\Models\Complex;
use App\Models\Court;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourtController extends Controller
{
    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|in:indoor,outdoor',
            'description' => 'string|max:255',
            'location' =>  'required|string|max:255',
            'price_per_hour' =>  'required|numeric|min:0',
            'status' => 'required|in:active,inactive,maintenance',
            'complex_id' => 'required|integer|min:1|exists:complexes,id',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput();

        $data = $validate->validated();

        if ($request->hasFile('image_path')) {   //=> Se l'immagine esiste viene salvata
            $imagePath = $request->file('image_path')->store('courts', 'public'); // salva in storage/app/public/courts
            $data['image_path'] = $imagePath;
        }

        $data['is_available'] = true;
        
        Court::create($data);

        return redirect()->back()->with(['title' => 'Inserimento Effettuato', 'message' => 'Campo inserito con successo']);
    }

    public function showAll() {
        $query = Court::query();

        /** @var User $user */
        $user = Auth::user();   //=> Specifico il tipo di $user (VS non sa qual è il tipo ritornato generando)

        if(!($user && $user->hasRole('admin')))
            $query->where('status', 'active');
        
        $court = $query->get();

        return view('pages.court.viewCourt')->with('courts', $court);
    }

    public function showByComplex($complexId) {

        $query = Court::where('complex_id', $complexId);

        $courts = $query->get();

        return view('pages.court.viewCourt')->with('courts', $courts);
    }


    public function selectCourt($number = 9) {  //=> Default = 9
        $courts = Court::take($number)->get();
        return view('homepage', compact('courts'));
    }

    public function edit($courtId = null) {
        $court = [];

        try {
            $court = Court::findOrFail($courtId);
        }
        catch(ModelNotFoundException $e){   //=> Se l'id non esiste, ritorna alla pagina di visualizzazione e mostra l'errore
            return redirect()->route('court.show')->with(['title' => 'Errore durante la ricerca', 'message' => 'Campo non trovato']);
        }

        return view('pages.court.editCourt')->with('court', $court);
    }

    public function update(Request $request, $courtId) {   

        $court = Court::findOrFail($courtId);

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:indoor,outdoor',
            'description' => 'string|max:255',
            'location' =>  'required|string|max:255',
            'price_per_hour' =>  'required|numeric|min:0',
            'status' => 'required|in:active,inactive,maintenance',
            'complex_id' => 'required|integer|exists:complexes,id',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image_path')) {   //=> Se l'immagine esiste viene salvata
            $imagePath = $request->file('image_path')->store('courts', 'public'); // salva in storage/app/public/courts
            $validate['image_path'] = $imagePath;
        }

        $court->update($validate); 

        return redirect()->route('court.show', $courtId)->with(['title' => 'Modifica Effettuata', 'message' => 'Campo aggiornato con successo']);
    }

    public function delete(Request $request, $courtId) {
        try {
            $court = Court::findOrFail($courtId);
            $court->delete();
        }
        catch(\Exception $e){
            return redirect()->route('court.show');
        }

        return redirect()->route('court.show');
    }
}
