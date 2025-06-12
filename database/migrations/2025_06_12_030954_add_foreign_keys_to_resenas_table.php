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
    Schema::table('resenas', function (Blueprint $table) {
        // Verificar que las columnas no existan primero
        if (!Schema::hasColumn('resenas', 'user_id')) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        }
        
        if (!Schema::hasColumn('resenas', 'producto_id')) {
            // Especifica explícitamente la columna de referencia
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('cascade');
        }
        
        // Mantén tu restricción CHECK si es necesaria
        $table->integer('calificacion')->check('calificacion >= 1 AND calificacion <= 5')->change();
    });
}

public function down(): void
{
    Schema::table('resenas', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['resenas_producto_id_foreign']); // Nombre generado para esta FK
        
        $table->dropColumn(['user_id', 'producto_id']);
    });
}
};