// header on scroll background
const header = document.querySelector("#header");
const resMenu = document.querySelector(".nav-links");

AOS.init();

window.addEventListener('scroll', () => {
  if (window.pageYOffset > 60) {
    header.classList.add('shadow');
  } else {
    header.classList.remove('shadow');
  }
})

// toggle responsive menu
const navToggler = document.querySelector(".nav-toggler");
const toggleIcon = document.querySelector(".nav-toggler i");
const backdrop = document.querySelector(".backdrop-filter");

navToggler.addEventListener('click', () => {
  toggleIcon.classList.toggle('bx-x');
  resMenu.classList.toggle('show');
  backdrop.classList.toggle('show');
})

backdrop.addEventListener('click', () => {
  toggleIcon.classList.remove('bx-x');
  resMenu.classList.remove('show');
  backdrop.classList.remove('show');
})
