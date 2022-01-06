<?php

class SetObject {
    protected $set = [];
    protected $index = '';

    public function toArray(): array
    {
        return [
            '@set' => $this->set
        ];
    }
}