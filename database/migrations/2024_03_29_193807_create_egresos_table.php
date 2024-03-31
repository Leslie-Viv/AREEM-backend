<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->string('nombrecompleto');
            $table->string('nombreempresa');
            $table->date('anomesdereporte');
            $table->string('origenegreso');
            $table->string('tipodecuenta');
            $table->string('tipoegreso');
            $table->string('descripcionegreso');
            $table->string('gasto');
            $table->string('nombreunidad');
            $table->date('fechareal');
            $table->string('montototal');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('rol_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos');
    }
};
