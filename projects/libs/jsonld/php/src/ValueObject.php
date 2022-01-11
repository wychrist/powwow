<?php

class Value {
    protected $value = '';
    protected $type = '';
    protected $language = '';
    protected $direction  = '';
    protected $index = '';
    protected $context = '';

    public function toArray()
    {
        return [
            '@value' => $this->value,
        ];
    }
}