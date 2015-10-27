<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 12:41
 */

namespace view;


class PubView implements IView {

    private $pub;
    private $navView;
    public function __construct(\model\Pub $pub, \view\NavigationView $navView) {
        $this->pub = $pub;
        $this->navView = $navView;
    }



    public function response() {

        $id = $this->pub->getId();
        $name = $this->pub->getName();
        $address = $this->pub->getAddress();
        $webpageURL = $this->pub->getWebpageURL();


        $html = "<div class='row'>
                    <div class='col-md-4'>
                    <h2>$name</h2>
                    <address>$address</address>
                    <a href='$webpageURL'>Gå till hemsidan</a>
                    </div>
                    <div class='col-md-8'>
                    <h3>Öl-sortiment</h3>
                        <div class='table-responsive'>
                        <table class='table'>

                            ". $this->getBeerTableRows() ."
                        </table>
                        </div>

                    </div>
                </div>";
        return $html;
    }

    private function getBeerTableRows() {
        $beers = $this->pub->getBeers();
        $html = "<thead><tr><th>Namn</th><th>Bryggeri</th><th>Pris</th></thead>";
        foreach($beers as $beer) {
            $html .= "<tr>";
            $html .= "<td><a href='". $this->navView->getURLToBeer($beer->getID()) ."'>". $beer->getName() ."</a>";
            $html .= "<td>" . $beer->getBrewery() . "</td>";
            $html .= "<td>". $beer->getPrice() ."</td>";

            $html .= "</tr>";
        }

        return $html;
    }

}