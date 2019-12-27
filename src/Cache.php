<?php

namespace RD;

use Illuminate\Contracts\Cache\Repository as InitCache;
use RD\Traits\Key;

/**
 * Class Cache
 *
 * @package RD
 */
class Cache
{
    /**
     * add key method that returns model key
     */
    use Key;

    /**
     * holds Cache laravel class
     *
     * @var InitCache $cache
     */
    protected $cache;

    /**
     * cache tag name
     *
     * @var string $tag
     */
    protected $tag = 'rd-cache';

    /**
     * Cache constructor.
     *
     * @param InitCache $cache
     */
    public function __construct(InitCache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * puts item to cache
     *
     * @param $model
     * @param $html
     *
     * @return mixed
     */
    public function put($model, $html)
    {
        return $this
            ->cache
            ->tags($this->tag())
            ->rememberForever($this->key($model), function () use ($html) {
                return $html;
            });
    }

    /**
     * checks if given model is cached or not
     * checks using given models cache key method
     *
     * @param $model
     *
     * @return mixed
     */
    public function has($model)
    {
        return $this->cache->tags($this->tag())->has($this->key($model));
    }

    /**
     * if $tag parameter is set then sets cache tag name
     * otherwise returns current cache tag name
     *
     * @param null $tag
     *
     * @return $this|string
     */
    public function tag($tag = null)
    {
        if ($tag === null) {
            return $this->tag;
        }
        $this->tag = $tag;

        return $this;
    }
}
