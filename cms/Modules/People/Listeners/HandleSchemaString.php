<?php

namespace Modules\People\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleSchemaString
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $types = [
            'person'
        ];

        $str = '';
        foreach($types as $aType) {
            //$event->userSchema  
            $str .= file_get_contents(dirname(__DIR__) ."/graphql/{$aType}.graphql");
        }

        // $event->userSchema .= $str;

        return $str;

    }
}
