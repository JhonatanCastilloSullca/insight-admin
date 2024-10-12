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
        Schema::create('pais', function (Blueprint $table) {
            $table->id();
            $table->string('iso', 2);
            $table->string('nombre', 180);
            $table->string('code', 80); 
            $table->string('text', 180); 
            $table->string('textIncaRail', 200)->nullable(); 
            $table->string('codeMinisterio', 80)->nullable(); 
            $table->string('textMinisterio', 180)->nullable(); 
            $table->string('codeConsetur', 80)->nullable(); 
            $table->string('textConsetur', 180)->nullable(); 
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
        Schema::dropIfExists('pais');
    }
};
