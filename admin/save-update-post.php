
<?php
include 'config.php';
if (empty($_FILES['new-image']['name'])) {
     $image_name = $_POST['old-image'];
} else {
     $errors = array();
     $file_name = $_FILES['new-image']['name'];
     $file_size = $_FILES['new-image']['size'];
     $file_tmp = $_FILES['new-image']['tmp_name'];
     $file_type = $_FILES['new-image']['type'];
     $file_ext = end(explode('.', $file_name));
     $extensions = array("jpeg", "jpg", "png");

     if (in_array($file_ext, $extensions) === false) {
          $errors[] = "This file is not allwoed, please choose a JPG or PNG files.";
     }
     if ($file_size > 2097152) {
          $errors[] = "File size must be 2mb or lower.";
     }
     $newname = time() . "-" . basename($file_name);
     $target = "upload/" . $newname;
     $image_name = $newname;
     if (empty($errors) == true) {
          move_uploaded_file($file_tmp, $target);
     } else {
          print_r($errors);
          die();
     }
}
$sql = "update post set title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category={$_POST["category"]},post_img='{$image_name}'
 where post_id='{$_POST["post_id"]}';";
if ($_POST['old-category'] != $_POST['category']) {
     $sql .= "update category set post=post-1 where category_id='{$_POST['old-category']}';";
     $sql .= "update category set post=post+1 where category_id='{$_POST['category']}';";
}

$result = mysqli_multi_query($conn, $sql) or die(mysqli_error($conn) . "Query Failed");
if ($result) {
     header("Location:http://localhost/news-template/admin/post.php");
}
?>