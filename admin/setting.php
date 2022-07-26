<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Website Settings</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <?php
                include 'config.php';
                $sql = "select *from website_settings";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <form action="setting-update.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="post_title">Website Name</label>
                                <input type="text" name="web_name" value="<?php echo $row['website_name']; ?>" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="">Website Logo</label>
                                <input type="file" name="web_logo"><br>
                                <img src="images/<?php echo $row['website_logo']; ?>" height="120px" width="100%">

                                <input type="hidden" name="old-logo" value="<?php echo $row['website_logo']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Footer Description</label>
                                <textarea name="web_desc" class="form-control" rows="5" required><?php echo $row['website_desc']; ?></textarea>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                        </form>
                        <!--/Form -->
                <?php   }
                } else {
                    echo "No record";
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>