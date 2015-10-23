<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-19
 * Time: 14:37
 */

namespace view;


class AddBeerFormView implements IView{

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

    private function getTextField($title, $name, $type) {
        $value = $this->getPostField($name);

        return "<label for='$name'>$title: </label>
                <input id='$name' type='$type' value='$value' name='$name' />";
    }

    private function getRadioButton($name, $value) {
        return "<input type='radio' name='$name' value='$value'>$value</input>";
    }

    /**
     * Returns a $_POST-variable. Shamelessly stolen from
     * https://github.com/dntoll/1DV608/blob/master/lectures/LectureCode/view/AdminView.php#L68
     * @param $field
     * @return string
     */
    private function getPostField($field) {
        if (isset($_POST[$field])) {
            return trim($_POST[$field]);
        }
        return "";
    }
}