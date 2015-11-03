<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-27
 * Time: 15:24
 */

namespace controller;


use common\SessionHandler;
use model\AdminFacade;
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
require_once("src/admin/view/AdminView.php");
require_once("src/admin/model/AdminFacade.php");



class AdminController {


    private $view;
    private $navView;
    private $adminFacade;


    public function __construct(\view\NavigationView $navView) {
        $this->navView = $navView;
        $this->adminFacade = new AdminFacade();
    }

    public function doControl() {

        // setup login
        $userDAL = new \model\UserDAL();
        $sessionHandler = new \common\SessionHandler();
        $cookieHandler = new \view\CookieHandler();
        $loginModel = new \model\LoginModel($sessionHandler, $userDAL);
        $loginView = new \view\LoginView($sessionHandler, $cookieHandler, $loginModel);
        $loginController = new \controller\LoginController($loginModel, $loginView);

        // execute
        $loginController->doLoginAction();

        $this->view = new \view\AdminView($loginView, $this->navView);

        if ($this->navView->adminWantsToAddBeer()) {
            $this->view = new \view\AddBeerView($sessionHandler, $this->adminFacade->getPubs());
            if ($this->view->adminPressedSave()) {
                $beer =  $this->view->getBeer();
                $pubBeer = $this->view->getPubBeer($beer->getId());
                $this->adminFacade->addBeer($beer);
                $this->adminFacade->addPubBeer($pubBeer);

            }

        } elseif ($this->navView->adminWantsToAddPub()) {
            $this->view = new \view\AddPubView($sessionHandler);
        }
    }

    public function getView() {
        return $this->view;
    }
}