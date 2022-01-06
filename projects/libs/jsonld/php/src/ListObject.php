<?php

class ListObject
{
    protected $list = [];
    protected $index = '';

    public function toArray()
    {
        $data = [
            '@list' => $this->list,
        ];

        if ($this->index) {
            $data['@index'] = $this->index;
        }

        return $data;
    }
}
