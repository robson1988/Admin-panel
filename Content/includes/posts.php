<?php

		include_once "admin.php"; 


		if(isset($_GET['delete'])) {
				$postId = $_GET['delete'];
											
				$deletePost=new Post;
				$deletePost->deletePost($postId);
				header('Location: posts.php');
				exit();
								
				} else {}
				
				
		
				
							
?>

 <div class="display-admin-page ">
  
	<div class = "show-posts">														<!-- POST TABLE BUTTONS -->
		<div class="row ">
		
			<div class="col-3 align-self-center without-padding">
				<h3 class="title ">Wszystkie wpisy</h3>
			</div>
			
			<div class="col-2 align-self-center">
				<a class=" btn btn-custom btn-sm " href="posts-template.php">Dodaj nowy</a>
			</div>
			
			<div class="col-4 "></div>
					
			<div class="col-3 align-self-center without-padding">
						<div class="input-group">
							<input class="ml-auto mr-1" type="text" name="searchPostField"/>
							<button class="btn btn-custom btn-sm" type="submit" name="searchPost">Search</button>
						</div>
					</div>
					
					
		</div>
		
		<div class="row align-items-center">
					<div class="col-6 without-padding">
						<div class="input-group">
						<form  class="input-group" method="POST" action="posts.php">
							<select class="custom-select custom-select-sm mr-1" name="bulk_action_value">
								<option selected>Bulk Action</option>
								<option value="1">Approve</option>
								<option value="2">Reject</option>
								<option value="3">Delete</option>
							</select>
							<button class="btn btn-custom btn-custom-small btn-sm mr-1" type="submit" name="bulk_action">Apply</button>
							
							<select class="custom-select custom-select-sm ml-1"  name="filter_date">
								<option value="0">Date</option>
								<?php  $get_date = new Post(); $get_date->showPostsDate();?>
							</select>
							
							
							<select class="custom-select custom-select-sm ml-1 mr-1" name="category_value">
								<option value='0'>All Categories</option>
								<?php  $get_categories = new Post(); $get_categories->getCategories();?>
							</select>
							
							<button class="btn btn-custom btn-custom-small btn-sm" type="submit" name="filter_categories">Filter</button>	
							</form>
							
						</div>
			</div>
					
					<div class="col-3 "></div>
					
				<div class="col-3 without-padding ">									<!-- PAGINATION-->
					<nav aria-label="Posts page pagination ">
					  <ul class="pagination pagination-sm justify-content-end  mt-3">
						<li class="page-item ">
						  <a class="page-link" href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						  </a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
						  <a class="page-link" href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						  </a>
						</li>
					  </ul>
					</nav>
				</div>		
					
		</div>																				<!-- END - POST TABLE BUTTONS -->
		
		
		
		
		
		
		
		<div class="table-responsive">												<!-- TABLE DATA DISPLAY-->
				<table class="table table-sm table-hover table-bordered mb-0">
					<thead class="post-thead custom-colors">
						<tr>
						 <th></th> 
						  <th>Id</th>
						  <th>Author </th>
						  <th>Title</th>
						  <th>Category</th>
						  <th>Tags</th>
						  <th>Image</th>
						  <th>Content</th> 
						  <th>Comments</th>
						  <th>Date</th>
						  <th >Status</th>	
						  <th></th>
						  <th></th>
						</tr>
					 </thead>
					  <tbody class="post-tbody">
					  
						  <?php  
								if(!isset($_POST['filter_categories']) || $_POST['category_value'] == 0) {
									
											$show=new Post;
											$show->showAllPosts(); 
								} else {
									
										$filterCategories = $_POST['category_value'];
											
											$show = new Post;
											$show->filtertByCategories($filterCategories);

								}
	
							?>
		  
					   </tbody>
			  </table>
		 </div>																			<!--END -  TABLE DATA DISPLAY-->
		 
		 
		 <div class="row">															<!-- PAGINATION-->
		 
			 <div class="col-9"></div>
			 
			 <div class="col-3 without-padding ">	
					<nav aria-label="Posts page pagination ">
						  <ul class="pagination pagination-sm justify-content-end  mt-3">
							<li class="page-item ">
							  <a class="page-link" href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							  </a>
							</li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
							  <a class="page-link" href="#" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							  </a>
							</li>
						  </ul>
				     </nav>
			</div>		
		 
		 
		 </div>
</div>

<?php

		include_once "admin.footer.php"; 
 
 ?>
