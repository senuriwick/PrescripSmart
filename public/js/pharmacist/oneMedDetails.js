$(document).ready(function () {
    // Attach click event to the "Mark as Out of Stock" button
    $("#outOfStock").click(function (e) {
        e.preventDefault();

        // Make an AJAX request
        $.ajax({
            type: "POST",
            url: "out_of_stock.php", // Replace with the actual server-side script URL
            data: {
                id: "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>", // Add other necessary data
            },
            success: function (response) {
                // Update the UI or handle the response from the server
                console.log(response);
                // For example, you can reload the page after successful update
                location.reload();
            },
            error: function (error) {
                console.error("Error:", error);
            }
        });
    });
});