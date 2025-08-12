<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilitySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'court_id',     //campo a cui si riferisce la disponibilità
        'day_of_week',  //giorno della settimana
        'start_time',
        'end_time',
        'is_available', //disponibilità del campo effettiva
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i', 
        'end_time' => 'datetime:H:i', 
        'is_available' => 'boolean',
        'day_of_week' => 'string', 
    ];

    //riferimento al campo
    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}