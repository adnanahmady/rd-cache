<?php

class RussianDollsCashingTest extends TestCase
{
    /** @test */
    public function it_caches_the_given_key()
    {
        $post = $this->makeModel('Post');
        $cache = new \Illuminate\Cache\Repository(
            new \Illuminate\Cache\ArrayStore
        );
        $cache = new \RD\Cache($cache);
        $cache->put($post, '<div>view fragment</div>');
        $this->assertTrue($cache->has($post));
        $this->assertTrue($cache->has($post->getCacheKey()));

    }
}