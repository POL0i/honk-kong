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
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            //$table->id('id_detalle');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);

            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_producto');
            $table->primary(['id_pedido','id_producto']);
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos');
            $table->foreign('id_producto')->references('id_producto')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};
