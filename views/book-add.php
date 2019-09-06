<?php wp_enqueue_media();?>
<?php
	global $wpdb;
	$authors = $wpdb->get_results(
					$wpdb->prepare(
						"SELECT id,name from " . my_authors_table() . " ORDER by id DESC", ""
					)
				);
?>
<div class="container">
	<div class="row">
		<div class="alert alert-info">
			<h4>Book Add Page</h4>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Add New Book</div>
			<div class="panel-body">
				<form class="form-horizontal" action="javascript:void(0)" id="frmAddBook">
					<div class="form-group">
						<label class="control-label col-sm-2" for="name">Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Enter name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="author">Author:</label>
						<div class="col-sm-10">
							<select class="form-control" id="author" name="author">
								<option value="-1"> -- Select Author -- </option>
								<?php 
									foreach ($authors as $author) {
										echo "<option value='".$author->id."'>".$author->name."</option>";
									}
								?>
							</select>
							<!-- <input type="text" class="form-control" required id="author" name="author" placeholder="Enter Author name"> -->
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="about">About:</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="about" name="about" placeholder="About the Book"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="about">Upload Image:</label>
						<div class="col-sm-10">
							<input type="button" class="btn btn-info" id="btn-upload" value="Upload image"/>
							<span id="show-image"></span>
							<input type="hidden" id="image_name" name="image_name">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>