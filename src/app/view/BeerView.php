<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 23:09
 */

namespace view;


class BeerView  {

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
                        <div><b>Namn: </b><p>' . $this->beer->getName(). '</p></div>
                        <div><b>Bryggeri:</b><p>' . $this->beer->getBrewery(). '</p></div>
                        <div><b>Abv: </b><p>' . $this->beer->getAbv(). '</p></div>
                        <div><b>Land: </b><p>' . $this->beer->getCountry(). '</p></div>
                        <div><b>Serveringstyp: </b><p>' . $this->beer->getServingType(). '</p></div>
                        <div><b>Volym: </b><p>' . $this->beer->getVolume(). ' cl</p></div>
                    </div>
                </div>';

        return $html;
    }
}