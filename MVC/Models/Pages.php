<?php

namespace MVC\Models;

class Pages
{
    public $collection;
    private $index;

    public function __construct($pages = null)
    {
        if ($pages == null) {
            $pages = [

                new Page('Title1', 'Content1'),
                new Page('Title2', 'Content2'),
                new Page('Title3', 'Content3')
            ];
        }
        $this->collection = $pages;
    }
}
