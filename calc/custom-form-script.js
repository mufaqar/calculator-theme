jQuery(document).ready(function ($) {
    var currentStep = 1;
 
    $("#nextBtn").on("click", function () {
       var formData = $("#field_step" + currentStep).val();
 
       $.ajax({
          type: "POST",
          url: ajax_object.ajaxurl,
          data: { action: 'save_step_data', step: currentStep, formData: formData },
          success: function (response) {
             // Handle success if needed
 
             // Move to the next step
             currentStep++;
             showStep(currentStep);
          },
          error: function (error) {
             // Handle errors if needed
          }
       });
    });
 
    $("#prevBtn").on("click", function () {
       // Move to the previous step
       currentStep--;
       showStep(currentStep);
    });
 
    function showStep(step) {
       $(".step").hide();
       $("#step" + step).show();
 
       // Show/hide Previous and Next buttons based on the step
       $("#prevBtn").toggle(step > 1);
       $("#nextBtn").toggle(step < 5); // Adjust the number based on the total steps
    }
 });
 