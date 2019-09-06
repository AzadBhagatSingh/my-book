<div class="container">
	<div class="row">
		<div class="alert alert-info">
			<h4>Author Add Page</h4>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Add New Author</div>
			<div class="panel-body">
				<form class="form-horizontal" action="javascript:void(0)" id="frmAddAuthor">
					<div class="form-group">
						<label class="control-label col-sm-2" for="name">Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Enter name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="fb_link">Fb Link:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" required id="fb_link" name="fb_link" placeholder="Enter Fb Link name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="about">About:</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="about" name="about" placeholder="About the Book"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>