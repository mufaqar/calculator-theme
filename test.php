<?php
/*
Template Name: Testing
*/
get_header();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dynamic Form</title>
<?php wp_head(); ?>
</head>
<body>

<div id="form-container">
    <form id="my-form">
        <input type="text" name="job_title" placeholder="Job Title">
        <button type="button" id="save-job" data-nonce="<?php echo wp_create_nonce('save_form_data_nonce'); ?>">Save Job</button>
        <div id="saved-job-title"></div>
    </form>
</div>

<button id="add-row">Add Row</button>

<div id="saved-data">
    <!-- Saved form data will be displayed here -->
</div>

<?php wp_footer(); ?>
<script>
jQuery(document).ready(function($) {
    // Function to add multiple rows with specified number
    function addRows(numRows) {
        for (var i = 0; i < numRows; i++) {
            var newRow = '<div class="row">' +
                            '<input type="text" name="field1[]" placeholder="Field 1">' +
                            '<input type="text" name="field2[]" placeholder="Field 2">' +
                            '<input type="text" name="field3[]" placeholder="Field 3">' +
                            '<button type="button" class="remove-row">Remove</button>' +
                        '</div>';
            $('#form-container').append(newRow);
        }
    }

    // Hide "Add Row" button initially
    $('#add-row').hide();

    // Function to handle saving job
    function saveJob() {
        var jobTitle = $('input[name="job_title"]').val().trim();
        if (jobTitle === '') {
            alert('Please enter a job title.');
            return;
        }
        // Hide job title input and save job button
        $('input[name="job_title"]').hide();
        $('#save-job').hide();
        // Display saved job title
        $('#saved-job-title').text(jobTitle);
        // Show "Add Row" button
        $('#add-row').show();
        // Show the initial row
        addRows(12);
    }

    // Event delegation for dynamically added elements
    $('#form-container').on('click', '#save-job', saveJob);
    $('#form-container').on('click', '#add-row', function() {
        addRows(3); // Change the number of rows to add as needed
    });
    $('#form-container').on('click', '.remove-row', function() {
        $(this).parent('.row').remove();
    });
    
    // Save and display form data via AJAX
    $('#submit-form').click(function(){
        $.ajax({
            type: 'POST',
            url: 'process.php', // Replace with your processing script
            data: $('#my-form').serialize(),
            success: function(response){
                // Clear the form
                $('#form-container').empty();
                // Display saved form data
                $('#saved-data').html(response);
            },
            error: function(){
                alert('Error submitting form!');
            }
        });
    });
});
</script>
</body>
</html>
