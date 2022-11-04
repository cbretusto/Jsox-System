<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionHistoryDeptSectConformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_history_dept_sect_conformances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('conformance_id')->unsigned()->comment = 'revision history conformance ID';
            $table->string('category')->nullable();
            $table->string('counter')->nullable();
            $table->longText('dept_sect')->nullable();
            $table->longText('name')->nullable();
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show,1-hide';
            $table->timestamps();
            
            // Foreign Key
            $table->foreign('conformance_id')->references('id')->on('revision_history_conformances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revision_history_dept_sect_conformances');
    }
}
