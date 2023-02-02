<?php

include 'config.php';
include 'model/userReg.php';
error_reporting(0);
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
        $user = new UserReg(1, $username, $email, $password);
        $result = UserReg::registerUser($user, $conn);

        if (!$result->num_rows > 0) {
            $result = UserReg::addUser($user, $conn);
            if ($result) {
                echo "<script>alert('User successfully registrated!')</script>";
                header("Location: login.php");
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Something went wrong...')</script>";
            }
        } else {
            echo "<script>alert('Email already exist!')</script>";
        }
    } else {
        echo "<script>alert('Password does not match')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/log.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Registration</title>


</head>

<body>
    <?php
    include 'headings/header.php';
    ?>

    <div class="bodi">
        <div class="container">
            <form action="" method="POST" class="login-email">
                <p class="login-text" style="font-size: 2rem; font-weight: 600;">Register to make an appointment</p>
                <div class="input-group">
                    <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Comfirm your password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Register</button>
                </div>
                <p class="login-register-text">Already have an account? <a href="login.php">&nbsp; Just login</a> </p>
            </form>
        </div>
    </div>

    <?php
    include 'headings/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"></script>

</body>

</html>