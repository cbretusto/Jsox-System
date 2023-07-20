<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditFindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_findings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year');
            $table->bigInteger('yec_audit_findings');
            $table->bigInteger('dtt_audit_findings');
            $table->bigInteger('pmi_audit_findings');
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
        Schema::dropIfExists('audit_findings');
    }
}
