const navbar = document.querySelector("nav");
const dropdownNavbar = document.querySelector(".dropdown__navbar");
const dropdownNavbarWrapper = document.querySelector(".dropdown__wrapper__container");
const burgerBtn = document.querySelector(".burger__icon");

window.addEventListener("scroll", () => {
    const topOfPage = window.scrollY;

    if(topOfPage > 100) {
        navbar.classList.add("scrolled-nav");
    }

    else {
        navbar.classList.remove("scrolled-nav");
    }
});


burgerBtn.addEventListener("click", () => {
    dropdownNavbar.classList.toggle("activated--dropdown");
    dropdownNavbarWrapper.classList.toggle("activated--dropdown--wrapper");
})

dropdownNavbarWrapper.addEventListener("click", () => {
    dropdownNavbar.classList.toggle("activated--dropdown");
    dropdownNavbarWrapper.classList.toggle("activated--dropdown--wrapper");
})



