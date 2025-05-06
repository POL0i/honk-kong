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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->timestamp('fecha')->useCurrent();
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['pendiente', 'completado', 'fallido'])->default('pendiente');
            $table->string('direccion_envio', 255)->nullable();
            $table->string('metodo_pago', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
