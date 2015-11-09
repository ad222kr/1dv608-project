<?php

namespace view;

/**
 * Class ListPubsView
 * View class to present the class \model\Pubrepository. Lists all pubs
 * @package view
 */

class ListPubsView  {

    /**
     * @var \model\PubRepository
     */
    private $pubRepository;

    /**
     * @var NavigationView
     */
    private $navView;

    /**
     * @param \model\PubRepository $pubRepository
     * @param NavigationView $navView
     */
    public function __construct(\model\PubRepository $pubRepository, \view\NavigationView $navView) {
        $this->pubRepository = $pubRepository;
        $this->navView = $navView;
    }

    /**
     * Response returned to the LayoutView and rendered
     * @return string
     */
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

    /**
     * @return \model\Pub
     * @throws \PubDoesNotExistsException
     */
    public function getSelectedPub() {
        try {
            $id = $this->navView->getPubId();

            $pub = $this->pubRepository->getPubFromID($id);

            return $pub;
        } catch (\PubDoesNotExistsException $e) {
            if (\Settings::DEBUG_MODE) {
                echo "No such pub";
                throw $e;
            } else {
                echo "No such pub";
            }
        }

    }

    /**
     * @return string
     */
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