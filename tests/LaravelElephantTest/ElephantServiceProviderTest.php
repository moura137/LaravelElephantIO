<?php
namespace LaravelElephantTest;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use Moura137\LaravelElephant\ElephantServiceProvider;
use Moura137\LaravelElephant\LaraElephantIO;

class ElephantServiceProviderTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }
    
    public function testShouldBoot()
    {
        $sp = m::mock('Moura137\LaravelElephant\ElephantServiceProvider[package]');
        $sp->shouldReceive('package')
           ->once()
           ->with('moura137/laravel-elephantio')
           ->andReturn(true);
           
        $sp ->boot();
    }

	public function testShouldRegister()
    {
        $test = $this;

        // Configurations
        $url = 'http://localhost';
        $port = '8000';
        $debug = true;

        $config = m::mock('Illuminate\Config\Repository');
        $config->shouldReceive('get')
               ->once()
               ->with('laravel-elephantio::config')
               ->andReturn(array('url' => $url, 'port' => $port, 'debug' => $debug));

        $elephant = m::mock('ElephantIO\Client');
        $elephant->shouldReceive('init')
                 ->once()
                 ->withNoArgs()
                 ->andReturn($elephant);
                 
        $elephant->shouldReceive('close')
                 ->once()
                 ->withNoArgs();

        //LaravelApp
        $app = m::mock('ArrayAccess');
        $app->shouldReceive('offsetGet')
            ->times(1)
            ->with('config')
            ->andReturn($config)

            ->getMock()
            ->shouldReceive('offsetGet')
            ->times(1)
            ->with('elephant.io')
            ->andReturn($elephant);

        $sp = new ElephantServiceProvider($app);
        
        $app->shouldReceive('bind')
            ->once()
            ->andReturnUsing(
                // Make sure that the commands are being registered
                // with a closure that returns the correct
                // object.
                function ($name, $closure) use ($test, $app) {
                    
                    $shouldBe = ['elephant.io' => 'ElephantIO\Client'];

                    $test->assertInstanceOf($shouldBe[$name], $closure($app));
                }
            );

        $app->shouldReceive('bind')
            ->once()
            ->andReturnUsing(
                // Make sure that the commands are being registered
                // with a closure that returns the correct
                // object.
                function ($name, $closure) use ($test, $app, $elephant) {

                    $shouldBe = ['laravel.elephantio' => 'Moura137\LaravelElephant\LaraElephantIO'];
                        $test->assertInstanceOf($shouldBe[$name], $closure($app));
                }
            );
        $sp->register();
    }
}