<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClcCategoryPmiClcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clc_category_pmi_clc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('status')->default(0)->comment = '1-active,2-Inactive';
            $table->string('fiscal_year');
            $table->string('titles');
            $table->string('control_objectives');
            $table->string('internal_controls');
            $table->string('g_ng');
            $table->string('detected_problems_improvement_plans');
            $table->string('review_findings');
            $table->string('follow_up_details');
            $table->string('g_ng_last');
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
        Schema::dropIfExists('clc_category_pmi_clc');
    }
}
