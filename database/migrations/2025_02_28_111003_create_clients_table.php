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
        Schema::create('tb_clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->string('client_code');
            $table->string('client_name');

            $table->timestamps();

            // unique
            $table->unique([
                'client_code', 
                'client_name',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_clients');
    }
};
