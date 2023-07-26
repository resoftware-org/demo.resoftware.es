<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing courses
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->bigInteger('author_id')->unsigned(); // users.id bigint(20) unsigned
            $table->integer('category_id')->unsigned()->nullable(); // categories.id int(10) unsigned
            $table->string('title');
            $table->string('seo_title')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description');
            $table->string('image')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->boolean('featured')->default(0);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        // Create table for storing downloads related to courses
        Schema::create('downloads', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('author_id')->unsigned();
            $table->integer('course_id')->unsigned(); // courses.id int(10) unsigned
            $table->string('title');
            $table->text('excerpt')->nullable();
            $table->string('file');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('downloads');
        Schema::dropIfExists('courses');
    }
};
