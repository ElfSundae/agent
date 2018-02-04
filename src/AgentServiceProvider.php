<?php

namespace ElfSundae\Laravel\Agent;

use Illuminate\Support\ServiceProvider;

class AgentServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAgent();

        $this->registerClient();
    }

    /**
     * Register the Agent.
     *
     * @return void
     */
    protected function registerAgent()
    {
        $this->app->register(\Jenssegers\Agent\AgentServiceProvider::class);

        $this->app->alias('agent', \Jenssegers\Agent\Agent::class);
    }

    /**
     * Register the Client.
     *
     * @return void
     */
    protected function registerClient()
    {
        $this->app->singleton('agent.client', function ($app) {
            return (new Client)->setAgent($app->make('agent'));
        });

        $this->app->alias('agent.client', Client::class);
    }
}
