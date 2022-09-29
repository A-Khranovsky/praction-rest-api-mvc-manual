<?php

namespace MVC\Decorators;

class PagesDecorator extends DecoratorFactory
{
    public $pages;

    public function __construct($pages)
    {
        $this->pages = $pages;
    }

    public function title()
    {
        foreach ($this->pages->collection as $item) {
            $decorated_item = new PageDecorator($item);
            yield $decorated_item->title();
        }
    }

    public function collection_render($call, $separator = '<br />')
    {
        return implode(
            $separator,
            array_map($call, $this->pages->collection)
        );
    }

    public function body()
    {
        foreach ($this->pages->collection as $item) {
            $decorated_item = new PageDecorator($item);
            yield $decorated_item->body();
        }
    }

    public function pagesBar()
    {
        foreach ($this->pages->collection as $item) {
            $decorated_item = new PageDecorator($item);
            yield $decorated_item-> pagesBar();
        }
    }

    public function items()
    {
        return $this->collection_render(
            function ($item) {
                $decorated_item = new PageDecorator($item);
                return $decorated_item->items();
            },
            ''
        );
    }
}
