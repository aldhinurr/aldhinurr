<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['MENUNGGU', 'SEDANG DIPERIKSA', 'SEDANG DIKERJAKAN', 'SELESAI', 'DIALIHKAN'])->nullable();
            $table->string('jenis', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
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
        Schema::dropIfExists('report_services');
    }
}
