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
        Schema::create('archivar_ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('nombrecompleto');
            $table->string('nombreunidad');
            $table->date('anomesdereporte');
            $table->string('producto');
            $table->date('fechareal');
            $table->string('montototal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivar_ingresos');
    }
};
