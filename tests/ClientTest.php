<?php

namespace ElfSundae\Laravel\Agent\Test;

use ElfSundae\Laravel\Agent\Client;

class ClientTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(Client::class, new Client);
    }
}
