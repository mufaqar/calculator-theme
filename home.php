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
                <form class="" id="mock_user" method="POST">
                    <?php get_template_part('forms/step4');  ?>
                    <hr />
                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit next2" type="button" data-step="step2">
                            Next
                        </button>
                    </div>
                </form>
            </div>


            <div class="step" id="step2">
                <form class="" id="mock_calc" method="POST">
                    <?php get_template_part('forms/step2');  ?>
                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step1">
                            Previous
                        </button>
                        <button class="btn fs-6 fw-bold mt-2 w-fit next3" type="button" data-step="step3">
                            Post Jobs
                        </button>
                    </div>
                </form>
            </div>

            <div class="step" id="step3">
                <form class="" id="post_jobs_data" method="POST">
                    <?php get_template_part('forms/step3');  ?>
                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                            Previous
                        </button>
                        <button class="btn fs-6 fw-bold mt-2 w-fit savePreJobData" type="submit">
                            savePreJobData
                        </button>
                    </div>

                </form>

            </div>

            <div class="step" id="step4">
                <form class="" id="post_jobs_data" method="POST">
                    <?php get_template_part('forms/step4');  ?>

                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                            Previous
                        </button>
                        <button class="btn fs-6 fw-bold mt-2 w-fit ben_job" type="submit">
                            Post Accident Benfits
                        </button>

                    </div>
                </form>
            </div>
            <!-- Bennifit Insert Data  -->
            <div class="step" id="step5">
                <form class="" id="benifit_data" method="POST">
                    <?php get_template_part('forms/step5');  ?>

                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                            Previous
                        </button>
                        <button class="btn fs-6 fw-bold mt-2 w-fit calculation" type="submit">
                            Calculations
                        </button>

                    </div>
                </form>
            </div>

            <!-- Calculation Insert Data  -->

            <div class="step" id="step6">
                <form class="" id="post_jobs_data" method="POST">
                    <?php get_template_part('forms/step6');  ?>

                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step3">
                            Previous
                        </button>


                    </div>
                </form>
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


    $('#addPreJob').click(function() {

        var formData = {
            job_title: $('#pre_job1_title').val()
        };
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: "addJob",
                form_data: formData
            },
            success: function(response) {
                console.log(response);
                var newHTML = response;
                $(".add_prejob").html(newHTML);
                addRow();
                $('.paystub_btn').show();

            },
            error: function(xhr, status, error) {
                // Handle the AJAX error here
            }
        });

    });
    $('#addPostJob').click(function() {

            var formData = {
                job_title: $('#post_job1_title').val()
            };
            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                type: 'POST',
                data: {
                    action: "addJob",
                    form_data: formData
                },
                success: function(response) {
                    console.log(response);
                    var newHTML = response;
                    $(".add_postjob").html(newHTML);
                    addRowPost();
                    $('.paystub_btn').show();

                },
                error: function(xhr, status, error) {
                    // Handle the AJAX error here
                }
            });

    });

    $('#addBenJob').click(function() {
        var formData = {
            job_title: $('#ben_job1_title').val()
        };
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: "addJob",
                form_data: formData
            },
            success: function(response) {
                console.log(response);
                var newHTML = response;
                $(".add_benjob").html(newHTML);
                addRowBen();
                $('.paystub_btn').show();

            },
            error: function(xhr, status, error) {
                // Handle the AJAX error here
            }
        });

    });


    function getFormValues() {
        var formData = [];
        $('.stub').each(function(index) {
            var field1Value = $(this).find('input[name="f_date[]"]').val();
            var field2Value = $(this).find('input[name="t_date[]"]').val();
            var field3Value = $(this).find('input[name="g_earning[]"]').val();
            var field4Value = $(this).find('input[name="sp[]"]').val();
            formData.push({
                from_date: field1Value,
                to_date: field2Value,
                earning: field3Value,
                comt: field4Value
            });
        });
        return formData;
    }

    // Remove row on button click
    $('#pre_accident_form').on('click', '.remove-row', function() {
        $(this).parent('.stub').remove();
        var formData = getFormValues();
        console.log(formData); // Log form data after removing row
    });
    $('#post_accident_form').on('click', '.remove-row', function() {
        $(this).parent('.stub').remove();
        var formData = getFormValues();
        console.log(formData); // Log form data after removing row
    });
    $('#ben_accident_form').on('click', '.remove-row', function() {
        $(this).parent('.stub').remove();
        var formData = getFormValues();
        console.log(formData); // Log form data after removing row
    });

    function addRow() {
        var newRow = '<div class="stub row gx-md-3 gy-4 align-items-center">' +
            '<div class="col-md-3"><label for="pre_from_date">From Date </label><input type="text" name="f_date[]" placeholder="Field 1" class="form-control fs-6 fw-normal datepicker"></div>' +
            '<div class="col-md-3"><label for="pre_from_date">To Date </label><input type="text" name="t_date[]" placeholder="Field 2" class="form-control fs-6 fw-normal datepicker"></div>' +
            '<div class="col-md-3"><label for="pre_from_date">Gross Earnings </label><input type="text" name="g_earning[]" placeholder="Gross Earnings" class="form-control fs-6 fw-normal "></div>' +
            '<div class="col-md-2"><label for="pre_from_date">Special Condition </label><input type="text" name="sp[]" placeholder="Special Condition" class="form-control fs-6 fw-normal "></div>' +
            '<img class="remove-row col-md-1 rm_btn" src="<?php bloginfo('template_directory'); ?>/images/cross.png" width="48" height="48" />' +
            '</div>';
        $('#pre_accident_form').append(newRow);
    }

    function addRowPost() {
        var newRow = '<div class="stub row gx-md-3 gy-4 align-items-center">' +
            '<div class="col-md-3"><label for="post_from_date">From Date </label><input type="text" name="f_date[]" placeholder="Field 1" class="form-control fs-6 fw-normal datepicker"></div>' +
            '<div class="col-md-3"><label for="post_from_date">To Date </label><input type="text" name="t_date[]" placeholder="Field 2" class="form-control fs-6 fw-normal datepicker"></div>' +
            '<div class="col-md-3"><label for="post_from_date">Gross Earnings </label><input type="text" name="g_earning[]" placeholder="Gross Earnings" class="form-control fs-6 fw-normal "></div>' +
            '<div class="col-md-2"><label for="post_from_date">Special Condition </label><input type="text" name="sp[]" placeholder="Special Condition" class="form-control fs-6 fw-normal "></div>' +
            '<img class="remove-row col-md-1 rm_btn" src="<?php bloginfo('template_directory'); ?>/images/cross.png" width="48" height="48" />' +
            '</div>';
        $('#post_accident_form').append(newRow);
    }

    function addRowBen() {
        var newRow = '<div class="stub row gx-md-3 gy-4 align-items-center">' +
            '<div class="col-md-3"><label for="ben_from_date">From Date </label><input type="text" name="f_date[]" placeholder="Field 1" class="form-control fs-6 fw-normal datepicker"></div>' +
            '<div class="col-md-3"><label for="ben_from_date">To Date </label><input type="text" name="t_date[]" placeholder="Field 2" class="form-control fs-6 fw-normal datepicker"></div>' +
            '<div class="col-md-3"><label for="ben_from_date">Gross Earnings </label><input type="text" name="g_earning[]" placeholder="Gross Earnings" class="form-control fs-6 fw-normal "></div>' +
            '<div class="col-md-2"><label for="ben_from_date">Special Condition </label><input type="text" name="sp[]" placeholder="Special Condition" class="form-control fs-6 fw-normal "></div>' +
            '<img class="remove-row col-md-1 rm_btn" src="<?php bloginfo('template_directory'); ?>/images/cross.png" width="48" height="48" />' +
            '</div>';
        $('#ben_accident_form').append(newRow);
    }

    $('#addPreJob2').click(function() {
        addRow();
        var formData = getFormValues();
        console.log(formData);

    });

    $('#addPostJob2').click(function() {
        addRowPost();
        var formData = getFormValues();
        console.log(formData);

    });
    $('#addBenJob2').click(function() {
        addRowBen();
        var formData = getFormValues();
        console.log(formData);

    });




    $('.next3').click(function() {
        var formData = $("#mock_calc").serialize();
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: "save_user_income_data",
                form_data: formData
            },
            success: function(data) {
                $('#step3').addClass('active');
                $('#step2').removeClass('active');
            },
            error: function(error) {
                console.error('Error during AJAX call:', error);
            }
        });
    });

    $('.savePreJobData').click(function(e) {
        var pre_jobs_data = $("#pre_jobs_data").serialize();
        e.preventDefault();
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: "savePreJobData",
                form_data: pre_jobs_data
            },
            success: function(data) {
                $('#step4').addClass('active');
                $('#step3').removeClass('active');
            },
            error: function(error) {
                console.error('Error during AJAX call:', error);
            }
        });
    });

    $('.ben_job').click(function(e) {
        var pre_jobs_data = $("#post_jobs_data").serialize();
        e.preventDefault();
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: "savePreJobData",
                form_data: pre_jobs_data
            },
            success: function(data) {
                $('#step5').addClass('active');
                $('#step4').removeClass('active');
            },
            error: function(error) {
                console.error('Error during AJAX call:', error);
            }
        });
    });

    $('.calculation').click(function(e) {

        var benifit_data = $("#benifit_data").serialize();
        e.preventDefault();
        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: "calculation",
                form_data: benifit_data
            },
            success: function(data) {
                $('#step6').addClass('active');
                $('#step5').removeClass('active');
            },
            error: function(error) {
                console.error('Error during AJAX call:', error);
            }
        });
    });

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



// jQuery(document).ready(function($) {
//     $("#mock_calc").submit(function(e) {      
//       e.preventDefault();     

//         var formData = $("#mock_calc").serialize();
//         $.ajax({
//             type: "post",    
//             url: "<?php echo admin_url('admin-ajax.php'); ?>",
//             data: {
//                 action: "save_form_user_data",
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