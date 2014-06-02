<?php
namespace LaravelElephant;

use ElephantIO\Client;
use LaravelElephant\LaraElephantIO;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ElephantServiceProvider extends BaseServiceProvider
{
	protected $config;

	/**
	 * Bootstrap the service provider.
	 *
	 * @return void
	 */
    public function boot()
    {
        $this->package('moura137/laravel-elephantio');
    }

    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
    {
        $this->config = $this->app['config']->config('laravel-elephant::config');

    	$this->app->share('elephant.io', function($app){
            return new Client($this->getAddress(), 'socket.io', 1, false, true, $this->getDebug());
        });

        $this->app->bind('laravel.elephant', function($app){
            return new LaraElephantIO($app['elephant.io']);
        });
    }

	protected function getAddress()
    {
    	$address = rtrim($this->config['url'], '/');
    	$port = $this->config['port'];
    	if (!empty($port)) {
    		$address .= ':' . $port;
    	}

        return $address;
    }

    protected function getDebug()
    {
    	return $this->config['debug'];
    }
}