<?php

namespace ElfSundae\Agent\Test;

use ElfSundae\Agent\Agent;
use PHPUnit\Framework\TestCase;

class AgentTest extends TestCase
{
    protected $ua = [
        'iOS' => 'Mozilla/5.0 (iPad; CPU OS 5_1_3 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko ) Version/5.1 Mobile/9B176 Safari/7534.48.3',
        'Android' => 'Mozilla/5.0 (Linux; U; Android 2.4.2; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
    ];

    public function testInstantiation()
    {
        $this->assertInstanceOf(Agent::class, new Agent);
    }

    public function testVersion()
    {
        $agent = new Agent;
        $agent->setUserAgent($this->ua['iOS']);
        $this->assertSame('5.1.3', $agent->version('iOS'));
        $agent->setUserAgent($this->ua['Android']);
        $this->assertSame('2.4.2', $agent->version('Android'));
    }

    public function testVersionNumber()
    {
        $agent = new Agent;
        $agent->setUserAgent($this->ua['iOS']);
        $this->assertSame(5.13, $agent->versionNumber('iOS'));
        $agent->setUserAgent($this->ua['Android']);
        $this->assertSame(2.42, $agent->versionNumber('Android'));
    }

    public function testLanguage()
    {
        $agent = new Agent;
        $agent->setHttpHeaders([
            'HTTP_ACCEPT_LANGUAGE' => 'zh-CN,zh;q=0.9,en-US;q=0.8,en;q=0.7,zh-TW;q=0.6',
        ]);

        $this->assertSame('zh-cn', $agent->language());

        $this->assertTrue($agent->language('zh'));
        $this->assertTrue($agent->language('en'));
        $this->assertFalse($agent->language('de'));
    }

    public function testOs()
    {
        $agent = new Agent;
        $agent->setUserAgent($this->ua['iOS']);
        $this->assertSame('iOS', $agent->os());
        $agent->setUserAgent($this->ua['Android']);
        $this->assertSame('AndroidOS', $agent->os());
    }

    public function testOsVersion()
    {
        $agent = new Agent;
        $agent->setUserAgent($this->ua['iOS']);
        $this->assertSame('5.1.3', $agent->osVersion());
        $agent->setUserAgent($this->ua['Android']);
        $this->assertSame('2.4.2', $agent->osVersion());
    }
}
