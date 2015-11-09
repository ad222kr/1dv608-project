<?php

namespace view;

require_once("src/common/exceptions/BeerNotValidException.php");

class AddBeerView extends BaseFormView{

    /**
     * Action of the form
     * @var string
     */
    private static $action = "?action=admin&add_beer";

    /**
     * ID's for the different form-elements
     */
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

    /**
     * Error-messages
     */
    private static $nameMissingMessage = "Ölens namn saknas, vänligen fyll i";
    private static $abvMissingMessage = "Ölens alkoholprocent saknas, vänligen fyll i";
    private static $breweryMissingMessage = "Ölens bryggeri saknas, vänligen fyll i";
    private static $countryMissingMessage = "Ölens ursprungsland saknas, vänligen fyll i";
    private static $volumeMissingMessage = "Ölens volum saknas, vänligen fyll i";
    private static $priceMissingMessage = "Ölnes pris saknas, vänligen fyll i";
    private static $servingTypeMissingMessage = "Ölens serveringstyp saknas, vänligen välj!";

    /**
     * Serving types
     */
    private static $servingTypeBottleValue = "Flaska";
    private static $servingTypeTapValue = "Fat";

    /**
     * @param \common\ITempDataHandler $tempDataHandler
     * @param \model\PubRepository $pubs
     */
    public function __construct(\common\ITempDataHandler $tempDataHandler ,\model\PubRepository $pubs) {
        parent::__construct($tempDataHandler);
        $this->pubs = $pubs;
    }


    /**
     * Response generated by this view
     *
     * @return string
     */
    public function response() {

        $message = $this->getMessage();
        return "<form method='post' action='". self::$action."'>
                <p id='" . self::$messageId . "'>" . $message . "</p>" .
                $this->getErrorMessages() .
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

    /**
     * @return string
     */
    private function getPubDropDown() {
        $html = "<select id='". self::$pubId ."' name='". self::$pubId ."'>";
        foreach ($this->pubs->get() as $pub) {
            $html .= $this->getDropDownOption($pub->getName(), $pub->getId());
        }
        $html .= "</select>";
        return $html;
    }


    /**
     * @return Beer
     * @throws \BeerNotValidException
     */
    public function getBeer() {

            $name = $this->getPostField(self::$nameID);
            $abv = $this->getPostField(self::$abvID);
            $brewery = $this->getPostField(self::$breweryID);
            $country = $this->getPostField(self::$countryID);
            $volume = $this->getPostField(self::$volumeID);
            $servingType = $this->getPostField(self::$servingTypeID);

        if ($this->isValid($name, $abv, $brewery, $country, $volume, $servingType))
            return new Beer($name, $abv, $brewery, $country, $volume, $servingType);

        return null; // Controller checks for null
    }

    /**
     * Instance representing relational-table. Holds the price of the beer.
     *
     * @param $beerId
     * @return \model\PubBeer
     */
    public function getPubBeer($beerId) {
        $pubId = $this->getPostField(self::$pubId);
        $price = $this->getPostField(self::$priceID);

        return new \model\PubBeer($pubId, $beerId, $price);
    }

    /**
     * @return bool
     */
    public function adminPressedSave() {
        return isset($_POST[self::$submitPostID]);
    }

    /**
     * @param $name
     * @param $abv
     * @param $brewery
     * @param $country
     * @param $volume
     * @param $servingType
     * @return bool
     */
    private function isValid($name, $abv, $brewery, $country, $volume,$servingType) {
        $isValid = true;
        $errorMessages = array();

        if (empty($name)) {
            $isValid = false;
            $errorMessages[] = self::$nameMissingMessage;
        }
        if (empty($abv)) {
            $isValid = false;
            $errorMessages[] = self::$abvMissingMessage;
        }

        if (empty($brewery)) {
            $isValid = false;
            $errorMessages[] = self::$breweryMissingMessage;
        }

        if (empty($country)) {
            $isValid = false;
            $errorMessages[] = self::$countryMissingMessage;
        }

        if (empty($volume)) {
            $isValid = false;
            $errorMessages[] = self::$volumeMissingMessage;
        }
        if (empty($servingType)) {
            $isValid = false;
            $errorMessages[] = self::$servingTypeMissingMessage;
        }

        if (empty($this->getPostField(self::$priceID))) {
            $errorMessages[] = self::$priceMissingMessage;
        }
        $this->setErrorMessages($errorMessages);
        return $isValid;
    }
}