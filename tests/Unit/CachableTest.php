<?php

class CachableTest extends TestCase {
    /** @test */
    public function it_gets_a_unique_cache_key_for_an_eloquent_model()
    {
        $post = $this->makeModel('Post');
        $this->assertEquals(
            'Post/1-' . $post->updated_at->timestamp,
            $post->getCacheKey()
        );
    }
}
