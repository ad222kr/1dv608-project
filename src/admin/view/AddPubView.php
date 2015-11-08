<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-23
 * Time: 17:05
 */

namespace view;


class AddPubView extends BaseFormView {

    private static $submitPostId = "AddPubView::Submit";
    private static $nameId = "AddPubView::Name";
    private static $addressId = "AddPubView::Address";
    private static $webpageId = "AddPubView::WebpageId";
    private static $messageId = "AddPubView::Message";

    private static $nameMissingMessage = "Pubens namn saknas, vänligen ange!";
    private static $addressMissingMessage = "Pubens adress saknas, vänligen ange!";
    private static $webpageURLMissingMessage = "Pubens webaddress saknas, vänligen ange!";


    public function response() {
        $message = $this->getMessage();
        return "<form method='post'>
        <p id='" . self::$messageId . "'>" . $message . "</p>" .
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
        try {
            $name = $this->getPostField(self::$nameId);
            $address = $this->getPostField(self::$addressId);
            $webpage = $this->getPostField(self::$webpageId);

            return new \model\Pub($name, $address, $webpage);
        } catch (\NameMissingException $e) {
            $this->setMessage(self::$nameMissingMessage, true);
        } catch (\AddressMissingException $e) {
            $this->setMessage(self::$addressMissingMessage, true);
        } catch (\WebpageURLMissingException $e) {
            $this->setMessage(self::$webpageURLMissingMessage, true);
        }

    }
}