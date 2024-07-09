<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validationName($name) {
        if (preg_match("/^[a-zA-ZÀ-ÿ]+(([',. -][a-zA-ZÀ-ÿ ])?[a-zA-ZÀ-ÿ]*)*$/", $name)){
            return false;
        } else {
            return true;
        }
    }

    function validationPostalCode($postalCode) {
        if (preg_match("/^\d{4}\s?-\s?\d{3}$/", $postalCode)){
            return false;
        } else {
            return true;
        }
    }

    function validationUsername($username) {
        if (preg_match("/^[a-zA-Z0-9]{5,}$/", $username)){
            return false;
        } else {
            return true;
        }
    }

    function validationEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }        
    }
?>