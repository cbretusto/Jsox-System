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
            $table->unsignedTinyInteger('rcm_internal_control_counter')->unsigned();
            $table->string('category')->nullable();
            $table->string('fiscal_year')->nullable();
            $table->string('first_half')->nullable();
            $table->string('assessed_by')->comment = 'Approver - IAS Jr Auditor (First Half)';
            $table->string('view_assessed_by')->comment = 'view only';
            $table->string('checked_by')->comment = 'Approver - IAS General Manager (First Half)';
            $table->string('view_checked_by')->comment = 'view only';
            $table->string('concerned_dept')->nullable();
            $table->string('non_key_control')->nullable();
            $table->string('dic_status')->nullable();
            $table->string('oec_status')->nullable();
            $table->string('second_half')->nullable();
            $table->string('second_half_assessed_by')->comment = 'Approver - IAS Jr Auditor (Second Half)';
            $table->string('view_second_half_assessed_by')->comment = 'view only';
            $table->string('second_half_checked_by')->comment = 'Approver - IAS General Manager (Second Half)';
            $table->string('view_second_half_checked_by')->comment = 'view only';
            $table->longText('rf_improvement')->nullable();
            $table->string('rf_status')->nullable();
            $table->string('follow_up_assessed_by')->nullable();
            $table->string('follow_up_checked_by')->nullable();
            $table->longText('fu_improvement')->nullable();
            $table->string('fu_status')->nullable();
            $table->string('yec_approved_date')->nullable();
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
