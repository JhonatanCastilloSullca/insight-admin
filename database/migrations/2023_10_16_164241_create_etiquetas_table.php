<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('etiquetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50)->nullable();
            $table->string('estado',1)->default(1);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('etiquetas');
    }
};
