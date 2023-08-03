<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'employee_type_id',
        'position_id',
        'department_id',
        'phone',
        'first_day_of_work',
        'cost_rate',
        'bill_rate',
        'utilization_target'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employeeType(): HasOne
    {
        return $this->hasOne(EmployeeType::class, 'id', 'employee_type_id');
    }

    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function position(): HasOne
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
