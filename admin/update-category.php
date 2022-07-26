<?php include "header.php";
if ($_SESSION['user_role'] == '0') {
    header("location:http://localhost/news-template/admin/post.php");
}


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <?php
                include 'config.php';

                $id = $_GET['id'];
                $sql = "select *from category  where category_id={$id} ";
                $result = mysqli_query($conn, $sql) or die("Query Failed.");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <!-- <div class="form-group">
                                <label>Category Name</label>
                                <input type="" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>" placeholder="" required>
                            </div> -->
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                        </form>
                <?php
                    }
                } else {
                    echo "<div class='alert alert-danger'>No Record Found.</div>";
                }
                if (isset($_POST['update'])) {
                    $category_name = $_POST['cat_name'];
                    $sql1 = "update category set category_name='$category_name' where category_id=$id";
                    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn) . "Query Failed.");
                    if ($result) {
                        header("location:http://localhost/news-template/admin/category.php");
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php";
?>