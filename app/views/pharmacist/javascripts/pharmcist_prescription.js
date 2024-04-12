
function openPopup() {
    document.getElementById('dim-overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}
  
function closePopup() {
document.getElementById('dim-overlay').style.display = 'none';
document.getElementById('popup').style.display = 'none';
}

// $(document).ready(function() {
//     // Attach click event listener to prescription div elements
//     $('.presDiv').on('click', function() {
//         var prescriptionId = $(this).data('prescription-id');
//         // Make AJAX request to fetch prescription details
//         $.ajax({
//             url: '<?php echo URLROOT; ?>/Pharmacist/getPrescriptionDetails',
//             method: 'GET',
//             data: { prescription_id: prescriptionId },
//             success: function(response) {
//                 // Handle the response and display details in the popup
//                 $('#content').html(response);
//             },
//             error: function(xhr, status, error) {
//                 // Handle errors
//                 console.error(error);
//             }
//         });
//     });
// });


