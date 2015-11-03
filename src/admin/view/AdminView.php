<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-27
 * Time: 15:27
 */

namespace view;


class AdminView  {


    private $loginView;
    private $navView;
    public function __construct(LoginView $loginView, NavigationView $navView) {
        $this->loginView = $loginView;
        $this->navView = $navView;
    }


    public function response() {
        $html = "<h2>Administration</h2>";
        $html .= $this->loginView->response();
        $html .= "<a href=" . $this->navView->getURLToAddPub() . ">Lägg till pub</a>";
        $html .= "<a href=" . $this->navView->getURLToAddBeer() . ">Lägg til öl</a>";
        return $html;
    }

}