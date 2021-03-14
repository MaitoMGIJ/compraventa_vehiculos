<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license');
            $table->bigInteger('type');
            $table->bigInteger('brand');
            $table->bigInteger('reference');
            $table->integer('model');
            $table->string('color');
            $table->text('photo')->nullable();
            $table->text('comment');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('type')->references('id')->on('vehicle_types');
            $table->foreign('brand')->references('id')->on('vehicle_brands');
            $table->foreign('reference')->references('id')->on('vehicle_references');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
