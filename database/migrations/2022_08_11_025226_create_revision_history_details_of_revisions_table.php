<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionHistoryDetailsOfRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_history_details_of_revisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plc_module_id')->nullable()->comment = 'revision history ID';
            $table->string('category')->nullable();
            $table->string('groupby')->nullable()->comment = 'count per card';
            $table->string('counter')->nullable();
            $table->longText('details_of_revision')->nullable();
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
        Schema::dropIfExists('revision_history_details_of_revisions');
    }
}