<?php

namespace Modules\CongregateEmailValidator;

class ValidatorResult
{
    public function __construct(protected string $token, protected bool $alreadyExist, protected string $url){}

    public function getToken(): string
    {
        return $this->token;
    }

    public function alreadyExist(): bool
    {
        return $this->alreadyExist;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
