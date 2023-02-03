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
        Schema::create('notes_pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id');
            $table->foreignId('user_id');
            $table->text('notes')->nullable();
            $table->string('tindakan')->nullable();
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
        Schema::dropIfExists('notes_pengaduan');
    }
};
