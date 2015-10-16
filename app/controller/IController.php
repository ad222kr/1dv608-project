<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-16
 * Time: 19:05
 */

namespace controller;


interface IController {
    public function doControl();
    public function getView();

}