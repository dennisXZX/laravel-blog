<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('post_id')->unsigned();
            // this specifies 'post_id' is a foreign key which references the 'id' column in 'posts' table
            $table->foreign('post_id')->references('id')->on('posts');

            $table->integer('tag_id')->unsigned();
            // this specifies 'tag' is a foreign key which references the 'id' column in 'tags' table
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
