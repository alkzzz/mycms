<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori')->unsigned();
            $table->integer('urutan')->unsigned();
            $table->string('title_id');
            $table->string('slug_id')->unique();
            $table->text('content_id');
            $table->string('title_en');
            $table->string('slug_en')->unique();
            $table->text('content_en');
            $table->integer('id_gambar')->unsigned();
            $table->string('file');
            $table->string('link');
            $table->string('post_type');
            $table->boolean('has_child')->default(false);
            $table->integer('post_parent')->default(0);
            $table->timestamps();

            $table->foreign('id_kategori')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

            $table->foreign('id_gambar')
                  ->references('id')->on('sliders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
