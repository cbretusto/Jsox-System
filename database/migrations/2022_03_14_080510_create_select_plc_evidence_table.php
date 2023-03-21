<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectPlcEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select_plc_evidence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('plc_category_id')->unsigned();
            $table->bigInteger('plc_sa_id')->unsigned();
            $table->string('assessment_details_and_findings')->nullable();
            $table->string('plc_evidences_id')->nullable();
            $table->unsignedTinyInteger('filter')->default(0)->comment = '0-show,1-hide';
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
        Schema::dropIfExists('select_plc_evidence');
    }
}
