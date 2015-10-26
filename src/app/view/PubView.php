<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-26
 * Time: 12:41
 */

namespace view;


class PubView implements IView {

    private $pub;

    public function __construct(\model\Pub $pub) {
        $this->pub = $pub;
    }



    public function response() {
        return "<p>This is a beer! " . $this->pub->getName() . "</p>";
    }
}