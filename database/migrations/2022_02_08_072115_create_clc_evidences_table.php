<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClcEvidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clc_evidences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date_uploaded');
            $table->string('fiscal_year');
            $table->string('audit_period');
            $table->string('clc_category');
            $table->string('uploaded_file');
            $table->string('uploaded_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('clc_evidences');
    }
}
