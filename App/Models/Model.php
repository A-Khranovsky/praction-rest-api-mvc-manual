<?php


namespace App\Models;


use App\Config\Database;

abstract class Model
{
    public static function run($resource)
    {
        $modelName = substr_replace($resource, '', -1);
        $modelClass = __NAMESPACE__ . '\\' . ucfirst($modelName);
        return new $modelClass(new Database());
    }
}