<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id',11)->nullable(false);
            $table->string('codigo',40)->unique();
            $table->string('nombre',120);
            $table->double('salarioDolares')->nullable(false);
            $table->double('salarioPesos')->nullable(false);
            $table->string('direccion',250)->nullable(false);
            $table->string('estado',50)->nullable(false);
            $table->string('ciudad',50)->nullable(false);
            $table->string('telefono',10)->nullable(false);
            $table->string('correo',100)->nullable(false);
            $table->tinyInteger('active')->default("0")->nullable(false);
            $table->softDeletes();
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
        Schema::dropIfExists('empleados');
    }
}
