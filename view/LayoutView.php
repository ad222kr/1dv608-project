<?php

namespace view;

/**
 * Class LayoutView
 * Basic layout for a HTML-page
 * @package view
 */
class LayoutView {

    public function render($title, $html) {
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <title>' . $title . '</title>
                </head>
                <body>
                    <h1>Hello Projectapp</h1>

                    <div class="container">
                        ' . $html .'
                    </div>

                </body>
            </html>';
    }
}