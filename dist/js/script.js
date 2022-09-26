"use strict";

var navbar = document.querySelector("nav");
var dropdownNavbar = document.querySelector(".dropdown__navbar");
var dropdownNavbarWrapper = document.querySelector(".dropdown__wrapper__container");
var burgerBtn = document.querySelector(".burger__icon");
window.addEventListener("scroll", function () {
  var topOfPage = window.scrollY;

  if (topOfPage > 100) {
    navbar.classList.add("scrolled-nav");
  } else {
    navbar.classList.remove("scrolled-nav");
  }
});
burgerBtn.addEventListener("click", function () {
  dropdownNavbar.classList.toggle("activated--dropdown");
  dropdownNavbarWrapper.classList.toggle("activated--dropdown--wrapper");
});
dropdownNavbarWrapper.addEventListener("click", function () {
  dropdownNavbar.classList.toggle("activated--dropdown");
  dropdownNavbarWrapper.classList.toggle("activated--dropdown--wrapper");
});