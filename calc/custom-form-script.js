jQuery(document).ready(function ($) {
    var currentStep = 1;
 
    $("#nextBtn").on("click", function () {
       var formData = $("#field_step" + currentStep).val();
 
       $.ajax({
          type: "POST",
          url: ajax_object.ajaxurl,
          data: { action: 'save_step_data', step: currentStep, formData: formData },
          success: function (response) {
             currentStep++;
             showStep(currentStep);
          },
          error: function (error) {
          }
       });
    });
 
    $("#prevBtn").on("click", function () {
       currentStep--;
       showStep(currentStep);
    });
 
    function showStep(step) {
       $(".step").hide();
       $("#step" + step).show();
       $("#prevBtn").toggle(step > 1);
       $("#nextBtn").toggle(step < 5); 
    }
 });
 