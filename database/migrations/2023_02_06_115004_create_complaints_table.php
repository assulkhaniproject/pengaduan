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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_complaint_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->text('description');
            $table->enum('status', ['Waiting', 'Approved', 'Decline', 'Finish'])->default('Waiting');
            $table->text('notes')->nullable();
            $table->longText('location')->nullable();
            // $table->text('latitude')->nullable();
            // $table->text('longitude')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_complaint_id')->references('id')->on('category_complaints');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
};
