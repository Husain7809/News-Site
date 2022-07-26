<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location:http://localhost/news-template/admin/post.php");
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label>Username *</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="">
                        </div>
                        <input type="submit" name="login" id="loginBtn" class="btn btn-primary" value="login" style="width: auto;" />
                    </form>
                    <!-- /Form  End -->
                    <?php
                    if (isset($_POST['login'])) {
                        include 'config.php';
                        if (empty($_POST['username']) || empty($_POST['password'])) {
                            echo "<div class='alert alert-danger'>* Username or Password Required</div>";
                        } else {
                            $user = mysqli_real_escape_string($conn, $_POST['username']);
                            $pass = md5($_POST['password']);
                            $sql = "select user_id,username,role from user where username='$user' AND password='$pass'";
                            $result = mysqli_query($conn, $sql) or die("Query Failed." . mysqli_error($conn));
                            if (
                                mysqli_num_rows($result) > 0
                            ) {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $_SESSION['username'] = $row['username'];
                                    $_SESSION['user_id'] = $row['user_id'];
                                    $_SESSION['user_role'] = $row['role'];
                                    echo "<script>
                                    document.getElementById('loginBtn').value = 'Loading...';
                                    location.href='post.php';
                                    </script>";
                                }
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Username and Password Not Match..</div>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<!-- <script>
    document.getElementById('loginBtn').addEventListener('click', function() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        if (username == "" && password == "") {
        } else {}
    })
</script> -->