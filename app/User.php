<?php

namespace App;

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
        return $role === $this->getRoles();
    }

    /***
     * @param $role
     * @return mixed
     */
    public function hasRoles($role)
    {
        $currentRole = $this->getRoles();
        if (!$role === $currentRole) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getRoles()
    {
        $role = $this->getAttribute('role');

        if (is_null($role)) {
            $role = "";
        }

        return $role;
    }
}
