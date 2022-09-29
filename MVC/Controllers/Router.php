<?php

namespace MVC\Controllers;

class Router
{
    public $model, $ext, $id, $page;

    public static function parse($path)
    {
        $path = explode('/', $path);

        list($path, $ext) = explode('.', end($path)); //handling only the end from the last slash

        $arr = explode('/', $path);

        $ext = explode('?', $ext);
        if (count($ext) == 2) {
            $buf = explode('=', $ext[1]);
            $page = end($buf);
        } else {
            $page = null;
        }

        return new self(
            $arr[0],
            $ext[0],
            count($arr) > 1 ? $arr[1] : null,
            $page
        );
    }

    private function __construct($model, $ext = null, $id = null, $page = null)
    {
        $this->model = $model;
        $this->ext = $ext;
        $this->id = $id;
        $this->page = $page;
    }
}
