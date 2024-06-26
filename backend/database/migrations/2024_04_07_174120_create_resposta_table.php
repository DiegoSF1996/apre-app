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
        Schema::create('resposta', function (Blueprint $table) {
            $table->id();
            $table->string('descricao',255);   
            $table->foreignId('questao_id')->nullable()->constrained(table:'questao',column:'id');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resposta');
    }
};
