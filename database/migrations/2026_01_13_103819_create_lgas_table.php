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
        Schema::create('lga', function (Blueprint $table) {
            $table->integer('uniqueid')->primary();
            $table->integer('lga_id');
            $table->string('lga_name');
            $table->integer('state_id');
            $table->text('lga_description')->nullable();
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
        Schema::dropIfExists('lga');
    }
};
