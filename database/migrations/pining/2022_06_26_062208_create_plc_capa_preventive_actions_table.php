<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlcCapaPreventiveActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plc_capa_preventive_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plc_capa_id');
            $table->string('category');
            $table->string('counter');
            $table->string('preventive_action');
            $table->text('preventive_action_attachment');
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
        Schema::dropIfExists('plc_capa_preventive_actions');
    }
}
