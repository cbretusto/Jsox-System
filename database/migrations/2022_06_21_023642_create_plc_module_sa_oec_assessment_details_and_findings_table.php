<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlcModuleSaOecAssessmentDetailsAndFindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plc_module_sa_oec_assessment_details_and_findings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sa_id')->unsigned();
            $table->string('category')->nullable();
            $table->string('counter')->nullable();
            $table->string('oec_assessment_details_findings')->nullable();
            $table->string('oec_status')->nullable();
            $table->text('oec_attachment')->nullable();
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
        Schema::dropIfExists('plc_module_sa_oec_assessment_details_and_findings');
    }
}
