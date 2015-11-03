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
    private $isLoggedIn;
    public function __construct(LoginView $loginView, NavigationView $navView, $isLoggedIn) {
        $this->loginView = $loginView;
        $this->navView = $navView;
        $this->isLoggedIn = $isLoggedIn;
    }


    public function response() {
        $html = "<h2>Administration</h2>";

        if ($this->isLoggedIn) {
            $html .= "<a href=" . $this->navView->getURLToAddPub() . ">Lägg till pub</a><br/ >";
            $html .= "<a href=" . $this->navView->getURLToAddBeer() . ">Lägg til öl</a>";
        } else {
            $html .= "<p>Vänligen logga in för att administrera pubar och öl</p>";
        }

        $html .= $this->loginView->response();
        return $html;
    }

}