<?php

namespace view;


use model\Beer;
use model\PubBeer;

class AddBeerView extends BaseFormView{

    private static $nameID = "AddBeerView::Name";
    private static $abvID = "AddBeerView::Abv";
    private static $breweryID = "AddBeerView::Brewery";
    private static $imageURLID = "AddBeerView::ImageURL";
    private static $countryID = "AddBeerView::Country";
    private static $volumeID = "AddBeerView::Volume";
    private static $servingTypeID = "AddBeerView::ServingType";
    private static $priceID = "AddBeerView::Price";
    private static $submitPostID = "AddBeerView::Submit";
    private static $pubId = "AddBeerView::PubId";


    private static $inputTypeText = "text";
    private static $inputTypeNumber = "number";

    private static $servingTypeBottleValue = "Flaska";
    private static $servingTypeTapValue = "Fat";

    public function __construct(\common\ITempDataHandler $tempDataHandler ,\model\PubRepository $pubs) {
        parent::__construct($tempDataHandler);
        $this->pubs = $pubs;
    }

    public function response() {
        return "<form method='post'>" .
                $this->getPubDropDown() . "<br />" .
                $this->getTextField("Namn: ", self::$nameID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Alkoholprocent: ", self::$abvID, self::$inputTypeNumber) . "<br />" .
                $this->getTextField("Bryggeri: ", self::$breweryID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Land: ", self::$countryID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Volym: ", self::$volumeID, self::$inputTypeNumber) . "<br />" .
                $this->getTextField("Pris: ", self::$priceID, self::$inputTypeNumber) . "<br />" .

                "<label for='" . self::$servingTypeID . "'>Serveringstyp: </label><br />" .
                $this->getRadioButton(self::$servingTypeID, self::$servingTypeBottleValue) . "<br />" .
                $this->getRadioButton(self::$servingTypeID, self::$servingTypeTapValue) . "<br />" .
                "<input type='submit' name='".self::$submitPostID."'>
                </form>";
    }

    private function getPubDropDown() {
        $html = "<select id='". self::$pubId ."' name='". self::$pubId ."'>";
        foreach ($this->pubs->get() as $pub) {
            $html .= $this->getDropDownOption($pub->getName(), $pub->getId());
        }
        $html .= "</select>";
        return $html;
    }

    public function getBeer() {
        $name = $this->getPostField(self::$nameID);
        $abv = $this->getPostField(self::$abvID);
        $brewery = $this->getPostField(self::$breweryID);
        $country = $this->getPostField(self::$countryID);
        $volume = $this->getPostField(self::$volumeID);
        $servingType = $this->getPostField(self::$servingTypeID);

        return new Beer($name, $abv, $brewery, $country, $volume, $servingType);
    }

    public function getPubBeer($beerId) {
        $pubId = $this->getPostField(self::$pubId);
        $price = $this->getPostField(self::$priceID);
        return new \model\PubBeer($pubId, $beerId, $price);
    }

    public function adminPressedSave() {
        return isset($_POST[self::$submitPostID]);
    }




}