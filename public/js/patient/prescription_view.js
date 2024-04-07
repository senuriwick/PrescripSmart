
  document.addEventListener("DOMContentLoaded", function () {
    const eyeIcons = document.querySelectorAll('.file img[src*="Eye.png"]');

    eyeIcons.forEach(icon => {
      const prescriptionID = icon.getAttribute('data-container-pid');
      const modal = document.getElementById(`myModal${prescriptionID}`);
      const closeButton = modal.querySelector(".close");

      icon.addEventListener("click", () => {
        modal.style.display = 'block';
      });

      closeButton.addEventListener("click", () => {
        modal.style.display = "none";
      });

      window.addEventListener("click", (event) => {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });
    });
  });