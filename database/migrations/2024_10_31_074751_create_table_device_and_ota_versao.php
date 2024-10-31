<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeviceAndOtaVersao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 30);
            $table->string('slug', 10)->nullable();
            $table->timestamps();
        });

        Schema::create('ota_versao', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_device');
            $table->integer('version');
            $table->boolean('ativa');
            $table->text('descricao')->nullable();
            $table->foreign('id_device')->references('id')->on('device');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ota_versao');
        Schema::dropIfExists('devices');
    }
}
