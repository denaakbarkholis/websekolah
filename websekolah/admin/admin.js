$(document).on("click", ".sidebar ul li", function () {
  $(this).addClass("active").siblings().removeClass("active");
});

let btnMenu = document.querySelector("#btn-menu");
let sidebar = document.querySelector(".sidebar");
let content = document.querySelector("#content");

btnMenu.onclick = function () {
  sidebar.classList.toggle("active");
  btnMenu.classList.toggle("active");
  content.classList.toggle("active");
};
