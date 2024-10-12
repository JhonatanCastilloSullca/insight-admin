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
        Schema::create('pdf_datos', function (Blueprint $table) {
            $table->id();
            $table->text('img_principal')->nullable();
            $table->string('ruc',11)->nullable();
            $table->string('razon_social',150)->nullable();
            $table->text('rec_cancel1')->nullable();
            $table->text('rec_cancel2')->nullable();
            $table->text('poli_ven1')->nullable();
            $table->text('poli_ven2')->nullable();
            $table->text('poli_nota')->nullable();
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
        Schema::dropIfExists('pdf_datos');
    }
};
