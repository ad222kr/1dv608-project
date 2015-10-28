<?php

namespace common;

class SessionHandler implements ITempDataHandler, ILoginStateHandler {
    private static $sessionUserLocation = "SessionHandler::loggedInUser";
    public function __construct() {
        session_start();
    }
    public function setTempData($key, $value) {
        assert(is_string($value), "Argument \$message needs to be of type string");
        $this->setData($key, $value);
    }
    public function getTempData($key) {
        if ($this->exists($key))
            return $this->getAndUnset($key);
        return "";
    }
    public function getLoggedInUser(){
        if ($this->exists(self::$sessionUserLocation)) {
            return $this->getData(self::$sessionUserLocation);
        }
    }
    public function setLoggedIn(\model\UserCredentials $user) {
        $this->setData(self::$sessionUserLocation, $user);
    }
    public function isLoggedIn() {
        if ($this->exists(self::$sessionUserLocation))
            return true;
        return false;
    }
    public function setLoggedOut() {
        $this->unsetData(self::$sessionUserLocation);
    }
    private function setData($key, $value) {
        $_SESSION[$key] = $value;
    }
    private function getData($key) {
        if ($this->exists($key))
            return $_SESSION[$key];
        return null;
    }
    private function unsetData($key) {
        if ($this->exists($key))
            unset($_SESSION[$key]);
    }
    private function getAndUnset($key) {
        $tempData = $this->getData($key);
        $this->unsetData($key);
        return $tempData;
    }
    private function exists($key) {
        return isset($_SESSION[$key]);
    }
    public function setRegisteredUsername($name) {
        $this->setData(self::$registeredUsernameKey, $name);
    }
    public function getRegisteredUsername() {
        $this->getAndUnset(self::$registeredUsernameKey);
    }
}