<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teacher_profiles')->cascadeOnDelete();
            $table->enum('day', ['Monday','Tuesday','Wednesday','Thursday','Friday','Sunday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            // No duplicate slot for same class + day + time
            $table->unique(['class_id', 'day', 'start_time'], 'routine_class_day_time_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};
