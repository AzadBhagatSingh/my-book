<?php
	/*
	Template Name: Front end book page layout
	*/
	get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-success" style="background-color: #d3f582;">
				<h3>EPIC Cources</h3>
			</div>
			<?php
				echo do_shortcode("[book_page]");
			?>
		</div>		
	</div>
</div>
<?php
	get_footer();
?>