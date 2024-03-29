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
        Schema::table('users', function (Blueprint $table) {
            $table->string('usertype');
            $table->string('verified');
            $table->string('userslug');
            $table->string('sport')->nullable();
            $table->string('staffid')->nullable();
            $table->string('firstlogin')->nullable();
            $table->string('following')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
