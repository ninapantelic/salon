<?php

class UserLog
{
    //atributi
    public $id;
    //public $korisnickoime;
    public $email;
    public $password;

    //konstruktor
    public function __construct($id = null, $email = null, $password = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public static function loginUser($user, mysqli $conn)
    {
        $query = "SELECT * FROM users WHERE email='$user->email' and password='$user->password'";
        return $conn->query($query);
    }
}
