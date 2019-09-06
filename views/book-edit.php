<?php wp_enqueue_media();?>
<?php
	$book_id = isset($_GET['edit_id'])?$_GET['edit_id']:0;
	global $wpdb;
	$book_data = $wpdb->get_row(
						$wpdb->prepare(
							"SELECT * from ".my_book_table()." WHERE id = %d",$book_id
						)
					);
?>
<div class="container">
	<div class="row">
		<div class="alert alert-info">
			<h4>Book Update Page</h4>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Update Book</div>
			<div class="panel-body">
				<form class="form-horizontal" action="javascript:void(0)" id="frmEditBook">
					<input type="hidden" name="book_id" value="<?php echo $_GET['edit_id'];?>">
					<div class="form-group">
						<label class="control-label col-sm-2" for="name">Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Enter name" value="<?php echo $book_data->name;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="author">Author:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required id="author" name="author" placeholder="Enter Author name" value="<?php echo $book_data->author;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="about">About:</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="about" name="about" placeholder="About the Book"><?php echo $book_data->about;?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="about">Upload Image:</label>
						<div class="col-sm-10">
							<input type="button" class="btn btn-info" id="btn-upload" value="Upload image"/>
							<span id="show-image"><img src="<?php echo $book_data->book_image;?>" style="height: 80px; width: 80px;"></span>
							<input type="hidden" id="image_name" name="image_name" value="<?php echo $book_data->book_image;?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>