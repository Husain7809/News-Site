<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $sql_logo = "select *from website_settings";
                $result_logo = mysqli_query($conn, $sql_logo) or die("Query Failed");
                $row_logo = mysqli_fetch_assoc($result_logo);
                echo "<span>{$row_logo['website_desc']}</span>";
                ?>

            </div>
        </div>
    </div>
</div>
</body>

</html>