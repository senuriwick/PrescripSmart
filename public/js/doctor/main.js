function show(icon) {
    // Find the data-target attribute from the clicked icon to target the corresponding content
    var contentId = icon.getAttribute('data-target');
    var content = document.getElementById(contentId);

    // Find the button element within the same row
    var presBtn = icon.closest('tr').querySelector('button');

    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
        // presBtn.style.backgroundColor = "green";
        // presBtn.style.width = "15vw";
        // presBtn.innerHTML = "View Medical History";
        icon.classList.remove("fa-solid", "fa-chevron-down");
        icon.classList.add("fa-solid", "fa-chevron-up");
    } else {
        content.style.display = "none";
        presBtn.style.backgroundColor = "rgba(0, 105, 255, 1)";
        presBtn.style.width = "12vw";
        presBtn.innerHTML = "Add Prescription";
        icon.classList.remove("fa-solid", "fa-chevron-up");
        icon.classList.add("fa-solid", "fa-chevron-down");
    }
}

