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
    private static $messageId = "AddBeerView::Message";

    private static $nameMissingMessage = "Ölens namn saknas, vänligen fyll i";
    private static $abvMissingMessage = "Ölens alkoholprocent saknas, vänligen fyll i";
    private static $breweryMissingMessage = "Ölens bryggeri saknas, vänligen fyll i";
    private static $countryMissingMessage = "Ölens ursprungsland saknas, vänligen fyll i";
    private static $volumeMissingMessage = "Ölens volum saknas, vänligen fyll i";
    private static $priceMissingMessage = "Ölnes pris saknas, vänligen fyll i";

    private static $servingTypeBottleValue = "Flaska";
    private static $servingTypeTapValue = "Fat";

    public function __construct(\common\ITempDataHandler $tempDataHandler ,\model\PubRepository $pubs) {
        parent::__construct($tempDataHandler);
        $this->pubs = $pubs;
    }

    public function response() {

        $message = $this->getMessage();
        return "<form method='post'>
                <p id='" . self::$messageId . "'>" . $message . "</p>" .
                $this->getPubDropDown() . "<br />" .
                $this->getTextField("Namn: ", self::$nameID, self::$inputTypeText) . "<br />" .
                $this->getFloatingPointNumberInputField("Alkoholprocent: ", self::$abvID) . "<br />" .
                $this->getTextField("Bryggeri: ", self::$breweryID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Land: ", self::$countryID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Volym: ", self::$volumeID, self::$inputTypeNumber) . "<br />" .
                $this->getFloatingPointNumberInputField("Pris: ", self::$priceID) . "<br />" .

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
        try {
            $name = $this->getPostField(self::$nameID);
            $abv = $this->getPostField(self::$abvID);
            $brewery = $this->getPostField(self::$breweryID);
            $country = $this->getPostField(self::$countryID);
            $volume = $this->getPostField(self::$volumeID);
            $servingType = $this->getPostField(self::$servingTypeID);

            return new Beer($name, $abv, $brewery, $country, $volume, $servingType);
        } catch (\NameMissingException $e) {
            // Should gather all missing and present every field that is empty but not time..
            $this->setMessage(self::$nameMissingMessage, true);
        } catch (\AbvMissingException $e) {
            $this->setMessage(self::$abvMissingMessage, true);
        } catch (\BreweryMissingException $e) {
            $this->setMessage(self::$breweryMissingMessage, true);
        } catch (\CountryMissingException $e) {
            $this->setMessage(self::$countryMissingMessage, true);
        } catch (\VolumeMissingException $e) {
            $this->setMessage(self::$volumeMissingMessage, true);
        }
    }

    public function getPubBeer($beerId) {
        try {
            $pubId = $this->getPostField(self::$pubId);
            $price = $this->getPostField(self::$priceID);
            return new \model\PubBeer($pubId, $beerId, $price);
        } catch (\PriceMissingException $e) {
            $this->setMessage(self::$priceMissingMessage, true);
        }

    }

    public function adminPressedSave() {
        return isset($_POST[self::$submitPostID]);
    }




}