<?php

namespace App\Models;

use Closure;
use App\Models\Group;
use App\Traits\ModelExtendTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Security\Entities\Role;

class Company extends Group
{
    use ModelExtendTrait;

    private static $company;

    private static $defaultCompany;

    protected $defaultType = self::TYPE_COMPANY;

    public function subsidiaries(): HasMany
    {
        return $this->children(Subsidiary::class);
    }

    public function departments(): MorphToMany
    {
        return $this->groups(Department::class);
    }


    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'company_id');
    }

    /**
     * Returns the default or active company
     *
     * You can pass the active company as a
     * query string assigned to the param "com"
     *
     * @param Closure|null $callback Will be called and passed the current company
     * @return Company|null
     */
    public static function getDefault(?Closure $callback = null): ?Company
    {
        if (self::$company != null) {
            if ($callback) {
                $callback(self::$company);
            }
            return self::$company;
        }


        $company = request()->get('com');


        $defaultAlias = env('DEFAULT_COMPANY_ALIAS', 'bulbul');

        /**
         * @var User
         */
        $user = auth()->user();
        if($user) {
            $defaultAlias = $user->getCurrentCompany();
        }

        $alias = ($company) ? $company : $defaultAlias;

        $group = self::where(['alias' => $alias, 'type' => Group::TYPE_COMPANY])->first();

        if (!$group) {
            if ($alias == $defaultAlias) {

                $group = new self();
                $group->name = env('DEFAULT_COMPANY_NAME', "Bulbul");
                $group->alias = $defaultAlias;

                $group->save();

                // default subsidiary
                // The subsidiary feature is off for now
                // it is much easy to create multiple compoanies
                /*$subsidiary = new Subsidiary(
                    [
                        'name' => $group->name,
                        'alias' => $group->alias,
                        'parent_id' => $group->id
                    ]
                );

                $subsidiary->save(); */

            } else {
                $group = self::where('alias', $defaultAlias)->first();
            }
        }

        if ($group && $callback) {
            $callback($group);
        }

        self::$company = $group;

        return $group;
    }

    /**
     * Set the current default company
     *
     * This method should only be used when you want
     * to deliberately override the current default company
     *
     * @param Company|string $companyOrAlias
     *
     */
    public static function setDefault($companyOrAlias)
    {
        if(!is_object($companyOrAlias)) {
            $companyOrAlias = self::where('alias', $companyOrAlias)->firstOrFail();
        }
        self::$company = $companyOrAlias;
    }


    public static function forCompany($companyOrAlias, Closure $callback)
    {
        $old = self::getDefault();
        self::setDefault($companyOrAlias);
        $result = $callback();
        self::setDefault($old);

        return $result;
    }

    /**
     * Returns the default company
     *
     * NOTE: This method will always return the defualt company if one exist
     *
     * @param Closure|null $callback
     * @return Company|null
     */
    public static function getSystemDefault(?Closure $callback = null): ?Company
    {
        if (self::$defaultCompany != null) {
            if ($callback) {
                $callback(self::$defaultCompany);
            }

            return self::$defaultCompany;
        }

        $defaultAlias = env('DEFAULT_COMPANY_ALIAS', 'bulbul');
        $group = self::where('alias', $defaultAlias)->first();


        if ($group && $callback) {
            $callback($group);
        }

        self::$defaultCompany = $group;

        return $group;
    }
}
