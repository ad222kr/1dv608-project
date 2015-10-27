<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-25
 * Time: 21:29
 */

namespace view;

/**
 * Class BaseFormView
 * Contains functions for getting Form-elements
 * @package view
 */

class BaseFormView {


    protected function getTextField($title, $name, $type) {
        $value = $this->getPostField($name);

        return "<label for='$name'>$title: </label>
                <input id='$name' type='$type' value='$value' name='$name' />";
    }

    protected function getRadioButton($name, $value) {
        return "<input type='radio' name='$name' value='$value'>$value</input>";
    }

    /**
     * Returns a $_POST-variable. Shamelessly stolen from
     * https://github.com/dntoll/1DV608/blob/master/lectures/LectureCode/view/AdminView.php#L68
     * @param $field
     * @return string
     */
    protected function getPostField($field) {
        if (isset($_POST[$field])) {
            return trim($_POST[$field]);
        }
        return "";
    }
}