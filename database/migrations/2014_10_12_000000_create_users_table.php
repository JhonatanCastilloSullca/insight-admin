<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('email',150)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->decimal('sueldo',7,2)->nullable();
            $table->time('hora_ingreso')->nullable();
            $table->time('hora_salida')->nullable();
            $table->string('dia_descanso',100)->nullable();
            $table->string('usuario',200)->unique();
            $table->string('password',200)->nullable();
            $table->text('imagen')->nullable();
            $table->BigInteger('documento_id')-> unsigned()->nullable();
            $table->foreign('documento_id')->references('id')->on('documentos');
            $table->string('estado',1)->default(1);
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
        Schema::dropIfExists('users');
    }
};
