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

    public function biometrics()
    {
        return $this->hasMany(Biometric::class);
    }

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class, 'role_user');
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    public function setting()
    {
        return $this->hasOne(Setting::class)->withDefault([
            # default settings. no database record is created
            'show_sidebar' => 1,
        ]);;
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }


    /**
     * Check if user has an exact role
     *
     * @param string $role
     */
    public function isRole($role, Clinic $clinic)
    {
        if ($this->roles()->where('role', $role)->where('clinic_id', $clinic->id)->first()) {
            return true;
        }
        return false;
    }


    /**
     * Check if user has a minimun role
     *
     * @param string $role
     */
    public function hasRole($role, Clinic $clinic)
    {
        if ($this->roles()->where('clinic_id', $clinic->id)->first() != null && Role::select('weight')->where('role', $role)->first() != null && $this->roles()->where('clinic_id', $clinic->id)->first()->weight >= Role::select('weight')->where('role', $role)->first()->weight) {
            return true;
        }
        return false;
    }

    /**
     * Check if user has any of a role in a clinic
     *
     * @param array $roles
     * @param Clicni $clinic
     */
    public function hasAnyRoles($roles, Clinic $clinic)
    {
        if ($this->roles()->whereIn('role', $roles)->where('clinic_id', $clinic->id)->first()) {
            return true;
        }
        return false;
    }
}
