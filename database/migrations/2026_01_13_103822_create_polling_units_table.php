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
        Schema::create('polling_unit', function (Blueprint $table) {
            $table->integer('uniqueid')->primary();
            $table->integer('polling_unit_id');
            $table->integer('ward_id');
            $table->integer('lga_id');
            $table->integer('uniquewardid')->nullable();
            $table->string('polling_unit_number')->nullable();
            $table->string('polling_unit_name')->nullable();
            $table->text('polling_unit_description')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
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
        Schema::dropIfExists('polling_unit');
    }
};
