<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aticulos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('categoria_id')->unsigned();
            $table->String('codigo', 50)->nullable();
            $table->String('nombre', 50)->unique();
            $table->decimal('precio_venta', 11, 2);
            $table->integer('stock');
            $table->String('descripcion', 256)->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aticulos');
    }
}
