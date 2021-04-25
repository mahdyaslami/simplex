<?php

namespace Simplex\Facade;

use League\Container\Container as LeagueContainer;

class Container
{
    private static $self = null;

    private $container;

    private function __construct()
    {
        $this->container = new LeagueContainer();
    }

    /**
     * Add an item to the container.
     * 
     * @param string $id
     * @param mixed  $concrete
     * @return void
     */
    public function bind(string $id, $concrete)
    {
        $this->container->add($id, $concrete);
    }

    /**
     * Add an item to the container. the item is always unique.
     * 
     * @param  string $id
     * @param  mixed  $concrete
     * @return void
     */
    public function singleton(string $id, $concrete)
    {
        $this->container->add($id, $concrete, true);
    }

    /**
     * Return true if container can return object for identifier.
     * 
     * @param string $id — Identifier of the entry to look for.
     * @return bool
     */
    public function has(string $id)
    {
        return $this->container->has($id);
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     * 
     * @param  string $id — Identifier of the entry to look for.
     * @return mixed
     */
    public function get(string $id)
    {
        return $this->container->get($id);
    }

    /**
     * Get instanse of self.
     * 
     * @return $this
     */
    public static function getInstance()
    {
        if (is_null(static::$self)) {
            static::$self = new static;
        }

        return static::$self;
    }
}
