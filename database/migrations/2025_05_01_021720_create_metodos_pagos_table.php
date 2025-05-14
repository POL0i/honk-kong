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
            $table->string('cvv');
            $table->float('monto');
            $table->enum('estado',['pendiente','aprobado','fallido','reembolsado'])->default('pendiente');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_pedido');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos');
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
