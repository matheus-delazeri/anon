<?php

namespace App\Models;

use App\Enums\QuestionStatusEnum;
use App\Models\Question\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'answer',
        'status',
        'parent_id',
        'moderator_id',
        'room_id',
        'user_id'
    ];

    protected $casts = [
        'status' => QuestionStatusEnum::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): HasOne
    {
        return $this->hasOne(Question::class);
    }

    /**
     * Who declined or approved the question
     *
     * @return HasOne
     */
    public function moderator(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function approved(): bool
    {
        return $this->status == QuestionStatusEnum::APPROVED;
    }

    public function answered(): bool
    {
        return $this->status == QuestionStatusEnum::ANSWERED;
    }

    public function pending(): bool
    {
        return $this->status == QuestionStatusEnum::PENDING;
    }

    /**
     * Get the count of upvotes for the question.
     *
     * @return int
     */
    public function upvotesCount()
    {
        return $this->votes()->where('increment', '=', 1)->count();
    }

    /**
     * Get the count of downvotes for the question.
     *
     * @return int
     */
    public function downvotesCount()
    {
        return $this->votes()->where('increment', '=', -1)->count();
    }
}
