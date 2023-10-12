<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 200)->nullable(false);
            $table->string('status', 50)->default("Baru");
            $table->string('unit', 100)->nullable();
            $table->float('total', 12)->nullable()->default(0);
            $table->text('attachment')->nullable();
            $table->string('description', 200)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->string('processed_by', 50)->nullable();
            $table->timestamps();
            $table->timestamp('processed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_services');
    }
}
