<?php 

	function create_db_tables()
	{
		$sql = "CREATE TABLE `".my_book_table()."` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `name` varchar(255) DEFAULT NULL,
				 `author` varchar(255) DEFAULT NULL,
				 `about` text,
				 `book_image` text,
				 `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		dbDelta($sql);

		$sql2 = "CREATE TABLE `".my_authors_table()."` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `name` varchar(255) DEFAULT NULL,
				 `fb_link` text,
				 `about` text,
				 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		dbDelta($sql2);


		$sql3 = "CREATE TABLE `".my_students_table()."` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `name` varchar(255) NOT NULL,
				 `email` text NOT NULL,
				 `user_login_id` int(11) NOT NULL,
				 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		dbDelta($sql3);

		$sql4 = "CREATE TABLE `".my_enrol_table()."` (
				 `id` int(11) NOT NULL AUTO_INCREMENT,
				 `student_id` int(11) NOT NULL,
				 `book_id` int(11) NOT NULL,
				 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				 PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		dbDelta($sql4);

		
	}
?>