<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->string('judul_topic', 255);
            $table->text('isi_konten');
            $table->boolean('is_locked')->default(false);
            $table->timestamps();

            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
        });

        Schema::create('forum_komentars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('users_id');
            $table->text('isi_komentar');
            $table->timestamps();

            $table->foreign('topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
            $table->foreign('users_id')->references('users_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_komentars');
        Schema::dropIfExists('forum_topics');
    }
};
