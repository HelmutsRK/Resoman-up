<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'phone', 'reg_number'
    ];

    protected array $validation_rules = [
        'name' => 'required',
    ];

    public function getValidationRules(): array
    {
        return $this->validation_rules;
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
