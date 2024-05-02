var fieldCounter = 1;
var postfieldCounter = 1;
var postbenifitCounter = 1;
var predatafieldCounter = 1;
var newfitCounter = 1;

var currentDate = new Date().toISOString().split('T')[0];

jQuery(document).ready(function ($) {
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

//   $('#addPreJob').click(function () {
//     fieldCounter++;
//     var newHTML = "<p>New HTML content</p>";
//     var preaccidentForm = `
//          <div class="row gx-md-3 gy-4">
                     
//                      <div class="col-md-3">
//                         <label for="pre_from_date">From Date </label>
//                         <input type="text" name="pre_job${fieldCounter}_from_date" class="form-control fs-6 fw-normal datepicker" id="pre_job${fieldCounter}_from_date" placeholder="From Date">
//                      </div>
//                      <div class="col-md-3">
//                         <label for="pre_job${fieldCounter}_to_date">To Date</label>
//                         <input type="text" name="pre_job${fieldCounter}_to_date" class="form-control fs-6 fw-normal datepicker" id="pre_job${fieldCounter}_to_date" placeholder="To Date">
//                      </div>
                  
//                      <div class="col-md-3">
//                         <label for="job_entry_${predatafieldCounter}_${newfitCounter}_earning">Gross Earnings</label>
//                         <input type="text" name="job_entry_${predatafieldCounter}_${newfitCounter}_earning" class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_earning"
//                               placeholder="Gross Earnings">
//                      </div>
//                      <div class="col-md-3">
//                         <label for="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment">Special Condition</label>
//                         <input type="text" name="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment" class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment"
//                               placeholder="Special Condition">
//                      </div> 
                    
                    
                     
//                </div>`;
//     $('#pre_accident_form').append(preaccidentForm);
//     $(".add_job").html(newHTML);


//   });
  $('#addPreJob2').click(function () {
   fieldCounter++;
   var preaccidentForm = `
        <div class="row gx-md-3 gy-4 ">                    
                    <div class="col-md-3">
                       <label for="pre_from_date">From Date </label>
                       <input type="text" name="pre_job${fieldCounter}_from_date" class="form-control fs-6 fw-normal datepicker" id="pre_job${fieldCounter}_from_date" placeholder="From Date">
                    </div>
                    <div class="col-md-3">
                       <label for="pre_job${fieldCounter}_to_date">To Date</label>
                       <input type="text" name="pre_job${fieldCounter}_to_date" class="form-control fs-6 fw-normal datepicker" id="pre_job${fieldCounter}_to_date" placeholder="To Date">
                    </div>
                 
                    <div class="col-md-3">
                       <label for="job_entry_${predatafieldCounter}_${newfitCounter}_earning">Gross Earnings</label>
                       <input type="text" name="job_entry_${predatafieldCounter}_${newfitCounter}_earning" class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_earning"
                             placeholder="Gross Earnings">
                    </div>
                    <div class="col-md-3">
                       <label for="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment">Special Condition</label>
                       <input type="text" name="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment" class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment"
                             placeholder="Special Condition">
                    </div> 
                   
                   
                    
              </div>`;
   $('#pre_accident_form').append(preaccidentForm);
 });

  $('#addPostJob').click(function () {
    postfieldCounter++;
    var postaccidentForm = `
    <div class="row gx-md-3 gy-4 mb-4">
                     <div class="col-md-2">
                        <label for="post_job${postfieldCounter}_title">Job ${postfieldCounter}111</label>
                        <input type="text" name="post_job${postfieldCounter}_title" class="form-control fs-6 fw-normal" id="post_job${postfieldCounter}_title" placeholder="Job ${postfieldCounter}" >
                     </div>
                     <div class="col-md-2">
                        <label for="post_job${postfieldCounter}_from_date">From Date</label>
                        <input type="text" name="post_job${postfieldCounter}_from_date" class="form-control fs-6 fw-normal datepicker" id="post_job${postfieldCounter}_from_date" placeholder="From Date">
                     </div>
                     <div class="col-md-2">
                        <label for="post_job${postfieldCounter}_to_date">To Date</label>
                        <input type="text" name="post_job${postfieldCounter}_to_date" class="form-control fs-6 fw-normal datepicker" id="post_job${postfieldCounter}_to_date" placeholder="To Date">
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
       <label for="post_ben${postbenifitCounter}_title">Post-accident Benefits ${postbenifitCounter}</label>
       <input type="text" name="post_ben${postbenifitCounter}_title" class="form-control fs-6 fw-normal" id="post_ben${postbenifitCounter}_title" placeholder="Post-accident Benefits ${postbenifitCounter}" >
    </div>
    <div class="col-md-2">
       <label for="post_ben${postbenifitCounter}_from_date">From Date</label>
       <input type="text" name="post_ben${postbenifitCounter}_from_date" class="form-control fs-6 fw-normal datepicker" id="post_ben${postbenifitCounter}_from_date" placeholder="From Date">
    </div>
    <div class="col-md-2">
       <label for="post_ben${postbenifitCounter}_to_date">To Date</label>
       <input type="text" name="post_ben${postbenifitCounter}_to_date" class="form-control fs-6 fw-normal datepicker" id="post_ben${postbenifitCounter}_to_date" placeholder="To Date">
    </div>
    <div class="col-md-2">
       <label for="post_ben${postbenifitCounter}_earning">Gross BENEFIT</label>
       <input type="number" name="post_ben${postbenifitCounter}_earning" class="form-control fs-6 fw-normal" id="post_ben${postbenifitCounter}_earning" placeholder="Gross BENEFIT" >
    </div>
       
    </div>
`;
    $('#post_job_benifit_form').append(postBenigitForm);
  });

  $('.dynamic-btn').click(function () {
   alert("asdf");
    var predatafieldCounter = $(this).attr('id');
    newfitCounter++;
    var preJobDataForm = `
      <div class="row gx-md-3 gy-4 mb-4">
         <div class="col-md-2">
            <label for="job_entry_${predatafieldCounter}_${newfitCounter}_from_date">From Date ${newfitCounter}</label>
            <input type="text" value="${currentDate}" name="job_entry_${predatafieldCounter}_${newfitCounter}_from_date"
                  class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_from_date" placeholder="From Date">
         </div>
         <div class="col-md-2">
            <label for="job_entry_${predatafieldCounter}_${newfitCounter}_to_date">To Date</label>
            <input type="text" value="${currentDate}" name="job_entry_${predatafieldCounter}_${newfitCounter}_to_date"
                  class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_to_date" placeholder="To Date">
         </div>
         <div class="col-md-1 col">
         <div class="form-check">
               <input class="form-check-input" type="checkbox" name="job_entry_${predatafieldCounter}_${newfitCounter}_4_weeks" id="job_entry_${predatafieldCounter}_${newfitCounter}_4_weeks">
               <label class="form-check-label" for="job_entry_${predatafieldCounter}_${newfitCounter}_4_weeks">
                  Prior 4-weeks
               </label>
         </div>
      </div>
      <div class="col-md-2 col">
         <div class="form-check ps-md-5">
               <input class="form-check-input" type="checkbox" name="job_entry_${predatafieldCounter}_${newfitCounter}_52_weeks" id="job_entry_${predatafieldCounter}_${newfitCounter}_52_weeks" checked>
               <label class="form-check-label" for="job_entry_${predatafieldCounter}_${newfitCounter}_52_weeks">
                  Prior 52-weeks
               </label>
         </div>
      </div>
         <div class="col-md-2">
            <label for="job_entry_${predatafieldCounter}_${newfitCounter}_earning">Gross Earnings</label>
            <input type="number" name="job_entry_${predatafieldCounter}_${newfitCounter}_earning" class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_earning"
                  placeholder="Gross Earnings">
         </div>
         <div class="col-md-2">
            <label for="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment">Special Condition</label>
            <input type="text" name="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment" class="form-control fs-6 fw-normal" id="job_entry_${predatafieldCounter}_${newfitCounter}_pre_comment"
                  placeholder="Special Condition">
         </div>         
      </div>
`;
    $('#showPreJobData' + predatafieldCounter).append(preJobDataForm);
  });
});
