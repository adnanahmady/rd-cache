<?php

namespace RD\Traits;

/**
 * Trait Key
 *
 * @package RD\Traits
 */
trait Key
{
    /**
     * returns models cache key
     *
     * @param $model
     *
     * @return mixed
     */
    protected function key($model)
    {
        return is_object($model) ? $model->getCacheKey() : $model;
    }
}