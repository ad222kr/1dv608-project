<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-23
 * Time: 16:52
 */

namespace controller;


class PubController implements IController {

    private $listPubsView;
    private $pubView = null;
    private $navView;
    private $pubs;

    public function __construct(\view\ListPubsView $listPubsView, \view\NavigationView $navView, \model\PubRepository $pubs) {
        $this->navView = $navView;
        $this->pubs = $pubs;
        $this->$listPubsView = $listPubsView;
    }


    public function doControl() {
        if ($this->navView->userWantsToSeePub()) {
            $selectedPub = new \view\PubView();
        } else {
            // show all pubs
            $view = new \view\ListPubsView($this->pubs, $this->navView);
        }
    }

    public function getView() {
        return $this->view;
    }
}