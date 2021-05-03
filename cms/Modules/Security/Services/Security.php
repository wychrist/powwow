<?php

namespace Modules\Security\Services;

use App\Models\User;
use Closure;
use Modules\Security\Entities\Permission;
use Modules\Security\Entities\Role;

class Security
{
    private static $cache = [];

    /**
     * Checks if the specified user has read permission
     *
     * @param string $resource The resource is question
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function canRead(
        string $resource,
        $user = null,
        string $resourceId = null,
        Closure $callback = null
    ): bool {
        return self::checkPermission(Permission::READ, $resource, $user, $resourceId, $callback);
    }


    /**
     * Checks if the specified user has "read any" permission
     *
     * @param string $resource The resource is question
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function canReadAny(
        string $resource,
        $user = null,
        string $resourceId = null,
        Closure $callback = null
    ): bool {

        return self::checkPermission(Permission::READ_ANY, $resource, $user, $resourceId, $callback);
    }


    /**
     * Checks if the specified user has "create" permission
     *
     * @param string $resource The resource is question
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function canCreate(
        string $resource,
        $user = null,
        string $resourceId = null,
        Closure $callback = null
    ): bool {

        return self::checkPermission(Permission::CREATE, $resource, $user, $resourceId, $callback);
    }


    /**
     * Checks if the specified user has "update" permission
     *
     * @param string $resource The resource is question
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function canUpdate(
        string $resource,
        $user = null,
        string $resourceId = null,
        Closure $callback = null
    ): bool {

        return self::checkPermission(Permission::UPDATE, $resource, $user, $resourceId, $callback);
    }


    /**
     * Checks if the specified user has "delete" permission
     *
     * @param string $resource The resource is question
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function canDelete(
        string $resource,
        $user = null,
        string $resourceId = null,
        Closure $callback = null
    ): bool {
        return self::checkPermission(Permission::DELETE, $resource, $user, $resourceId, $callback);
    }


    /**
     * Grant "read" permission to the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function grantRead(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {

        self::changePermission(Permission::READ, $resource, $role, $user, $resourceId);
    }

    /**
     * Revoke "read" permission from the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function revokeRead(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::revokePermission(Permission::READ, $resource, $role, $user, $resourceId);
    }

    /**
     * Grant "read any" permission to the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function grantReadAny(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::changePermission(Permission::READ_ANY, $resource, $role, $user, $resourceId);
    }


    /**
     * Revoke "read any" permission from the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function revokeReadAny(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::revokePermission(Permission::READ_ANY, $resource, $role, $user, $resourceId);
    }

    /**
     * Grant "create" permission to the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function grantCreate(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::changePermission(Permission::CREATE, $resource, $role, $user, $resourceId);
    }

    /**
     * Revoke "create" permission from the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function revokeCreate(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::revokePermission(Permission::CREATE, $resource, $role, $user, $resourceId);
    }

    /**
     * Grant "update" permission to the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function grantUpdate(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::changePermission(Permission::UPDATE, $resource, $role, $user, $resourceId);
    }

    /**
     * Revoke "update" permission from the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function revokeUpdate(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::revokePermission(Permission::UPDATE, $resource, $role, $user, $resourceId);
    }


    /**
     * Grant "delete" permission to the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function grantDelete(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::changePermission(Permission::DELETE, $resource, $role, $user, $resourceId);
    }

    /**
     * Revoke "delete" permission from the specify user or role
     *
     * @param string $resource The resource is question
     * @param string|Role $role
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function revokeDelete(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::revokePermission(Permission::DELETE, $resource, $role, $user, $resourceId);
    }

    /**
     * Grant one or more permission to the specified user or role
     *
     * @param array $permissions
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function grant(
        array $permissions,
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {

        $clean = [];

        foreach ($permissions as $name) {
            $clean[$name] = true;
        }

        self::changePermission($clean, $resource, $role, $user, $resourceId, true);
    }


    /**
     * Revoke a list of permissions from the specify user or role
     *
     * @param array $permissions List of permission. Any of [Permission::READ, Permission::READ_ANY, Permission::CREATE, Permission::UPDATE, Permission::DELETE]
     * @param string $resource The resource is question
     * @param string|Role $role
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function revoke(
        array $permissions,
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {

        $clean = [];

        foreach ($permissions as $name) {
            $clean[$name] = false;
        }

        self::changePermission($clean, $resource, $role, $user, $resourceId, false);
    }

    /**
     * Grant all permissions to the specified user or role
     *
     * @param string $resource
     * @param string|Role $role
     * @param string|User $user
     * @param string $resourceId
     *
     * @return void
     */
    public static function grantAll(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        $permission = [
            Permission::READ,
            Permission::READ_ANY,
            Permission::CREATE,
            Permission::UPDATE,
            Permission::DELETE
        ];

        self::grant($permission, $resource, $role, $user, $resourceId);
    }

    /**
     * Revoke all permissions from the specify user or role
     *
     * @param string $resource The resource is question
     * @param string|User $user The user ID or object
     * @param string $resourceId The resource ID
     * @param Closure $callback A callback to call and pass the result
     *
     * @return boolean
     */
    public static function revokeAll(
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        $permission = [
            Permission::READ,
            Permission::READ_ANY,
            Permission::CREATE,
            Permission::UPDATE,
            Permission::DELETE
        ];

        self::revoke($permission, $resource, $role, $user, $resourceId);
    }

    public static function getGroupPermission(string $resource, $role): Permission
    {
        if (!is_object($role)) {
            $role = company()->roles()->where('alias', $role)->firstOrFail();
        }

        $permission = $role->permissions()->where('resource', $resource)->first();

        if (!$permission) {
            $dummy = [
                'resource' => $resource,
            ];

            foreach (self::getPermissionArray() as $perm) {
                $dummy[$perm]  = false;
            }
            $permission = new Permission($dummy);
        }

        return $permission;
    }


    private static function checkPermission(
        string $permission,
        string $resource,
        $user,
        string $resourceId = null,
        Closure $callback = null
    ): bool {

        $user = (is_object($user)) ? $user :  User::findOrFail($user);
        $key = $resource . $resourceId . $user->id;

        if (isset(self::$cache[$key])) {
            $can = self::$cache[$key];
        } else {

            $where = [
                'resource' => $resource,
                $permission => true
            ];

            $can = Permission::where($where)->where(function ($query) use ($user, $resourceId) {
                $query->whereIn('role_alias', $user->roles()->where('company_id', company()->id)->get()->pluck('alias'));
                if ($resourceId) {
                    $query->orWhere('user_id', $user->id);
                }
            })->where(function ($query) use ($resourceId) {
                if ($resourceId) {
                    $query->where('resource_id', $resourceId)
                        ->orWhereNull('resource_id');
                }
            })->count() > 0;

            self::$cache[$key] = $can;
        }

        if ($callback) {
            $callback($can);
        }

        return $can;
    }


    private static function changePermission(
        $permission,
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null,
        bool $flag = true
    ) {

        $listOrPermissions = [];

        if (!is_array($permission)) {
            switch ($permission) {
                case Permission::CREATE:
                    $listOrPermissions[Permission::CREATE] = $flag;
                    $listOrPermissions[Permission::UPDATE] = $flag;
                    $listOrPermissions[Permission::READ] = $flag;
                    $listOrPermissions[Permission::DELETE] = $flag;
                    if (!$resourceId && !$user) {
                        $listOrPermissions[Permission::READ_ANY] = $flag;
                    }
                    break;
                case Permission::UPDATE:
                    $listOrPermissions[Permission::READ] = $flag;
                    if (!$resourceId && !$user) {
                        $listOrPermissions[Permission::READ_ANY] = $flag;
                    }
                    break;
                case Permission::DELETE:
                    $listOrPermissions[Permission::READ] = $flag;
                    if (!$resourceId && !$user) {
                        $listOrPermissions[Permission::READ_ANY] = $flag;
                    }
                    break;
                case Permission::READ_ANY:
                    if (!$resourceId && !$user) {
                        $listOrPermissions[Permission::READ_ANY] = $flag;
                    }
                    break;
                case Permission::READ:
                    $listOrPermissions[Permission::READ] = $flag;
                    break;
            }
        } else {
            $listOrPermissions = $permission;
        }


        if ($role) {
            $role = (is_object($role)) ? $role :  company()->roles()->where('alias', $role)->firstOrFail();

            $permission = Permission::firstOrNew([
                'resource' => $resource,
                'role_alias' => $role->alias
            ]);

            foreach ($listOrPermissions as $field => $value) {
                $permission->{$field} = $value;
            }
            $permission->role()->associate($role);
            $permission->save();

            // apply the permission to a role
        } elseif ($user && $resourceId) {
            $user = (is_object($user)) ? $user : User::findOrFail($user);

            $permission = Permission::firstOrNew([
                'resource' => $resource,
                'resource_id' => $resourceId,
                'user_id' => $user->id
            ]);

            foreach ($listOrPermissions as $field => $value) {
                $permission->{$field} = $value;
            }
            $permission->user()->associate($user);
            $permission->save();
        }
    }


    private static function revokePermission(
        string $permission,
        string $resource,
        $role = null,
        $user = null,
        string $resourceId = null
    ) {
        self::changePermission($permission, $resource, $role, $user, $resourceId, false);
    }

    private static function getPermissionArray(): array
    {
        return [
            Permission::CREATE,
            Permission::UPDATE,
            Permission::DELETE,
            Permission::READ,
            Permission::READ_ANY,
        ];
    }
}
