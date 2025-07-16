<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php

require('inc.connection.php');

$login = $email = $password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginBtn'])) {
    
    $email = safe_input($_POST['email']);
    $password = safe_input($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
        
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_names'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            if ($_SESSION['user_role'] == 'admin') {
                header('Location: dashboard.php');
                exit();
            } elseif ($_SESSION['user_role'] == 'user') {
                header('Location: studentdashboard.php');
                exit();
            } else {
                echo "<script>alert('Invalid role');</script>";
            }

        } else {
            echo "<script>alert('Invalid email or password');</script>";
        

    } }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- CSS Links -->
    <link href="css/font-face.css" rel="stylesheet">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="vendor/wow/animate.css" rel="stylesheet">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet">
    <link href="vendor/slick/slick.css" rel="stylesheet">
    <link href="vendor/select2/select2.min.css" rel="stylesheet">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
</head>
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#"><img src="images/icon/logo.jpg" alt="Sound Entertainment" width="80px"></a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="loginBtn">Sign In</button>
                            </form>
                            <div class="register-link"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
