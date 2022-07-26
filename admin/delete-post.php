<?php
include 'config.php';
$post_id = $_GET['Post_Id'];
$category_id = $_GET['Cat_Id'];

$sql1 = "select *from post where post_id={$post_id}";
$result1 = mysqli_query($conn, $sql1) or die("Query failed:first");
$row = mysqli_fetch_assoc($result1);
unlink("upload/" . $row['post_img']);

$sql = "delete from post where post_id={$post_id};";
$sql .= "update category set post=post-1 where category_id={$category_id}";
if (mysqli_multi_query($conn, $sql)) {
     header("Location:http://localhost/news-template/admin/post.php");
} else {
     echo mysqli_error($conn) . "Query Failed";
}
