<?php

require "../config.php";
require "../model/client.php";

if (isset($_POST['id'])) {
    $myArray = Client::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}
