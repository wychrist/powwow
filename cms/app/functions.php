<?php

use App\Models\Company;

if (!function_exists('company')) {

    /**
     * Returns the default or active company
     *
     * You can pass the active company as a
     * query string assigned to the param "com"
     *
     * @param Closure|null $callback Will be called and passed the current company
     * @return Company|null
     */
    function company(?Closure $callback = null): ?Company
    {
        return Company::getDefault($callback);
    }

    /**
     * Appends a "whereHas" condition to the specified query
     *
     * This allows only resources/Entitis in the current company
     * to be returned
     *
     * @param object $query
     * @return object
     */
    function in_company(object $query): object
    {
        if (company()) {
            $query->whereHas('groups', function ($query) {
                $query->where('group_id', company()->id);
            });
        }

        return $query;
    }

    /**
     * Temporarly set a default company and perform some task
     *
     * @param Company | string $companyOrAlias
     * @param Closure $callback
     *
     * @return mix whatever returned by the callback
     */
    function for_company($companyOrAlias, Closure $callback)
    {
        return Company::forCompany($companyOrAlias, $callback);
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
    function set_company($companyOrAlias)
    {
        return Company::setDefault($companyOrAlias);
    }

    function get_default_company(?Closure $callback = null): ?Company
    {
        return Company::getSystemDefault($callback);
    }
}
