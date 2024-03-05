<?php
/*
Template Name: Home calc
*/

get_header();

?>
<section>
   <div class="container mx-auto">
         <h2 class="display-6 fw-bold lh-sm text-center">
            Setup your phone
         </h2>
         <p class="text-center">
            We will send you a SMS. Input the code to verify.
         </p>
   </div>
   <div class="container mx-auto col p-md-5 py-5 Step_form">
      <div class="row">
         <form class="mt-5">
            <div class="step active" id="step1">
               <h3 class="fs-4 mb-4 lh-sm">
                  CLAIM DETAILS
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-4 col-12">
                        <label for="first_name">Claimant's First Name</label>
                        <input type="text" name="first_name" class="form-control fs-6 fw-normal" id="first_name" placeholder="First Name" >
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="last_name">Claimant's Last Name</label>
                        <input type="text" name="last_name" class="form-control fs-6 fw-normal" id="last_name" placeholder="Last Name" >
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="gender">Claimant's Gender</label>
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
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-4 col-12">
                        <label for="birthdate">Claimant's Birthdate</label>
                        <input type="date" name="birthdate" class="form-control fs-6 fw-normal" id="birthdate" placeholder="Birth Date">
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="age">Claimant's Age Today</label>
                        <input type="number" name="age" class="form-control fs-6 fw-normal" id="age" placeholder="Age">
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="date_loss">Date of Loss (DOL)</label>
                        <input type="date" name="date_loss" class="form-control fs-6 fw-normal" id="date_loss" placeholder="Date of Loss (DOL)">
                     </div>
               </div>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-4 col-12">
                        <label for="age_loss">Claimant's Age on DOL</label>
                        <input type="number" name="age_loss" class="form-control fs-6 fw-normal" id="age_loss" placeholder="40">
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="calc_date">Calculation Date</label>
                        <input type="date" name="calc_date" class="form-control fs-6 fw-normal" id="calc_date" placeholder="Calculation Date">
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="age_calc">Claimant's Age on Calculation Date</label>
                        <input type="number" name="age_calc" class="form-control fs-6 fw-normal" id="age_calc" placeholder="Claimant's Age on Calculation Date">
                     </div>
               </div>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-4 col-12">
                        <label for="insurer">Insurer</label>
                        <input type="text" name="insurer" class="form-control fs-6 fw-normal" id="insurer" placeholder="Insurer" >
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="policy_no">Policy no</label>
                        <input type="text" name="policy_no" class="form-control fs-6 fw-normal" id="policy_no" placeholder="Policy no" >
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="claim_no">Claim no</label>
                        <input type="text" name="claim_no" class="form-control fs-6 fw-normal" id="claim_no" placeholder="Claim no" >
                     </div>
               </div>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-4 col-12">
                        <label for="employment_status">Employment Status on the DOL</label>
                        <input class="form-control" list="employment" name="employment_status" id="employment_status" placeholder="Employment Status on the DOL">
                        <datalist id="employment">
                           <option value="Employed">
                           <option value="Self employed">
                        </datalist>
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="irb_policy">Max IRB per Policy</label>
                        <input class="form-control" list="irb_policy_list" name="irb_policy" id="irb_policy" placeholder="Max IRB per Policy">
                        <datalist id="irb_policy_list">
                           <option value="$400">
                           <option value="$800">
                           <option value="$1000">
                        </datalist>
                     </div>
               </div>
               <div class="">
                  <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit next" type="button" data-step="step2">
                        Next
                  </button>
               </div>
            </div>
            <div class="step" id="step2">
               <h3 class="fs-4 mb-4 lh-sm">
                  PRE-ACCIDENT INCOME
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-12 col-12">
                        <label for="pre_job1">Job 1</label>
                        <input type="text" name="pre_job1" class="form-control fs-6 fw-normal" id="pre_job1" placeholder="Job 1" >
                     </div>
               </div>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-4 col-12">
                        <label for="pre_from_date">From Date</label>
                        <input type="date" name="pre_from_date" class="form-control fs-6 fw-normal" id="pre_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="pre_to_date">To Date</label>
                        <input type="date" name="pre_to_date" class="form-control fs-6 fw-normal" id="pre_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="pre_prior_weeks">Prior weeks</label>
                        <div class="d-flex align-items-end">
                           <div class="form-check">
                                 <input class="form-check-input" type="radio" name="pre_prior_weeks" id="pre_4_weeks">
                                 <label class="form-check-label" for="pre_4_weeks">
                                    Prior 4-weeks
                                 </label>
                           </div>
                           <div class="form-check ps-5">
                                 <input class="form-check-input" type="radio" name="pre_prior_weeks" id="pre_52_weeks" checked>
                                 <label class="form-check-label" for="pre_52_weeks">
                                    Prior 52-weeks
                                 </label>
                           </div>
                        </div>
                     </div>
               </div>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-4 col-12">
                        <label for="pre_earning">Gross Earnings</label>
                        <input type="number" name="pre_earning" class="form-control fs-6 fw-normal" id="pre_earning" placeholder="Gross Earnings" >
                     </div>
                     <div class="col-md-4 col-12">
                        <label for="pre_number">Gross Earnings</label>
                        <input type="number" name="pre_number" class="form-control fs-6 fw-normal" id="pre_number" placeholder="Gross Earnings" >
                     </div>
                     <div class="col-md-4 col-12 align-self-end">
                        <button class="bg-primary text-white border-0 rounded-0 fs-6 fw-bold mt-2 w-fit" type="button">
                           <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="30px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </button>
                     </div>
               </div>
               <div class="">
                  <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step1">
                        Previous
                  </button>
                  <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit next" type="button" data-step="step3">
                        Next
                  </button>
               </div>
            </div>
            <div class="step" id="step3">
               <h3 class="fs-4 mb-4 lh-sm">
                  POST-ACCIDENT INCOME
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-12 col-12">
                        <label for="post_job1">Job 1</label>
                        <input type="text" name="post_job1" class="form-control fs-6 fw-normal" id="post_job1" placeholder="Job 1" >
                     </div>
               </div>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-3 col-12">
                        <label for="post_from_date">From Date</label>
                        <input type="date" name="post_from_date" class="form-control fs-6 fw-normal" id="post_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="post_to_date">To Date</label>
                        <input type="date" name="post_to_date" class="form-control fs-6 fw-normal" id="post_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="post_earning">Gross Earnings</label>
                        <input type="number" name="post_earning" class="form-control fs-6 fw-normal" id="post_earning" placeholder="Gross Earnings" >
                     </div>
                     <div class="col-md-3 col-12 align-self-end">
                        <button class="bg-primary text-white border-0 rounded-0 fs-6 fw-bold mt-2 w-fit" type="button">
                           <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="30px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </button>
                     </div>
               </div>
               <div class="">
                  <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step2">
                        Previous
                  </button>
                  <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit next" type="button" data-step="step4">
                        Next
                  </button>
               </div>
            </div>
            <div class="step" id="step4">
               <h3 class="fs-4 mb-4 lh-sm">
                  POST-ACCIDENT BENEFITS
               </h3>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-12 col-12">
                        <label for="benifit1">Post-accident Benefits 1</label>
                        <input type="text" name="benifit1" class="form-control fs-6 fw-normal" id="benifit1" placeholder="Post-accident Benefits 1" >
                     </div>
               </div>
               <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-3 col-12">
                        <label for="benift_from_date">From Date</label>
                        <input type="date" name="benift_from_date" class="form-control fs-6 fw-normal" id="benift_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="benifit_to_date">To Date</label>
                        <input type="date" name="benifit_to_date" class="form-control fs-6 fw-normal" id="benifit_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-3 col-12">
                        <label for="benifit_gross">Gross Benefit</label>
                        <input type="number" name="benifit_gross" class="form-control fs-6 fw-normal" id="benifit_gross" placeholder="Gross Earnings" >
                     </div>
                     <div class="col-md-3 col-12 align-self-end">
                        <button class="bg-primary text-white border-0 rounded-0 fs-6 fw-bold mt-2 w-fit" type="button">
                           <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg enable-background="new 0 0 50 50" height="30px" width="30px" id="Layer_1" version="1.1" viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25" y2="25"/><line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9" y2="41"/></svg>
                        </button>
                     </div>
               </div>
               <div class="">
                  <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                        Previous
                  </button>
                  <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit" type="submit">
                        Submit
                  </button>
               </div>
            </div>
         </form>

      </div>
</div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".next").click(function() {
            var currentStep = $(this).closest(".step");
            var nextStep = currentStep.next(".step");
            currentStep.removeClass("active");
            nextStep.addClass("active");
        });

        $(".prev").click(function() {
            var currentStep = $(this).closest(".step");
            var prevStep = currentStep.prev(".step");
            currentStep.removeClass("active");
            prevStep.addClass("active");
        });
    });
</script>



<script>
   var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php get_footer(); ?>
