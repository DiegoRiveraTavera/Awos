<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  
public function up()
{
    Schema::create('sucursal', function (Blueprint $table) {
        $table->id('cve_suc');
        $table->integer('cve_ciu')->nullable();
        $table->char('nom_suc', 20)->nullable();
        $table->char('col_suc', 20)->nullable();
        $table->char('calle_suc', 20)->nullable();
        $table->integer('ne_suc', 3)->nullable();
        $table->integer('ni_suc', 3)->nullable();
        $table->integer('cp_suc', 6)->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursal');
    }
};