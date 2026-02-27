<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('section')->nullable();
            $table->string('academic_year')->index();
            $table->foreignId('class_teacher_id')->nullable()->constrained('teacher_profiles')->nullOnDelete();
            $table->timestamps();

            $table->unique(['class_name', 'section', 'academic_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
