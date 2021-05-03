<?php

namespace App\Traits;

trait Contactable
{
    public function contacts()
    {
        return $this->morphToMany(Contact::class, 'contactable');
    }
}
