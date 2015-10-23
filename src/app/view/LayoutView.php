<?php

namespace view;

/**
 * Class LayoutView
 * Basic layout for a HTML-page
 * @package view
 */
class LayoutView  {

    private $cssOff = false; // just debug, cant see var_dump sometimes cus of bootstrap...

    /**
     * Title of the application
     * @var string
     */
    private static $title = "AppYo";
    private static $css = array(
        "bootstrap" => "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css",
        "bootstrap-theme" => "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css",
        "site" => "css/site.css"

    );

    /**
     * @var NavigationView
     */
    private $navigationView;

    public function __construct(NavigationView $navigationView) {
        $this->navigationView = $navigationView;
    }

    private function loadCss() {
        if ($this->cssOff) return; //debug remove later
        $ret = "";
        foreach (self::$css as $styleSheet) {
            $ret .= '<link rel="stylesheet" href="' . $styleSheet . '">';
        }
        return $ret;
    }

    public function render($html) {

        echo '<!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <title>' . self::$title . '</title>
                    ' . $this->loadCss() .'
                </head>
                <body>

                    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                      <div class="container">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand" href="?">' . self::$title .'</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse" >
                          ' . $this->navigationView->getLeftNavMenu() .
                              $this->navigationView->getRightNavMenu(). '
                        </div>
                      </div>
                    </nav>


                    <div class="container">

                        ' . $html .'

                    </div>

                    <footer class="footer">
                        <div class="container">
                            <p class="text-muted">Application created for the course 1DV608 - Web development with php.</p>
                        </div>
                    </footer>

                </body>
            </html>';
    }
}