<?php

namespace RD;

use Illuminate\Contracts\Cache\Repository as InitCache;

class Cache
{
    use Key;
    
    protected $cache;
    protected $tag = 'rd-cache';

    public function __construct(InitCache $cache)
    {
        $this->cache = $cache;
    }
    
    public function put($model, $html)
    {
        return $this
            ->cache
            ->tags($this->tag())
            ->rememberForever($this->key($model), function () use ($html) {
                return $html;
            });
    }

    public function has($model)
    {
        return $this->cache->tags($this->tag())->has($this->key($model));
    }

    public function tag($tag = null)
    {
        if ($tag === null) {
            return $this->tag;
        }
        $this->tag = $tag;

        return $this;
    }
}
