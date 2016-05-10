<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionSubmissionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_submission', function (Blueprint $table) {
            $table->integer('competition_id')->unsigned()->index();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->integer('submission_id')->unsigned()->index();
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->primary(['competition_id', 'submission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competition_submission');
    }
}
