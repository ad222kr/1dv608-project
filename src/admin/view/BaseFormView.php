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

abstract class BaseFormView {

    private static $messageKey = "SessionHandler::TempMessage";
    private static $errorMessagesKey = "SessionHandler::ErrorMessages";
    protected static $registeredUsernameKey = "SessionHandler::Username";
    protected static $inputTypeText = "text";
    protected static $inputTypeNumber = "number";
    /**
     * @var \common\ITempDataHandler
     */
    protected $tempDataHandler;
    /**
     * @var String, Feedback message
     */
    protected $message = null;


    public function __construct(\common\ITempDataHandler $tempDataHandler) {
        $this->tempDataHandler = $tempDataHandler;
    }

    /**
     * @param $stringToSanitize
     * @return string, input sanitized
     */
    protected function sanitizeInput($stringToSanitize) {
        assert(is_string($stringToSanitize));
        $sanitized = htmlspecialchars($stringToSanitize, ENT_COMPAT,'ISO-8859-1');
        return $sanitized;
    }

    public function reloadPage() {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
    /**
     * Sets a message to the session if it should persist, else to a member var
     *
     * @param $message
     * @param bool|false $shouldPersistRedirect
     */
    protected function setMessage($message, $shouldPersistRedirect = false) {
        assert(is_string($message));
        assert(is_bool($shouldPersistRedirect));
        if ($shouldPersistRedirect) {
            $this->tempDataHandler->setTempData(self::$messageKey, $message);
        } else {
            $this->message = $message;
        }
    }

    /**
     * Sets an array of error messages for the form to the session
     *
     * @param $errorMessages
     */
    protected function setErrorMessages($errorMessages) {
        assert(is_array($errorMessages));
        $this->tempDataHandler->setTempData(self::$errorMessagesKey, $errorMessages);
    }

    /**
     * @return String
     */
    protected function getMessage() {
        if (strlen($this->message) > 0) {
            return $this->message;
        }
        return $this->tempDataHandler->getTempData(self::$messageKey);
    }

    /**
     * Returns an unordered list of error-messages for the form
     *
     * @return string
     */
    protected function getErrorMessages() {
        $messages = $this->tempDataHandler->getTempData(self::$errorMessagesKey);
        if (empty($messages)) return "";

        $ret = "<ul>";
        foreach ($messages as $errMsg) {
            $ret .= "<li>$errMsg</li>";
        }

        $ret .= "</ul>";
        return $ret;

    }

    /**
     * @param $title
     * @param $name
     * @param $type
     * @return string
     */
    protected function getTextField($title, $name, $type) {
        $value = $this->getPostField($name);

        return "<label for='$name'>$title: </label>
                <input id='$name' type='$type' value='$value' name='$name' />";
    }

    /**
     * @param $title
     * @param $name
     * @return string
     */
    protected function getFloatingPointNumberInputField($title, $name) {
        $value = $this->getPostField($name);

        return "<label for='$name'>$title: </label>
                <input id='$name' type='number' step='any' value='$value' name='$name' />";
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    protected function getRadioButton($name, $value) {
        return "<input type='radio' name='$name' value='$value'>$value</input>";
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    protected function getDropDownOption($name, $value) {
        return "<option value='" . $value . "'>" . $name . "</option>";
    }

    /**
     * Returns a $_POST-variable. Shamelessly stolen from daniel
     * @param $field
     * @return string
     */
    protected function getPostField($field) {
        if (isset($_POST[$field])) {
            return $this->sanitizeInput($_POST[$field]);
        }
        return "";
    }
}