<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_id')->nullable();
            $table->bigInteger('transaction_type');
            $table->double('value');
            $table->date('date');
            $table->text('support')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->double('commission')->default(0);
            $table->bigInteger('user_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('transaction_type')->references('id')->on('transaction_types');
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
