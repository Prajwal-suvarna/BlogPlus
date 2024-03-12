<?php
include "includes/admin_header.php";

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                    <?php
                    if (isset($_GET['source'])) {

                        $source = $_GET['source'];
                    } else {
                        $source = "";
                    }

                    switch ($source) {

                        case 'add_post':
                            include "includes/add_posts.php";
                            break;

                        case 'edit_post':
                            include "includes/edit_post.php";
                            break;

                        default:
                            include "includes/view_all_posts.php";
                            break;
                    }

                    ?>

                    <?php

                    if (isset($_GET['delete'])) {

                        $delete_post_id = $_GET['delete'];

                        $query = "DELETE FROM posts WHERE post_id = ?";
                        $stmt = mysqli_prepare($connection, $query);
                        mysqli_stmt_bind_param($stmt, "i", $delete_post_id);
                        mysqli_stmt_execute($stmt);

                        if (!$stmt) {
                            die("Query Failed! " . mysqli_error($connection));
                        }
                        mysqli_stmt_close($stmt);

                        header("Location: posts.php");
                    }

                    ?>
                </div>
            </div>

            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
