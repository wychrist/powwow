<?php

class Term
{
    public string $name;
    public string $id;
    public string $type;

    public function __construct()
    {
        $this->name = '';
        $this->id = '';
        $this->type = '';
    }

    public function typeIsId(bool $typeIsId = true)
    {
        $this->type  = ($typeIsId)  ? '@id' : '';
    }

    public function toArray()
    {
        if ($this->name) {

            if ($this->id && $this->type) {
                return [
                    $this->name => [
                        '@id' => $this->id,
                        '@type' => $this->type
                    ]
                ];
            } elseif ($this->id && !$this->type) {
                return [$this->name => $this->id];
            }
        }
        return [];
    }
}
