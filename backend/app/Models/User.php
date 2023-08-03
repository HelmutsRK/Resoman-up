<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'show_in_list',
        'is_active',
        'allow_login'
    ];

    protected array $validation_rules = [
        'email' => 'required|email:rfc,dns'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if ($model->password) {
                $model->password = Hash::make($model->password);
            }
        });

//        self::created(function ($model) {
//            $profile = Profile::where(['user_id' => $model->id])->first();
//            if (!$profile) {
//                Profile::insert(['user_id' => $model->id]);
//            }
//        });
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getValidationRules(): array
    {
        return $this->validation_rules;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(UserSkill::class, 'user_id', 'id');
    }
}
