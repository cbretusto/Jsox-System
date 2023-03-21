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
            $table->string('date_uploaded')->nullable();
            $table->string('fiscal_year')->nullable();
            $table->string('audit_period')->nullable();
            $table->string('clc_category')->nullable();
            $table->string('uploaded_file')->nullable();
            $table->string('uploaded_by')->nullable();
            $table->string('updated_by')->nullable();
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
