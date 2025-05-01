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
        Schema::table('job_apply_societies', function (Blueprint $table) {
            $table->text('notes');
            $table->date('date');
            $table->foreignId('society_id')->references('id')->on('job_apply_societies')->constrained();
            $table->foreignId('job_vacancy_id')->references('id')->on('job_vacancies')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_apply_societies', function (Blueprint $table) {
            //
        });
    }
};
