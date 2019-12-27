<?php

namespace RD\Traits;

/**
 * Trait Cacheable
 * @package RD\Traits
 */
trait Cacheable
{
    /**
     * generates cache key for model
     *
     * @return string
     */
    public function getCacheKey()
    {
        return sprintf('%s/%s-%s',
            get_class($this),
            $this->id,
            $this->updated_at->timestamp
        );
    }
}
