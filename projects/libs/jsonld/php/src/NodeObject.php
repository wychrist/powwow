<?php

class NodeObject
{
    private $id;
    private $type = [];

    public function toArray()
    {
        $data = [
            '@id' => $this->id,
        ];

        if (count($this->type)) {
            $data['@type'] = (count($this->type) == 0) ? array_pop($this->type) : $this->type;
        }

        return $data;
    }
}
