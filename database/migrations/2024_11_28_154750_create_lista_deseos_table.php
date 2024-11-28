<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_lista_deseos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaDeseosTable extends Migration
{
    public function up()
    {
        Schema::create('lista_deseos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->Integer('teni_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('teni_id')->references('id_ten')->on('tenis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lista_deseos');
    }
}
