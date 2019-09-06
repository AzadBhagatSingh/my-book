<?php
	global $wpdb;
	global $user_ID;
	$books = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT * from " . my_book_table() . " ORDER by id DESC", ""
					)
				);
	// print_r($books);
	// print_r($user_ID);
?>
<?php
	if ($books >0) {
		foreach ($books as $book) {?>
		<div class="col-sm-4 course-layout">
			<p><img src="<?php echo $book->book_image;?>" style="width: 100px;height: 100px;"></p>
			<p><?php echo $book->name?></p>
			<p><?php echo get_author_details( $book->author)->name;?></p>
			<p>
				<?php if($user_ID>0){?>
					<form id="frmEnrolStudent">
						<input type="hidden" name="book_id" value="<?php echo $book->id;?>">
						<input type="hidden" name="student_id" value="<?php echo $user_ID;?>">
						<?php 
							if (student_enrolled($user_ID,$book->id)) { ?>
								<a class="btn btn-success" href="javascript:void(0)">Enrolled</a>
						<?php }else{ ?>
								<a class="btn btn-success epic-enrol-btn" href="javascript:void(0)">Enrol Now</a>
						<?php } ?>
						
					</form>
					
				<?php }else{?>
					<a class="btn btn-success" href="<?php echo wp_login_url();?>">Login to Enrol</a>
				<?php }?>
			</p>
		</div>		
	<?php }
	}	
?>

