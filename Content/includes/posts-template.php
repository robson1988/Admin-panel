<?php include_once "admin.php"; ?>


<div class="container ">
	<div class="row">
	    
	    <div class="col-md-8 col-md-offset-2">
	        
    		<h1>Create post</h1>
    		
    		<form action="" method="POST" enctype="multipart/form-data">
    		    
    		    <div class="form-group">
    		        <label for="tittle">Post title <span class="require">*</span></label>
    		        <input type="text" class="form-control" name="tittle" />
    		       
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="category">Select category <span class="require">*</span></label>
						<select class="custom-select custom-select-sm" name="category_value">
								<?php  $get_categories = new Post(); $get_categories->getCategories();?>
						</select>
    		    </div>
				
				<div class="form-group">
    		        <label for="tags">Tags </label>
    		        <input type="text" class="form-control" name="tags" />
    		    </div>
    		    
				<div class="form-group">
    		        <label for="img">Upload image </label></br>
    		        <input type="file" name="image"/>
    		    </div>
				
    		    <div class="form-group">
    		        <label for="content">Content</label>
    		        <textarea rows="5" class="form-control" name="content" ></textarea>
    		    </div>
				
    		    
    		    <div class="form-group">
    		        <p><span class="require">*</span> - required fields</p>
    		    </div>
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary" name="create_post">
    		            Create
    		        </button>
    		        <button class="btn btn-default">
    		            Cancel
    		        </button>
    		    </div>
    		    
    		</form>
		</div>
		
	</div>
</div>




<?php

if(isset($_POST['create_post'])) {
	
	
	$user_login = $_SESSION['uLogin'];
	$tittle=$_POST['tittle'];
	$category=$_POST['category_value'];
	$tags=$_POST['tags'];
	$post_image=$_FILES['image']['name'];
	$post_image_temp=$_FILES['image']['tmp_name'];
	$content=$_POST['content'];
	$date = date('y-m-d');
	
	
	move_uploaded_file($post_image_temp, "../images/".$date."-".$post_image);
	

	$insert = new Post();
	$insert->insertNewPost($user_login, $tittle, $category, $tags, $post_image, $content);
	
	
} else { 
	
 }
 
 
 include_once "admin.footer.php"; 
 
 ?>
