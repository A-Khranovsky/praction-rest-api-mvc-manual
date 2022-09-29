<?php

namespace MVC\Views;

class HtmlView extends ViewFactory
{
    const LAYOUT = <<<HTML
	<!DOCTYPE html>
	<html lang="ru">
	<head>
		<title>{{{title}}}</title>
		<meta charset="utf-8">
	</head>
	<body>
		{{{body}}}
		<br />
		{{{pagesBar}}}				
	</body>
	</html>
	HTML;

    protected $replacements, $page,
        $titles, $bodies, $pagesBars, $decorator;

    public function __construct($decorator, $page)
    {
        $this->decorator = $decorator;
        $this->page = $page;

        foreach ($decorator->title() as $title) {
            $this->titles[] = $title;
        }
        foreach ($decorator->body() as $body) {
            $this->bodies[] = $body;
        }
        foreach ($decorator->pagesBar() as $key => $pagesBar) {
            $pervious = $key;

            if ($pervious == 0) {
                $pervious = 1;
            }
            $next = $pervious + 1;
            if ($next == $key + 1) {
                $next++;
            }

            $this->pagesBars[] = str_replace(
                ['{{{pervious}}}', '{{{next}}}'],
                [$pervious, $next],
                $pagesBar
            );
        }
        $this->replacementsInit($page);
    }

    private function replacementsInit($page)
    {
        $this->replacements = [
            '{{{title}}}' => $this->titles[$page],
            '{{{body}}}' => $this->bodies[$page],
            '{{{pagesBar}}}' => $this->pagesBars[$page]
        ];
    }

    public function render()
    {
        $this->replacementsInit($this->page);

        return str_replace(
            array_keys($this->replacements),
            array_values($this->replacements),
            self::LAYOUT
        );
    }
}
