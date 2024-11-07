<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_xxxxxx_create_tenis_table.php
public function up()
{
    Schema::create('tenis', function (Blueprint $table) {
        $table->id('id_ten');
        $table->integer('id_model')->nullable();
        $table->integer('num_talla')->nullable();
        $table->char('categ_ten', 15)->nullable();
        $table->char('color_ten', 15)->nullable();
        $table->decimal('prec_ten', 6, 2)->nullable();
        $table->decimal('costo_ten', 6, 2)->nullable();
        $table->char('img_ten', 20)->nullable();
        $table->integer('cantidad')->default(0)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenis');
    }
};
