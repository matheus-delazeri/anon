<?php

namespace App\Models\Room;

use App\Enums\UserRoleEnum;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'expires_in',
        'role_granted'
    ];

    protected $casts = [
        'role_granted' => UserRoleEnum::class,
        'created_at' => 'datetime'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
