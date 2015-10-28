<?php

namespace view;

class ListPubsView  {

    private $pubRepository;
    private $navView;

    public function __construct(\model\PubRepository $pubRepository, \view\NavigationView $navView) {
        $this->pubRepository = $pubRepository;
        $this->navView = $navView;
    }

    public function response() {

        $html = "<div class='row'>

                    <h3>Pubar</h3>
                        <div class='table-responsive'>
                        <table class='table'>

                            ". $this->getPubTableRows() ."
                        </table>
                        </div>


                </div>";
        return $html;
    }

    public function getSelectedPub() {
        $id = $this->navView->getPubId();

        $pub = $this->pubRepository->getPubFromID($id);

        return $pub;
    }
    private function getPubTableRows() {
        $pubs = $this->pubRepository->get();
        $html = "<thead><tr><th>Namn</th><th>Adress</th></thead>";
        foreach($pubs as $pub) {
            $html .= "<tr>";
            $html .= "<td><a href='". $this->navView->getURLToPub($pub->getID()) ."'>". $pub->getName() ."</a>";
            $html .= "<td>" . $pub->getAddress() . "</td>";

            $html .= "</tr>";
        }

        return $html;
    }
}