<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php wp_footer(); ?>

<script>

$(function() {
    $("body").on("click", ".datepicker", function() {
        $(this).datepicker({
            uiLibrary: 'bootstrap5',
            dateFormat: 'M-dd-yy',
            changeYear: true,
            yearRange: '1970:+nn',
            onSelect: function(dateText, inst) {
                // Do something when a date is selected
            }
        });
        $(this).datepicker("show");
    });
});
</script>



</body>

</html>
