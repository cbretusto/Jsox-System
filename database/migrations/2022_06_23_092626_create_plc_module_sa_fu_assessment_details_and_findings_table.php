<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlcModuleSaFuAssessmentDetailsAndFindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plc_module_sa_fu_assessment_details_and_findings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sa_id')->unsigned();
            $table->string('category')->nullable();
            $table->string('counter')->nullable();
            $table->string('fu_assessment_details_findings')->nullable();
            $table->text('fu_attachment')->nullable();
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
        Schema::dropIfExists('plc_module_sa_fu_assessment_details_and_findings');
    }
}
