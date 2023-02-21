<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPLCModuleSa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plc_module_sa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rcm_id')->unsigned();
            $table->string('category');
            $table->string('fiscal_year');
            $table->string('assessed_by')->comment = 'Approver - IAS Jr Auditor (First Half)';
            $table->string('view_assessed_by')->comment = 'view only';
            $table->string('checked_by')->comment = 'Approver - IAS General Manager (First Half)';
            $table->string('view_checked_by')->comment = 'view only';
            $table->string('concerned_dept');
            $table->string('non_key_control');
            $table->string('dic_status');
            $table->string('oec_status');
            $table->string('second_half_assessed_by')->comment = 'Approver - IAS Jr Auditor (Second Half)';
            $table->string('view_second_half_assessed_by')->comment = 'view only';
            $table->string('second_half_checked_by')->comment = 'Approver - IAS General Manager (Second Half)';
            $table->string('view_second_half_checked_by')->comment = 'view only';
            $table->longText('rf_improvement');
            $table->string('rf_status');
            $table->longText('fu_improvement');
            $table->string('fu_status');
            $table->string('yec_approved_date');
            $table->unsignedTinyInteger('approver_status')->default(0)->comment = '0-For Update/Approval of Jr. Auditor, 1-Approval of IAS Manager, 2-(1st Half) Approved & (2nd half)For Approval Junior Auditor, 3-(1st Half) Approved & (2nd half) For Approval -IAS Manager, 4-Approved';
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show,1-hide';
            $table->timestamps();

            $table->foreign('rcm_id')->references('id')->on('tbl_plc_module_rcm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_plc_module_sa');
    }
}
