<?php

require "../config.php";
require "../model/client.php";

if (isset($_POST['id'])) {
    $obj = new Client($_POST['id']);
    $status = $obj->deleteById($conn);
    if ($status) {
        echo "Success";
    } else {
        echo "Failed";
    }
}
