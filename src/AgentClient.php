<?php

namespace ElfSundae\Laravel\Agent;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ElfSundae\Laravel\Agent\Client
 */
class AgentClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'agent.client';
    }
}
