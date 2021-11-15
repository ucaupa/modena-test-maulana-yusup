<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'nik',
        'name',
        'email',
        'email_verified_at',
        'phone',
        'bank_name',
        'bank_account',
        'has_npwp',
        'npwp',
        'postal_code',
        'sub_district',
        'district',
        'city',
        'province_id',
        'address',
        'organization_id',
        'role_id',
        'password',
        'is_active',
        'is_access_mobile',
        'cti_usage',
        'tmm',
        'limit_days',
        'limit_amount',
        'warehouse_request',
        'erp_user_id',
        'photo_profile_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo_profile_path ? Storage::url($this->photo_profile_path) : null;
    }

    /**
     * Get the item associated with the model.
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'key', 'role_id');
    }

    /**
     * Get the item associated with the model.
     */
    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }
}
