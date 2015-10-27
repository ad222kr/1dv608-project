<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-23
 * Time: 16:52
 */

namespace controller;


use view\BeerView;

class PubController implements IController {

    /**
     * @var ListPubsView
     */
    private $listPubsView;

    /**
     * @var null | \view\PubView
     */
    private $pubView = null;

    /**
     * @var \view\NavigationView
     */
    private $navView;

    /**
     * @var \model\PubRepository
     */
    private $pubs;

    public function __construct(\view\ListPubsView $listPubsView, \view\NavigationView $navView,
                                \model\PubRepository $pubs) {
        $this->navView = $navView;
        $this->pubs = $pubs;
        $this->listPubsView = $listPubsView;
    }


    public function doControl() {
        if ($this->navView->userWantsToSeePub()) {
            $selectedPub = $this->listPubsView->getSelectedPub();
            if ($selectedPub == null) return;
            $this->pubView = new \view\PubView($selectedPub, $this->navView);
        }

    }

    public function getView() {
        if ($this->pubView != null)
            return $this->pubView;
        else
            return $this->listPubsView;
    }
}