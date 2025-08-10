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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('auth_id');
            $table->string('created_by',100);
            $table->string('name',100)->unique();
            $table->string('url_key',155);
            $table->string('title',100);
            $table->string('keywords',155)->nullable();
            $table->string('description',155)->nullable();
            $table->string('short_description')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('tag')->nullable();
            $table->string('video_url')->nullable();
            $table->string('status',25)->default('Active');
            $table->datetime('published_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
