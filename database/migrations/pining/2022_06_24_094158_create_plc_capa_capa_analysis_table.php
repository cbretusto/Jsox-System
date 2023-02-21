<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlcCapaCapaAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plc_capa_capa_analysis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plc_capa_id');
            $table->string('category');
            $table->string('counter');
            $table->string('capa_analysis');
            $table->text('capa_analysis_attachment');
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show,1-hide';
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
        Schema::dropIfExists('plc_capa_capa_analysis');
    }
}
