// Animation on Scroll
AOS.init();

// Modal
const modal = document.querySelector(".modal-video");
const modalContent = document.querySelector(".modal-content");
const video = document.querySelector(".video");
const body = document.getElementsByTagName("body")[0];
var videoSrc = "";

function openModal(link) {
    videoSrc = link;
    video.setAttribute("src", videoSrc);
    modal.classList.add("show-modal");
    body.classList.add("stop-scroll");
}

function closeModal() {
    modal.classList.remove("show-modal");
    body.classList.remove("stop-scroll");
    video.setAttribute("src", "");
}

function videoOpen(link) {
    body.classList.add("is-clipped");
    document.getElementById("videoModal").classList.add("is-active");
    video.setAttribute("src", link);
}

window.onclick = function (event) {
    if (event.target == modalContent) {
        this.closeModal();
    }
}

$(document).ready(function () {
    $('.img-slider').slick({
        autoplay: true,
        arrows: false,
        dots: true,
        pauseOnHover: false
    });

    const curDate = new Date();
    console.log(curDate);
    // if (curDate.getDay() === 5 && curDate.getHours() === 10 && curDate.getMinutes === 30) {

    // }
});

function openMenu() {
    const headerText = document.querySelector(".header-text");
    const navLinks = document.querySelector(".nav-links");
    const menuBurger = document.getElementById("menuBurger");
    const nav = document.getElementsByTagName("nav")[0];

    body.classList.toggle('stop-scroll');
    headerText.classList.toggle('hide-header');
    navLinks.classList.toggle('nav-active');
    menuBurger.classList.toggle('open');
    nav.classList.toggle('menuNavBG');
}

function openChat() {
    const chat = document.querySelector(".live-chat").classList.toggle("open");
}



