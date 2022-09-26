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
        Schema::create('marriges', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('phone');
            $table->text('password');
            $table->text('about')->nullable();
            $table->text('nid_card')->nullable();
            $table->text('profile_pic')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('educational_status')->nullable();
            $table->text('family_member')->nullable();
            $table->text('home_districts')->nullable();
            $table->text('monthly_income')->nullable();
            $table->text('height')->nullable();
            $table->text('color')->nullable();
            $table->text('present_address')->nullable();
            $table->text('work_type')->nullable();
            $table->text('image1')->nullable();
            $table->text('image2')->nullable();
            $table->text('image3')->nullable();
            $table->text('image4')->nullable();
            $table->text('interested')->nullable();
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
        Schema::dropIfExists('marriges');
    }
};
