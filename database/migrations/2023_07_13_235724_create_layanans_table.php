<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->enum('type', array("RUANG", "KENDARAAN"));
            $table->string('name')->nullable(false);
            $table->longText('description')->nullable();
            $table->longText('address')->nullable();
            $table->enum('location', array("GANESHA", "SARAGA", "JATINANGOR", "CIREBON"))->nullable();
            $table->float('price', 36, 2);
            $table->enum('price_for', array("JAM", "HARI"));
            $table->enum('status', array("AKTIF", "TIDAK AKTIF", "RUSAK", "TIDAK BISA DISEWA", "DIHAPUS"));
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->string('deleted_by', 50)->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layanans');
    }
}
