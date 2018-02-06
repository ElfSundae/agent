<?php

namespace ElfSundae\Agent\Test;

use Mobile_Detect;
use ElfSundae\Agent\Agent;
use PHPUnit\Framework\TestCase;

class AgentTest extends TestCase
{
    protected $ua = [
        'iOS' => 'Mozilla/5.0 (iPad; CPU OS 5_1_3 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko ) Version/5.1 Mobile/9B176 Safari/7534.48.3',
        'Android' => 'Mozilla/5.0 (Linux; U; Android 2.4.2; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
        'WeChat' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_3 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13G34 MicroMessenger/6.6.2 NetType/WIFI Language/zh_CN',
    ];

    public function testInstantiation()
    {
        $this->assertInstanceOf(Agent::class, new Agent);
    }

    public function testAddedProperties()
    {
        new Agent;
        $this->assertArrayHasKey('WeChat', Mobile_Detect::getProperties());
        $this->assertArrayHasKey('QQ', Mobile_Detect::getProperties());
        $this->assertArrayHasKey('NetType', Mobile_Detect::getProperties());
    }

    public function testVersionNumber()
    {
        $agent = new Agent;
        $agent->setUserAgent($this->ua['iOS']);
        $this->assertSame(5.13, $agent->versionNumber('iOS'));
        $agent->setUserAgent($this->ua['Android']);
        $this->assertSame(2.42, $agent->versionNumber('Android'));
        $agent->setUserAgent($this->ua['WeChat']);
        $this->assertSame(6.62, $agent->versionNumber('WeChat'));
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

    public function testAccessAttributes()
    {
        $agent = new Agent;
        $agent->set('a', 'A')
            ->set(['b' => 'B', 'c' => 'C']);
        $agent['d'] = 'D';

        $this->assertTrue($agent->has('a'));
        $this->assertTrue(isset($agent['b']));
        $this->assertFalse($agent->has('foo'));

        $this->assertSame('A', $agent->get('a'));
        $this->assertSame('B', $agent['b']);
        $this->assertSame('bar', $agent->get('foo', 'bar'));
        $this->assertEquals(
            ['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'],
            $agent->getAttributes()
        );

        $agent->remove('c', 'd');
        $this->assertEquals(['a' => 'A', 'b' => 'B'], $agent->getAttributes());
        $this->assertEquals(['a' => 'A', 'b' => 'B'], $agent->toArray());
        $this->assertJson($agent->toJson());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['a' => 'A', 'b' => 'B']),
            $agent->toJson()
        );

        unset($agent['b']);
        $this->assertEquals(['a' => 'A'], $agent->getAttributes());

        $agent->flush();
        $this->assertEmpty($agent->getAttributes());
    }
}
