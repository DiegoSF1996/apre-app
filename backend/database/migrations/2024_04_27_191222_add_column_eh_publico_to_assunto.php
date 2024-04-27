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
        Schema::table('assunto', function (Blueprint $table) {
            $table->string('eh_publico',100)->default(false); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assunto', function (Blueprint $table) {
            $table->dropColumn('eh_publico',100);
        });
    }
};
