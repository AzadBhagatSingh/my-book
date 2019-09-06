<?php 
/*
 *	Plugin Name: My Book
 *	Plugin URI: https://www.epicbusinesses.com/
 *	Description: This is demo plugin for Books.
 *	Author: Azad Bhagat Singh.
 *	Author URI: https://www.epicbusinesses.com/
 *	Version: 1.0
 */

	if (!defined("ABSPATH")) {
		exit;
	}
	if (!defined("MY_BOOK_PLUGIN_DIR_PATH")) {
		define("MY_BOOK_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
	}
	if (!defined("MY_BOOK_PLUGIN_URL")) {
		define("MY_BOOK_PLUGIN_URL", plugins_url(). "/my-book");
	}

	function my_book_include_assets()
	{
		$pages_includes = array(
							"book-list",
							"book-edit",
							"add-new",
							"add-author",
							"manage-author",
							"add-student",
							"manage-student",
							"course-tracker",
							"frontendpage"
						);
		$current_page = $_GET['page'];
		//$_SERVER[REQUEST_URI]
		//$_SERVER[HTTP_HOST]: http:// or https://
		if(empty($current_page)){
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(preg_match("/my_book/",$actual_link)){
				$current_page = "frontendpage";
			}
		}
		if (in_array($current_page, $pages_includes)) {
			/*style sheet*/
			wp_enqueue_style("bootstrap",MY_BOOK_PLUGIN_URL ."/assets/css/bootstrap.min.css");
			wp_enqueue_style("dataTables",MY_BOOK_PLUGIN_URL ."/assets/css/jquery.dataTables.min.css");
			wp_enqueue_style("notifyBar",MY_BOOK_PLUGIN_URL ."/assets/css/jquery.notifyBar.css");
			wp_enqueue_style("style",MY_BOOK_PLUGIN_URL ."/assets/css/style.css");

			/*scripts*/
			wp_enqueue_script("jquery");//to include jquery.min.js from wp own folder
			wp_enqueue_script("bootstrap.min.js",MY_BOOK_PLUGIN_URL ."/assets/js/bootstrap.min.js","",true);
			wp_enqueue_script("jquery.dataTables.min.js",MY_BOOK_PLUGIN_URL ."/assets/js/jquery.dataTables.min.js","",true);
			
			wp_enqueue_script("jquery.notifyBar.js",MY_BOOK_PLUGIN_URL ."/assets/js/jquery.notifyBar.js","",true);
			wp_enqueue_script("jquery.validate.min.js",MY_BOOK_PLUGIN_URL ."/assets/js/jquery.validate.min.js","",true);
			wp_enqueue_script("script.js",MY_BOOK_PLUGIN_URL ."/assets/js/script.js","",true);

			//make ajaxurl
			wp_localize_script("script.js","mybookajaxurl",admin_url("admin-ajax.php"));
		}
	}
	add_action("init", "my_book_include_assets");

	/*Add menu and submenus of plugin*/
	function my_book_plugin_menus(){
		add_menu_page("My Book","My Book","manage_options","book-list","my_book_list","dashicons-book-alt",30);
		add_submenu_page("book-list","Book List","Book List","manage_options","book-list","my_book_list");
		add_submenu_page("book-list","Add New Book","Add New Book","manage_options","add-new","my_book_add");
		add_submenu_page("book-list","","","manage_options","book-edit","my_book_update");

		/// my extended submenus
    add_submenu_page("book-list", "Add New Author", "Add New Author", "manage_options", "add-author", "my_author_add");
    add_submenu_page("book-list", "Manage Author", "Manage Author", "manage_options", "manage-author", "my_author_remove");
    add_submenu_page("book-list", "Add New Student", "Add New Student", "manage_options", "add-student", "my_student_add");
    add_submenu_page("book-list", "Manage Student", "Manage Student", "manage_options", "manage-student", "my_student_remove");
    add_submenu_page("book-list", "Course Tracker", "Course Tracker", "manage_options", "course-tracker", "course_tracker");
    //end section

	}
	add_action("admin_menu","my_book_plugin_menus");
	//callback function for Book List menu option
	function my_book_list(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/book-list.php");
	}
	//callback function for Add Book menu option
	function my_book_add(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/book-add.php");
	}
	//callback function for Update Book 
	function my_book_update(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/book-edit.php");
	}
	function my_author_add(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/author-add.php");
	}
	function my_author_remove(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/manage-author.php");
	}
	function my_student_add(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/sutdent-add.php");
	}
	function my_student_remove(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/manage-student.php");
	}
	function course_tracker(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/course-tracker.php");
	}

	/*create table on plugin installation*/
	//set table name
	function my_book_table(){
		global $wpdb;
		return $wpdb->prefix . "my_books";
	}
	function my_authors_table(){
		global $wpdb;
		return $wpdb->prefix . "my_authors";
	}
	function my_students_table(){
		global $wpdb;
		return $wpdb->prefix . "my_students";
	}
	function my_enrol_table(){
		global $wpdb;
		return $wpdb->prefix . "my_enrol";
	}
	//create table db query
	function my_book_generate_table_script(){
		global $wpdb;
		require_once ABSPATH . "wp-admin/includes/upgrade.php";
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/library/my_book_db.php");
		create_db_tables();

		//user registration role
		add_role("wp_book_user_key", "My Book User", array(
			"read"=>true
		));

		/*dynamic page creation code- listing of created books*/
		//create post object
		$my_post = array(
					"post_title"=>"Book Page",
					"post_content"=>"[book_page]",
					"post_status"=>'publish',
					"post_type"=>"page",
					"post_name"=>"my_book"
					);

		/*Insert post into the database*/
		$book_id = wp_insert_post($my_post);
		add_option("my_book_page_id",$book_id);
	}
	register_activation_hook(__FILE__,"my_book_generate_table_script");

	//drop table of plugin when uninstall
	function drop_table_plugin_books()	{
		global $wpdb;
		$wpdb->query("DROP TABLE IF EXISTS " . my_book_table());
		$wpdb->query("DROP TABLE IF EXISTS " . my_authors_table());
		$wpdb->query("DROP TABLE IF EXISTS " . my_students_table());
		$wpdb->query("DROP TABLE IF EXISTS " . my_enrol_table());

		//removing user role
		if(get_role("wp_book_user_key")){
			remove_role("wp_book_user_key");
		}

		//delete page 
		if (!empty(get_option("my_book_page_id"))) {
			wp_delete_post(get_option("my_book_page_id"),true);//wp_posts table
			delete_option("my_book_page_id");//wp_options table
		}
	}
	register_deactivation_hook(__FILE__,"drop_table_plugin_books");
	//register_uninstall_hook(__FILE__,"drop_table_plugin_books");

	function my_book_page_functions(){
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/views/my_book_frontend_list.php");
	}
	add_shortcode("book_page","my_book_page_functions");

	/*sending ajax request*/
	add_action("wp_ajax_mybooklibrary","my_book_ajax_handler");
	function my_book_ajax_handler(){
		global $wpdb;
		include_once(MY_BOOK_PLUGIN_DIR_PATH . "/library/my_book_library.php");
		wp_die();
	}

	/*create frontend page template*/
	add_filter("page_template", "epic_custom_page_layout");
	function epic_custom_page_layout($page_template){
		global $post;
		$page_slug = $post->post_name; //book page slug
		if ($page_slug == "my_book") {
			$page_template = MY_BOOK_PLUGIN_DIR_PATH . "/views/frontend-books-template.php";
		}
		return $page_template;
	}

	function get_author_details($authr_id){
		global $wpdb;
		$author_details = $wpdb->get_row(
							$wpdb->prepare(
								"SELECT * from ".my_authors_table()." where id = %d",$authr_id
							)
						);
		return $author_details;
	}

	function student_enrolled($student_id,$book_id){
		global $wpdb;
		$result = $wpdb->get_row(
			$wpdb->prepare("SELECT * from ".my_enrol_table()." where student_id = %d and book_id = %d",$student_id,$book_id)
		);
		if(!empty($result)){
			return true;
		}else{
			return false;
		}
	}
	/*function for login*/
	function epic_login_user_role_filter($redirect_to,$request,$user){
		//custom user role
		global $user;
		if(isset($user->roles) && is_array($user->roles)){//array which contains the user role data
			if (in_array("wp_book_user_key", $user->roles)) {
				return $redirect_to = site_url()."/my_book/";
			}else{
				return $redirect_to;
			}
		}
	}
	add_filter("login_redirect", "epic_login_user_role_filter",10,3);

	/*function for logout*/
	function epic_logout_user_role_filter(){
		//custom user role
		wp_redirect(site_url()."/my_book/");
		exit();
	}
	add_filter("wp_logout","epic_logout_user_role_filter")
?>