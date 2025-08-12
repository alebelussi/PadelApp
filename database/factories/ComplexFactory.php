<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

//factory per la creazione di oggetti che rappresentano i complessi dove ci sono i campi
class ComplexFactory extends Factory
{
    //funzione per definire i complessi fittizi dei vari campi
    public function definition(): array
    {
        $faker = \Faker\Factory::create('it_IT');
        return [
            'name' => $faker->company, 
            'description' => $faker->text(50), 
            'address' => $faker->streetAddress, 
            'city' => $faker->city, 
            'postal_code' => $faker->postcode, 
            'phone' => $faker->phoneNumber, 
            'email' => $faker->unique()->safeEmail, 
            //orari di apertura del complesso prestabilito
            'opening_hours' => [
                'monday' => '08:00-20:00',
                'tuesday' => '08:00-20:00',
                'wednesday' => '08:00-20:00',
                'thursday' => '08:00-20:00',
                'friday' => '08:00-20:00',
                'saturday' => '09:00-18:00',
                'sunday' => 'closed',
            ],
        ];
    }
}
