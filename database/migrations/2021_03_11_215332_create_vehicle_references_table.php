<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_references', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand');
            $table->string('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('brand')->references('id')->on('vehicle_brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_references');
    }
}
