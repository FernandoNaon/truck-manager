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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->default(null);
            $table->string('name');
            $table->integer('price');
            $table->enum('speed', [1, 2, 3, 4, 5]);
            $table->enum('fuel_cons',[1,2,3,4,5]);
            $table->enum('acceleration',[1,2,3,4,5]);
            $table->boolean('has_owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
