<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportServiceImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_service_images', function (Blueprint $table) {
            $table->id();
            $table->uuid('report_service_id')->nullable(false);
            $table->text('image')->nullable();
            $table->enum('status', ['SEBELUM', 'SESUDAH']);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->index('report_service_id');
            $table->foreign('report_service_id')->references('id')->on('report_serviceS')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_service_images');
    }
}
