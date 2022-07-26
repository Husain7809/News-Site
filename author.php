<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php

                    if (isset($_GET['user_id'])) {
                        $user_id = $_GET['user_id'];
                    }
                    $sql2 = "select username from user where user_id={$user_id}";
                    $result2 = mysqli_query($conn, $sql2) or die("Query failed");
                    if (mysqli_num_rows($result2) > 0)
                        $row2 = mysqli_fetch_assoc($result2);
                    ?>
                    <h2 class="page-heading"><?php echo $row2['username']; ?></h2>
                    <?php
                    include 'admin/config.php';
                    $user_id = $_GET['user_id'];
                    if (isset($_GET['Page'])) {
                        $page = $_GET['Page'];
                    } else {
                        $page = "1";
                    }
                    $limit = 3;
                    $offset = ($page - 1) * $limit;
                    $sql = "select post.post_id,post.title,post.description,post.post_img,post.post_date,
                    category.category_name,post.category,user.username,user.user_id from  post 
                    LEFT JOIN category ON post.category=category.category_id
                    LEFT JOIN user ON post.author=user.user_id
                    where user.user_id={$user_id}
                    ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . "Query failed.");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?Id=<?php echo $row['post_id']; ?>"><img src="./admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?Id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cat_id=<?php echo $row["category"]; ?>'><?php echo $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href=''><?php echo $row['username']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 100) . "..."; ?>
                                            </p>
                                            <a class='read-more pull-right' href="single.php?Id='<?php echo $row['post_id'] ?>'">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php     }
                    }
                    $sql1 = "select * from post JOIN user ON post.author=user.user_id where post.author={$user_id}";
                    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn) . "query failed.");
                    $row1 = mysqli_fetch_assoc($result1);
                    if (mysqli_num_rows($result1) > 0) {
                        $limit = 3;
                        $total_record = mysqli_num_rows($result1);
                        $total_page = ceil($total_record / $limit);
                        echo "<ul class='pagination'>";
                        if ($page > 1) {
                            echo "<li><a href='author.php?user_id={$user_id}&Page=" . ($page - 1) . " '>Prev</a></li>";
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo "<li class='{$active}'><a href='author.php?user_id={$user_id}&Page=$i'>$i</a></li>";
                        }
                        if ($page < $total_page) {
                            echo "<li><a href='author.php?user_id={$user_id}&Page=" . ($page + 1) . " '>Next</a></li>";
                        }
                        echo "</ul>";
                    }

                    ?>



                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>