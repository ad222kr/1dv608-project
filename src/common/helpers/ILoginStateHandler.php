<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-28
 * Time: 00:26
 */

namespace common;


interface ILoginStateHandler {
    public function setLoggedIn(\model\UserCredentials $user);
    public function isLoggedIn();
    public function setLoggedOut();
    public function getLoggedInUser();
}