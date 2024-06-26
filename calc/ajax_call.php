<?php



// Hook into WordPress' AJAX actions for authenticated and non-authenticated users
add_action('wp_ajax_get_existing_jobs', 'get_existing_jobs');
add_action('wp_ajax_nopriv_get_existing_jobs', 'get_existing_jobs');

function get_existing_jobs() {   

    $type =  $_POST['type'];
    $args = array(
        'post_type' => 'jobs',
        'post_status' => 'publish',
        'posts_per_page' => -1, 
        'job_type' => $type
    );

    $jobs_query = new WP_Query($args);
    if ($jobs_query->have_posts()) {
        $jobs = array();
        while ($jobs_query->have_posts()) {
            $jobs_query->the_post();
            $job_id = get_the_ID();
            $job_title = get_the_title();
            $existing_paystubs = get_post_meta($job_id, 'paystubs', true);            
            if (!$existing_paystubs) {
                $existing_paystubs = array();
            }

            // Add job data to the array
            $job_data = array(
                'job_id' => $job_id,
                'job_title' => $job_title,
                'paystubs' => $existing_paystubs
            );

            $jobs[] = $job_data;
        }
        
        // Restore original post data
        wp_reset_postdata();

        // Return the jobs data as JSON
        echo json_encode(array('success' => true, 'jobs' => $jobs));
    } else {
        // Return an error message if no jobs found
        echo json_encode(array('success' => false, 'message' => 'No jobs found.'));
    }

    // Terminate the script to ensure no further output
    wp_die();
}





function create_new_job() {
    $job_title = sanitize_text_field($_POST['job_title']);
    $type =  array($_POST['type']);
    $job_id = wp_insert_post(array(
        'post_title'   => $job_title,
        'post_type'    => 'jobs',
        'post_status'  => 'publish'
    ));

    if (!is_wp_error($job_id)) {
         wp_set_object_terms($job_id, $type, 'job_type'); 
         echo json_encode(array('success' => true, 'job_id' => $job_id));
         
    } else {
        echo json_encode(array('success' => false));
    }
    wp_die();
}
add_action('wp_ajax_create_new_job', 'create_new_job');
add_action('wp_ajax_nopriv_create_new_job', 'create_new_job');

function update_job_with_paystub() {
    
    
    $job_id = intval($_POST['job_id']);
    $paystub_data = array(
        'paystubId'       => sanitize_text_field($_POST['paystubId']),
        'from_date'       => sanitize_text_field($_POST['from_date']),
        'to_date'         => sanitize_text_field($_POST['to_date']),
        'gross_earnings'  => sanitize_text_field($_POST['gross_earnings']),
        'special_condition' => sanitize_text_field($_POST['special_condition'])
    );

    // Assuming paystubs are stored as an array in post meta
    $existing_paystubs = get_post_meta($job_id, 'paystubs', true);
    if (!$existing_paystubs) {
        $existing_paystubs = array();
    }
    $existing_paystubs[] = $paystub_data;
    update_post_meta($job_id, 'paystubs', $existing_paystubs);

    echo json_encode(array('success' => true));
    wp_die();
}
add_action('wp_ajax_update_job_with_paystub', 'update_job_with_paystub');
add_action('wp_ajax_nopriv_update_job_with_paystub', 'update_job_with_paystub');


function removePaystub() {
    
    $job_id = intval($_POST['job_id']);
    $paystubs = $_POST['job']; 
    $paystub_data = [];

    // Process each paystub
    foreach ($paystubs as $key => $paystub) {
        $paystub_data[] = array(
            'paystubId'         => $paystub['paystubId'],
            'from_date'         => $paystub['fromDate'],
            'to_date'           => $paystub['toDate'],
            'gross_earnings'    => $paystub['grossEarnings'],
            'special_condition' => $paystub['specialCondition']
        );
    }
    
    // Print the processed paystub data for debugging
    // print "<pre>";
    // print_r($paystub_data);

    // Check if the job type is 'jobs'
   
        // Remove existing paystub meta data
        delete_post_meta($job_id, 'paystubs');

        // Update the paystubs meta data with new data
        if (update_post_meta($job_id, 'paystubs', $paystub_data)) {
            wp_send_json_success(['message' => 'Paystubs updated successfully']);
        } else {
            wp_send_json_error(['message' => 'Failed to update paystubs']);
        }
        
        // Respond with success message
        echo json_encode(array('success' => true, 'message' => 'Data removed'));
   

    // Terminate the script
    wp_die();
}

add_action('wp_ajax_removePaystub', 'removePaystub');
add_action('wp_ajax_nopriv_removePaystub', 'removePaystub');




function remove_job() {    
    
    $post_id = sanitize_text_field($_POST['job_id']);
    $job_id = wp_delete_post($post_id); 

    if (!is_wp_error($job_id)) {
        echo json_encode(array('success' => true, 'job_id' => $job_id));
    } else {
        echo json_encode(array('success' => false));
    }
    wp_die();
}
add_action('wp_ajax_remove_job', 'remove_job');
add_action('wp_ajax_nopriv_remove_job', 'remove_job');
// Add action for saving form data
add_action('wp_ajax_check_user_data', 'check_user_data');
add_action('wp_ajax_nopriv_check_user_data', 'check_user_data');

function check_user_data() {   

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'check_user_data') {
            $email = sanitize_email($_POST['email']);          
            $user = get_user_by('email', $email);    
            if ($user) {                   
                $user_id = $user->ID;           
                $first_name = $user->first_name;
                $last_name = $user->last_name;
                $dob = get_user_meta($user->ID, 'dob', true);
                $age = get_user_meta($user->ID, 'age', true);
                $dol = get_user_meta($user->ID, 'dol', true);
                $age_loss = get_user_meta($user->ID, 'age_loss', true);
                $calc_date = get_user_meta($user->ID, 'calc_date', true);
                $age_calc = get_user_meta($user->ID, 'age_calc', true);
                $insurer = get_user_meta($user->ID, 'insurer', true);
                $policy_no = get_user_meta($user->ID, 'policy_no', true);
                $claim_no = get_user_meta($user->ID, 'claim_no', true);
                $empl_status = get_user_meta($user->ID, 'empl_status', true);
                $irb_policy = get_user_meta($user->ID, 'irb_policy', true);
                $gender = get_user_meta($user->ID, 'gender', true); 
                $userData = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'dob' => $dob,
                    'age' => $age,
                    'dol' => $dol,
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

                wp_send_json($userData);
            } 
           
    
        }
}




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
         $dol = $formData['dol'];
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
        'dol' => $dol,
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

            // Update user meta data
            update_user_meta($user_id, 'first_name', $first_name);
            update_user_meta($user_id, 'last_name', $last_name);
            update_user_meta($user_id, 'dob', $dob);
            update_user_meta($user_id, 'age', $age);
            update_user_meta($user_id, 'dol', $dol);
            update_user_meta($user_id, 'age_loss', $age_loss);
            update_user_meta($user_id, 'calc_date', $calc_date);
            update_user_meta($user_id, 'age_calc', $age_calc);
            update_user_meta($user_id, 'insurer', $insurer);
            update_user_meta($user_id, 'policy_no', $policy_no);
            update_user_meta($user_id, 'claim_no', $claim_no);
            update_user_meta($user_id, 'empl_status', $empl_status);
            update_user_meta($user_id, 'irb_policy', $irb_policy);
            update_user_meta($user_id, 'gender', $gender);

            echo "User created/updated successfully with ID: " . $user_id;
           
            
        } else {
            // There was an error creating or updating the user
            echo "Error creating/updating user: " . $user_id->get_error_message();
        }


    wp_die();
}



// Add action for saving form data
add_action('wp_ajax_addJob', 'addJob');
add_action('wp_ajax_nopriv_addJob', 'addJob');

function addJob() {  
    $formData = $_POST['form_data'];
    $job_title = $formData['job_title'];   

      // Insert the post into the database
      $post_id = wp_insert_post(array(
        'post_title'   => $job_title,
        'post_type' => 'jobs',
        'post_status'  => 'publish',
        'post_author'  => get_current_user_id()
    ));

    if ($post_id) {
        $response = array(
            'post_id'   => $post_id,
            'job_title' => $job_title
        );
        wp_send_json_success($response);
      
    } else {
        wp_send_json_error();
    }
    die();
}

// Add action for saving form data
add_action('wp_ajax_UpdateJob', 'UpdateJob');
add_action('wp_ajax_nopriv_UpdateJob', 'UpdateJob');

function UpdateJob() {  

    $post_id = $_POST['pid'];

  

    $data = $_POST['form_data'];
    print "<pre>";
    print_r($data);
    print "</pre>";

     // Retrieve all post meta for the given post ID
     $all_meta = get_post_meta($post_id);

     // Loop through all meta and delete keys that start with 'prejob_'
     foreach ($all_meta as $key => $value) {
         if (strpos($key, 'prejob_') === 0) {
             delete_post_meta($post_id, $key);
         }
     }

    

    // Loop through the array and add each entry to the post meta
    foreach ($data as $key => $entry) {
        // Ensure from_date and to_date are properly formatted (example: 'Y-m-d')
        $from_date = isset($entry['from_date']) ? sanitize_text_field($entry['from_date']) : '';
        $to_date = isset($entry['to_date']) ? sanitize_text_field($entry['to_date']) : '';
        $earning = isset($entry['earning']) ? sanitize_text_field($entry['earning']) : '';
        $comt = isset($entry['comt']) ? sanitize_text_field($entry['comt']) : '';


        if (!empty($from_date) && !empty($to_date)) {
        $meta_key = "prejob_{$key}";

        // Prepare the value to store as an associative array
        $meta_value = array(
            'from_date' => $from_date,
            'to_date' => $to_date,
            'earning' => $earning,
            'comt' => $comt
        );

        // Update the post meta
        update_post_meta($post_id, $meta_key, $meta_value);
        echo "upated Code";
    }
    }

    die();
    
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


	//print_r($preJobs);
	//print_r($postJobs);
	print_r($benefits);
	

	foreach ($preJobs as $key => $job_data) {   
		$post_title = isset($job_data["pre_job{$key}_title"]) ? $job_data["pre_job{$key}_title"] : '';
		$from_date = isset($job_data["pre_job{$key}_from_date"]) ? $job_data["pre_job{$key}_from_date"] : '';
		$to_date = isset($job_data["pre_job{$key}_to_date"]) ? $job_data["pre_job{$key}_to_date"] : '';
		$weeks_4 = isset($job_data["pre_job{$key}_4_weeks"]) && $job_data["pre_job{$key}_4_weeks"] == 'on';
		$weeks_52 = isset($job_data["pre_job{$key}_52_weeks"]) && $job_data["pre_job{$key}_52_weeks"] == 'on';
		$earning = isset($job_data["pre_job{$key}_earning"]) ? $job_data["pre_job{$key}_earning"] : '';	 
        if (!empty($post_title)) {
            $post_data = array(
                'post_title'   => $post_title,
                'post_status'  => 'publish',
                'post_author'  => 1, 
                'post_type'    => 'jobs'
            );
	
		    $post_id = wp_insert_post($post_data);

        }
	
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
	 
		

        if (!empty($post_title)) {
            $post_data = array(
                'post_title'   => $post_title,
                'post_status'  => 'publish',
                'post_author'  => 1, 
                'post_type'    => 'jobs'
            );
	
		    $post_id = wp_insert_post($post_data);

        }
	
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
	   
		$post_title = isset($job_data["post_ben{$key}_title"]) ? $job_data["post_ben{$key}_title"] : '';
		$from_date = isset($job_data["post_ben{$key}_from_date"]) ? $job_data["post_ben{$key}_from_date"] : '';
		$to_date = isset($job_data["post_ben{$key}_to_date"]) ? $job_data["post_ben{$key}_to_date"] : '';
		$weeks_4 = isset($job_data["post_ben{$key}_4_weeks"]) && $job_data["post_ben{$key}_4_weeks"] == 'on';
		$weeks_52 = isset($job_data["post_ben{$key}_52_weeks"]) && $job_data["post_ben{$key}_52_weeks"] == 'on';
		$earning = isset($job_data["post_ben{$key}_earning"]) ? $job_data["post_ben{$key}_earning"] : '';
	 
        if (!empty($post_title)) {
            $post_data = array(
                'post_title'   => $post_title,
                'post_status'  => 'publish',
                'post_author'  => 1, 
                'post_type'    => 'jobs'
            );
	
		    $post_id = wp_insert_post($post_data);

        }
	
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
    
    echo "updated";

    wp_die();
}





// Add action for saving form data
add_action('wp_ajax_savePreJobData', 'savePreJobData');
add_action('wp_ajax_nopriv_savePreJobData', 'savePreJobData');

function savePreJobData() {   
   

        print "<pre>";  
    
                
                parse_str($_POST['form_data'], $form_data);
                $arranged_data = array();

                if (!empty($form_data)) {
                    foreach ($form_data as $field_name => $field_value) {
                        $sanitized_value = sanitize_text_field($field_value);
                        $arranged_data[$field_name] = $sanitized_value;
                    }
                }   



                print_r($arranged_data);  
                
          

                $resultArray = array();
                
                foreach ($arranged_data as $key => $value) {
                    $parts = explode('_', $key);
                    if ($parts[0] == 'job' && isset($parts[2]) && isset($parts[3]) && is_numeric($parts[3])) {
                        $jobId = $parts[2];
                        $entryId = $parts[3];
                        $subKey = implode('_', array_slice($parts, 4)); // Create subkey without "job_entry_{$jobId}_{$entryId}_"
                
                        // Create subarrays for each job entry based on job ID and entry ID
                        if (!isset($resultArray[$jobId][$entryId])) {
                            $resultArray[$jobId][$entryId] = array();
                        }
                
                        // Add the value to the subarray
                        $resultArray[$jobId][$entryId][$subKey] = $value;
                    }
                }

                foreach ($resultArray as $index => $meta_values) {  
               
                    foreach ($meta_values as $meta_key => $meta_value) {
                       // print_r($meta_value);
                         update_post_meta($index, "paystub_$meta_key", $meta_value);                       
                        
                    }
                }
                
               
       
           die();
           
    
        
}




// Add action for saving form data
add_action('wp_ajax_calculation', 'calculation');
add_action('wp_ajax_nopriv_calculation', 'calculation');

function calculation() {   
       echo "Calculation";
       die();
       
    
        
}




function Calc( $from,$to, $dol, $earing) {

    $from_date = new DateTime($from);
    $to_date = new DateTime($to);
    $dol = new DateTime($dol);
    $earning = $earing;

    // echo "FD : ".$from_date->format('M-d-Y')."<br/>";
    // echo "TD : ".$to_date->format('M-d-Y')."<br/>";

    
    
    $P4W_F = (clone $dol)->modify('-28 days');
    $P4W = $P4W_F->format('M-d-Y');
    
    // Calculate the proportional earning
    $diff_from_to = $from_date->diff($to_date)->days + 1; 
    $diff_sp = $from_date->diff($dol)->days + 1; 
    $days = $P4W_F->diff($to_date)->days + 1;   
    
    $first = new DateTime(''. $P4W .'');  

    
    
    
    if($days >= 28 && $diff_sp >= 28){
       $days = 0;
    }
    
    if ($to_date >= $first && $to_date <= $dol) {

       
     
    } else {

        
    
        if( $diff_sp <= 28 ) {
            $days = $diff_sp;
        }
    }
    
   
    $calculated_earning_4weeks = round(($earning / $diff_from_to) * $days);
   // $calculated_earning_4weeks = $earning;
    $calculated_earning_52weeks = ($earning );

  
    if ($dol >= $from_date && $dol <= $to_date) {

    $dol_d_todate =  $dol->diff($to_date)->days ; 

    $calculated_earning_52weeks = ($earning /$diff_from_to * $dol_d_todate );

    }
    else {

        $calculated_earning_52weeks = ($earning );


    }

    
    // echo "4Week :".$calculated_earning_4weeks , "<br/>";
    // echo "52Week :".$calculated_earning_52weeks , "<hr/>";

    $results = array(
        "4Week" => $calculated_earning_4weeks,
        "52Week" => $calculated_earning_52weeks
    );

 

    return $results;
    
    }