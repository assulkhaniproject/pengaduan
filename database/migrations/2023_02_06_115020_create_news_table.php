<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_news_id')->unsigned();
            $table->string('title', 100);
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->text('image');
            $table->timestamps();

            // foreign key for catyegory_news
            $table->foreign('category_news_id')->references('id')->on('category_news');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
