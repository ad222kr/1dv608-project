<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 23:09
 */

namespace view;


class BeerView implements IView {

    private $beer;

    public function __construct(\model\Beer $beer) {
        $this->beer = $beer;
    }

    public function response() {
        return $this->beer->getName();
    }
}