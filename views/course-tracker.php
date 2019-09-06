<?php
	global $wpdb;
	$enrol_details = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT stu.name as stu_name, book.name, enrol.created_at FROM " . my_students_table() . "
						as stu JOIN ".my_enrol_table()." as enrol ON stu.user_login_id = enrol.student_id JOIN ".my_book_table()." as book ON enrol.book_id = book.id", ""
					)
				);
	// print_r($enrol_details);
	// SELECT stu.name, book.name, enrol.created_at FROM `cp_my_students` as stu JOIN cp_my_enrol as enrol ON stu.user_login_id = enrol.student_id JOIN cp_my_books as book ON enrol.book_id = book.id 
?>
<div class="container">
	<div class="row">
		<div class="alert alert-info">
			<h5>My Course Tracker List</h5>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">My Course Tracker List</div>
			<div class="panel-body">
				<table id="my-books" class="display" style="width:100%">
					<thead>
						<tr>
							<th>Sr. No</th>
							<th>Student Name</th>
							<th>Course</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if(count($enrol_details) > 0){
							$i=1;
							foreach ($enrol_details as $value) {?>
								<tr>
									<td><?php echo $i++;?></td>
									<td><?php echo $value->stu_name;?></td>
									<td><?php echo $value->name;?></td>
									<td><?php echo $value->created_at;?></td>
									<td>
										<!-- <a class="btn btn-info" href="admin.php?page=author-edit&edit_id=<?php //echo $author->id;?>">Edit</a> -->
										<!-- <a class="btn btn-danger btnauthordelete" href="javascript:void(0)" data-id="<?php echo $value->id;?>">Delete</a> -->
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