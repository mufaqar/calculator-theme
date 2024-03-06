<?php
/*
Template Name: Home calc
*/

get_header();

?>
<section>
   <div class="container mx-auto">
         <h2 class="display-6 fw-bold lh-sm text-center">
            MOCK CALCULATOR
         </h2>
   </div>
   <div class="container mx-auto col p-md-5 py-5 Step_form">
      <div class="row">
         <form class="" id="mock_calc" method="POST">
            <div class="step active" id="step1">
               <h3 class="fs-4 mb-4 lh-sm">
                  CLAIM DETAILS
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-3 col-12">
                        <label for="first_name">  First Name</label>
                        <input type="text" name="first_name" class="form-control fs-6 fw-normal" id="first_name" placeholder="First Name" >
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="last_name">  Last Name</label>
                        <input type="text" name="last_name" class="form-control fs-6 fw-normal" id="last_name" placeholder="Last Name" >
                     </div>
                     
                     <div class="col-md-3 col-12">
                        <label for="birthdate">  Email</label>
                        <input type="text" name="birthdate" class="form-control fs-6 fw-normal" id="email" placeholder="Enter Email Address">
                        
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="birthdate">  Birthdate</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" data-date-format="DD MMMM YYYY" value="2015-08-09" name="dob" class="form-control fs-6 fw-normal" id="dob" placeholder="Birth Date">
                        
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="age"> Age Today</label>
                        <input type="number" name="age" class="form-control fs-6 fw-normal" id="age" placeholder="Age">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="date_loss">Date of Loss (DOL)</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date_loss" class="form-control fs-6 fw-normal" id="date_loss" placeholder="Date of Loss (DOL)">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="age_loss">  Age on DOL</label>
                        <input type="number" name="age_loss" class="form-control fs-6 fw-normal" id="age_loss" placeholder="40">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="calc_date">Calculation Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="calc_date" class="form-control fs-6 fw-normal" id="calc_date" placeholder="Calculation Date">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="age_calc">  Age on Calculation Date</label>
                        <input type="number" name="age_calc" class="form-control fs-6 fw-normal" id="age_calc" placeholder="  Age on Calculation Date">
                     </div> 
                     <div class="col-md-3 col-12">
                        <label for="insurer">Insurer</label>
                        <input type="text" name="insurer" class="form-control fs-6 fw-normal" id="insurer" placeholder="Insurer" >
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="policy_no">Policy no</label>
                        <input type="text" name="policy_no" class="form-control fs-6 fw-normal" id="policy_no" placeholder="Policy no" >
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="claim_no">Claim no</label>
                        <input type="text" name="claim_no" class="form-control fs-6 fw-normal" id="claim_no" placeholder="Claim no" >
                     </div>               
                     <div class="col-md-3 col-12">
                        <label for="empl_status">Employment Status on the DOL</label>
                        <select id="empl_status" name="empl_status" class="form-select" aria-label="empl_status">
                           <option value="employed">Employed</option>
                           <option value="self_employed">Self employed</option>
                        </select>
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="irb_policy">Max IRB per Policy</label>
                        <select id="irb_policy" name="irb_policy" class="form-select" aria-label="irb_policy">
                          <option value="$400">$400</option>
                           <option value="$800">$800</option>
                           <option value="$1000">$1000</option>
                        </select>
                     </div>
                     <div class="col-md-3 col-12 ps-5">
                        <label for="gender">  Gender</label>
                        <div class="d-flex align-items-end">
                           <div class="form-check">
                                 <input class="form-check-input" type="radio" name="gender" id="male">
                                 <label class="form-check-label" for="male">
                                 Male
                                 </label>
                           </div>
                           <div class="form-check ps-5">
                                 <input class="form-check-input" type="radio" name="gender" id="female" checked>
                                 <label class="form-check-label" for="female">
                                    Female
                                 </label>
                           </div>
                        </div>
                     </div>
               </div>
               <div class="">
                  <button class="btn fs-6 fw-bold mt-2 w-fit next2" type="button" data-step="step2">
                        Next
                  </button>
                  
               </div>
            </div>
            <div class="step" id="step2">
               <h3 class="fs-4 mb-4 lh-sm">
                  PRE-ACCIDENT INCOME
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-2">
                        <label for="pre_job1_title">Job 1</label>
                        <input type="text" name="pre_job1_title" class="form-control fs-6 fw-normal" id="pre_job1_title" placeholder="Job 1" >
                     </div>
                     <div class="col-md-2">
                        <label for="pre_job1_from_date">From Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="pre_job1_from_date" class="form-control fs-6 fw-normal" id="pre_job1_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-2">
                        <label for="pre_job1_to_date">To Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="pre_job1_to_date" class="form-control fs-6 fw-normal" id="pre_job1_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-1 col">
                        <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="pre_job1_4_weeks" id="pre_job1_4_weeks">
                              <label class="form-check-label" for="pre_job1_4_weeks">
                                 Prior 4-weeks
                              </label>
                        </div>
                     </div>
                     <div class="col-md-2 col">
                        <div class="form-check ps-md-5">
                              <input class="form-check-input" type="checkbox" name="pre_job1_52_weeks" id="pre_job1_52_weeks" checked>
                              <label class="form-check-label" for="pre_job1_52_weeks">
                                 Prior 52-weeks
                              </label>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <label for="pre_job1_earning">Gross Earnings</label>
                        <input type="number" name="pre_job1_earning" class="form-control fs-6 fw-normal" id="pre_job1_earning" placeholder="Gross Earnings" >
                     </div>
                     <div class="col-md-1 align-self-end">
                        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPreJob">
                           <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </button>
                     </div>
               </div>
               <div id="pre_accident_form">            
                     
               </div>

                 <!-- Step2 POST-ACCIDENT INCOME -->
               <h3 class="fs-4 mb-4 lh-sm">
                  POST-ACCIDENT INCOME
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-2">
                        <label for="post_job1_title">Job 1</label>
                        <input type="text" name="post_job1_title" class="form-control fs-6 fw-normal" id="post_job1" placeholder="Job 1" >
                     </div>
                     <div class="col-md-2">
                        <label for="post_job1_from_date">From Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_job1_from_date" class="form-control fs-6 fw-normal" id="post_job1_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-2">
                        <label for="post_job1_to_date">To Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_job1_to_date" class="form-control fs-6 fw-normal" id="post_job1_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-2">
                        <label for="post_job1_earning">Gross Earnings</label>
                        <input type="number" name="post_job1_earning" class="form-control fs-6 fw-normal" id="post_job1_earning" placeholder="Gross Earnings" >
                     </div>
                     <div class="col-md-1 align-self-end">
                        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPostJob">
                           <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </button>
                     </div>
               </div>
               <div id="post_accident_form">         
                     
               </div>

                <!-- Step3 Post Form Benfits -->
                <h3 class="fs-4 mb-4 lh-sm">
                  POST-ACCIDENT BENEFITS
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-3">
                        <label for="post_ben1">Post-accident Benefits 1</label>
                        <input type="text" name="post_ben1_title" class="form-control fs-6 fw-normal" id="post_ben1" placeholder="Post-accident Benefits 1" >
                     </div>
                     <div class="col-md-2">
                        <label for="post_ben1_from_date">From Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_ben1_from_date" class="form-control fs-6 fw-normal" id="post_ben1_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-2">
                        <label for="post_ben1_to_date">To Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_ben1_to_date" class="form-control fs-6 fw-normal" id="post_ben1_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-2">
                        <label for="post_ben1_earning">Gross BENEFIT</label>
                        <input type="number" name="post_ben1_earning" class="form-control fs-6 fw-normal" id="post_ben1_earning" placeholder="Gross BENEFIT" >
                     </div>
                     <div class="col-md-1 align-self-end">
                        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPostJobBenifit">
                           <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </button>
                     </div>
               </div>
               <div id="post_job_benifit_form">         
                     
                </div>


               <div class="">
                  <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step1">
                        Previous
                  </button>
                  <button class="btn fs-6 fw-bold mt-2 w-fit next" type="button" data-step="step3">
                        Next
                  </button>
               </div>
            </div>
            <div class="step" id="step3">
                  <!-- Step1 PRE-ACCIDENT INCOME Job1-->
                  <div class="row gx-md-3 gy-4 mb-4">
                        <div class="col-md-12">
                           <h3 class="fs-4 mb-4 lh-sm">PRE-ACCIDENT INCOME Job 1</h3>
                        
                        </div>
                  </div>
                  <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-2">
                        <label for="pre_job1_from_date">From Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="pre_job1_from_date" class="form-control fs-6 fw-normal" id="pre_job1_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-2">
                        <label for="pre_job1_to_date">To Date</label>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="pre_job1_to_date" class="form-control fs-6 fw-normal" id="pre_job1_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-1 col">
                        <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="pre_job1_4_weeks" id="pre_job1_4_weeks">
                              <label class="form-check-label" for="pre_job1_4_weeks">
                                 Prior 4-weeks
                              </label>
                        </div>
                     </div>
                     <div class="col-md-2 col">
                        <div class="form-check ps-md-5">
                              <input class="form-check-input" type="checkbox" name="pre_job1_52_weeks" id="pre_job1_52_weeks" checked>
                              <label class="form-check-label" for="pre_job1_52_weeks">
                                 Prior 52-weeks
                              </label>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <label for="pre_job1_earning">Gross Earnings</label>
                        <input type="number" name="pre_job1_earning" class="form-control fs-6 fw-normal" id="pre_job1_earning" placeholder="Gross Earnings" >
                     </div>
                     <div class="col-md-2">
                        <label for="pre_comment">Special Condition</label>
                        <input type="text" name="pre_comment" class="form-control fs-6 fw-normal" id="pre_comment" placeholder="Special Condition" >
                     </div>
                     <div class="col-md-1 align-self-end">
                        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPreJob">
                           <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </button>
                     </div>
                  </div>
                  
                  <div id="pre_accident_form">            
                     
                  </div>
                   
                  
                  
               
               <div class="">
                  <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                        Previous
                  </button>
                  <button class="btn fs-6 fw-bold mt-2 w-fit next" type="button" data-step="step4">
                        Next
                  </button>
               </div>
            </div>

            <div class="step" id="step4">
                  
                   <!-- Step2 POST-ACCIDENT INCOME -->
                  <div class="row gx-md-3 gy-4 mb-4">
                        <div class="col-md-12">
                           <label for="post_job1_title" class="fs-4 mb-4 lh-sm">POST-ACCIDENT INCOME Job 1</label>
                           <input type="text" name="post_job1_title" class="form-control fs-6 fw-normal" id="post_job1" placeholder="POST-ACCIDENT INCOME Job 1" >
                        </div>
                  </div>
                  <div class="row gx-md-3 gy-4 mb-4">
                        <div class="col-md-2">
                           <label for="post_job1_from_date">From Date</label>
                           <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_job1_from_date" class="form-control fs-6 fw-normal" id="post_job1_from_date" placeholder="From Date">
                        </div>
                        <div class="col-md-2">
                           <label for="post_job1_to_date">To Date</label>
                           <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_job1_to_date" class="form-control fs-6 fw-normal" id="post_job1_to_date" placeholder="To Date">
                        </div>
                        <div class="col-md-2">
                           <label for="post_job1_earning">Gross Earnings</label>
                           <input type="number" name="post_job1_earning" class="form-control fs-6 fw-normal" id="post_job1_earning" placeholder="Gross Earnings" >
                        </div>
                        <div class="col-md-2">
                           <label for="pre_comment">Special Condition</label>
                           <input type="text" name="pre_comment" class="form-control fs-6 fw-normal" id="pre_comment" placeholder="Special Condition" >
                        </div>
                        <div class="col-md-1 align-self-end">
                           <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPostJob">
                              <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                           </button>
                        </div>
                  </div>
                  <div id="post_accident_form">         
                        
                  </div>
                  
                  
               
               <div class="">
                  <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step4">
                        Previous
                  </button>
                  <button class="btn fs-6 fw-bold mt-2 w-fit next" type="button" data-step="step5">
                        Next
                  </button>
               </div>
            </div>

            <div class="step" id="step5">
                  
                  
                 <!-- Step5 Post Form Benfits -->
                 <div class="row gx-md-3 gy-4 mb-4">
                    <div class="col-md-12">
                       <label for="post_ben1" class="fs-4 mb-4 lh-sm">POST-ACCIDENT BENEFITS Post-accident Benefits 1</label>
                       <input type="text" name="post_ben1_title" class="form-control fs-6 fw-normal" id="post_ben1" placeholder="Post-accident Benefits 1" >
                    </div>
                 </div>
                 <div class="row gx-md-3 gy-4 mb-4">
                    <div class="col-md-2">
                       <label for="post_ben1_from_date">From Date</label>
                       <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_ben1_from_date" class="form-control fs-6 fw-normal" id="post_ben1_from_date" placeholder="From Date">
                    </div>
                    <div class="col-md-2">
                       <label for="post_ben1_to_date">To Date</label>
                       <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_ben1_to_date" class="form-control fs-6 fw-normal" id="post_ben1_to_date" placeholder="To Date">
                    </div>
                    <div class="col-md-2">
                       <label for="post_ben1_earning">Gross BENEFIT</label>
                       <input type="number" name="post_ben1_earning" class="form-control fs-6 fw-normal" id="post_ben1_earning" placeholder="Gross BENEFIT" >
                    </div>
                    <div class="col-md-2">
                          <label for="benifit_comment">Special Condition</label>
                          <input type="text" name="benifit_comment" class="form-control fs-6 fw-normal" id="benifit_comment" placeholder="Special Condition" >
                       </div>
                    <div class="col-md-1 align-self-end">
                       <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPostJobBenifit">
                          <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                       </button>
                    </div>
                 </div>
              <div id="post_job_benifit_form">         
                    
               </div>
              
              <div class="">
                 <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step2">
                       Previous
                 </button>
                 <button class="btn fs-6 fw-bold mt-2 w-fit" type="submit">
                       Submit
                 </button>
              </div>
           </div>
            <div class="step" id="step4">
               
               <div class="">
                  <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                        Previous
                  </button>
                  <button class="btn fs-6 fw-bold mt-2 w-fit" type="submit">
                        Next
                  </button>
               </div>
            </div>
         </form>

         <div id="data_data" style="display:none">
           <?php
            print "<pre>";
           // Specify the post ID you want to retrieve
            $post_id = 21; // Replace with the actual post ID

            // Get the post data
            $post = get_post($post_id);

            // Check if the post exists
            if ($post) {
               // Get post meta data
               $benefits = get_post_meta($post_id, 'benefits', true);
               foreach ($benefits as $index => $item) {
               
                  foreach ($item as $key => $value) {
                      echo "  [$key] => $value\n";
                  }
                  echo "\n";
              }
               print_r($benefits);
              
            } else {
               echo 'Post not found';
            }

            ?>
         </div>

      </div>
</div>
</section>


<?php get_footer(); ?>

<script>

jQuery(document).ready(function($) {

$('.next2').click(function () {


  //  $('#step2').addClass('active');
  //  $('#step1').removeClass('active');

  var formData = {
        first_name: $('#first_name').val(),
        last_name: $('#last_name').val(),
        email: $('#email').val(),
        dob: $('#dob').val(),
        age: $('#age').val(),
        date_loss: $('#date_loss').val(),
        age_loss: $('#age_loss').val(),
        calc_date: $('#calc_date').val(),
        age_calc: $('#age_calc').val(),
        insurer: $('#insurer').val(),
        policy_no: $('#policy_no').val(),
        claim_no: $('#claim_no').val(),
        empl_status: $('#empl_status').val(),
        irb_policy: $('#irb_policy').val(),
        gender: $('input[name="gender"]:checked').val()
    };

    // Perform your AJAX call here
    $.ajax({
      url: "<?php echo admin_url('admin-ajax.php'); ?>",
        type: 'POST', // or 'GET' depending on your needs
        data: { 
         action: "save_form_data",
         form_data: formData
         },
        success: function (data) {
            
          $('#step2').addClass('active');
          $('#step1').removeClass('active');
            
        },
        error: function (error) {
            // Handle the AJAX error if needed
            console.error('Error during AJAX call:', error);
        }
    });
});
});



// jQuery(document).ready(function($) {
//     $("#mock_calc").submit(function(e) {      
//       e.preventDefault();     

//         var formData = $("#mock_calc").serialize();
//         $.ajax({
//             type: "post",    
//             url: "<?php echo admin_url('admin-ajax.php'); ?>",
//             data: {
//                 action: "save_form_data",
//                 form_data: formData
//             },
//             success: function(data) {               
//                 console.log(response);  
//                 console.log("12355");               
//                 $('#mock_calc').hide();
//                 $('#data_data').show();
              
//             },
//             error: function(error) {
//                 // Handle error response
//                 console.log(error.responseText);
//             }
//         });
//     });
// });

   </script>
