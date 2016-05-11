<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('submissions', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('competition_id');
        $table->integer('user_id');
        $table->string('type');
        $table->string('name');
        $table->text('description');
        $table->string('file_name');
        $table->string('file_path');
        $table->string('web_url');
        $table->string('cover_image');
        $table->string('pdf');
        $table->string('editors_note');
        $table->boolean('is_winner')->default(0);
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
        Schema::drop('submissions');
    }
}
