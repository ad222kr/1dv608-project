<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-20
 * Time: 13:26
 */

namespace controller;


class BeerController {

    private $view;

    public function __construct(\view\IView $view) {
        $this->view = $view;
    }

    public function doControl () {

    }

    public function getView () {
        return $this->view;
    }
}