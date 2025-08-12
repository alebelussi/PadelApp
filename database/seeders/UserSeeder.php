<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUserSeeder();
    }

    private function createUserSeeder()
    {
        //admin con id=1
        User::factory()->create([
            'name' => 'Alessandro',
            'surname' => 'Belussi',
            'email' => 'a.belussi007@studenti.unibs.it',
            'password' => bcrypt('0000'),
            'birth_date' => '2003-04-29',
            'gender' => 'male',
            'tax_code' => 'ABLSLS03D29A000Z',
            'phone' => '3404869403',
            'is_active' => true,
        ]);
        User::find(1)->assignRole('admin'); //assegno il ruolo di admin all'utente con ID 1
        //admin con id=2
        User::factory()->create([
            'name' => 'Tommaso',
            'surname' => 'Franzoni',
            'email' => 't.franzoni@studenti.unibs.it',
            'password' => bcrypt('1234'),
            'birth_date' => '2003-07-07',
            'gender' => 'male',
            'tax_code' => 'FRNTSM03L07A000Z',
            'phone' => '3313512921',
            'is_active' => true,
        ]);
        User::find(2)->assignRole('admin'); //assegno il ruolo di admin all'utente con ID 1
        //admin con id=3
        User::factory()->create([
            'name' => 'Vincenzo',
            'surname' => 'Ingiaimo',
            'email' => 'v.ingiaimo@studenti.unibs.it',
            'password' => bcrypt('4321'),
            'birth_date' => '2003-10-15',
            'gender' => 'male',
            'tax_code' => 'INGVNC03D15A000Z',
            'phone' => '3473465119',
            'is_active' => true,
        ]);
        User::find(3)->assignRole('admin'); //assegno il ruolo di admin all'utente con ID 1
        //creo un utente specifico
        $simpleUser= User::factory()->create([
            'name' => 'Alberto',
            'surname' => 'Ferrari',
            'email' => 'a.ferrari03@studenti.unibs.it',
            'password' => bcrypt('ironman'),
            'birth_date' => '2003-04-10',
            'gender' => 'male',
            'tax_code' => 'AFRRBT03D10A000Z',
            'phone' => '3270921251',
            'is_active' => true,
        ]);
        //assegno il ruolo di admin all'utente con ID 1
        $simpleUser->assignRole('user');
    }
}
