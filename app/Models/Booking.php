<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    //attributi della prenotazione
    protected $fillable = [
        'user_id', //id dell'utente che ha fatto la prenotazione
        'court_id', //id del campo prenotato
        'start_time',
        'end_time',
        'number_of_players', //numero di giocatori
        'racket_needed', //se le racchette sono necessarie
        'racket_count',
        'status', //stato della prenotazione
    ];

    //costanti per gli stati della prenotazione
    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';

    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
        self::STATUS_CANCELLED,
    ];

    //cast degli attributi
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    //riferimento all'utente che ha fatto la prenotazione
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //riferimento al campo che ha fatto la prenotazione
    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    //metodo che ritorna se lo stato della prenotazione è valido
    public static function isValidStatus(string $status): bool
    {
        return in_array($status, self::$statuses);
    }
}
