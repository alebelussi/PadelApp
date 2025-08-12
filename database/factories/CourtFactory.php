<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Complex;

//factory per la creazione di campi fittizi
class CourtFactory extends Factory
{
    //funzione per definire i campi fittizi
    public function definition(): array
    {
        $faker = \Faker\Factory::create('it_IT');
        return [
            'name' => $faker->unique()->word . ' Court',
            'type' => $faker->randomElement(['indoor', 'outdoor']), //tipo di campo
            'description' => $faker->text(20), //Descrizione del campo
            'status' => $faker->randomElement(['active', 'maintenance','inactive']), //Stato del campo
            'location' => $faker->address,
            'price_per_hour' => $faker->numberBetween(10, 50), //Prezzo per ora tra 10 e 50
            'image_path' => 'courts/4UsmYYwNiI9W3B8pFOklnWqHmEazupjUYdFfu4c4.webp',
            'complex_id' => Complex::inRandomOrder()->first()->id
        ];
    }
}
