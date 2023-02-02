<?php

require "../config.php";
require "../model/client.php";

session_start();
if (
    isset($_POST['name']) && isset($_POST['surname'])
    && isset($_POST['date']) && isset($_POST['service'])
) {
    $client = new Client(null, $_POST['name'], $_POST['surname'], $_POST['date'], $_POST['service'], $_SESSION['user_id']);
    $status = Client::add($client, $conn);

    if ($status) {
        echo 'Success';
    } else {
        echo "Failed";
    }
}
