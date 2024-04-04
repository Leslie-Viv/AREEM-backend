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
        Schema::create('tipo_egresos', function (Blueprint $table) {
            $table->id();
            $table->string('N1');
            $table->string('N2');
            $table->string('N3');
            $table->string('N4');
            $table->string('N5');
            $table->string('descripcionegreso');
            $table->string('gasto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_egresos');
    }
};
