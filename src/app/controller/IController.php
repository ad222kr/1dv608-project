<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-23
 * Time: 17:10
 */

namespace controller;


interface IController {

    public function doControl();
    public function getView();

}