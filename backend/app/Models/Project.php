<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'name',
        'number',
        'start_date',
        'end_date',
        'budget',
        'hours',
        'profit_target',
    ];

    protected array $validation_rules = [
        'name' => 'required',
        'number' => 'required',
        'customer_id' => 'nullable|exists:App\Models\Customer,id',
        'budget' => 'nullable|numeric',
        'hours' => 'nullable|numeric|min:0',
        'profit_target' => 'nullable|numeric|min:0'
    ];

    public function getValidationRules(): array
    {
        return $this->validation_rules;
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function skills(): HasManyThrough
    {
        return $this->hasManyThrough(
            Skill::class,
            ProjectSkill::class,
            'project_id',
            'id',
            'id',
            'skill_id'
        );
    }

    public function members(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            ProjectMember::class,
            'project_id',
            'id',
            'id',
            'user_id'
        );
    }
}
