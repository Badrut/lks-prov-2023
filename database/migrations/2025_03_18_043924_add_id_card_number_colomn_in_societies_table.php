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
        Schema::table('societies', function (Blueprint $table) {
            $table->char('id_card_number', 8);
            $table->string('password', 255);
            $table->string('name', 255);
            $table->date('born_date');
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->foreignId('regional_id')->references('id')->on('regionals')->constrained();
            $table->text('login_tokens')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('societies', function (Blueprint $table) {
            //
        });
    }
};
