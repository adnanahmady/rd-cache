<?php

namespace RD\Caching;

use Illuminate\Support\Facades\Cache;

class RussianDolls {
    protected static $keys = [];

    public static function setUp($model)
    {
        ob_start();
        static::$keys[] = $key = $model->getCacheKey();

        return Cache::tags('rd-cache')->has($key);
    }

    public static function tearDown()
    {
        $html = ob_get_clean();
        $key = array_pop(static::$keys);

        return Cache::tags('rd-cache')->rememberForever($key, function () use ($html) {
            return $html;
        });
    }
}
