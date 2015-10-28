<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-27
 * Time: 21:47
 */

namespace common;


interface ITempDataHandler {
    public function getTempData($key);
    public function setTempData($key, $value);
}