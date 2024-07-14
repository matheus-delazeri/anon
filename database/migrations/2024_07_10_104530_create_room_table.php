<?php

use App\Enums\UserRoleEnum;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('owner_id')->nullable(false)->constrained('users');
            $table->string('name')->nullable(false);
            $table->text('description')->nullable(false);
            $table->softDeletes();
        });

        Schema::create('room_user', function (Blueprint $table) {
            $table->foreignId('room_id');
            $table->foreignId('user_id');
            $table->enum('role', UserRoleEnum::cases())->default(UserRoleEnum::PARTICIPANT);
            $table->boolean('is_banned')->default(false);
            $table->primary(['room_id', 'user_id']);
        });

        Schema::create('room_invites', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at');
            $table->integer('expires_in')->default(3600);
            $table->foreignId('room_id')->nullable(false)->constrained('rooms');
            $table->enum('role_granted', UserRoleEnum::cases());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
        Schema::dropIfExists('room_user');
    }
};
