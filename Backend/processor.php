<?php
session_start();

abstract class Account {
    private string $name;
    private string $dob;
    private string $address = "Not defined";

    public function __construct($name, $dob) {
        $this->name = $name;
        $this->dob = $dob;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getName() {
        return $this->name;
    }

    public function updateAddress($newAddress) {
        $this->address = $newAddress;
    }

    public function updateName($newName) {
        $this->name = $newName;
    }

    abstract public function updateDob($newDob);
}

class User extends Account {
    private int $changeCount = 0;
    private string $uniqid;

    public function __construct($name, $dob) {
        parent::__construct($name, $dob);
        $this->uniqid = UniqueID();
        $_SESSION["id"] = $this->uniqid;
    }

    public function getID() {
        return $this->uniqid;
    }

    public function getDob() {
        return $this->dob;
    }

    public function updateDob($newDob) {
        if ($changeCount != 2) {
            $changeCount += 1;
            $this->dob = $newDob;
            return "Date of Birth updated!";
        } else {
            return "Date of Birth has been changed too many times!";
        }
    }
}

class Manager extends Account {
    public function __construct($name, $dob) {
        parent::__construct($name, $dob);
    }

    public function updateDob($newDob) {
        $this->dob = $newDob;
    }
}

function UniqueID($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

function Processor() {
    $users = [];
    $users[] = new User("James", "12-22-2004");
    $users[] = new User("Alice", "09-02-2000");

    foreach ($users as $user) {
        if ($user->getID() === $_SESSION['id']) {
            $name = $user->getName();
            echo "Hello, $name";
        }
    }
}

Processor();
?>