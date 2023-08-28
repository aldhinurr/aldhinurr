<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_service_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('repair_service_id')->nullable(false);
            $table->uuid('floor_id')->nullable(false);
            $table->string('name', 200)->nullable(false);
            $table->float('cost')->nullable(false);
            $table->index('repair_service_id');
            $table->foreign('repair_service_id')->references('id')->on('repair_services')->onDelete('cascade');
            $table->index('floor_id');
            $table->foreign('floor_id')->references('id')->on('floors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_service_details');
    }
}
