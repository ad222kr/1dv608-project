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


    public function response() {
        return "<form method='post'>" .
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

        return new \model\Pub($name, $address, $webpage);
    }
}