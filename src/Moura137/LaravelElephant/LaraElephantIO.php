<?php
namespace Moura137\LaravelElephant;

use ElephantIO\Client as ElephantIO;

class LaraElephantIO
{
	/**
	 * @var \ElephantIO\Client
	 */
	protected $elephant;

	/**
	 * Construct, initialize o elephant.io
	 * 
	 * @param ElephantIO $elephant
	 */
    public function __construct(ElephantIO $elephant)
    {
    	$this->elephant = $elephant;
    	$this->elephant->init();
    }

    /**
	 * Destruct, close o elephant.io
	 */
    public function __destruct()
    {
    	$this->elephant->close();
    }

    /**
	 * Call Methods Elephant
	 * 
	 * @param string $method
	 * @param array $args
	 */
    public function __call($method, $args)
    {
    	return call_user_func_array(array($this->elephant, $method), $args);
    }
}