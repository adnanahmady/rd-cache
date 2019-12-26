<?php

namespace RD;

class Directive
{
    use Key;
    
    protected $keys = [];
    protected $cache;
    
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function setUp($model)
    {
        ob_start();
        $this->keys[] = $key = $this->key($model);

        return $this->cache->has($key);
    }

    public function tearDown()
    {
        return $this->cache->put(
            array_pop($this->keys), ob_get_clean()
        );
    }
}