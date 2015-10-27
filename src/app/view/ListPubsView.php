<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-25
 * Time: 22:05
 */

namespace view;


class ListPubsView implements IView {

    private $pubRepository;
    private $navView;

    public function __construct(\model\PubRepository $pubRepository, \view\NavigationView $navView) {
        $this->pubRepository = $pubRepository;
        $this->navView = $navView;
    }

    public function response() {
        $ret = "<ul>";


        foreach ($this->pubRepository->get() as $pub) {


            $id = $pub->getId();
            $name = $pub->getName();
            $address = $pub->getAddress();
            $webPageURL = $pub->getWebpageURL();
            $urlToPubView = $this->navView->getURLToPub($id);


            $ret .= "<li><a href='$urlToPubView'>$name</a></li>";
        }

        $ret .= "</ul>";

        return $ret;
    }

    public function getSelectedPub() {

        try{
            $id = $this->navView->getPubId();

            $pub = $this->pubRepository->getPubFromID($id);

            return $pub;
        } catch (\PubDoesNotExistsException $e) {
            echo $e->getMessage(); //TODO: flöashmessage
        }

    }

    /**
     * In a perfect world this function would be in the PubView
     * but since the ListPubView is the view injected into pub-controller
     * this function resides here so we can know what beer to view.
     * @return mixed
     */

}