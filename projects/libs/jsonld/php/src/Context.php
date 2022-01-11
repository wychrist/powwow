<?php

class Context
{
    protected $terms = [];
    protected $url;

    public function addTerm(Term $term)
    {
        $this->terms[] = $term;
        return $this;
    }

    public function toArray()
    {
        if ($this->url) {
            return [
                '@context' => $this->url
            ];
        }

        $terms = [];
        foreach ($this->terms as $term) {
            $terms = array_merge($terms, $term->toArray());
        }

        return [
            '@context' => $terms
        ];
    }
}
