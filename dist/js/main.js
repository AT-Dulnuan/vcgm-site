// Animation on Scroll
AOS.init();

// Modal
const modal = document.querySelector(".modal-video");
const modalContent = document.querySelector(".modal-content");
const video = document.querySelector(".video");
const body = document.getElementsByTagName("body")[0];

function openModal(link) {
    video.setAttribute("src", link);
    modal.classList.add("show-modal");
    body.classList.add("stop-scroll");
}

function closeModal() {
    modal.classList.remove("show-modal");
    body.classList.remove("stop-scroll");
}

window.onclick = function (event) {
    if (event.target == modalContent) {
        this.closeModal();
    }
}

// Mobile Menu
const navMobile = document.querySelector(".mobile-menu");
const burgerBtn = document.getElementById("open-menu");

burgerBtn.addEventListener("click", toggleMenu)

function toggleMenu() {
    navMobile.classList.toggle("open");
    burgerBtn.classList.toggle("open");
    body.classList.toggle("stop-scroll");
}

// function openMenu() {
//     navMobile.classList.add("open");
//     openBtn.classList.add("open");
//     body.classList.add("stop-scroll");
// }

// function closeMenu() {
//     navMobile.classList.remove("open");
// }

$(document).ready(function () {
    $('.img-slider').slick({
        autoplay: true,
        arrows: false,
        dots: true,
        pauseOnHover: false
    });
});