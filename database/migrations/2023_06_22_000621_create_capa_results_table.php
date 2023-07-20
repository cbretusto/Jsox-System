<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapaResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capa_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fiscal_year')->nullable();
            $table->string('audit_period')->nullable();
            $table->string('dept_sect')->nullable();
            $table->string('capa')->nullable();
            $table->string('uploaded_by')->nullable();
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
        Schema::dropIfExists('capa_results');
    }
}
