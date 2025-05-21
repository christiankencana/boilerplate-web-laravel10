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
        Schema::create('tb_company_has_locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id');

            $table->string('location_name');
            $table->string('location_address');

            $table->timestamps();

            // unique
            $table->unique([
                'company_id',
                
                'location_name',
                'location_address',
            ]);

            // references uuid
            $table->foreign('company_id')->references('id')->on('tb_companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_company_has_locations');
    }
};
