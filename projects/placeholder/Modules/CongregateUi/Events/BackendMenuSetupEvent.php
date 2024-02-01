<?php

namespace Modules\CongregateUi\Events;

use Modules\CongregateUi\Services\BackendMenuService;
use Modules\CongregateUi\Services\MenuItem;

class BackendMenuSetupEvent
{

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function addSettingInstance(MenuItem $item)
    {
        BackendMenuService::addModuleInstance($item);
    }
    public function addSetting(string $label, string | array $link = '#', string | null $icon = null, string $id = null, bool $active = false)
    {
        BackendMenuService::addSetting($label, $link, $icon, $id, $active);
    }

    public function addModuleInstance(MenuItem $item)
    {
        BackendMenuService::addModuleInstance($item);
    }

    public function addModule(string $label, string | array $link = '#', string | null $icon = null, string $id = null, bool $active = false)
    {
        BackendMenuService::addModule($label, $link, $icon, $id, $active);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
