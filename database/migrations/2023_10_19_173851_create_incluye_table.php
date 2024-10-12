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
        Schema::create('incluye', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('itinerario_id')-> unsigned();
            $table->foreign('itinerario_id')->references('id')->on('itinerarios');
            $table->BigInteger('incluye_id')-> unsigned();
            $table->foreign('incluye_id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incluye');
    }
};
