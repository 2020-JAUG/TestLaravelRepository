<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Address extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table)
        {
            $table->id();
            $table->string('label');
            $table->string('type');
            $table->string('road');
            $table->string('block');
            $table->string('number');
            $table->string('bis');
            $table->string('stairs');
            $table->string('floor');
            $table->string('door');
            $table->string('postal_code');
            $table->string('locality');
            $table->string('province');
            $table->string('country');
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
        Schema::dropIfExists('addresses');
    }
}