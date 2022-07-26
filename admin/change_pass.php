<?php include 'header.php' ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size:30px;">Change Password</h1>
        </div>
        <div class="col-md-5 col-md-offset-3" style="margin-top: 50px;">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
                <label for="">Old Password:</label>
                <input type="Password" class="form-control" name="opass" placeholder="Old Password.." style="margin-bottom: 10px;" required>
                <label for="">New Password:</label>
                <input type="Password" class="form-control" name="pass" placeholder="New Password.." style="margin-bottom: 10px;" required>
                <label for="">Confirm Password:</label>
                <input type="Password" class="form-control" name="cpass" placeholder="Confirm Password.." style="margin-bottom: 10px;" required>
                <button class="btn btn-primary" name="Submit">Change</button>
            </form>

            <?php
            include 'config.php';

            if (isset($_POST['Submit'])) {
                $opass = md5($_POST['opass']);
                $npass = md5($_POST['pass']);
                $cpass = md5($_POST['cpass']);
                $sql = "select * from user where user_id={$_SESSION['user_id']}";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn) . "Query Failed");
                $row = mysqli_fetch_assoc($result);
                if ($opass == $row['password']) {
                    if ($opass == $cpass) {
                        echo "<div class='alert alert-danger'>Old and New Password Same..Please Choose Diffrent Password!.</div>";
                    } else if($npass==$cpass){
                        $sql1="UPDATE user SET password='{$cpass}' WHERE user_id={$_SESSION['user_id']}";
                        $result1=mysqli_query($conn,$sql1)or die(mysqli_error($conn)."Query Failed");
                        if($result1){
                            echo "<script>alert('Password Change Successfully')</script>";
                        }
                    }else{
                        echo "<div class='alert alert-danger'>New and Confirm Password Not Match!.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Old Password Invalid!.</div>";
                }
            }

            ?>
        </div>
    </div>
</div>