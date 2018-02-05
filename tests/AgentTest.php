<?php

namespace ElfSundae\Agent\Test;

use ElfSundae\Agent\Agent;
use PHPUnit\Framework\TestCase;

class AgentTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(Agent::class, new Agent);
    }
}
