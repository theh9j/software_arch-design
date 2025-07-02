<?php
session_start();
require_once("Backend/constants.php");

class Account {
    private $name;
    private $age;
    private $address;

    function Account() {
        $address = "Not defined";
    }

    function updateAddress($newAddress) {
        $address = $newAddress;
        return $address;
    }

    function updateName($newName) {
        $name = $newName;
        return $name;
    }

    function updateAge($newAge) {
        

        return $age;
    }
}



?>