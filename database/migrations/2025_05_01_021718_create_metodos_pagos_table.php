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
        Schema::create('metodos_pagos', function (Blueprint $table) {
            $table->id('id_pago');
            $table->string('nombre_titular');
            $table->integer('numero_targera');
            $table->string('fecha_expiracion');
            $table->integer('cvc');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metodos_pagos');
    }
};
