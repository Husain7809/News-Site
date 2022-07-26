<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:http://localhost/news-template/admin/");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>ADMIN Panel</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- profile--admin-------- -->
    <style>
        .dropbtn {
            background-color: #1E90FF;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 20px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #1E90FF;
        }
        #profile{
            color: white;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div id="header-admin">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-2">
                    <?php
                    include 'config.php';
                    $sql_logo = "select *from website_settings";
                    $result_logo = mysqli_query($conn, $sql_logo) or die("Query Failed");

                    if (mysqli_num_rows($result_logo) > 0) {
                        while ($row_logo = mysqli_fetch_assoc($result_logo)) {
                            if ($row_logo['website_logo'] == "") {
                                echo "<h1>" . $row_logo['website_name'] . "</h1>";
                            } else {
                                echo "<a href='post.php'><img class='logo' src='images/{$row_logo['website_logo']}'></a>";
                            }
                        }
                    }
                    ?>

                </div>
                <!-- /LOGO -->
                <!-- LOGO-Out -->
                <div class="col-md-offset-7  col-md-3">
                    <!-- <a href="logout.php" class="admin-logout">Hi <?php echo $_SESSION['username']; ?>, logout</a> -->
                    <div class="dropdown">
                        <button class="dropbtn"><i class="fa fa-user" aria-hidden="true" id="profile"></i> Hi,<?php echo $_SESSION['username']; ?></button>
                        <div class="dropdown-content">
                            <a href="change_pass.php">Change Password</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
                <!-- /LOGO-Out -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php">Post</a>
                        </li>
                        <?php
                        if ($_SESSION['user_role'] == '1') { ?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                            <li>
                                <a href="setting.php">Settings</a>
                            </li>
                            
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->