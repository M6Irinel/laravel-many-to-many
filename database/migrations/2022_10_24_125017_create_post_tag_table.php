<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $t) {
            $t->unsignedBigInteger('post_id');
            $t->unsignedBigInteger('tag_id');

            $t->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $t->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $t->primary(['post_id', 'tag_id']);
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
