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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('code')->nullable();
            $table->string('keyword')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('mrp')->nullable();
            $table->string('selling')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();
            $table->text('long_description')->nullable();

            // Define foreign key separately
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
