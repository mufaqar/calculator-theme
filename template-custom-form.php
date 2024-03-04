<?php
/*
Template Name: Custom Form Template
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
               Step 1
            </h3>
            <div class="row gx-md-4 gy-4 mb-4">
                  <div class="col-md-6 col-12">
                     <label for="start_date" class="d-none">Date</label>
                     <input type="date" name="start_date" class="form-control fs-6 fw-normal" id="start_date" placeholder="From Date*" required>
                  </div>
                  <div class="col-md-6 col-12">
                     <label for="end_date" class="d-none">Date</label>
                     <input type="date" name="end_date" class="form-control fs-6 fw-normal" id="end_date" placeholder="To Date*" required>
                  </div>
            </div>
            <div class="row gx-md-4 gy-4 mb-4">
                  <div class="col-md-6 col-12">
                     <label for="firts_weeks" class="d-none">Date</label>
                     <input type="text" name="firts_weeks" class="form-control fs-6 fw-normal" id="firts_weeks" placeholder="Prior 4-weeks">
                  </div>
                  <div class="col-md-6 col-12">
                     <label for="second_weeks" class="d-none">Date</label>
                     <input type="text" name="second_weeks" class="form-control fs-6 fw-normal" id="second_weeks" placeholder="Prior 52-weeks">
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
               Step 2
            </h3>
            <div class="row gx-md-4 gy-4 mb-4">
                  <div class="col-md-12 col-12">
                     <label for="earnings" class="d-none">Date</label>
                     <input type="text" name="earnings" class="form-control fs-6 fw-normal" id="earnings" placeholder="Gross Earnings">
                  </div>
            </div>
            <div class="row gx-md-4 gy-4 mb-4">
                  <div class="col-md-6 col-12">
                     <label for="date" class="d-none">Date</label>
                     <input type="date" name="date" class="form-control fs-6 fw-normal" id="date" placeholder="Date" required>
                  </div>
                  <div class="col-md-6 col-12">
                     <label for="number" class="d-none">Date</label>
                     <input type="tel" name="number" class="form-control fs-6 fw-normal" id="number" placeholder="Number" required>
                  </div>
            </div>
            <div class="">
            <button class="btn rounded-0 fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step1">
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
            
            // Check if any required fields in the current step are empty
            var requiredInputs = currentStep.find('input[required], textarea[required]');
            var isValid = true;
            requiredInputs.each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).addClass('is-invalid'); // Add class to indicate invalid input
                    $(this).siblings('.invalid-feedback').remove(); // Remove any previous error messages
                    $(this).after('<div class="invalid-feedback">This field is required.</div>'); // Add error message
                } else {
                    $(this).removeClass('is-invalid'); // Remove class if input is valid
                    $(this).siblings('.invalid-feedback').remove(); // Remove error message if input is valid
                }
            });

            // If all required fields are filled, proceed to the next step
            if (isValid) {
                currentStep.removeClass("active");
                nextStep.addClass("active");
            }
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
