<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class TestCase
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * instantiates an instance of model and returns it
     * given class name must be based on models from Extras/Models path
     *
     * @param $class
     *
     * @return mixed
     */
    public function makeModel($class)
    {
        $this->migrateTables(strtolower($class).'s');
        $model = new $class();
        $model->title = 'some title';
        $model->save();

        return $model;
    }

    /**
     * sets up database needs for test
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->setUpDatabase();
    }

    /**
     * creates a connection to sqlite database on the flight
     */
    public function setUpDatabase()
    {
        $database = new DB;
        $database->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    /**
     * migrates a database table for given model
     */
    protected function migrateTables($table)
    {
        DB::schema()->create($table, function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }
}

