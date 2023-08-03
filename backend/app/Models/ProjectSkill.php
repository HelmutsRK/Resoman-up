<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProjectSkill extends Model
{
    use HasFactory;

    public function project(): HasOne
    {
        return $this->hasOne(Project::class);
    }

    public function skill(): HasOne
    {
        return $this->hasOne(Skill::class);
    }
}
