<?php

use Illuminate\Database\Eloquent\Model;
use RD\Traits\Cacheable;

/**
 * a test example for using laravel model
 *
 * Class Post
 */
class Post extends Model
{
    /**
     * add make cache key ability to model
     */
    use Cacheable;
}
