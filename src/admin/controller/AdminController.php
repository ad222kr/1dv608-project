<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-27
 * Time: 15:24
 */

namespace controller;


class AdminController implements IController {

    private $adminView;

    public function __construct(\view\AdminView $adminView) {
        $this->adminView = $adminView;
    }

    public function doControl() {
        // TODO: Implement doControl() method.
    }

    public function getView() {
        return $this->adminView;
    }
}