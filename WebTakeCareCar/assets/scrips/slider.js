
    let slideIndex = 1;
showSlide(slideIndex);

function showSlide(n) {
  let slides = document.getElementsByClassName("slide");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.opacity = 0;
  }
  for (let i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.opacity = 1;
  dots[slideIndex - 1].className += " active";
}

function nextSlide(n) {
  showSlide(slideIndex += n);
}

setInterval(function() {
  nextSlide(1);
}, 3000);

