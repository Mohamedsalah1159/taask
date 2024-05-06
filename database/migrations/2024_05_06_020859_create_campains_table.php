<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campains', function (Blueprint $table) {
            $table->id();
            $table->string('campain_name', 150);
            $table->enum('type', ['live','ready']);
            $table->string('video', 50)->nullable();
            $table->text('description')->nullable();
            $table->json('brands')->nullable();
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
        Schema::dropIfExists('campains');
    }
}
