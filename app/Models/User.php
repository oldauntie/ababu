<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Traits\UUID;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use UUID;


    protected $keyType = 'string';
    # public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale_id', 
        'registration', 
        'phone', 
        'mobile',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'role_user');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }


    /**
     * Check if user can cure a certain Pet
     *
     * @param  \App\Pet $pet
     */
    public function canCure(Pet $pet)
    {
        if ($this->roles()->where('clinic_id', $pet->clinic_id)->first())
        {
            return true;
        }
        return false;
    }


    /**
     * Check if user belongs to a clinic
     *
     * @param int $clinic_id
     */
    public function belongsToClinic($clinic_id)
    {
        if ($this->roles()->where('clinic_id', $clinic_id)->first())
        {
            return true;
        }
        return false;
    }


    /**
     * Check if user has any of a role
     *
     * @param array $roles
     */
    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first())
        {
            return true;
        }
        return false;
    }

    /**
     * Check if user has a role
     *
     * @param string $role
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first())
        {
            return true;
        }
        return false;
    }

    /**
     * Check if user has any of a role in a clinic
     *
     * @param array $roles
     * @param int $clinic_id
     */
    public function hasAnyRolesByClinicId($roles, $clinic_id)
    {
        if ($this->roles()->whereIn('name', $roles)->where('clinic_id', $clinic_id)->first())
        {
            return true;
        }
        return false;
    }


    /**
     * Check if user has a role in a clinic
     *
     * @param string $roles
     * @param int $clinic_id
     */
    public function hasRoleByClinicId($role, $clinic_id)
    {
        if ($this->roles()->where('name', $role)->where('clinic_id', $clinic_id)->first())
        {
            return true;
        }
        return false;
    }

    /**
     * Check if user is root
     *
     */
    public function isRoot()
    {
        return $this->hasRole('root');
    }
}
