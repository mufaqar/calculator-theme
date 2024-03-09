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
            <form class="" id="mock_user" method="POST">
                <div class="step active" id="step1">
                    <?php get_template_part('forms/step1');  ?>
                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit next2" type="button" data-step="step2">
                            Next
                        </button>
                    </div>
                </div>
            </form>


            <div class="step" id="step2">
                <form class="" id="mock_calc" method="POST">
                    <?php get_template_part('forms/step2');  ?>

                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step1">
                            Previous
                        </button>
                        <button class="btn fs-6 fw-bold mt-2 w-fit next3" type="button" data-step="step3">
                            Next
                        </button>
                    </div>
                </form>
            </div>

            <div class="step" id="step3">
                <form class="" id="mock_calc" method="POST">
                    <?php get_template_part('forms/step3');  ?>

                    <div class="">
                        <button class="btn fs-6 fw-bold mt-2 w-fit prev" type="button" data-step="step2">
                            Previous
                        </button>
                        <button class="btn fs-6 fw-bold mt-2 w-fit next4" type="button" data-step="step4">
                            Next
                        </button>
                    </div>
                </form>
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
                    $('#date_loss').val(data.date_loss);
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



    $('.next2').click(function() {
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

        $.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: 'POST',
            data: {
                action: "save_form_user_data",
                form_data: formData
            },
            success: function(data) {
                $('#step2').addClass('active');
                $('#step1').removeClass('active');
            },
            error: function(error) {
                console.error('Error during AJAX call:', error);
            }
        });
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