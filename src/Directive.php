<?php

namespace RD;

use RD\Traits\Key;

/**
 * Class Directive
 *
 * @package RD
 */
class Directive
{
    /**
     * add key method that returns model key
     */
    use Key;

    /**
     * an array of given cache keys
     *
     * @var array $keys
     */
    protected $keys = [];

    /**
     * package Cache Instance
     *
     * @var Cache $cache
     */
    protected $cache;

    /**
     * Directive constructor.
     *
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * sets up object buffering
     * and checks existence of cached model html output
     *
     * @param $model
     *
     * @return mixed
     */
    public function setUp($model)
    {
        ob_start();
        $this->keys[] = $key = $this->key($model);

        return $this->cache->has($key);
    }

    /**
     * caches model html output
     *
     * @return mixed
     */
    public function tearDown()
    {
        return $this->cache->put(
            array_pop($this->keys), ob_get_clean()
        );
    }
}