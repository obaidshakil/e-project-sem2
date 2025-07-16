

<?php 
 require('inc.connection.php');


if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Forms</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <style>
    .admin-header {
    position: relative;  /* Allow absolute positioning within this container */
    width: 100%;         /* Full width */
    padding: 10px;
}

.logout-button {
    position: absolute; /* Position the button absolutely */
    right: 10px;        /* Distance from the right edge */
    top: 10px;          /* Distance from the top */
    padding: 10px 20px;
    background-color: #f44336;
    color: white;
    border: none;
    cursor: pointer;
}
</style>
    

</head>


<body class="animsition">
    <div class="page-wrapper">
       
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.jpg" alt="Sound Entertainment" width="80px" height="50px"/>
            
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="dashboard.php">Dashboard</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">

                            
                        </li>
</ul>
                       
                      <li class="has-sub">
    <a class="js-arrow" href="#">
        <i class="fas fa-copy"></i> Forms
    </a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
        <li>
            <a href="userform.php">
                <i class="bi bi-person-plus-fill"></i> Create Account
            </a>
        </li>
        <li>
            <a href="viewuser.php">
                <i class="bi bi-eye-fill"></i> View Account
            </a>
        </li>
       
    </ul>
</li>
<li class="has-sub">
    <a class="js-arrow" href="#">
        <i class="fas fa-copy"></i> Categories
    </a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
        <li>
            <a href="categoryform.php">
                <i class="bi bi-plus"></i> Create Categories
            </a>
        </li>
        <li>
            <a href="categoryview.php">
                <i class="bi bi-eye-fill"></i> View Categories
            </a>
        </li>
       
    </ul>
</li>
<li class="has-sub">
    <a class="js-arrow" href="#">
        <i class="fa fa-music"></i> Music
    </a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
        <li>
            <a href="addmusicform.php">
                <i class="bi bi-plus"></i> Add Music
            </a>
        </li>
        <li>
            <a href="musictable.php">
                <i class="bi bi-eye-fill"></i> View Music
            </a>
        </li>
       
    </ul>
</li>
                      
                       
<li class="has-sub">
    <a class="js-arrow" href="#">
        <i class="fas fa-copy"></i> Ratings
    </a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
       
        <li>
            <a href="ratingtable.php">
                <i class="bi bi-eye-fill"></i> View Ratings
            </a>
        </li>
       
    </ul>
</li>
<li class="has-sub">
    <a class="js-arrow" href="#">
        <i class="fa fa-video-camera"></i> Videos
    </a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
       
        <li>

            <a href="videoadd.php">
                <i class="bi bi-plus"></i> Add Video
            </a>
        </li>
        <li>
            
            <a href="videotable.php">
                <i class="bi bi-eye-fill"></i> View Video
            </a>
        </li>
       
    </ul>
</li>

                       
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </form>
                <div class="header-button">
                    <div class="noti-wrap">
                        <div class="noti__item"
                        >

                <div class="d-flex">
                    <span class="text-black me-3 align-self-center">
                        <?php echo $_SESSION['user_names'] ?? 'Guest'; ?>
                    </span>
                    <a href="login.php?action=logout" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>


                   
                </div>
            </div>
        </div>
    </div>


</header>
</body>
</html>

            