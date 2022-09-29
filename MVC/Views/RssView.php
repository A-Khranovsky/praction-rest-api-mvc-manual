<?php

namespace MVC\Views;

class RssView extends ViewFactory
{
    const LAYOUT = <<<HTML
		<?xml version="1.0" encoding="UTF-8"?>
		<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
			<chanel>
				<title>{{{title}}}</title>
				<link>http://example.com/</link>
					{{{items}}}
			</chanel>
		</rss>	
	HTML;

    protected $replacements;

    public function __construct($decorator, $page)
    {
        $this->replacements = [
            '{{{title}}}' => $decorator->title(),
            '{{{items}}}' => $decorator->items()
        ];
    }

    public function render()
    {
        return str_replace(
            array_keys($this->replacements),
            array_values($this->replacements),
            self::LAYOUT
        );
    }
}
