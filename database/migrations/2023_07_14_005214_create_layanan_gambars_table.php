<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananGambarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_gambars', function (Blueprint $table) {
            $table->id();
            $table->uuid('layanan_id')->nullable(false);
            $table->longText('picture')->nullable(false);
            $table->enum('status', array("AKTIF", "TIDAK AKTIF", "DIHAPUS"));
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->string('deleted_by', 50)->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('layanan_gambars', function (Blueprint $table) {
            $table->dropForeign('gambar_layanans_layanan_id_foreign');
            $table->dropIndex('gambar_layanans_layanan_id_index');
            $table->dropColumn('layanan_id');
        });
    }
}
