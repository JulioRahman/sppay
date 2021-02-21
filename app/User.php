<?php

namespace App;

use App\Role\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
    ];

    /**
     * @param string $roles
     * @return $this
     */
    public function setRole(string $role)
    {
        $this->setAttribute('role', $role);
        return $this;
    }

    /***
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        return $role === $this->getRole();
    }

    /**
     * @return string
     */
    public function getRole()
    {
        $role = $this->getAttribute('role');

        if (is_null($role)) {
            $role = "";
        }

        return $role;
    }

    public function isStudent()
    {
        return $this->hasRole(UserRole::ROLE_STUDENT);
    }

    public function isOperator()
    {
        return $this->hasRole(UserRole::ROLE_OPERATOR);
    }

    /**
     * Get the payments for the operator.
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    /**
     * Get the student for the student user.
     */
    public function student()
    {
        return $this->hasOne('App\Student');
    }
}
