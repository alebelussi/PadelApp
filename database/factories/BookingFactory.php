<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Court;
use App\Models\User;
use App\Models\Booking;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $user_id = User::inRandomOrder()->value('id');
        $court_id = Court::inRandomOrder()->value('id');

        $maxAttempts = 10;
        $attempt = 0;
        do {
            $date = $this->faker->dateTimeBetween('+1 day', '+7 days');
            $hour = rand(8, 19);
            $minute = [0, 30][rand(0, 1)];
            $start_time = (clone $date)->setTime($hour, $minute);
            $end_time = (clone $start_time)->modify('+90 minutes');

            $overlap = Booking::where('user_id', $user_id)
                ->where(function ($query) use ($start_time, $end_time) {
                    $query->where('start_time', '<', $end_time)
                        ->where('end_time', '>', $start_time);
                })
                ->exists();

            $attempt++;
        } while ($overlap && $attempt < $maxAttempts);

        if ($overlap) {
            // Non è stato possibile trovare uno slot valido
            return [];
        }

        $number_of_players = $this->faker->randomElement([2, 4]);
        $racket_needed = $this->faker->boolean();
        $racket_count = $racket_needed ? rand(1, $number_of_players) : null;

        return [
            'user_id' => $user_id,
            'court_id' => $court_id,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'number_of_players' => $number_of_players,
            'racket_needed' => $racket_needed,
            'racket_count' => $racket_count,
            'status' => $this->faker->randomElement(Booking::$statuses),
        ];
    }

}
