<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPlcEvidences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plc_evidences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fiscal_year')->nullable();
            $table->string('audit_period')->nullable();
            $table->string('plc_category')->nullable();
            $table->string('plc_evidences')->nullable();
            $table->string('date_uploaded')->nullable();
            $table->string('uploaded_by')->nullable();
            $table->string('revised_by')->nullable();
            $table->string('revised_date')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('tbl_plc_evidences');
    }
}
