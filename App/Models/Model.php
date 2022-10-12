<?php

namespace App\Models;

use App\Config\Database;

abstract class Model
{
    public static function run(string $resource): ?Model
    {
        $modelName = substr_replace($resource, '', -1);
        $modelClass = __NAMESPACE__ . '\\' . ucfirst($modelName);
        if (class_exists($modelClass)) {
            $model = new $modelClass(new Database());
        } else {
            $model = null;
        }
        return $model;
    }
}
