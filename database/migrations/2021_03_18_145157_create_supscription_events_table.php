<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupscriptionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supscription_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supscription_id');
            $table->string('provider');
            $table->json('receipt');
            $table->decimal('cash',18,2);
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
        Schema::dropIfExists('supscription_events');
    }
}
