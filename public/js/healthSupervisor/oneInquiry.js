// Get the modal

var modal = document.getElementById("replyModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
document.getElementById("reply").onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Send button functionality
document.getElementById("sendButton").onclick = function() {
  var replyText = document.getElementById("replyText").value;
  // Perform actions to send email with the reply text here
  console.log(replyText);
  // Close modal after sending email
  modal.style.display = "none";
}
