<?php

include 'config.php';
include 'model/userLog.php';

session_start();
error_reporting(0);

if (isset($_SESSION['user_id'])) {
    header("Location: main.php");
    exit();
}

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $user = new UserLog(1, $email, $password);
    $odg = UserLog::loginUser($user, $conn);

    if ($odg->num_rows == 1) {
        $_SESSION['user_id'] = $user->id;
        header("Location: main.php");
        exit();
    } else {

        echo "<script>alert('Email or password incorrect!')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/log.css">

</head>

<body>
    <?php
    include 'headings/header.php';
    ?>
    <div class="bodi">

        <div class="container">
            <form action="" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login to make an appointment</p> <br>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Login</button>
                </div>
                <p class="login-register-text"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;If you do not have account just &nbsp;<a href="register.php">Register</a></p>
            </form>
        </div>
    </div>

    <?php
    include 'headings/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>