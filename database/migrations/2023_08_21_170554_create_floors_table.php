<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('building_id')->nullable(false);
            $table->integer('number')->nullable(false);
            $table->string('floor_classification', 20)->nullable(false);
            $table->string('room_classification', 100)->nullable(false);
            $table->string('room_description', 200)->nullable(false);
            $table->float('large')->nullable(false);
            $table->integer('capacity')->nullable();
            $table->enum('status', array("AKTIF", "TIDAK AKTIF", "DIHAPUS"));
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->string('deleted_by', 50)->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->index('building_id');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floors');
    }
}
