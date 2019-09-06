<?php
	global $wpdb;
	$students = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT * from " . my_students_table() . " ORDER by id DESC", ""
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
						<?php if(count($students) > 0){
							$i=1;
							foreach ($students as $student) {
								$userdata = get_userdata($student->user_login_id);
								?>
								<tr>
									<td><?php echo $i++;?></td>
									<td><?php echo $student->name;?></td>
									<td><?php echo $student->email;?></td>
									<td><?php echo $userdata->user_login;?></td>
									<td><?php echo $student->created_at;?></td>
									<td>
										<!-- <a class="btn btn-info" href="admin.php?page=author-edit&edit_id=<?php //echo $author->id;?>">Edit</a> -->
										<a class="btn btn-danger btnauthordelete" href="javascript:void(0)" data-id="<?php echo $student->id;?>">Delete</a>
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