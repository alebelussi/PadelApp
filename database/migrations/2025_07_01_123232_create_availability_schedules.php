<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('availability_schedules', function (Blueprint $table) {
                $table->id();
                $table->time('start_time');
                $table->time('end_time');
                $table->enum('day_of_week', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
                $table->boolean('is_available')->default(true);
                $table->timestamps();
                $table->foreignId('court_id')->constrained()->onDelete('cascade');
                //Nome breve per evitare errore
                $table->unique(
                    ['court_id', 'day_of_week', 'start_time', 'end_time'], 
                    'avail_sched_court_day_start_end_unique'
                );
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('availability_schedule');
        }
    };
?>