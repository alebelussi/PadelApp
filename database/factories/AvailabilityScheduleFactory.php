<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Court;   

//factory per la creazione di orari di disponibilità dei campi fittizi
class AvailabilityScheduleFactory extends Factory
{
    //funzione per definire gli orari di disponibilità dei campi fittizi
    public function definition(): array
    {
        return [
           'day_of_week' => $this->faker->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            'start_time' => $this->faker->time('H:i', '08:00'), 
            'end_time' => $this->faker->time('H:i', '23:00'), 
            'is_available' => $this->faker->boolean(95), //95% di probabilità che il campo sia disponibile
            //creo prima il campo a cui appartiene l'orario di disponibilità
            'court_id' =>  Court::factory(), 
        ];
    }
}
