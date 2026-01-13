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
        Schema::create('announced_pu_results', function (Blueprint $table) {
            $table->integer('result_id')->primary();
            $table->string('polling_unit_uniqueid');
            $table->string('party_abbreviation');
            $table->integer('party_score');
            $table->string('entered_by_user')->nullable();
            $table->dateTime('date_entered')->nullable();
            $table->string('user_ip_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announced_pu_results');
    }
};
