<?php

namespace App\Role;

/***
 * Class UserRole
 * @package App\Role
 */
class UserRole
{

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_OPERATOR = 'OPERATOR';
    const ROLE_STUDENT = 'STUDENT';

    /**
     * @var array
     */
    protected static $roleHierarchy = [
        self::ROLE_ADMIN => ['*'],
        self::ROLE_OPERATOR => [
            self::ROLE_STUDENT,
        ],
        self::ROLE_STUDENT => []
    ];

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role)
    {
        if (isset(self::$roleHierarchy[$role])) {
            return self::$roleHierarchy[$role];
        }

        return [];
    }

    /***
     * @return array
     */
    public static function getRoleList()
    {
        return [
            static::ROLE_ADMIN => 'Admin',
            static::ROLE_OPERATOR => 'Petugas',
            static::ROLE_STUDENT => 'Siswa',
        ];
    }
}
