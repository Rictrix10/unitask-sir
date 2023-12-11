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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('id_task');
            $table->string('name');
            $table->text('description');
            $table->boolean('favorite');
            $table->string('image')->nullable();
            $table->date('initial_date')->nullable();
            $table->date('finish_date')->nullable();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');

            $table->unsignedBigInteger('id_state');
            $table->foreign('id_state')->references('id_state')->on('states');

            $table->unsignedBigInteger('id_priority');
            $table->foreign('id_priority')->references('id_priority')->on('priorities');

            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id_category')->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};


