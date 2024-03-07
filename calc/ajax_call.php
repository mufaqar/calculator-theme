<?php



// Add action for saving form data
add_action('wp_ajax_save_form_user_data', 'save_form_user_data');
add_action('wp_ajax_nopriv_save_form_user_data', 'save_form_user_data');

function save_form_user_data() {   

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'save_form_user_data') {
        $formData = $_POST['form_data'];
         $first_name = $formData['first_name'];
         $last_name = $formData['last_name'];
         $email = $formData['email'];
         $dob = $formData['dob'];
         $age = $formData['age'];
         $date_loss = $formData['date_loss'];
         $age_loss = $formData['age_loss'];
         $calc_date = $formData['calc_date'];
         $age_calc = $formData['age_calc'];
         $insurer = $formData['insurer'];
         $policy_no = $formData['policy_no'];
         $claim_no = $formData['claim_no'];
         $empl_status = $formData['empl_status'];
         $irb_policy = $formData['irb_policy'];
         $gender = $formData['gender'];         
    }
    // Create an array with user data
    $user_data = array(
        'user_login' => $email, 
        'user_pass' => wp_generate_password(), 
        'first_name' => $first_name,
        'last_name' => $last_name,
        'user_email' => $email,
        // Add other user meta data as needed
        'dob' => $dob,
        'age' => $age,
        'date_loss' => $date_loss,
        'age_loss' => $age_loss,
        'calc_date' => $calc_date,
        'age_calc' => $age_calc,
        'insurer' => $insurer,
        'policy_no' => $policy_no,
        'claim_no' => $claim_no,
        'empl_status' => $empl_status,
        'irb_policy' => $irb_policy,
        'gender' => $gender,
    );

  

        // Check if the user already exists
        $user = get_user_by('email', $email);

        if ($user) {
            // User already exists, update user data
            $user_id = $user->ID;

            // Update user data
            wp_update_user($user_data);
        } else {
            // User doesn't exist, insert a new user
            $user_id = wp_insert_user($user_data);
        }

        // Check if the user was created or updated successfully
        if (!is_wp_error($user_id)) {
            // User created or updated successfully

            // Update user meta data
            update_user_meta($user_id, 'first_name', $first_name);
            update_user_meta($user_id, 'last_name', $last_name);
            update_user_meta($user_id, 'dob', $dob);
            update_user_meta($user_id, 'age', $age);
            update_user_meta($user_id, 'date_loss', $date_loss);
            update_user_meta($user_id, 'age_loss', $age_loss);
            update_user_meta($user_id, 'calc_date', $calc_date);
            update_user_meta($user_id, 'age_calc', $age_calc);
            update_user_meta($user_id, 'insurer', $insurer);
            update_user_meta($user_id, 'policy_no', $policy_no);
            update_user_meta($user_id, 'claim_no', $claim_no);
            update_user_meta($user_id, 'empl_status', $empl_status);
            update_user_meta($user_id, 'irb_policy', $irb_policy);
            update_user_meta($user_id, 'gender', $gender);
            // Add other user meta updates as needed

            echo "User created/updated successfully with ID: " . $user_id;
        } else {
            // There was an error creating or updating the user
            echo "Error creating/updating user: " . $user_id->get_error_message();
        }






  
    



    // $preJobs = [];
    // $postJobs = [];
    // $benefits = [];
    // $benefits_arr = [];
    // parse_str($_POST['form_data'], $form_data);
    // $arranged_data = array();
    // if (!empty($form_data)) {
    //     foreach ($form_data as $field_name => $field_value) {
    //         $sanitized_value = sanitize_text_field($field_value);
    //         $arranged_data[$field_name] = $sanitized_value;
    //     }
    // }

    // $first_name =  $arranged_data['first_name'];
    // $last_name =  $arranged_data['last_name'];
    // $gender =  $arranged_data['gender'];
    // $birthdate =  $arranged_data['birthdate']; 
    // $age =  $arranged_data['age']; 
    // $date_loss =  $arranged_data['date_loss']; 
    // $age_loss =  $arranged_data['age_loss']; 
    // $calc_date =  $arranged_data['calc_date']; 
    // $age_calc =  $arranged_data['age_calc']; 
    // $insurer =  $arranged_data['insurer']; 
    // $policy_no =  $arranged_data['policy_no'];  
    // $claim_no =  $arranged_data['claim_no'];
    // $employment_status =  $arranged_data['employment_status']; 
    // $irb_policy =  $arranged_data['irb_policy'];    
 

    // foreach ($arranged_data as $key => $value) {
    //     if (strpos($key, 'pre_job') === 0) {          
    //         preg_match('/\d+/', $key, $matches);
    //         $index = $matches[0];
    //          $preJobs[$index][$key] = $value;


    //     } elseif (strpos($key, 'post_job') === 0) {
    //         preg_match('/\d+/', $key, $matches);
    //         $index = $matches[0];
    //         $postJobs[$index][$key] = $value;
    //     } elseif (strpos($key, 'post_ben') === 0) {
    //         preg_match('/\d+/', $key, $matches);
    //         $index = $matches[0];
    //         $benefits[$index][$key] = $value;
    //     }
    // }     
    //      // Set the post data
    //     $post_data = array(
    //         'post_title'    => $claim_no,
    //         'post_status'   => 'publish', 
    //         'post_type'     => 'irr_orders'
    //     );

    //     $post_id = wp_insert_post($post_data);
    //     if ($post_id) {
    //         $meta_data = array(
    //             'first_name' => $first_name,
    //             'last_name' => $last_name,
    //             'gender' => $gender,
    //             'birthdate' => $birthdate,
    //             'age' => $age,
    //             'date_loss' => $date_loss,
    //             'age_loss' => $age_loss,
    //             'calc_date' => $calc_date,
    //             'insurer' => $insurer,
    //             'policy_no' => $policy_no,
    //             'claim_no' => $claim_no,
    //             'employment_status' => $employment_status,
    //             'irb_policy' => $irb_policy,
    //             'preJobs' => $benefits,
    //             'postJobs' => $postJobs,
    //             'benefits' => $benefits
    //         );

    //         foreach ($meta_data as $meta_key => $meta_value) {
    //             add_post_meta($post_id, $meta_key, $meta_value, true);
    //         }

    //         echo "Form Added Sucessfully $post_id inserted successfully with meta data.";
    //     } else {
    //         echo "Error inserting post.";
    //     }

    // // Print the results
    // echo "Pre Jobs:\n";
    // print_r($preJobs);

    // echo "\nPost Jobs:\n";
    // print_r($postJobs);

    // echo "\nBenefits:\n";
    // print_r($benefits);

    // // Print the results
    // echo "Post Benefits:\n";
    // print_r($postBenefits);
   
   // wp_send_json_success('Form data saved successfully');

    // Always exit to avoid further execution
    wp_die();
}


// Add action for saving form data
add_action('wp_ajax_save_user_income_data', 'save_user_income_data');
add_action('wp_ajax_nopriv_save_user_income_data', 'save_user_income_data');

function save_user_income_data() { 
	print "<pre>";  
    
    $preJobs = [];
    $postJobs = [];
    $benefits = [];

    parse_str($_POST['form_data'], $form_data);
    $arranged_data = array();
    if (!empty($form_data)) {
        foreach ($form_data as $field_name => $field_value) {
            $sanitized_value = sanitize_text_field($field_value);
            $arranged_data[$field_name] = $sanitized_value;
        }
    }   

	print_r($arranged_data);
 

	foreach ($arranged_data as $key => $value) {
		if (strpos($key, 'pre_job') === 0) {          
			preg_match('/\d+/', $key, $matches);
			$index = $matches[0];
			$preJobs[$index][$key] = $value;
		} elseif (strpos($key, 'post_job') === 0) {
			preg_match('/\d+/', $key, $matches);
			$index = $matches[0];
			$postJobs[$index][$key] = $value;
		} elseif (strpos($key, 'post_ben') === 0) {
			preg_match('/\d+/', $key, $matches);
			$index = $matches[0];
			$benefits[$index][$key] = $value;
		}
	}   

	// foreach($preJobs as  $preJob)
	// {
	// 	print_r($preJob);
	// 	echo $index;

	// 	echo $preJob['pre_job1_title']."----";

	// 	// $new_post = array(
	// 	// 	'post_title'    => 'Your Post Title',
	// 	// 	'post_content'  => 'Your post content goes here.',
	// 	// 	'post_status'   => 'publish',
	// 	// 	'post_author'   => 1, // Replace with the user ID of the post author
	// 	// 	'post_type'     => 'post', // You can use 'page' for pages
	// 	// );
		
	// 	// // Insert the post into the database
	// 	// $post_id = wp_insert_post($new_post);
		
	// 	// // Check if the post was successfully inserted
	// 	// if ($post_id) {
	// 	// 	echo "Post inserted successfully with ID: $post_id";
	// 	// } else {
	// 	// 	echo "Failed to insert post";
	// 	// }
	// }


	//print_r($preJobs);
	print_r($postJobs);
	//print_r($benefits);

	
		die();

	foreach ($preJobs as $key => $job_data) {
   
		$post_title = isset($job_data["pre_job{$key}_title"]) ? $job_data["pre_job{$key}_title"] : '';
		$from_date = isset($job_data["pre_job{$key}_from_date"]) ? $job_data["pre_job{$key}_from_date"] : '';
		$to_date = isset($job_data["pre_job{$key}_to_date"]) ? $job_data["pre_job{$key}_to_date"] : '';
		$weeks_4 = isset($job_data["pre_job{$key}_4_weeks"]) && $job_data["pre_job{$key}_4_weeks"] == 'on';
		$weeks_52 = isset($job_data["pre_job{$key}_52_weeks"]) && $job_data["pre_job{$key}_52_weeks"] == 'on';
		$earning = isset($job_data["pre_job{$key}_earning"]) ? $job_data["pre_job{$key}_earning"] : '';
	 
		$post_data = array(
			'post_title'   => $post_title,
			'post_status'  => 'publish',
			'post_author'  => 2, 
			'post_type'    => 'jobs'
		);
	
		$post_id = wp_insert_post($post_data);
	
		if ($post_id) {
			update_post_meta($post_id, 'pre_job_from_date', $from_date);
			update_post_meta($post_id, 'pre_job_to_date', $to_date);
			update_post_meta($post_id, 'pre_job_4_weeks', $weeks_4);
			update_post_meta($post_id, 'pre_job_52_weeks', $weeks_52);
			update_post_meta($post_id, 'pre_job_earning', $earning);		  
			$taxonomy_slug = 'job_type';
			$term_slug = 'pre-income'; 
			wp_set_object_terms($post_id, $term_slug, $taxonomy_slug);
			echo "Pre-Job post inserted successfully. ID: $post_id\n";
		} else {
			echo "Failed to insert pre-job post\n";
		}
	}
	
	foreach ($postJobs as $key => $job_data) {
	   
		$post_title = isset($job_data["post_job{$key}_title"]) ? $job_data["post_job{$key}_title"] : '';
		$from_date = isset($job_data["post_job{$key}_from_date"]) ? $job_data["post_job{$key}_from_date"] : '';
		$to_date = isset($job_data["post_job{$key}_to_date"]) ? $job_data["post_job{$key}_to_date"] : '';
		$weeks_4 = isset($job_data["post_job{$key}_4_weeks"]) && $job_data["post_job{$key}_4_weeks"] == 'on';
		$weeks_52 = isset($job_data["post_job{$key}_52_weeks"]) && $job_data["post_job{$key}_52_weeks"] == 'on';
		$earning = isset($job_data["post_job{$key}_earning"]) ? $job_data["post_job{$key}_earning"] : '';
	 
		$post_data = array(
			'post_title'   => $post_title,
			'post_status'  => 'publish',
			'post_author'  => 2, 
			'post_type'    => 'jobs'
		);
	
		$post_id = wp_insert_post($post_data);
	
		if ($post_id) {
			update_post_meta($post_id, 'post_job_from_date', $from_date);
			update_post_meta($post_id, 'post_job_to_date', $to_date);
			update_post_meta($post_id, 'post_job_4_weeks', $weeks_4);
			update_post_meta($post_id, 'post_job_52_weeks', $weeks_52);
			update_post_meta($post_id, 'post_job_earning', $earning);		  
			$taxonomy_slug = 'job_type';
			$term_slug = 'post-income'; 
			wp_set_object_terms($post_id, $term_slug, $taxonomy_slug);
			echo "Post-Job post inserted successfully. ID: $post_id\n";
		} else {
			echo "Failed to insert post-job post\n";
		}
	}

	foreach ($benefits as $key => $job_data) {
	   
		$post_title = isset($job_data["post_job{$key}_title"]) ? $job_data["post_job{$key}_title"] : '';
		$from_date = isset($job_data["post_job{$key}_from_date"]) ? $job_data["post_job{$key}_from_date"] : '';
		$to_date = isset($job_data["post_job{$key}_to_date"]) ? $job_data["post_job{$key}_to_date"] : '';
		$weeks_4 = isset($job_data["post_job{$key}_4_weeks"]) && $job_data["post_job{$key}_4_weeks"] == 'on';
		$weeks_52 = isset($job_data["post_job{$key}_52_weeks"]) && $job_data["post_job{$key}_52_weeks"] == 'on';
		$earning = isset($job_data["post_job{$key}_earning"]) ? $job_data["post_job{$key}_earning"] : '';
	 
		$post_data = array(
			'post_title'   => $post_title,
			'post_status'  => 'publish',
			'post_author'  => 2, 
			'post_type'    => 'jobs'
		);
	
		$post_id = wp_insert_post($post_data);
	
		if ($post_id) {
			update_post_meta($post_id, 'post_benefit_from_date', $from_date);
			update_post_meta($post_id, 'post_benefit_to_date', $to_date);
			update_post_meta($post_id, 'post_benefit_4_weeks', $weeks_4);
			update_post_meta($post_id, 'post_benefit_52_weeks', $weeks_52);
			update_post_meta($post_id, 'post_benefit_earning', $earning);		  
			$taxonomy_slug = 'job_type';
			$term_slug = 'post-benefits'; 
			wp_set_object_terms($post_id, $term_slug, $taxonomy_slug);
			echo "Post-benefits post inserted successfully. ID: $post_id\n";
		} else {
			echo "Failed to insert post-benefits post\n";
		}
	}
	
	


	
	
	
        
    
    

    wp_die();
}




// // Localize the AJAX URL
// add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// function enqueue_custom_scripts() {
//     wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true);

//     // Localize the script with new data
//     wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
// }


