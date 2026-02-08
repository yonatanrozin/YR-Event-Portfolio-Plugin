let carousel = document.querySelector(".wp-block-yr-featured-items-carousel");
let scrollInterval = carousel.dataset.scrollInterval || 10000;
let items = carousel.querySelector("section");
function next(e) {
    items.scrollBy({left: 1, behavior: "smooth"});
}
function prev(e) {
    items.scrollBy({left: -1, behavior: "smooth"});
}

let carouselScrollInterval;
function startInterval() {
    stopInterval();
    carouselScrollInterval = window.setInterval(next, scrollInterval);
}
function stopInterval() {
    window.clearInterval(carouselScrollInterval);
}
carousel.querySelector(".next").addEventListener("click", next);
carousel.querySelector(".prev").addEventListener("click", prev);
carousel.addEventListener("pointerenter", startInterval);
carousel.addEventListener("pointerleave", stopInterval);
startInterval();