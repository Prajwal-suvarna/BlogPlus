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
            // Check if a category is selected
            if(isset($_GET['cat_id'])) {
                $selected_category_id = $_GET['cat_id'];
                
                // Retrieve the category name
                $category_query = "SELECT cat_title FROM categories WHERE cat_id = $selected_category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category_row = mysqli_fetch_assoc($category_result);
                $category_name = $category_row['cat_title'];

                // Display the selected category name
                echo "<h1 class='page-header'>Category: $category_name</h1>";

                // Query to retrieve posts for the selected category
                $query = "SELECT * FROM posts WHERE post_category_id = $selected_category_id";
                $result = mysqli_query($connection, $query);

                // Display posts
                while($row = mysqli_fetch_assoc($result)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 25000);
                    ?>
                    <!-- First Blog Post -->
                    <h2><a href="#"><?php echo $post_title?></a></h2>
                    <p class="lead">by <a href="index.php"><?php echo $post_author ?></a></p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <?php
                }
            } 
            ?>
        </div>
        

        <!-- Sidebar -->
        <?php include "includes/sidebar.php";?>      
    </div>
    <!-- /.row -->
    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php";?>
</div>
<!-- /.container -->
