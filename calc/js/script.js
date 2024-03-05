var fieldCounter = 1;
var postfieldCounter = 1;
var postbenifitCounter = 1;

jQuery(document).ready(function ($) {
  $('[data-provide="datepicker"]').datepicker({
    format: 'yyyy-mm-dd', // Set your desired date format
    autoclose: true,
  });
  $('.next').click(function () {
    var currentStep = $(this).closest('.step');
    var nextStep = currentStep.next('.step');
    currentStep.removeClass('active');
    nextStep.addClass('active');
  });

  $('.prev').click(function () {
    var currentStep = $(this).closest('.step');
    var prevStep = currentStep.prev('.step');
    currentStep.removeClass('active');
    prevStep.addClass('active');
  });


  $('#addPreJob').click(function () {
    fieldCounter++;
    var preaccidentForm = `
         <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-2">
                        <label for="pre_job${fieldCounter}_title">Job ${fieldCounter}</label>
                        <input type="text" name="pre_job${fieldCounter}_title" class="form-control fs-6 fw-normal" id="pre_job${fieldCounter}_title" placeholder="Job ${fieldCounter}" >
                     </div>
                     <div class="col-md-2">
                        <label for="pre_from_date">From Date</label>
                        <input type="date" name="pre_job${fieldCounter}_from_date" class="form-control fs-6 fw-normal" id="pre_job${fieldCounter}_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-2">
                        <label for="pre_job${fieldCounter}_to_date">To Date</label>
                        <input type="date" name="pre_job${fieldCounter}_to_date" class="form-control fs-6 fw-normal" id="pre_job${fieldCounter}_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-1 col">
                        <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="pre_job${fieldCounter}_4_weeks" id="pre_job${fieldCounter}_4_weeks">
                              <label class="form-check-label" for="pre_job${fieldCounter}_4_weeks">
                                 Prior 4-weeks
                              </label>
                        </div>
                     </div>
                     <div class="col-md-2 col">
                        <div class="form-check ps-md-5">
                              <input class="form-check-input" type="checkbox" name="pre_job${fieldCounter}_52_weeks" id="pre_job${fieldCounter}_52_weeks" checked>
                              <label class="form-check-label" for="pre_job${fieldCounter}_52_weeks">
                                 Prior 52-weeks
                              </label>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <label for="pre_job${fieldCounter}_earning">Gross Earnings</label>
                        <input type="number" name="pre_job${fieldCounter}_earning" class="form-control fs-6 fw-normal" id="pre_job${fieldCounter}_earning" placeholder="Gross Earnings" >
                     </div>
                     
               </div>`;
    $('#pre_accident_form').append(preaccidentForm);
  });

  $('#addPostJob').click(function () {
    postfieldCounter++;
    var postaccidentForm = `
    <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-2">
                        <label for="post_job${postfieldCounter}_title">Job ${postfieldCounter}</label>
                        <input type="text" name="post_job${postfieldCounter}_title" class="form-control fs-6 fw-normal" id="post_job${postfieldCounter}" placeholder="Job ${postfieldCounter}" >
                     </div>
                     <div class="col-md-2">
                        <label for="post_job${postfieldCounter}_from_date">From Date</label>
                        <input type="date" name="post_job${postfieldCounter}_from_date" class="form-control fs-6 fw-normal" id="post_job${postfieldCounter}_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-2">
                        <label for="post_job${postfieldCounter}_to_date">To Date</label>
                        <input type="date" name="post_job${postfieldCounter}_to_date" class="form-control fs-6 fw-normal" id="post_job${postfieldCounter}_to_date" placeholder="To Date">
                     </div>
                     <div class="col-md-2">
                        <label for="post_job${postfieldCounter}_earning">Gross Earnings</label>
                        <input type="number" name="post_job${postfieldCounter}_earning" class="form-control fs-6 fw-normal" id="post_job${postfieldCounter}_earning" placeholder="Gross Earnings" >
                     </div>
                     
               </div>
`;
    $('#post_accident_form').append(postaccidentForm);
  });

  $('#addPostJobBenifit').click(function () {
    postbenifitCounter++;
    var postBenigitForm = `
    <div class="row gx-md-3 gy-4 mb-4">
    <div class="col-md-3">
       <label for="post_ben${postbenifitCounter}">Post-accident Benefits ${postbenifitCounter}</label>
       <input type="text" name="post_ben${postbenifitCounter}_title" class="form-control fs-6 fw-normal" id="post_ben${postbenifitCounter}" placeholder="Post-accident Benefits ${postbenifitCounter}" >
    </div>
    <div class="col-md-2">
       <label for="post_ben${postbenifitCounter}_from_date">From Date</label>
       <input type="date" name="post_ben${postbenifitCounter}_from_date" class="form-control fs-6 fw-normal" id="post_ben${postbenifitCounter}_from_date" placeholder="From Date">
    </div>
    <div class="col-md-2">
       <label for="post_ben${postbenifitCounter}_to_date">To Date</label>
       <input type="date" name="post_ben${postbenifitCounter}_to_date" class="form-control fs-6 fw-normal" id="post_ben${postbenifitCounter}_to_date" placeholder="To Date">
    </div>
    <div class="col-md-2">
       <label for="post_ben${postbenifitCounter}_earning">Gross BENEFIT</label>
       <input type="number" name="post_ben${postbenifitCounter}_earning" class="form-control fs-6 fw-normal" id="post_ben${postbenifitCounter}_earning" placeholder="Gross BENEFIT" >
    </div>
       
    </div>
`;
    $('#post_job_benifit_form').append(postBenigitForm);
  });
});


