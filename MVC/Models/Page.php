<?php

namespace MVC\Models;

class Page
{

    public $title, $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function render()
    {
        return '<h1>' . htmlspecialchars($this->title) . '</h1>' .
            '<p>' . htmlspecialchars($this->content) . '</p>';
    }
}
