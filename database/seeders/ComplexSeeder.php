<?php

namespace Database\Seeders;

use App\Models\Complex;
use Illuminate\Database\Seeder;

class ComplexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $this->createComplexes();
    }

    private function createComplexes(): void {
        $complexes = [
            [
                'id' => 1,
                'name' => 'Centro Sportivo Santa Lucia',
                'description' => 'Struttura moderna con campi da calcio a 5, tennis e padel, situata nel cuore del quartiere Santa Lucia.',
                'address' => 'Via Santa Lucia 42',
                'city' => 'Verona',
                'postal_code' => '37132',
                'phone' => '0459876543',
                'email' => 'info@santaluciasport.it',
                'opening_hours' => [
                    'monday' => '08:00-20:00',
                    'tuesday' => '08:00-20:00',
                    'wednesday' => '08:00-20:00',
                    'thursday' => '08:00-20:00',
                    'friday' => '08:00-20:00',
                    'saturday' => '09:00-18:00',
                    'sunday' => 'closed',
                ],
            ],
            [
                'id' => 2,
                'name' => 'Sport Village Milano Nord',
                'description' => 'Centro polifunzionale con palestra, piscina e campi da padel di ultima generazione.',
                'address' => 'Via G. Galilei 10',
                'city' => 'Milano',
                'postal_code' => '20128',
                'phone' => '0287654321',
                'email' => 'milano@sportvillage.it',
                'opening_hours' => [
                    'monday' => '07:00-22:00',
                    'tuesday' => '07:00-22:00',
                    'wednesday' => '07:00-22:00',
                    'thursday' => '07:00-22:00',
                    'friday' => '07:00-22:00',
                    'saturday' => '08:00-20:00',
                    'sunday' => '08:00-14:00',
                ],
            ],
            [
                'id' => 3,
                'name' => 'Parco dello Sport Firenze',
                'description' => 'Area immersa nel verde con campi all’aperto per calcetto, basket e beach volley.',
                'address' => 'Via dei Campi 88',
                'city' => 'Firenze',
                'postal_code' => '50135',
                'phone' => '0551234567',
                'email' => 'info@parcosportfirenze.it',
                'opening_hours' => [
                    'monday' => '09:00-21:00',
                    'tuesday' => '09:00-21:00',
                    'wednesday' => '09:00-21:00',
                    'thursday' => '09:00-21:00',
                    'friday' => '09:00-21:00',
                    'saturday' => '09:00-19:00',
                    'sunday' => '10:00-16:00',
                ],
            ],
            [
                'id' => 4,
                'name' => 'Sporting Club Napoli Est',
                'description' => 'Struttura storica rinnovata con campi da tennis e piscina semi-olimpionica.',
                'address' => 'Via delle Palme 3',
                'city' => 'Napoli',
                'postal_code' => '80147',
                'phone' => '0816543210',
                'email' => 'napoli@sportingclub.it',
                'opening_hours' => [
                    'monday' => '07:30-21:00',
                    'tuesday' => '07:30-21:00',
                    'wednesday' => '07:30-21:00',
                    'thursday' => '07:30-21:00',
                    'friday' => '07:30-21:00',
                    'saturday' => '08:00-20:00',
                    'sunday' => '08:00-14:00',
                ],
            ],
            [
                'id' => 5,
                'name' => 'Centro Padel Roma Sud',
                'description' => 'Centro specializzato in padel con 8 campi e spogliatoi moderni.',
                'address' => 'Via Appia Nuova 250',
                'city' => 'Roma',
                'postal_code' => '00179',
                'phone' => '0669873210',
                'email' => 'roma@padelsud.it',
                'opening_hours' => [
                    'monday' => '08:00-23:00',
                    'tuesday' => '08:00-23:00',
                    'wednesday' => '08:00-23:00',
                    'thursday' => '08:00-23:00',
                    'friday' => '08:00-23:00',
                    'saturday' => '09:00-22:00',
                    'sunday' => '09:00-20:00',
                ],
            ],
            [
                'id' => 6,
                'name' => 'Centro Polisportivo Bologna 2000',
                'description' => 'Struttura polivalente con campi indoor, pista di atletica e palestra multifunzionale.',
                'address' => 'Via delle Scienze 15',
                'city' => 'Bologna',
                'postal_code' => '40127',
                'phone' => '0517896541',
                'email' => 'info@bologna2000sport.it',
                'opening_hours' => [
                    'monday' => '07:00-22:00',
                    'tuesday' => '07:00-22:00',
                    'wednesday' => '07:00-22:00',
                    'thursday' => '07:00-22:00',
                    'friday' => '07:00-22:00',
                    'saturday' => '08:00-20:00',
                    'sunday' => '09:00-14:00',
                ],
            ],
            [
                'id' => 7,
                'name' => 'Sport Arena Torino Sud',
                'description' => 'Centro attrezzato con campi da calcio a 7, beach volley e sala fitness.',
                'address' => 'Strada del Drosso 102',
                'city' => 'Torino',
                'postal_code' => '10135',
                'phone' => '0117643219',
                'email' => 'contatti@sportarenatorino.it',
                'opening_hours' => [
                    'monday' => '08:30-22:30',
                    'tuesday' => '08:30-22:30',
                    'wednesday' => '08:30-22:30',
                    'thursday' => '08:30-22:30',
                    'friday' => '08:30-22:30',
                    'saturday' => '09:00-21:00',
                    'sunday' => '09:00-18:00',
                ],
            ],
            [
                'id' => 8,
                'name' => 'Padel Center Bari Mare',
                'description' => 'Struttura moderna fronte mare dedicata esclusivamente al padel, con bar e zona relax.',
                'address' => 'Lungomare Starita 21',
                'city' => 'Bari',
                'postal_code' => '70123',
                'phone' => '0804567890',
                'email' => 'info@padelbarimare.it',
                'opening_hours' => [
                    'monday' => '08:00-23:00',
                    'tuesday' => '08:00-23:00',
                    'wednesday' => '08:00-23:00',
                    'thursday' => '08:00-23:00',
                    'friday' => '08:00-23:00',
                    'saturday' => '09:00-22:00',
                    'sunday' => '09:00-20:00',
                ],
            ],
            [
                'id' => 9,
                'name' => 'Green Valley Sport Center',
                'description' => 'Centro immerso nel verde con percorsi di trekking, campi in erba sintetica e zona yoga.',
                'address' => 'Contrada Valle Verde',
                'city' => 'L\'Aquila',
                'postal_code' => '67100',
                'phone' => '0862412365',
                'email' => 'valleysport@abruzzo.it',
                'opening_hours' => [
                    'monday' => '09:00-20:00',
                    'tuesday' => '09:00-20:00',
                    'wednesday' => '09:00-20:00',
                    'thursday' => '09:00-20:00',
                    'friday' => '09:00-20:00',
                    'saturday' => '08:00-18:00',
                    'sunday' => '08:00-13:00',
                ],
            ],
        ];

        foreach ($complexes as $complex) {
            Complex::factory()->create($complex);
        }
    }
}
