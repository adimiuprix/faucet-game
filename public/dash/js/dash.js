const sideMenu = document.querySelector("#menu"); // side menu
const menuToggler = document.querySelector(".menu-toggle-btn:not(.lg)") || document.querySelector("#hideshow"); // hamburger icon
const menuTogglerLg = document.querySelector(".menu-toggle-btn.lg") || document.querySelector("#hideshow-lg"); // hamburger icon for large device
const sidebarCloseBtn = document.querySelector("#sidebar-close"); // close button inside sidebar
const overlay = document.querySelector(".responsive-overlay"); // responsive overlay

function isMobileView() {
  return window.innerWidth < 768;
}

function openMobileSidebar() {
  if (sideMenu) {
    sideMenu.classList.remove("hide");
  }
  if (overlay) {
    overlay.classList.add("show");
  }
}

function closeMobileSidebar() {
  if (sideMenu) {
    sideMenu.classList.add("hide");
  }
  if (overlay) {
    overlay.classList.remove("show");
  }
}

function toggleMobileSidebar() {
  if (!sideMenu) return;
  if (sideMenu.classList.contains("hide")) {
    openMobileSidebar();
  } else {
    closeMobileSidebar();
  }
}

// Large device toggle
if (menuTogglerLg) {
  menuTogglerLg.addEventListener("click", (e) => {
    e.preventDefault();
    if (sideMenu) {
      sideMenu.classList.toggle("hide-lg");
    }
  });
}

// Mobile hamburger toggle
if (menuToggler) {
  menuToggler.addEventListener("click", (e) => {
    e.preventDefault();
    toggleMobileSidebar();
  });
}

// Sidebar close button (inside sidebar header on mobile)
if (sidebarCloseBtn) {
  sidebarCloseBtn.addEventListener("click", (e) => {
    e.preventDefault();
    closeMobileSidebar();
  });
}

// Overlay click to close
if (overlay) {
  overlay.addEventListener("click", () => {
    closeMobileSidebar();
  });
}

// Ensure proper initial state and sync on resize
function handleSidebarResponsive() {
  if (!sideMenu) return;
  if (isMobileView()) {
    sideMenu.classList.add("hide");
    if (overlay) {
      overlay.classList.remove("show");
    }
  } else {
    sideMenu.classList.remove("hide");
    if (overlay) {
      overlay.classList.remove("show");
    }
  }
}

// Initialize on load
handleSidebarResponsive();

// Auto adjust on resize
window.addEventListener("resize", handleSidebarResponsive);

function initActiveMenu() {
  // === following js will activate the menu in left side bar based on url ====
  $(".insideScroll a").each(function () {
    var pageUrl = window.location.href.split(/[?#]/)[0];
    if (this.href == pageUrl) {
      $(this).addClass("active");
      $(this).parent().addClass("mm-active"); // add active to li of the current link
      $(this).parent().parent().addClass("mm-show");
      $(this).parent().parent().prev().addClass("mm-active"); // add active class to an anchor
      $(this).parent().parent().parent().addClass("mm-active");
      $(this).parent().parent().parent().parent().addClass("mm-show"); // add active to li of the current link
      $(this)
        .parent()
        .parent()
        .parent()
        .parent()
        .parent()
        .addClass("mm-active");
    }
  });
}

initActiveMenu();

// dark mode
let lightMode = localStorage.getItem('lightMode');

const logoLight = document.querySelector('.logo-light');
const logoDark = document.querySelector('.logo-dark');
const darkModeToggle = document.querySelector('.theme-toggler');
const themeIcon = document.querySelector('.theme-toggler i');

const enableLightMode = () => {
  // Show light logo, hide dark logo
  if (logoLight) logoLight.style.display = 'block';
  if (logoDark) logoDark.style.display = 'none';
  
  document.documentElement.setAttribute("data-theme", "light");
  document.body.classList.add('light-mode');
  document.body.classList.remove('dark-mode');
  
  if (themeIcon) themeIcon.classList.replace('fa-moon', 'fa-sun');
  localStorage.setItem('lightMode', 'enabled');
}

const disableLightMode = () => {
  // Show dark logo, hide light logo
  if (logoLight) logoLight.style.display = 'none';
  if (logoDark) logoDark.style.display = 'block';
  
  localStorage.setItem('lightMode', null);
  document.body.classList.add('dark-mode');
  document.body.classList.remove('light-mode');
  
  if (themeIcon) themeIcon.classList.replace('fa-sun', 'fa-moon');
  document.documentElement.setAttribute("data-theme", "");
}

if (lightMode === 'enabled') {
  enableLightMode();
}

if (darkModeToggle) {
  darkModeToggle.addEventListener('click', () => {
    lightMode = localStorage.getItem('lightMode');

    if (lightMode !== 'enabled') {
      enableLightMode();
    } else {
      disableLightMode();
    }
  });
};

// copy referral
function copyRefer() {
  const copyTxt = document.querySelector("#refer-link");
  const copyBtn = document.querySelector(".refer-copy-btn");

  copyBtn.addEventListener('click', () => {
    navigator.clipboard.writeText(copyTxt.value);
    console.log("FIRED");

    Swal.fire(
      'Copied',
      '',
      'success'
    );
  })
}

if (window.location.href.includes("referral")) {
  copyRefer();
}

// custom tab
const tabBtn = document.querySelectorAll(".tab-toggler");
const tabContent = document.querySelectorAll(".tab-container");

tabBtn.forEach(btn => {
  btn.addEventListener("click", () => {
    let target = btn.getAttribute("data-target");

    tabContent.forEach(tab => {
      tab.classList.remove("active");
    })

    document.querySelector(`#tab-${target}`).classList.add("active");
  })
})


// jquery for toggle sub menu 2

$(document).ready(function () {
  $(".sub-btn-two").click(function () {
    $(this).next(".sub-menu-two").slideToggle();
    $(this).find(".dropdown").toggleClass("rotate");
  });
});