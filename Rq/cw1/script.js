
let card = document.querySelector(".card");
let description = document.querySelector(".card-body ");
let cardFooter = document.querySelector(".card-footer");
cardFooter.style.cursor = "pointer";
cardFooter.addEventListener("click", function () {
    window.location.href = "https://www.example.com";
  
});
