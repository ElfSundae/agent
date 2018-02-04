<?php

namespace ElfSundae\Agent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ElfSundae\Agent\Agent
 */
class Agent extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'agent';
    }
}
