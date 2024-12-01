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
            $table->string('reference')->unique();
            $table->uuid('parent_id')->nullable()->index();
            $table->string('channel')->index();
            $table->string('status');
            $table->string('title');
            $table->text('description');
            $table->timestamp('flashed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
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