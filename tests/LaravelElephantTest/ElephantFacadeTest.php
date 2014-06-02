<?php
namespace LaravelElephantTest;

use PHPUnit_Framework_TestCase;
use ReflectionClass;
use LaravelElephant\ElephantFacade;

class ElephantFacadeTest extends PHPUnit_Framework_TestCase
{
	protected function callProtectedMethod($object, $method, array $args=array())
	{
		$class = new ReflectionClass(get_class($object));
		$method = $class->getMethod($method);
		$method->setAccessible(true);
		return $method->invokeArgs($object, $args);
	}

	public function testGetFacadeAccessor()
    {
    	$object = new ElephantFacade;

    	$return = $this->callProtectedMethod($object, 'getFacadeAccessor');
	    
	    $this->assertEquals('laravel.elephant', $return);
    }
}