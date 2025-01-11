import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

setTimeout(function () {
    document.getElementById("alert").style.display = "none";
}, 3000);

// Get the modal
const modal = document.getElementById("Modal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
const img = document.getElementById("imageZoom");
const modalImg = document.getElementById("img01");
img.onclick = function () {
    modal.style.display = "block";
    modalImg.src = this.src;
};

// Get the <span> element that closes the modal
const close = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
close.onclick = function () {
    modal.style.display = "none";
};
