<?php

namespace Modules\Security\Traits;

use Closure;
use Modules\Security\Services\Security;

trait PermissionTrait
{
    public function canRead(string $resource, string $resourceId = null, Closure $callback = null): bool
    {
        return Security::canRead($resource, $this, $resourceId, $callback);
    }

    public function canReadAny(string $resource, string $resourceId = null, Closure $callback = null): bool
    {
        return Security::canReadAny($resource, $this, $resourceId, $callback);
    }

    public function canCreate(string $resource, string $resourceId = null, Closure $callback = null): bool
    {
        return Security::canCreate($resource, $this, $resourceId, $callback);
    }

    public function canUpdate(string $resource, string $resourceId = null, Closure $callback = null): bool
    {
        return Security::canUpdate($resource, $this, $resourceId, $callback);
    }

    public function canDelete(string $resource, string $resourceId = null, Closure $callback = null): bool
    {
        return Security::canDelete($resource, $this, $resourceId, $callback);
    }

}