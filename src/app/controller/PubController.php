<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-23
 * Time: 16:52
 */

namespace controller;


class PubController implements IController {

    private $view;
    private $navView;

    public function __construct(\view\IView $view, \view\NavigationView $navView) {
        $this->view = $view;
        $this->navView = $navView;
    }


    public function doControl() {

    }

    public function getView() {
        return $this->view;
    }
}