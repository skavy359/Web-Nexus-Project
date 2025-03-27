const setupDropdown = (dropdownId, contentId) => {
    const details = document.getElementById(dropdownId);
    const content = document.getElementById(contentId);

    details.addEventListener("click", (event) => {
        event.preventDefault(); // Prevent default toggle behavior
        
        if (!details.open) {
            content.style.maxHeight = content.scrollHeight + "px";
            setTimeout(() => details.setAttribute("open", ""), 0); // Open after animation
        } else {
            content.style.maxHeight = "0px";
            setTimeout(() => details.removeAttribute("open"), 300); // Close after animation
        }
    });
};

// Setup all dropdowns
setupDropdown("dropdown1", "content1");
setupDropdown("dropdown2", "content2");
setupDropdown("dropdown3", "content3");