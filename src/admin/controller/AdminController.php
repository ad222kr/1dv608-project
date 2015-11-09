<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-27
 * Time: 15:24
 */

namespace controller;

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


/**
 * Class AdminController
 * Handles administration actions like adding pubs and beers to the database.
 * @package controller
 */
class AdminController {

    /**
     * Depending on what action, the view can be one of three different vies.
     * @var \view\AdminView | \view\AddBeerView | \view\AddPubView
     */
    private $view;

    /**
     * @var \view\NavigationView
     */
    private $navView;

    /**
     * @var \model\AdminFacade
     */
    private $adminFacade;


    /**
     * @param \view\NavigationView $navView
     */
    public function __construct(\view\NavigationView $navView) {
        $this->navView = $navView;
        $this->adminFacade = new \model\AdminFacade();
    }

    public function doControl() {

        // setup everything for the login
        $userDAL = new \model\UserDAL();
        $sessionHandler = new \common\SessionHandler();
        $cookieHandler = new \view\CookieHandler();
        $loginModel = new \model\LoginModel($sessionHandler, $userDAL);
        $loginView = new \view\LoginView($sessionHandler, $cookieHandler, $loginModel);
        $loginController = new \controller\LoginController($loginModel, $loginView);

        $isLoggedIn = $loginController->doLoginAction();

        // The first view is always the AdminView
        $this->view = new \view\AdminView($loginView, $this->navView, $isLoggedIn);

        // Don't want to continue further down if not logged in
        if (!$isLoggedIn) return;

        if ($this->navView->adminWantsToAddBeer()) {

            $this->view = new \view\AddBeerView($sessionHandler, $this->adminFacade->getPubs());

            if ($this->view->adminPressedSave()) {

                $beer =  $this->view->getBeer();
                if ($beer == null) return;

                $pubBeer = $this->view->getPubBeer($beer->getId());
                $this->adminFacade->addBeer($beer);
                $this->adminFacade->addPubBeer($pubBeer);
                $this->navView->redirectToBeer($beer->getId());
            }

        } elseif ($this->navView->adminWantsToAddPub()) {

            $this->view = new \view\AddPubView($sessionHandler);

            if ($this->view->adminPressedSave()) {
                $pub = $this->view->getPub();
                if ($pub == null) return;
                $this->adminFacade->addPub($pub);
                $this->navView->redirectToPub($pub->getId());
            }
        }
    }

    /**
     * Returns a view depending on which action
     * @return \view\AddBeerView|\view\AddPubView|\view\AdminView
     */
    public function getView() {
        return $this->view;
    }
}