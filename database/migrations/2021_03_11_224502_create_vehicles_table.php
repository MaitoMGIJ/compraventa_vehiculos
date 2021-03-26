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
            $table->date('insurance_expiration')->nullable();
            $table->date('technomechanical_expiration')->nullable();
            $table->text('photo')->nullable();
            $table->text('comment');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('vehicles');
    }
}
