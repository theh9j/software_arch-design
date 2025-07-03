<?php
session_start();

abstract class Account {
    private string $name;
    private string $dob;
    private string $address = "Not defined";
    protected string $uniqid;

    public function __construct($name, $dob) {
        $this->name = $name;
        $this->dob = $dob;
        $this->uniqid = UniqueID();
        $_SESSION["id"] = $this->uniqid;
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

    public function getID() {
        return $this->uniqid;
    }

    abstract public function updateDob($newDob);
}

class User extends Account {
    private int $changeCount = 0;

    public function __construct($name, $dob) {
        parent::__construct($name, $dob);
        
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
        $this->uniqid = parent::getID() . "ADMIN";
        $_SESSION["id"] = $this->uniqid;
    }

    public function updateDob($newDob) {
        $this->dob = $newDob;
    }

    public function deleteAccount(&$accounts, $targetId) {
        foreach ($accounts as $index => $account) {
            if (str_ends_with($account->getID(), "ADMIN")) {
                continue;
            }
            if ($account->getID() === $targetId) {
                $nam = $account->getName();
                unset($accounts[$index]);
                return "Account with name $nam has been deleted.";
            }
        }
        return "Deletion failed: Either not found or is an ADMIN account.";
    }
}

function UniqueID($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzBCDEFGHIJKLMNOPQRSTUVWXYZ';
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
    $users[] = new Manager("Tam", "02-12-2002");
    $mana = new Manager("Bob", "02-12-2002");

    foreach ($users as $user) {
        if ($user->getID() === $_SESSION['id']) {
            $name = $user->getID();
            echo "Hello, $name";
        }
    }

    $rep2 = $mana->getID();
    echo $rep2;

    $rep = $mana->deleteAccount($users, $users[0]->getID());
    echo $rep;
}

Processor();
?>