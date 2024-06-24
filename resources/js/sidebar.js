const sidebar = document.getElementById("sidebar");
const sidebarBackdrop = document.getElementById("sidebarBackdrop");
const toggleSidebarMobileHamburger = document.getElementById(
    "toggleSidebarMobileHamburger"
);
const toggleSidebarMobileClose = document.getElementById(
    "toggleSidebarMobileClose"
);
const toggleSidebarMobileEl = document.getElementById("toggleSidebarMobile");
const toggleSidebarMobileSearch = document.getElementById(
    "toggleSidebarMobileSearch"
);

// Function to toggle the sidebar
const toggleSidebarMobile = (
    sidebar,
    sidebarBackdrop,
    toggleSidebarMobileHamburger,
    toggleSidebarMobileClose
) => {
    sidebar.classList.toggle("hidden");
    sidebarBackdrop.classList.toggle("hidden");
    toggleSidebarMobileHamburger.classList.toggle("hidden");
    toggleSidebarMobileClose.classList.toggle("hidden");
};

// Initial check to hide sidebar on mobile
const initialCheck = () => {
    if (window.innerWidth < 768) {
        // Adjust the width as needed for your breakpoint
        sidebar.classList.add("hidden");
        sidebarBackdrop.classList.add("hidden");
        toggleSidebarMobileHamburger.classList.remove("hidden");
        toggleSidebarMobileClose.classList.add("hidden");
    } else {
        sidebar.classList.remove("hidden");
        sidebarBackdrop.classList.add("hidden");
        toggleSidebarMobileHamburger.classList.add("hidden");
        toggleSidebarMobileClose.classList.remove("hidden");
    }
};

// Run the initial check when the script loads
initialCheck();

// Add event listeners to toggle buttons
toggleSidebarMobileEl.addEventListener("click", () => {
    toggleSidebarMobile(
        sidebar,
        sidebarBackdrop,
        toggleSidebarMobileHamburger,
        toggleSidebarMobileClose
    );
});

toggleSidebarMobileSearch.addEventListener("click", () => {
    toggleSidebarMobile(
        sidebar,
        sidebarBackdrop,
        toggleSidebarMobileHamburger,
        toggleSidebarMobileClose
    );
});

sidebarBackdrop.addEventListener("click", () => {
    toggleSidebarMobile(
        sidebar,
        sidebarBackdrop,
        toggleSidebarMobileHamburger,
        toggleSidebarMobileClose
    );
});

// Optional: Add a resize event listener to handle window resize
window.addEventListener("resize", initialCheck);
