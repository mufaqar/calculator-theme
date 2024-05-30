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
            <div class="step active" id="step1">
            <?php get_template_part('forms/prejobs');  ?>
                <!-- <form class="" id="mock_user" method="POST">
                   
                </form> -->

                <hr />
                <div class="">
                    <button class="btn fs-6 fw-bold mt-2 w-fit next2" type="button" data-step="step2">
                        Next
                    </button>
                </div>

            </div>

            <div class="step" id="step2">
                <?php //get_template_part('forms/prejobs');  ?>
                <div class="">
                    <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step1">
                        Previous
                    </button>
                    <button class="btn fs-6 fw-bold mt-2 w-fit next3" type="button" data-step="step3">
                        Post Jobs
                    </button>
                </div>

            </div>

            <div class="step" id="step3">
                <?php //get_template_part('forms/postjobs');  ?>
                <div class="">
                    <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                        Previous
                    </button>

                    <button class="btn fs-6 fw-bold mt-2 w-fit next4" type="button" data-step="step4">
                        Jobs Benfits
                    </button>
                </div>


            </div>

            <div class="step" id="step4">
               
                    <?php get_template_part('forms/jobben');  ?>

                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step4">
                            Previous
                        </button>
                        <button class="btn fs-6 fw-bold mt-2 w-fit next5" type="button" data-step="step5">
                        Calculation
                    </button>

                    </div>
               
            </div>
            <!-- Bennifit Insert Data  -->
            <div class="step" id="step5">
             
                    <?php get_template_part('forms/step6');  ?>

                    <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step4">
                            Previous
                        </button>
                       
            </div>

        </div>
    </div>
</section>


<?php get_footer(); ?>

<script>
jQuery(document).ready(function($) {
    $(document).ready(function() {
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap5',
            dateFormat: 'M-dd-yy',
            changeYear: true,
            yearRange: '1970:+nn',
            onSelect: function(dateText, inst) {
                // Do something when a date is selected
            }
        });
    });


    $('#email').blur(function() {
        var userData;
        var email = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "check_user_data",
                email: email
            },
            success: function(data) {
                if (data) {
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#dob').val(data.dob);
                    $('#age').val(data.age);
                    $('#dol').val(data.dol);
                    $('#age_loss').val(data.age_loss);
                    $('#calc_date').val(data.calc_date);
                    $('#age_calc').val(data.age_calc);
                    $('#insurer').val(data.insurer);
                    $('#policy_no').val(data.policy_no);
                    $('#claim_no').val(data.claim_no);
                    $('#empl_status').val(data.empl_status);
                    $('#irb_policy').val(data.irb_policy);
                    $('#gender').val(data.gender);
                }
            }
        });
    });


    $('#dob').blur(function() {

        var dob = $(this).val();
        var dobDate = new Date(dob);
        var today = new Date();
        var age = today.getFullYear() - dobDate.getFullYear();
        if (today.getMonth() < dobDate.getMonth() || (today.getMonth() === dobDate.getMonth() && today
                .getDate() < dobDate.getDate())) {
            age--;
        }

        $('#age').val(age);
    });

    $('#dol').blur(function() {

        var dol = $(this).val();
        var dob = $("#dob").val();

        var lossDate = new Date(dol);
        var birthDate = new Date(dob);
        var ageDifference = lossDate.getFullYear() - birthDate.getFullYear();
        var m = lossDate.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && lossDate.getDate() < birthDate.getDate())) {
            ageDifference--;
        }
        $('#age_loss').val(ageDifference);
    });

    $('#calc_date').blur(function() {

        var dol = $(this).val();
        var dob = $("#dob").val();

        var lossDate = new Date(dol);
        var birthDate = new Date(dob);
        var ageDifference = lossDate.getFullYear() - birthDate.getFullYear();
        var m = lossDate.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && lossDate.getDate() < birthDate.getDate())) {
            ageDifference--;
        }

        $('#age_calc').val(ageDifference);
    });





    $('.next2').click(function(event) {
        event.preventDefault();
        // Perform validation
        if (isValid()) {

            var formData = {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                dob: $('#dob').val(),
                age: $('#age').val(),
                dol: $('#dol').val(),
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

            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                type: 'POST',
                data: {
                    action: "save_form_user_data",
                    form_data: formData
                },
                success: function(data) {

                    //  $('#user_id').val(data.email);
                    $('#step2').addClass('active');
                    $('#step1').removeClass('active');
                },
                error: function(error) {
                    console.error('Error during AJAX call:', error);
                }
            });
        } else {
            // If validation fails, show an error message or take other actions
            alert('Please fill out the required fields.');
        }

    });

    $('.next3').click(function(event) {

        $('#step3').addClass('active');
        $('#step2').removeClass('active');


    })

    $('.next4').click(function(event) {

        $('#step4').addClass('active');
        $('#step3').removeClass('active');


    })

    $('.next5').click(function(event) {

$('#step5').addClass('active');
$('#step4').removeClass('active');


})

    function isValid() {
        var isValid = true;
        $('.required-field').each(function() {
            var inputValue = $(this).val().trim();
            if (inputValue === '') {
                isValid = false;
                return false;
            }
        });
        return isValid;
    }


});
</script>