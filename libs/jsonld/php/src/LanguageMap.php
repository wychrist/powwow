<?php

class LanguageMap
{
    protected $language = null;

    public function toArray()
    {
        $data = [
            '@lanugage' => $this->language
        ];

        return $data;
    }
}
