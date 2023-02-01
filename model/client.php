
<?php

class Client
{
    public $id;
    public $name;
    public $surname;
    public $date;
    public $service;
    public $userid;

    public function __construct($id = null, $name = null, $surname = null, $date = null, $service = null, $userid = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->date = $date;
        $this->service = $service;
        $this->userid = $userid;
    }


    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM clients";
        return $conn->query($query);
    }



    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM clients WHERE id=$id";

        $myObj = array();
        if ($msqlObj = $conn->query($query)) {
            while ($row = $msqlObj->fetch_array(1)) {
                $myObj[] = $row;
            }
        }

        return $myObj;
    }


    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM clients WHERE id=$this->id";
        return $conn->query($query);
    }


    public function update($id, mysqli $conn)
    {
        $query = "UPDATE clients set name = '$this->name',surname = '$this->surname',date = '$this->date'
        ,service = '$this->service' WHERE id='$id'";
        return $conn->query($query);
    }


    public static function add(Client $client, mysqli $conn)
    {
        $query = "INSERT INTO clients(name, surname, date, service,userid) VALUES('$client->name','$client->surname','$client->date','$client->service','$client->userid')";
        return $conn->query($query);
    }
}
