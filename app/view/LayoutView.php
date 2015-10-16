<?php

namespace view;

/**
 * Class LayoutView
 * Basic layout for a HTML-page
 * @package view
 */
class LayoutView  {

    /**
     * Title of the application
     * @var string
     */
    private static $title = "AppYo";

    /**
     * @var NavigationView
     */
    private $navigationView;

    public function __construct(NavigationView $navigationView) {
        $this->navigationView = $navigationView;
    }

    public function render($html) {
        header('Content-Type: text/html; charset=utf-8');
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>' . self::$title . '</title>
                </head>
                <body>
                    <header>
                        <h1>Hello ProjectApp</h1>
                    </header>

                    <div class="container">
                        ' . $html .'
                    </div>

                    <footer>
                        <p>Application created for the course 1dv608 - Web development with PHP at Linneaus Univercity by Alex Driaguine</p>
                        <p>ÅÄÖ LOL</p>
                    </footer>

                </body>
            </html>';
    }
}