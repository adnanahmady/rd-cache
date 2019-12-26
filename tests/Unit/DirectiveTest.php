<?php

class DirectiveTest extends TestCase {
    protected $cache;

    /** @test */
    public function it_caches_specified_output_if_doesnt_exists()
    {
        $directive = $this->getNewDirectiveInstance();
        $model = $this->makeModel('Post');
        $html = "<h1>cache test</h1>";
        $this->assertFalse($directive->setUp($model));

        echo $html;

        $this->assertEquals($directive->tearDown($model, $html), $html);
        $this->assertTrue($this->cache->has($model));
    }

    protected function getNewDirectiveInstance()
    {
        $cache = new Illuminate\Cache\Repository(
            new Illuminate\Cache\ArrayStore
        );

        $this->cache = new RD\Cache($cache);

        return new \RD\Directive($this->cache);
    }
}