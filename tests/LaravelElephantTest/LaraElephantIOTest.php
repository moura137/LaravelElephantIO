<?php
namespace LaravelElephantTest;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use Moura137\LaravelElephant\LaraElephantIO;

class LaraElephantIOTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testEmit()
    {
    	$event = 'sendMsg';
    	$args = array('foo');
    	$endpoint = 'bar';
    	$callback = function(){};

    	$elephant = m::mock('ElephantIO\Client');

        $elephant->shouldReceive('initialize')
                 ->once()
                 ->withNoArgs()
                 ->andReturn($elephant);

        $elephant->shouldReceive('close')
                 ->once()
                 ->withNoArgs();

        $elephant->shouldReceive('emit')
        		 ->once()
        		 ->with($event, $args)
        		 ->andReturn('RETURN EVENT');

        $LaraElephant = new LaraElephantIO($elephant);

        $this->assertEquals('RETURN EVENT', $LaraElephant->emit($event, $args));
    }
}