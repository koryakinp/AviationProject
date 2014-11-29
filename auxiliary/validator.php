<?php

class Validate {

    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    // Validate a generic text field
    public function text($name, $value, $required = true, $min = '', $max = '') {
        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        if ($required && empty($value)) { $field->setErrorMessage('Required');}

        if ($min != '' && $max != '') {
            if (strlen($value) < $min) {
                $field->setErrorMessage('Too short');
            } else if (strlen($value) > $max) {
                $field->setErrorMessage('Too long');
            } else {
                $field->clearErrorMessage();
            }
        }
    }

    // Validate a field with a generic pattern
    public function pattern($name, $value, $pattern, $message, $required = true) {
        $field = $this->fields->getField($name);

        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } else if ($match != 1) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }

    public function phone($name, $value, $required = false) {
        $field = $this->fields->getField($name);

        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        $pattern = '/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/';
        $message = 'Invalid phone number.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        $pattern = '/^[\w\.-]+(\+[\w-]*)?@([\w-]+\.)+[\w-]+$/';
        $message = 'Invalid email address.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function validInteger($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        $pattern = '/^[0-9]{1,10}$/';
        $message = 'Integer is not valid.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function validateCategoryToDelete($name, $value) {
        $field = $this->fields->getField($name);
        if ($field->hasError()) {
            return;
        }
        if (count(DataBase::getCategoriesByRoot($value)) > 0) {
            $field->setErrorMessage('The category has child categories in it.');
        } else {
            $field->clearErrorMessage();
        }
    }

    public function validateCategoryToAdd($name, $categoryName) {
        $field = $this->fields->getField($name);
        if ($field->hasError()) {
            return;
        }
        if (DataBase::getCategory('categoryName', $categoryName) != null) {
            $field->setErrorMessage('A category with a name "' . $categoryName . '" already exists.');
        } else {
            $field->clearErrorMessage();
        }
    }

    public function ifUsernameUnique($name, $value) {
        $field = $this->fields->getField($name);

        if (DataBase::getUser('username', $value) != null) {
            $field->setErrorMessage('User ' . $value . ' is already registered.');
        } else {
            $field->clearErrorMessage();
        }
    }

    public function ifEmailUnique($name, $value) {
        $field = $this->fields->getField($name);

        if (DataBase::getUser('email', $value) != null) {
            $field->setErrorMessage('Email ' . $value . ' is already registered.');
        } else {
            $field->clearErrorMessage();
        }
    }

    public function isChecked($name, $value, $required = false) {
        $field = $this->fields->getField($name);

        if (!$required) {
            $field->clearErrorMessage();
            return;
        }

        if ($value == false) {
            $field->setErrorMessage($field->getMessage());
        } else {
            $field->clearErrorMessage();
        }
    }

    public function isDropSelected($name, $value, $notSelectedValue, $required = false) {
        $field = $this->fields->getField($name);

        if (!$required) {
            $field->clearErrorMessage();
            return;
        }

        if ($value == $notSelectedValue) {
            $field->setErrorMessage($field->getMessage());
        } else {
            $field->clearErrorMessage();
        }
    }

    public function ifUserisactive($name, $value, $password) {
        $field = $this->fields->getField($name);
        $user = DataBase::getUser('username', $value);
        if ($user == null) {
            $field->setErrorMessage('No such user exists!');
        } else if ($user->getStatus() != 'active') {
            $field->setErrorMessage('User account is not active!');
        } else if (Hash::make($password, $user->getSalt()) != $user->getPasswordHash()) {
            $field->setErrorMessage('Password is not correct!');
        } else {
            $field->clearErrorMessage();
        }
    }

    public function ifPasswordMatches($name, $password, $confirmation) {
        $field = $this->fields->getField($name);
        if ($field->hasError())
            return;
        if ($password != $confirmation) {
            $field->setErrorMessage('Passwords do not match!');
        }
    }

    public function ifPasswordCorrect($name, $userid, $oldpassword, $newpassword, $confirmation) {
        $field = $this->fields->getField($name);
        $user = DataBase::getUser('userID', $userid);
        $salt = $user->getSalt();
        if ($user->getPasswordHash() != Hash::make($oldpassword, $salt)) {
            $field->setErrorMessage('Old password is not correct!');
        } else if ($newpassword != $confirmation) {
            $field->setErrorMessage('Passwords do not match');
        } else {
            $field->clearErrorMessage();
        }
    }

}

?>