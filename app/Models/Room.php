<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use App\Models\Room\Invite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function (Room $model) {
            $model->users()->attach($model->id, [
                'user_id' => auth()->id(),
                'role' => UserRoleEnum::ADMIN
            ]);
        });
    }

    public function invites(): HasMany
    {
        return $this->hasMany(Invite::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function creator()
    {
        return $this->users()->firstWhere('role', UserRoleEnum::ADMIN);
    }

    public function moderators()
    {
        return $this->users()->where('role', UserRoleEnum::MODERATOR);
    }

    public function participants()
    {
        return $this->users()->where('role', UserRoleEnum::PARTICIPANT);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function hasPrivileges(User $user)
    {
        return $this->moderators()->where('user_id', $user->id)->exists()
            || $this->creator()->id == $user->id;
    }
}
