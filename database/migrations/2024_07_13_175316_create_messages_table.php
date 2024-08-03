<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messagess', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender', false, true);
            $table->bigInteger('receiver', false, true);
            $table->text('message');
            $table->timestamps();
            $table->foreign('sender')->references('id')->on('patients');
            $table->foreign('receiver')->references('id')->on('patients');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};