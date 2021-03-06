<?php
namespace model;

class LoginModel {
    /**
     * @var \common\ILoginStateHandler
     */
    private $loginStateHandler;
    /**

     */
    private $userDAL;
    /**
     * @var TempCredentialsDAL
     */
    private $tempDAL;
    /**
     * @param \common\ILoginStateHandler $loginStateHandler
     */
    public function __construct(\common\ILoginStateHandler $loginStateHandler, \model\UserDAL $userDAL) {
        $this->loginStateHandler = $loginStateHandler;
        $this->userDAL = $userDAL;
        $this->tempDAL = new TempCredentialsDAL();
    }
    public function tryLoginUser(UserCredentials $toLogin) {
        $registered = $this->userDAL->getUserByName($toLogin->getUsername());
        $tempPassword = $this->tempDAL->getTempPassword($toLogin->getUsername());
        $loginByPostCredentials = password_verify($toLogin->getPassword(), $registered->getPassword());
        $loginByCookies = $tempPassword != "" && $tempPassword === $toLogin->getCookiePassword();
        if (!$loginByPostCredentials && !$loginByCookies)
            throw new \WrongCredentialsException("Wrong credentials");
        $this->loginUser($toLogin);
    }
    private function loginUser(UserCredentials $user) {
        $this->loginStateHandler->setLoggedIn($user);
    }
    public function logoutUser() {
        $this->loginStateHandler->setLoggedOut();
    }
    public function userIsLoggedIn() {
        if ($this->loginStateHandler != null){
            return $this->loginStateHandler->isLoggedIn();
        }
        return false;
    }
    /**
     * @return string, random string for cookie
     */
    private function generateCookiePassword() {
        // https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence#title.2
        // not good according to this article but will have to suffice for this assignment
        $password = '';
        for ($i = 0; $i < 30; $i++) {
            $password .= chr(mt_rand(0, 255));
        }
        return bin2hex($password);
    }
    /**
     * Generates a random password for cookies, saves to file
     *
     * @return string
     */
    public function getTempPassword() {
        $tempPassword = $this->generateCookiePassword();
        $user = $this->loginStateHandler->getLoggedInUser();
        $this->tempDAL->saveCookiePassword($user->getUsername(), $tempPassword);
        return $tempPassword;
    }
}