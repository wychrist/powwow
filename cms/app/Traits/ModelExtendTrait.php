<?php

namespace App\Traits;

use Illuminate\Support\Str;
use ReflectionClass;

/**
 * copied from: https://gist.github.com/calebporzio/a63b165b500d491a0c250eb5853e5d94
 **/
trait ModelExtendTrait
{
    public function getParentClass()
    {
        static $parentClassName;

        return $parentClassName ?: $parentClassName = (new ReflectionClass($this))->getParentClass()->getName();
    }

    public function getTable()
    {
        if (! isset($this->table)) {
            return str_replace('\\', '', Str::snake(Str::plural(class_basename($this->getParentClass()))));
        }

        return $this->table;
    }

    public function getForeignKey()
    {
        return Str::snake(class_basename($this->getParentClass())).'_'.$this->primaryKey;
    }

    public function joiningTable($related, $instance = null)
    {
        $models = [
            Str::snake(class_basename($related)),
            Str::snake(class_basename($this->getParentClass())),
        ];

        sort($models);

        return strtolower(implode('_', $models));
    }
}