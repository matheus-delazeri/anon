<?php

namespace App\Models\Room;

use App\Enums\UserRoleEnum;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'expires_in',
        'role_granted',
        'hash'
    ];

    protected $casts = [
        'role_granted' => UserRoleEnum::class,
        'created_at' => 'datetime'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            $model->hash = Str::random();
        });
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function link()
    {
        return route('invite', ['hash' => $this->hash]);
    }

    public function isExpired()
    {
        $expiresAt = $this->created_at->addSeconds($this->expires_in);
        return now()->greaterThan($expiresAt);
    }

}
