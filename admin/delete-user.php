<?php
if ($_SESSION['user_role'] == '0') {
     header("location:http://localhost/news-template/admin/post.php");
}
include 'config.php';
$user_id = $_GET['Id'];
$sql = "DELETE FROM user WHERE user_id=$user_id";
if (!mysqli_query($conn, $sql)) {
     die("Query Failed..");
} else {
     header("Location:http://localhost/news-template/admin/users.php");
}
mysqli_close($conn);
