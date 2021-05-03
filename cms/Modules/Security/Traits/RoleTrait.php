<?php

namespace Modules\Security\Traits;

use Closure;
use Fideloper\Proxy\TrustedProxyServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Security\Entities\Role;
use Illuminate\Support\Facades\Cache;

trait RoleTrait
{
    private $_isSuperAdmin = null;
    private $_isAdmin = null;
    private $_isStaff = null;
    private $_isCustomer = null;

    /**
     * Returns the user roles
     *
     * @param string $type the type of roles to return. Default all
     * @param Closure $callback A call that can be use to alter the query
     *
     * @return Relation;
     */
    public function roles(Closure $callback = null)
    {
        $query = $this->morphToMany(Role::class, 'entity_roles')->where('company_id', company()->id);

        if ($callback) {
            $callback($query);
        }

        return $query;
    }

    /**
     *
     */
    public function isSuperAdmin(): bool
    {

        if ($this->_isSuperAdmin === null) {
            $this->_isSuperAdmin =  $this->roles()->where('alias', Role::ROLE_SUPER_ADMIN)->count() > 0;
            if ($this->_isSuperAdmin) {
                $this->_isAdmin = true;
                $this->_isStaff = true;
            }
        }

        return $this->_isSuperAdmin;
    }

    public function isAdmin(): bool
    {

        if ($this->_isAdmin === null) {
            $this->_isAdmin = false;

            $collection = $this->roles(function ($query) {
                $query->whereIn('alias', [
                    Role::ROLE_SUPER_ADMIN,
                    Role::ROLE_ADMIN
                ]);
            })->get();

            $collection->each(function ($role) {
                switch ($role->alias) {
                    case Role::ROLE_SUPER_ADMIN:
                        $this->_isSuperAdmin = true;
                        $this->_isAdmin = true;
                        $this->_isStaff = true;
                        break;
                    case Role::ROLE_ADMIN:
                        $this->_isAdmin = true;
                        $this->_isStaff = true;
                        break;
                }
            });
        }


        return $this->_isAdmin;
    }


    public function isStaff(): bool
    {
        if ($this->_isStaff === null) {
            $this->_isStaff = false;

            $collection = $this->roles(function ($query) {
                $query->whereIn('alias', [
                    Role::ROLE_SUPER_ADMIN,
                    Role::ROLE_ADMIN,
                    Role::ROLE_STAFF
                ]);
            })->get();

            $collection->each(function ($role) {
                switch ($role->alias) {
                    case Role::ROLE_SUPER_ADMIN:
                        $this->_isSuperAdmin = true;
                        $this->_isAdmin = true;
                        $this->_isStaff = true;
                        break;
                    case Role::ROLE_ADMIN:
                        $this->_isAdmin = true;
                        $this->_isStaff = true;
                        break;
                    default:
                        $this->_isStaff = true;
                }
            });
        }

        return $this->_isStaff;
    }


    public function isCustomer()
    {
        $this->_isCustomer =  $this->roles(function ($query) {
            $query->where('alias', Role::ROLE_CUSTOMER);
        })->count() > 0;

        return $this->_isCustomer;
    }
}
