<?php

namespace SumoCoders\FrameworkCoreBundle\Tests\Service;

use SumoCoders\FrameworkCoreBundle\Service\JsData;

class JsDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var JsData
     */
    private $jsData;

    /**
     * @inherit
     */
    protected function setUp()
    {
        $this->jsData = new JsData($this->getRequestStack());
    }

    /**
     * @inherit
     */
    protected function tearDown()
    {
        $this->jsData = null;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getRequestStack()
    {
        $currentRequest = $this
            ->getMockBuilder('\Symfony\Component\HttpFoundation\Request')
            ->getMock();
        $currentRequest->method('getLocale')
            ->will(
                $this->returnValue('nl')
            );

        $requestStack = $this
            ->getMockBuilder('\Symfony\Component\HttpFoundation\RequestStack')
            ->getMock();
        $requestStack->method('getCurrentRequest')
            ->will(
                $this->returnValue(
                    $currentRequest
                )
            );

        return $requestStack;
    }

    /**
     * Test jsData->get()
     */
    public function testGet()
    {
        // request is only parsed when fetching the data from the javascript
        (string) $this->jsData;
        $this->assertEquals('nl', $this->jsData->get('request')['locale']);
    }

    /**
     * Test jsData->parse()
     */
    public function testToString()
    {
        $var = (string) $this->jsData;
        $this->assertEquals('{"request":{"locale":"nl"}}', $var);
    }

    /**
     * This will check that the parent constructor is called
     */
    public function testCorrectConstruction()
    {
        self::assertEquals([], $this->jsData->all());
    }
}
