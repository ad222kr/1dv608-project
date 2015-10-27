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
        return $this->getBeerHTML();
    }

    private function getBeerHTML() {
        $image = $this->beer->getImageURL();
        $html = '<div class="row">
                    <div class="col-md-4">
                        <img src="'.$image .'" alt="BeerImage" class="img-circle beer-image img-responsive">
                    </div>
                    <div class="col-md-8">
                        
                    </div>
                </div>';

        return $html;
    }
}