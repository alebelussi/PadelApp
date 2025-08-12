<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagePath = 'court.webp';

        $customCourts = [
            [
                'name' => 'Arena Milano Indoor',
                'type' => 'indoor',
                'description' => 'Campo coperto moderno',
                'status' => 'active',
                'location' => 'Via Roma 12, Milano',
                'price_per_hour' => 35,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Sun Court Firenze',
                'type' => 'outdoor',
                'description' => 'Perfetto per l\'estate',
                'status' => 'active',
                'location' => 'Viale dei Colli 45, Firenze',
                'price_per_hour' => 28,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Green Field Roma',
                'type' => 'outdoor',
                'description' => 'Campo in erba sintetica',
                'status' => 'maintenance',
                'location' => 'Via Appia Nuova 120, Roma',
                'price_per_hour' => 30,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Sky Dome Torino',
                'type' => 'indoor',
                'description' => 'Copertura panoramica',
                'status' => 'active',
                'location' => 'Corso Francia 55, Torino',
                'price_per_hour' => 40,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Beach Court Rimini',
                'type' => 'outdoor',
                'description' => 'Campo sabbioso da beach tennis',
                'status' => 'inactive',
                'location' => 'Lungomare Tintori 23, Rimini',
                'price_per_hour' => 25,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Centro Sportivo Napoli',
                'type' => 'indoor',
                'description' => 'Struttura climatizzata',
                'status' => 'active',
                'location' => 'Via Toledo 200, Napoli',
                'price_per_hour' => 33,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Colosseo Court',
                'type' => 'outdoor',
                'description' => 'Vista sul Colosseo',
                'status' => 'maintenance',
                'location' => 'Piazza del Colosseo 1, Roma',
                'price_per_hour' => 38,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Lagoon Court Venezia',
                'type' => 'outdoor',
                'description' => 'Suggestivo campo sull’acqua',
                'status' => 'inactive',
                'location' => 'Fondamenta Zattere 91, Venezia',
                'price_per_hour' => 32,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Mountain Arena Trento',
                'type' => 'indoor',
                'description' => 'Struttura tra le Alpi',
                'status' => 'active',
                'location' => 'Via Brennero 101, Trento',
                'price_per_hour' => 36,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Arena Verona Court',
                'type' => 'outdoor',
                'description' => 'Campo accanto all’Arena',
                'status' => 'active',
                'location' => 'Piazza Bra 1, Verona',
                'price_per_hour' => 29,
                'image_path' => $imagePath,
                'complex_id' => \App\Models\Complex::inRandomOrder()->first()->id,
            ],
        ];

        foreach ($customCourts as $court) {
            Court::create($court);
        }
    }
}
