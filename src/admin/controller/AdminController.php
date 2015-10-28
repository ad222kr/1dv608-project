<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-27
 * Time: 15:24
 */

namespace controller;


use common\SessionHandler;
use view\AdminView;

require_once("src/common/helpers/ITempDataHandler.php");
require_once("src/admin/view/BaseFormView.php");

require_once("src/common/helpers/ILoginStateHandler.php");
require_once("src/common/helpers/SessionHandler.php");


require_once("src/common/exceptions/UsernameMissingException.php");
require_once("src/common/exceptions/WrongCredentialsException.php");


require_once("src/admin/controller/LoginController.php");

require_once("src/admin/view/LoginView.php");

require_once("src/admin/view/CookieHandler.php");
require_once("src/admin/model/LoginModel.php");
require_once("src/admin/model/UserCredentials.php");
require_once("src/admin/model/DAL/UserDAL.php");
require_once("src/admin/model/DAL/TempCredentialsDAL.php");



class AdminController {


    private $view;
    private $sessionHandler;
    private $userDAL;
    private $navView;


    public function __construct(\view\NavigationView $navView) {
        $this->navView = $navView;
        $this->sessionHandler = new SessionHandler();
        $this->userDAL = new \model\UserDAL();

    }

    public function doControl() {

        if ($this->sessionHandler->isLoggedIn()) {
            $this->view = new AdminView();
        } else {
            $cookieHandler = new \view\CookieHandler();
            $loginModel = new \model\LoginModel($this->sessionHandler, $this->userDAL);
            $loginView = new \view\LoginView($this->sessionHandler, $cookieHandler, $loginModel);
            $loginController = new \controller\LoginController($loginModel, $loginView);

            $loginController->doLoginAction();

            $this->view = $loginController->getView();
        }



    }

    public function getView() {
        return $this->view;
    }
}