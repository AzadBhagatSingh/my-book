<?php
	global $wpdb;
	$all_books = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT * from " . my_book_table() . " ORDER by id DESC", ""
					)
				);
?>
<div class="container">
	<div class="row">
		<div class="alert alert-info">
			<h5>My book list</h5>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">My book list</div>
			<div class="panel-body">
				<table id="my-books" class="display" style="width:100%">
					<thead>
						<tr>
							<th>Sr. No</th>
							<th>Name</th>
							<th>Author</th>
							<th>About</th>
							<th>Book Image</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(count($all_books) > 0){
								$i = 1;
								foreach ($all_books as $book) {?>
								<tr>
									<td><?php echo $i++;?></td>
									<td><?php echo $book->name;?></td>
									<td><?php echo get_author_details( $book->author)->name;?></td>
									<td><?php echo $book->about;?></td>
									<td><img src="<?php echo $book->book_image;?>" style="height: 80px;width: 80px;"></td>
									<td><?php echo $book->create_at;?></td>
									<td>
										<a class="btn btn-info" href="admin.php?page=book-edit&edit_id=<?php echo $book->id;?>">Edit</a>
										<a class="btn btn-danger btnbookdelete" href="javascript:void(0)" data-id="<?php echo $book->id;?>">Delete</a>
									</td>
								</tr>			
							<?php
								}
							}
						?>
						
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>