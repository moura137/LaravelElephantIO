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
     * @var boolean
     */
    protected $init = false;

    /**
     * Construct, initialize o elephant.io
     *
     * @param ElephantIO $elephant
     */
    public function __construct(ElephantIO $elephant)
    {
        $this->elephant = $elephant;
    }

    /**
     * Conectar
     *
     * @return void
     */
    public function connect()
    {
        if (!$this->init) {
            $this->elephant->initialize();
            $this->init = true;
        }
    }

    /**
     * Emits a message through the engine
     *
     * @param string $event
     * @param array  $args
     *
     * @return $this
     */
    public function emit($event, array $args)
    {
        $this->connect();

        return $this->elephant->emit($event, $args);
    }

    /**
     * Call Methods Elephant
     *
     * @param string $method
     * @param array  $args
     */
    public function __call($method, $args)
    {
        $this->connect();

        return call_user_func_array(array($this->elephant, $method), $args);
    }

    /**
     * Destruct, close o elephant.io
     *
     * @return void
     */
    public function close()
    {
        if ($this->init) {
            $this->elephant->close();
        }

        $this->init = false;
    }

    /**
     * Destruct, close o elephant.io
     */
    public function __destruct()
    {
        $this->close();
    }
}
