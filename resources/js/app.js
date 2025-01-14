import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// setTimeout для высплывающих окон alert
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        const alertElement = document.getElementById("alert");
        if (alertElement) {
            alertElement.style.display = "none";
        }
    }, 3000);
});

// Модальное окно с увеличением изображения при клике на изображение
const modal = document.querySelector(".modal");
const imgs = document.getElementsByClassName("imageZoom");
const modalImg = document.querySelector(".modal-content");

for (let img of imgs) {
    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
    };
}

const close = document.getElementsByClassName("close")[0];

if (close) {
    close.onclick = function () {
        modal.style.display = "none";
    };
}
