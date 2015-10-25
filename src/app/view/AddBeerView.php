<?php

namespace view;


class AddBeerView extends BaseFormView implements IView{

    private static $nameID = "AddBeerView::Name";
    private static $abvID = "AddBeerView::Abv";
    private static $breweryID = "AddBeerView::Brewery";
    private static $imageURLID = "AddBeerView::ImageURL";
    private static $countryID = "AddBeerView::Country";
    private static $volumeID = "AddBeerView::Volume";
    private static $servingTypeID = "AddBeerView::ServingType";
    private static $priceID = "AddBeerView::Price";
    private static $submitPostID = "AddBeerView::Submit";

    private static $inputTypeText = "text";
    private static $inputTypeNumber = "number";

    private static $servingTypeBottleValue = "Flaska";
    private static $servingTypeTapValue = "Fat";

    public function response() {
        return "<form method='post'>" .
                $this->getTextField("Namn: ", self::$nameID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Alkoholprocent: ", self::$abvID, self::$inputTypeNumber) . "<br />" .
                $this->getTextField("Bryggeri: ", self::$breweryID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Land: ", self::$countryID, self::$inputTypeText) . "<br />" .
                $this->getTextField("Volym: ", self::$volumeID, self::$inputTypeNumber) . "<br />" .

                "<label for='" . self::$servingTypeID . "'>Serveringstyp: </label><br />" .
                $this->getRadioButton(self::$servingTypeID, self::$servingTypeBottleValue) . "<br />" .
                $this->getRadioButton(self::$servingTypeID, self::$servingTypeTapValue) . "<br />" .
                "<input type='submit' name='".self::$submitPostID."'>
                </form>";
    }


}