<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-25
 * Time: 22:05
 */

namespace view;


class ListBeersView implements IView {

    private $pubRepository;
    private $navView;

    public function __construct(\model\PubRepository $pubRepository, \view\NavigationView $navView) {
        $this->pubRepository = $pubRepository;
        $this->navView = $navView;
    }

    public function response() {
        $ret = "<ul>";

        foreach ($this->pubRepository->getPubs() as $pub) {
            $id = $pub->getId();
            $name = $pub->getName();
            $address = $pub->getAddress();
            $webPageURL = $pub->getWebpageURL();
            $urlToPubView = $this->navView->getURLToPub($id);

            $ret .= "<li><a href='$urlToPubView'>$name</a></li>";

        }

        return $ret;
    }
}