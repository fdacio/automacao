<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSinalAnteriorComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('componentes', function (Blueprint $table) {
            $table->boolean('sinal_anterior')->after('sinal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('componentes', function (Blueprint $table) {
            $table->dropColumn('sinal_anterior');
        });
    }
}
