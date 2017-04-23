<?php

namespace SumoCoders\FrameworkCoreBundle\Tests\Menu;

use SumoCoders\FrameworkCoreBundle\Menu\MenuBuilder;

class MenuBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MenuBuilder
     */
    protected $menuBuilder;

    /**
     * @inherit
     */
    protected function setUp()
    {
        $this->menuBuilder = new MenuBuilder();
    }

    /**
     * @inherit
     */
    protected function tearDown()
    {
        $this->menuBuilder = null;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getEventDispatcher()
    {
        $eventDispatcher = $this
            ->getMockBuilder('\Symfony\Component\EventDispatcher\EventDispatcherInterface')
            ->getMock();

        return $eventDispatcher;
    }

    protected function getItem()
    {
        $item = $this->getMockBuilder('\Knp\Menu\ItemInterface')->getMock();

        return $item;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getFactory()
    {
        $item = $this->getItem();

        /** @var \PHPUnit_Framework_MockObject_MockBuilder $factory */
        $factory = $this->getMockBuilder('\Knp\Menu\FactoryInterface')->getMock();
        $factory->method('createItem')
            ->will(
                $this->returnValue(
                    $item
                )
            );

        return $factory;
    }

    /**
     * Test the getters and setters
     */
    public function testGettersAndSetters()
    {
        $eventDispatcher = $this->getEventDispatcher();
        $this->menuBuilder->setEventDispatcher($eventDispatcher);
        $this->assertEquals(
            $eventDispatcher,
            $this->menuBuilder->getEventDispatcher(),
            'eventDispatcher doesn\'t match'
        );

        $factory = $this->getFactory();
        $this->menuBuilder->setFactory($factory);
        $this->assertEquals(
            $factory,
            $this->menuBuilder->getFactory(),
            'factory doesn\'t match'
        );
    }

    public function testCreateMainMenu()
    {
        $this->markTestSkipped('I need time to mock this whole thing...');

        $this->menuBuilder->setFactory($this->getFactory());
        $this->menuBuilder->setEventDispatcher($this->getEventDispatcher());

        $this->menuBuilder->createMainMenu();
    }
}
