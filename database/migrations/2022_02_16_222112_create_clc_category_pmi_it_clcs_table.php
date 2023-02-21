<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClcCategoryPmiItClcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clc_category_pmi_it_clcs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('pmi_it_clc_assessment_status')->default(0)->comment = '1-active,2-Inactive';
            $table->string('fiscal_year');
            $table->string('control_objectives');
            $table->string('internal_controls');
            $table->string('g_ng');
            $table->string('detected_problems_improvement_plans');
            $table->string('review_findings');
            $table->string('follow_ups');
            $table->string('status_last');
            $table->string('g_ng_last');
            $table->unsignedTinyInteger('uploaded_file_status')->default(1)->comment = '1-with file,2-without file';
            $table->string('created_by');
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
        Schema::dropIfExists('clc_category_pmi_it_clcs');
    }
}
