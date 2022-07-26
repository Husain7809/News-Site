 <?php
     include 'config.php';
     if (isset($_POST['submit'])) {
          if (empty($_FILES['web_logo']['name'])) {
               $file_name = $_POST['old-logo'];
          } else {
               $errors = array();
               $file_name = $_FILES['web_logo']['name'];
               $file_size = $_FILES['web_logo']['size'];
               $file_tmp = $_FILES['web_logo']['tmp_name'];
               $file_type = $_FILES['web_logo']['type'];
               $file_ext = end(explode('.', $file_name));
               $extensions = array("jpeg", "jpg", "png");

               // if (in_array($file_ext, $extensions) === false) {
               //      $errors[] = "This file is not allwoed, please choose a JPG or PNG files.";
               // }
               if ($file_size > 2097152) {
                    $errors[] = "File size must be 2mb or lower.";
               }
               if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "images/" . $file_name);
               } else {
                    print_r($errors);
                    die();
               }
          }


          $sql = "UPDATE website_settings SET website_name='{$_POST['web_name']}',website_logo='{$file_name}',website_desc='{$_POST['web_desc']}'";
          $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . "Query Failed");
          if ($result) {
               header("Location:http://localhost/news-template/admin/setting.php");
          }
     }
     ?>