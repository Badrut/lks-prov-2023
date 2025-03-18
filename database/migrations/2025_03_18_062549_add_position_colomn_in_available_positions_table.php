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
        Schema::table('available_positions', function (Blueprint $table) {
            $table->foreignId('job_vacancy_id')->references('id')->on('job_vacancies')->constrained();
            $table->string('position');
            $table->bigInteger('capacity');
            $table->bigInteger('apply_capacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('avalaible_positions', function (Blueprint $table) {
            //
        });
    }
};
