<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_fees', function (Blueprint $table) {
            $table->id();
            $table->uuid('reservation_id')->nullable(false);
            $table->unsignedBigInteger('facility_id')->nullable(false);
            $table->float('fee', 36, 2)->nullable(false);
            $table->timestamps();
            $table->index('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->index('facility_id');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_fees');
    }
}
