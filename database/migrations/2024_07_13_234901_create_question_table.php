<?php

use App\Enums\QuestionStatusEnum;
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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('parent_id')->nullable()->constrained('question');
            $table->foreignId('moderator_id')->nullable()->constrained('users');
            $table->foreignId('room_id')->nullable(false)->constrained('rooms');
            $table->foreignId('user_id')->nullable(false)->constrained('users');
            $table->text('content')->nullable(false);
            $table->text('answer')->nullable();
            $table->enum('status', QuestionStatusEnum::cases())->default(QuestionStatusEnum::PENDING);
        });

        Schema::create('question_vote', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('question_id');
            $table->foreignId('user_id');
            $table->enum('increment', [-1, 0, 1]);
            $table->primary(['question_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
