<?php
include 'config.php';
$id = $_GET['id'];
$sql = "DELETE FROM category WHERE category_id={$id}";
$result = mysqli_query($conn, $sql) or die("Query failed.");
if (!$result) {
     die("Query Failed.");
} else {
     header("Location:http://localhost/news-template/admin/category.php");
}
