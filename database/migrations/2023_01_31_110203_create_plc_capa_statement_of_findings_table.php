<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlcCapaStatementOfFindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plc_capa_statement_of_findings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('plc_capa_id')->unsigned();
            $table->string('category')->nullable();
            $table->string('assessment_status')->default(0)->comment = '0-DIC,1-OEC,2-RFA';
            $table->string('counter')->nullable();
            $table->longText('statement_of_findings')->nullable();
            $table->longText('dic_statement_of_findings')->nullable();
            $table->text('dic_attachment')->nullable();
            $table->longText('oec_statement_of_findings')->nullable();
            $table->text('oec_attachment')->nullable();
            $table->longText('rfa_statement_of_findings')->nullable();
            $table->text('rfa_attachment')->nullable();
            $table->longText('capa_analysis')->nullable();
            $table->text('capa_analysis_attachment')->nullable();
            $table->longText('corrective_action')->nullable();
            $table->text('corrective_action_attachment')->nullable();
            $table->longText('preventive_action')->nullable();
            $table->text('preventive_action_attachment')->nullable();
            $table->string('commitment_date');
            $table->string('in_charge')->nullable();
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
        Schema::dropIfExists('plc_capa_statement_of_findings');
    }
}
