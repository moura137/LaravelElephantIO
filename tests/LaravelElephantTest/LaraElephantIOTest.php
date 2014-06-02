<?php
namespace LaravelElephantTest;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use LaravelElephant\LaraElephantIO;

class LaraElephantIOTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    protected function createElephant()
    {
    	$elephant = m::mock('ElephantIO\Client');

    	$elephant->shouldReceive('init')
        		 ->once()
        		 ->withNoArgs()
        		 ->andReturn($elephant);
        		 
        $elephant->shouldReceive('close')
        		 ->once()
        		 ->withNoArgs();

        return $elephant;
    }

	public function testConstructAndDestruct()
    {
        $elephant = $this->createElephant();

        $LaraElephant = new LaraElephantIO($elephant);
        $this->assertAttributeEquals($elephant, 'elephant', $LaraElephant);

        unset($LaraElephant);
    }

    public function testMethodCall()
    {
    	$event = 'sendMsg';
    	$args = array('foo');
    	$endpoint = 'bar';
    	$callback = function(){};

    	$elephant = $this->createElephant();

        $elephant->shouldReceive('emit')
        		 ->once()
        		 ->with($event, $args, $endpoint, $callback)
        		 ->andReturn('RETURN EVENT');

        $LaraElephant = new LaraElephantIO($elephant);

        $this->assertEquals('RETURN EVENT', $LaraElephant->emit($event, $args, $endpoint, $callback));
    }
}