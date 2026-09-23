[<?php

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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->constrained('departments')
                ->cascadeOnDelete();

            $table->foreignId('position_id')
                ->constrained('positions')
                ->cascadeOnDelete();

            $table->string('address')->nullable();

            $table->string('pob')->nullable();

            $table->date('dob')->nullable();

            $table->enum('gender', [
                'male',
                'female'
            ])->nullable();

            $table->enum('religion', [
                'islam',
                'katolik',
                'protestan',
                'hindu',
                'buddha'
            ])->nullable();

            $table->string('phone_number')->nullable();

            $table->integer('salary')->default(0);

            $table->date('start_date')->nullable();

            $table->enum('status', [
                'applicant',
                'active',
                'trainee',
                'x'
            ])->default('active');

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
