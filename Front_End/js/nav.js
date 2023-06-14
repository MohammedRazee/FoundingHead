const hamburger = document.querySelector(".menu-hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
});

const dropMenu = document.querySelector(".merch-menu");
const dropper = document.querySelector(".merch-dropdown");

dropper.addEventListener("click", () => {
    dropMenu.classList.toggle("active");
});