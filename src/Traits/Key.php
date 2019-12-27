<?php

namespace RD;

trait Key
{
    protected function key($model)
    {
        return is_object($model) ? $model->getCacheKey() : $model;
    }
}