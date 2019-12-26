<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function makeModel($class)
    {
        $model = new $class();
        $model->title = 'some title';
        $model->save();

        return $model;
    }

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->setUpDatabase();
        $this->migrateTables();
    }

    public function setUpDatabase()
    {
        $database = new DB;
        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    protected function migrateTables()
    {
        DB::schema()->create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }
}

