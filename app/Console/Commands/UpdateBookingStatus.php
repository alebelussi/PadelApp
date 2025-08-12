<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    protected $signature = 'bookings:update-statuses';
    protected $description = 'Aggiorna lo stato delle prenotazioni da pending a confirmed e da confirmed a cancelled';

    public function handle(): void {
        $now = now();

        //=> Da 'pending' a 'confirmed' dopo 5 minuti
        Booking::where('status', Booking::STATUS_PENDING)
            ->where('created_at', '<=', $now->subMinutes(5))
            ->update(['status' => Booking::STATUS_CONFIRMED]);

        //=> Da 'confirmed' a 'cancelled' se end_time è passato
        Booking::where('status', Booking::STATUS_CONFIRMED)
            ->where('end_time', '<', $now)
            ->update(['status' => Booking::STATUS_CANCELLED]);

        $this->info('Stati delle prenotazioni aggiornati con successo.');
    }
}
