<?php

class UserReg
{
    //atributi
    public $id;
    public $username;
    public $email;
    public $password;

    //konstruktor
    public function __construct($id = null, $username = null, $email = null, $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public static function registerUser($korisnik, mysqli $conn)
    {
        $query = "SELECT * FROM users WHERE email='$korisnik->email'";
        return $conn->query($query);
    }
    public static function addUser($user, $conn)
    {
        $query = "INSERT INTO users (username, email, password)
        VALUES ('$user->korisnicusernamekoime', '$user->email', '$user->password')";
        return $conn->query($query);
    }
}
