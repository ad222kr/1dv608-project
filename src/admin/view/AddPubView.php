<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-23
 * Time: 17:05
 */

namespace view;


class AddPubView extends BaseFormView {

    private static $action = "?action=admin&add_pub";

    private static $submitPostId = "AddPubView::Submit";
    private static $nameId = "AddPubView::Name";
    private static $addressId = "AddPubView::Address";
    private static $webpageId = "AddPubView::WebpageId";
    private static $messageId = "AddPubView::Message";

    private static $nameMissingMessage = "Pubens namn saknas, vänligen ange!";
    private static $addressMissingMessage = "Pubens adress saknas, vänligen ange!";
    private static $webpageURLMissingMessage = "Pubens webaddress saknas, vänligen ange!";
    private static $URLWrongFormatMessage = "Pubens webaddress är ej tillåten, måste vara http(s)://www.urlhere.domain";


    public function response() {
        $message = $this->getMessage();
        return "<form method='post' action='". self::$action ."'>
        <p id='" . self::$messageId . "'>" . $message . "</p>" .
        $this->getErrorMessages() .
        $this->getTextField("Namn: ", self::$nameId, self::$inputTypeText) . "<br />" .
        $this->getTextField("Adress: ", self::$addressId, self::$inputTypeText) . "<br />" .
        $this->getTextField("Webbsida: ", self::$webpageId, self::$inputTypeText) . "<br />" .
        "<input type='submit' name='".self::$submitPostId."'>
                </form>";
    }

    public function adminPressedSave() {
        return isset($_POST[self::$submitPostId]);
    }

    public function getPub() {
        $name = $this->getPostField(self::$nameId);
        $address = $this->getPostField(self::$addressId);
        $webpage = $this->getPostField(self::$webpageId);

        if ($this->isValid($name, $address, $webpage))
            return new \model\Pub(htmlspecialchars($name), htmlspecialchars($address), htmlspecialchars($webpage));

        else return null;
    }

    private function isValid($name, $address, $webpage) {

        $isValid = true;
        $errorMessages = array();

        if (empty($name)) {
            $isValid = false;
            $errorMessages[] = self::$nameMissingMessage;
        }

        if (empty($address)) {
            $isValid = false;
            $errorMessages[] = self::$addressMissingMessage;
        }

        if (empty($webpage)) {
            $isValid = false;
            $errorMessages[] = self::$webpageURLMissingMessage;

        } elseif (!filter_var($webpage, FILTER_VALIDATE_URL)) {
            $isValid = false;
            $terrorMessages[] = self::$URLWrongFormatMessage;
        }
        $this->setErrorMessages($errorMessages);
        return $isValid;
    }

}