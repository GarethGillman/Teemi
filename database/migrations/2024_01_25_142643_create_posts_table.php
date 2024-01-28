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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('title');
            $table->string('slug');
            $table->string('type');
            $table->longText('description', 160);
            $table->string('excerpt');
            $table->string('status');
            $table->string('visibility');
            $table->string('commenting');
            $table->dateTime('scheduled');
            $table->string('seotitle');
            $table->string('seodesc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
