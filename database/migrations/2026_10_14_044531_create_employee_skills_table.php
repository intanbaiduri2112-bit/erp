<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_skills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained()
                ->cascadeOnDelete();

            $table->foreignId('skill_type_id')->constrained()
                ->cascadeOnDelete();

            $table->foreignId('skill_id')->constrained()
                ->cascadeOnDelete();

            $table->foreignId('skill_level_id')->constrained()
                ->cascadeOnDelete();

            $table->integer('level_progress')->default(0);

            $table->boolean('is_default_level')->default(false);

            $table->string('image');

            $table->date('effective_date');

            $table->date('expiry_date')->nullable();

            $table->timestamps();
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('employee_skills');
    }
};
    /**
     * Reverse the migrations.
     */
    

