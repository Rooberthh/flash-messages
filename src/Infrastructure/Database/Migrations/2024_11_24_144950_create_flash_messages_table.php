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
        Schema::create('flash_messages', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference')->unique();
            $table->uuid('parent_id')->nullable()->index();
            $table->string('channel')->index();
            $table->string('status');
            $table->string('title');
            $table->text('description');
            $table->boolean('temporary');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('parent_id')->on('flash_messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_messages');
    }
};
