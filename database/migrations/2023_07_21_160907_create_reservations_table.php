<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('layanan_id')->nullable(false);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->float('fee', 36, 2)->nullable(false);
            $table->string('fee_for', 20)->nullable(false);
            $table->float('extra_fee', 36, 2);
            $table->float('total', 36, 2)->nullable(false);
            $table->string('status', 20)->nullable(false);
            $table->timestamp('expired_payment')->nullable();
            $table->text('receipt')->nullable();
            $table->string('created_by', 50);
            $table->string('canceled_by', 50)->nullable();
            $table->string('approved_by', 50)->nullable();
            $table->timestamps();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->index('layanan_id');
            $table->foreign('layanan_id')->references('id')->on('layanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
