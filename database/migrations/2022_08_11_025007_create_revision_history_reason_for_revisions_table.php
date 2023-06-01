<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionHistoryReasonForRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_history_reason_for_revisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('plc_module_id')->unsigned()->comment = 'revision history ID';
            $table->string('category')->nullable();
            $table->string('groupby')->nullable()->comment = 'count per card';
            $table->string('counter')->nullable();
            $table->longText('reason_for_revision')->nullable();
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
        Schema::dropIfExists('revision_history_reason_for_revisions');
    }
}
