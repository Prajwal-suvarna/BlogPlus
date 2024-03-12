<?php include "includes/db.php";?>
<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if(isset($_GET['cat_id'])){
                $the_cat_id= $_GET['cat_id'];
                // Fetch category name
                $cat_query = "SELECT cat_title FROM categories WHERE cat_id = $the_cat_id";
                $cat_result = mysqli_query($connection, $cat_query);
                $cat_row = mysqli_fetch_assoc($cat_result);
                $category_name = $cat_row['cat_title'];
                
                // Fetch posts based on category
                $query = "SELECT * from posts WHERE post_category_id = $the_cat_id";
                $post_by_category = mysqli_query($connection, $query);
                
                // Display category name
                echo "<h1 class='page-header'>Category: $category_name</h1>";

                while($row = mysqli_fetch_assoc($post_by_category)){
                    $post_id= $row['post_id'];
                    $post_title= $row['post_title'];
                    $post_author= $row['post_author'];
                    $post_date= $row['post_date'];
                    $post_image= $row['post_image'];
                    $post_content= substr($row['post_content'],0,250);
                    ?>
                    <!-- Display post -->
                    <h2><a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title?></a></h2>
                    <p class="lead">by <a href="index.php"><?php echo $post_author ?></a></p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                <?php 
                }
            }   
            ?>
        </div>

        <?php include "includes/sidebar.php";?>      
    </div>
    <!-- /.row -->
    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php";?>
</div>
