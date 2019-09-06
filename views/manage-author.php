<?php
	global $wpdb;
	$authors = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT * from " . my_authors_table() . " ORDER by id DESC", ""
					)
				);
?>
<div class="container">
	<div class="row">
		<div class="alert alert-info">
			<h5>My Author list</h5>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">My Author list</div>
			<div class="panel-body">
				<table id="my-books" class="display" style="width:100%">
					<thead>
						<tr>
							<th>Sr. No</th>
							<th>Name</th>
							<th>Fb Link</th>
							<th>About</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if(count($authors) > 0){
							$i=1;
							foreach ($authors as $author) {?>
								<tr>
									<td><?php echo $i++;?></td>
									<td><?php echo $author->name;?></td>
									<td><?php echo $author->fb_link;?></td>
									<td><?php echo $author->about;?></td>
									<td><?php echo $author->created_at;?></td>
									<td>
										<!-- <a class="btn btn-info" href="admin.php?page=author-edit&edit_id=<?php //echo $author->id;?>">Edit</a> -->
										<a class="btn btn-danger btnauthordelete" href="javascript:void(0)" data-id="<?php echo $author->id;?>">Delete</a>
									</td>
								</tr>
						<?php }
						}
						?>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>