<script>
    $(document).ready(function () {
        function updateInstructorPercentage() {
            var adminPercentage = parseFloat($('#admin_percentage').val()) || 0;
            var gatewayPercentage = parseFloat($('#gateway_percentage').val()) || 0;
            var instructorPercentage = Math.max(0, 100 - adminPercentage - gatewayPercentage);

            $('#instructor_percentage').val(instructorPercentage.toFixed(2) + '%');
        }

        $('#admin_percentage, #gateway_percentage').on('input', updateInstructorPercentage);
        updateInstructorPercentage();
    });
</script>
