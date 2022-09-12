<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionHistoryConcernDeptSectInchargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_history_concern_dept_sect_incharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plc_module_id')->nullable()->comment = 'revision history ID';
            $table->string('category')->nullable();
            $table->string('groupby')->nullable()->comment = 'count per card';
            $table->string('counter')->nullable();
            $table->longText('concern_dept_sect')->nullable();
            $table->longText('in_charge')->nullable();
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
        Schema::dropIfExists('revision_history_concern_dept_sect_incharges');
    }
}
