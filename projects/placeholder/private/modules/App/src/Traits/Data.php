<?php

namespace App\Traits;

/**
 *
 * @author unleash
 */
trait Data
{

    protected $_data = [];

    public function setData(array $data)
    {
        $this->_data = $data;
        return $this;
    }

    public function set($field, $value)
    {
        $this->_data[$field] = $value;
        return $this;
    }

    public function toArray()
    {
        return $this->_data;
    }

    public function has($field)
    {
        return (isset($this->_data[$field]));
    }

    public function getData($field, $default = false)
    {
        return (isset($this->_data[$field])) ? $this->_data[$field] : $default;
    }

    public function __set($key, $value)
    {
        if (isset($this->{$key})) {
            $this->{$key} = $key;
        } else {
            $this->_data[$key] = $value;
        }
    }

    public function __get($key)
    {
        if (isset($this->{$key})) {
            return $this->{$key};
        }

        return $this->getData($key);
    }

}
