<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClcCategoryPmiFcrpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clc_category_pmi_fcrps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('status')->default(0)->comment = '1-active,2-Inactive';
            $table->string('fiscal_year')->nullable();
            $table->string('no')->nullable();
            $table->string('titles')->nullable();
            $table->string('control_objectives')->nullable();
            $table->string('internal_controls')->nullable();
            $table->string('g_ng')->nullable();
            $table->string('detected_problems_improvement_plans')->nullable();
            $table->string('review_findings')->nullable();
            $table->string('follow_up_details')->nullable();
            $table->string('g_ng_last')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('clc_category_pmi_fcrps');
    }
}
