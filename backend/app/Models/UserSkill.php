<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'skill_id',
        'rating',
    ];



    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function skill(): HasMany
    {
        return $this->hasMany(Skill::class, 'id', 'skill_id');
    }
}
