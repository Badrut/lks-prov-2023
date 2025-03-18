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
        Schema::table('validations', function (Blueprint $table) {
            $table->foreignId('job_category_id')->references('id')->on('job_categories')->constrained();
            $table->foreignId('society_id')->references('id')->on('societies')->constrained();
            $table->foreignId('validator_id')->references('id')->on('validators')->constrained();
            $table->enum('status', ['accepted', 'declined', 'pending']);
            $table->text('work_experience');
            $table->text('job_position');
            $table->text('reason_accepted');
            $table->text('validator_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('validations', function (Blueprint $table) {
            //
        });
    }
};
