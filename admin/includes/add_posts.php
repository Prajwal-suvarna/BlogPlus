<?php 

if(isset($_POST['create_post'])){

    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_comment_count = 0; 
    $post_date = date('Y-m-d'); // Use 'Y-m-d' format for MySQL date
    
    // Move uploaded file to the destination folder
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    // Prepare the INSERT statement with placeholders
    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
    $query .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Initialize and prepare the statement
    $stmt = mysqli_prepare($connection, $query);
    
    // Bind parameters to the placeholders
    mysqli_stmt_bind_param($stmt, "issssssis", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Check if the query was successful
    if(mysqli_stmt_affected_rows($stmt) === 1) {
        $post_id = mysqli_insert_id($connection);
        echo "<p class='bg-success'>Post Updated  <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>View/Edit Other Posts</a></p>";
    } else {
        echo "<p class='bg-danger'>Error: Unable to create post.</p>";
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
}

?>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">    
    </div> 

    <div class="form-group">
        <select name="post_category" id="">
            
            <?php

            $query = "SELECT * FROM categories";
            $select_category = mysqli_query($connection, $query);          

            while($row = mysqli_fetch_assoc($select_category)){

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];    
                
                echo "<option value='$cat_id'>$cat_title</option>";
            }
            
            ?>
            
            <option value=""></option>
        </select> 
    </div>

     <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control">    
     </div>  
     
     <div class="form-group">
        
        <select class="form-control" name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>

     </div> 

     <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="form-control">    
     </div> 

     <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>  
     </div> 

     <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">    
     </div>  
      
      <div class="form-group">
        <input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">    
     </div> 
</form>
