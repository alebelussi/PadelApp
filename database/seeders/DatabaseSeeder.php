<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Court;
use App\Models\AvailabilitySchedule as Availability;
use App\Models\Complex;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    //creo i vari seeder per popolare il database
    public function run(): void
    {
        $this->createPermissionSeeder();
        $this->createRoleSeeder();
        $this->call([
            ComplexSeeder::class,
            CourtSeeder::class,
            UserSeeder::class,
        ]);
        $this->createBookingSeeder();
    }

    //seeder per creare le prenotazioni
    private function createBookingSeeder() {
        //creo una prenotazione specifica
        Booking::factory()->create([
            'user_id' => 1, //associata all'utente con ID 1
            'court_id' => 1, //associata al campo con ID 1
            'start_time' => now()->addDays(1)->setHour(10)->setMinute(0),
            'end_time' => now()->addDays(1)->setHour(11)->setMinute(0),
            'number_of_players' => [2, 4][rand(0, 1)],
            'racket_needed' => (bool) rand(0, 1),
            'status' => Booking::STATUS_CONFIRMED, 
        ]);
        //creo 20 prenotazioni fittizie
        Booking::factory(20)->create();
    }  

    //seeder per creare i campi da gioco
  /*  private function createCourtSeeder()
    {
        //creo un campo specifico
        Court::factory()->create([
            'id' => 1, //imposto l'ID per poterlo associare alle prenotazioni
            'name' => 'Campo 1',
            'type' => 'outdoor',
            'status' => 'active',
            'description' => 'Campo da padel all\'aperto con erba sintetica',
            'location' => 'Lato est del complesso',
            'price_per_hour' => 20.00,
            'image_path' => 'courts/AjS1te4NkWlmAHS8JGVDrACHJBGyXckP2sbP95WN.webp'
        ]);

        //creo un campo specifico
        Court::factory()->create([
            'id' => 2, //imposto l'ID per poterlo associare alle prenotazioni
            'name' => 'Campo 1',
            'type' => 'outdoor',
            'status' => 'active',
            'description' => 'Campo da padel all\'aperto con erba sintetica',
            'location' => 'Lato est del complesso',
            'price_per_hour' => 20.00,
            'image_path' => 'courts/l2Sk9y4SZQm4cAMIZYqnYPeWFvTBgv8ZbYVfCnIz.webp'
        ]);

        //creo un campo specifico
        Court::factory()->create([
            'id' => 3, //imposto l'ID per poterlo associare alle prenotazioni
            'name' => 'Campo 1',
            'type' => 'outdoor',
            'status' => 'active',
            'description' => 'Campo da padel all\'aperto con erba sintetica',
            'location' => 'Lato est del complesso',
            'price_per_hour' => 20.00,
            'image_path' => 'courts/OhDOJkY40iHozM9lx5oPFRG5DzNlKv7wmYsFHchv.webp'
        ]);
        //creo 5 campi da gioco fittizi
        Court::factory(5)->create();
    }*/

    //seeder per creare le disponibilità dei campi
 /*   private function createAvailabilitySeeder()
    {
        //creo una disponibilità specifica
        Availability::factory()->create([  
            'court_id' => 1, 
            'day_of_week' => 'Monday', 
            'start_time' => '10:00:00',
            'end_time' => '18:00:00',
            'is_available' => true,
        ]);
        //creo 20 disponibilità fittizie
        Availability::factory(20)->create();
    }*/

    private function createPermissionSeeder()
    {
        //permessi dell'applicazione
        Permission::create(['name' => 'booking_create']);
        Permission::create(['name' => 'booking_view']);
        Permission::create(['name' => 'booking_cancel']);
        Permission::create(['name' => 'court_create']);
        Permission::create(['name' => 'court_view']);
        Permission::create(['name' => 'court_edit']);
        Permission::create(['name' => 'court_delete']);
        Permission::create(['name' => 'complex_create']);
        Permission::create(['name' => 'complex_view']);
        Permission::create(['name' => 'complex_edit']);
        Permission::create(['name' => 'complex_delete']);
    }

    private function createRoleSeeder(): void
    {
        //ruolo di amministratore
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'booking_view',
            'booking_cancel',
            'court_create',
            'court_view',
            'court_edit',
            'court_delete',
            'complex_create',
            'complex_view',
            'complex_edit',
            'complex_delete'
        ]);
        //ruolo di utente
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'booking_create',
            'booking_view',
            'booking_cancel',
            'court_view',
            'complex_view'
        ]);
    }
}