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
        Schema::create('package_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained();
            $table->unsignedInteger('price');
            $table->string('badge')->nullable();
            $table->unsignedInteger('discount')->nullable();
            $table->unsignedInteger('discount_price')->nullable();
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
        Schema::dropIfExists('package_pricings');
    }
};
