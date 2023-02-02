<?php

require "../config.php";
require "../model/client.php";

session_start();

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['date']) && isset($_POST['service'])) {

    $obj = new Client($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['date'], $_POST['service'], $_SESSION['user_id']);
    $status = $obj->update($_POST['id'], $conn);

    if ($status) {
        echo 'Success';
    } else {
        echo 'Failed';
    }
}
