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
        Schema::create('tb_companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('client_id');

            $table->string('company_code');
            $table->string('company_main_name');
            $table->string('company_alternative_name')->nullable();

            $table->timestamps();

            // unique
            $table->unique([
                'client_id',
                
                'company_code', 
                'company_main_name',
                'company_alternative_name',
            ]);

            // references uuid
            $table->foreign('client_id')->references('id')->on('tb_clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_companies');
    }
};
