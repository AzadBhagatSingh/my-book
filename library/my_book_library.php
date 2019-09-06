<?php
	if($_REQUEST['param']=="save_book"){
		$post_data = array(
						"name" => $_REQUEST['name'],
						"author" => $_REQUEST['author'],
						"about" => $_REQUEST['about'],
						"book_image" => $_REQUEST['image_name'],
					);
		if($wpdb->insert(my_book_table(),$post_data)){
			echo json_encode(array("status"=>1,"message"=>"Book Created Successfully"));
		}else{
			echo json_encode(array("status"=>0,"message"=>"Data not saved"));
		}
	}elseif ($_REQUEST['param']=="edit_book") {
		$post_data = array(
						"name" => $_REQUEST['name'],
						"author" => $_REQUEST['author'],
						"about" => $_REQUEST['about'],
						"book_image" => $_REQUEST['image_name'],
					);
		// print_r($post_data);
		$wpdb->update(my_book_table(),$post_data,array("id"=>$_REQUEST['book_id']));
		echo json_encode(array("status"=>1,"message"=>"Book Updated Successfully"));
		// if($wpdb->insert(my_book_table(),$post_data)){
			// 	echo json_encode(array("status"=>1,"message"=>"Book Created Successfully"));
		// }else{
			// 	echo json_encode(array("status"=>0,"message"=>"Data not saved"));
		// }
	}elseif ($_REQUEST['param']=="delete_book") {
		
		$wpdb->delete(my_book_table(),array("id"=>$_REQUEST['book_id']));
		echo json_encode(array("status"=>1,"message"=>"Book Deleted Successfully"));
	}elseif ($_REQUEST['param']=="save_author") {
		$post_data = array(
						"name" => $_REQUEST['name'],
						"fb_link" => $_REQUEST['fb_link'],
						"about" => $_REQUEST['about']
					);
		if($wpdb->insert(my_authors_table(),$post_data)){
			echo json_encode(array("status"=>1,"message"=>"Author Created Successfully"));
		}else{
			echo json_encode(array("status"=>0,"message"=>"Author Data not saved"));
		}
	}elseif ($_REQUEST['param']=="save_student") {
		//username should not be repeated: username_exists($_REQUEST['username']);
		//email should be unique: email_exists($_REQUEST['email']);

		$student_id = $user_id = wp_create_user($_REQUEST['username'],$_REQUEST['password'],$_REQUEST['email']);
		$user = new WP_User($student_id);
		$user->set_role("wp_book_user_key");
		$post_data = array(
						"name" => $_REQUEST['name'],
						"email" => $_REQUEST['email'],
						"user_login_id" => $user_id
					);
		if($wpdb->insert(my_students_table(),$post_data)){
			echo json_encode(array("status"=>1,"message"=>"Student Created Successfully"));
		}else{
			echo json_encode(array("status"=>0,"message"=>"Student Data not saved"));
		}
	}elseif ($_REQUEST['param']=="enrol_student") {
		$post_data = array(
						"student_id" => $_REQUEST['student_id'],
						"book_id" => $_REQUEST['book_id']
					);
		if($wpdb->insert(my_enrol_table(),$post_data)){
			echo json_encode(array("status"=>1,"message"=>"Enrolled Successfully"));
		}else{
			echo json_encode(array("status"=>0,"message"=>"Data not saved"));
		}
	}