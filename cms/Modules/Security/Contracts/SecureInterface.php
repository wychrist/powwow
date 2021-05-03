<?php

namespace Modules\Security\Contracts;

interface SecureInterface
{
    /**
     * Returns a nice human readable name for the entity/resource
     * 
     * This will be use as a display in the UI
     * 
     * @return string
     */
    public static function getHumanName(): string;

    /**
     * Returns a description of the entity/resource
     * 
     * @return string
     */
    public static function getHumanDescription(): string;
}