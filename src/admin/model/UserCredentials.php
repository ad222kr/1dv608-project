<?php
namespace model;
class UserCredentials {
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $cookiePassword;
    /**
     * @param $username
     * @param $password
     * @param string $cookiePassword
     * @throws \PasswordMissingException
     * @throws \UsernameMissingException
     */
    public function __construct($username, $password, $cookiePassword="" ) {
        assert(is_string($username), "Username needs to be of type string");
        assert(is_string($password), "Password needs to be of type string");
        if (trim($username) == '')
            throw new \UsernameMissingException("Username is missing");
        if (trim($password) == '' && trim($cookiePassword) == '')
            throw new \PasswordMissingException("Password is missing");
        $this->username = $username;
        $this->password = $password;
        $this->cookiePassword = $cookiePassword;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getCookiePassword() {
        return $this->cookiePassword;
    }
}