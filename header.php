<?php
include 'admin/config.php';
$page = basename($_SERVER['PHP_SELF']);
switch ($page) {
    case "single.php":
        if (isset($_GET['Id'])) {
            $sql_title = "select * from post where post_id={$_GET['Id']}";
            $result_title = mysqli_query($conn, $sql_title) or die("Query Failed.");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['title'];
        } else {
            echo "No post Found";
        }
        break;
    case "category.php":
        if (isset($_GET['cat_id'])) {
            $sql_title = "select *from category where category_id={$_GET['cat_id']}";
            $result_title = mysqli_query($conn, $sql_title) or die("Query Failed.");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['category_name'] . " News";
        } else {
            $page_title = "No category found";
        }
        break;
    case "author.php":
        if (isset($_GET['user_id'])) {
            $sql_title = "select *from user where user_id={$_GET['user_id']}";
            $result_title = mysqli_query($conn, $sql_title) or die("Query Failed.");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = " News By     " . $row_title['first_name'] . " " . $row_title['last_name'];
        } else {
            $page_title = "No author found";
        }
        break;
    case "search.php":
        if (isset($_GET['search'])) {
            $page_title = $_GET['search'] . " - News Search";
        } else {
            $page_title = "No search found";
        }
        break;
    default:
        $page_title = "Home Page";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <link rel="shortcut icon" type="image" href="icon.jpg"> -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                    <?php
                    $sql_logo = "select *from website_settings";
                    $result_logo = mysqli_query($conn, $sql_logo) or die(mysqli_error($conn)."Query Failed");

                    if (mysqli_num_rows($result_logo) > 0) {
                        while ($row_logo = mysqli_fetch_assoc($result_logo)) {
                            if ($row_logo['website_logo'] == "") {
                                echo "<h1>" . $row_logo['website_name'] . "</h1>";
                            } else {
                                echo "<a href='{$hostname}'><img class='logo' src='admin/images/{$row_logo['website_logo']}'></a>";
                            }
                        }
                    }
                    ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_GET['cat_id'])) {
                        $cat_id = $_GET['cat_id'];
                    }

                    include 'admin/config.php';
                    $sql = "select *from category where post>0";
                    $result = mysqli_query($conn, $sql) or die("Query Failed:category");
                    if (mysqli_num_rows($result) > 0) {
                        $active = "";
                    ?>
                        <ul class='menu'>
                            <li><a href='<?php echo $hostname; ?>'>Home</a></li>";
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                if (isset($_GET['cat_id'])) {
                                    if ($row['category_id'] == $cat_id) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                }
                                echo "<li><a class='{$active}' href='category.php?cat_id={$row['category_id']}'>{$row['category_name']}</a></li>";
                            } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->
    