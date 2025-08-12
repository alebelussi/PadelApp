<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    // Attributi del campo da padel
    protected $fillable = [
        'name',
        'type',            //tipo di campo             
        'description',     //descrizione del campo
        'location',         //posizione del campo
        'price_per_hour',   
        'status',           //es: attivo/manutenzione/...
        'complex_id',       //struttura a cui appartiene il campo
        'is_available',
        'image_path'
    ];

    //cast degli attributi
    protected $casts = [
        'price_per_hour' => 'float',
        'status' => 'string', // stato del campo, es: 'active', 'maintenance'
    ];

    // tipi consentiti per il campo 'type'
    public const TYPES = ['indoor', 'outdoor'];

    // Riferimento alla struttura (Complex) a cui appartiene il campo
    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    // Tutte le prenotazioni associate a questo campo
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    //tutte le disponibilità associate a questo campo
    public function availabilitySchedules()
    {
        return $this->hasMany(AvailabilitySchedule::class);
    }

    //eventualmente puoi aggiungere un metodo helper per validare i tipi
    public static function isValidType(string $type): bool
    {
        return in_array($type, self::TYPES);
    }
}