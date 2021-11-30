document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("navbar_top").classList.add("fixed-top");
  // add padding top to show content behind navbar
  navbar_height = document.querySelector("#navbar_top").offsetHeight;
  document.body.style.paddingTop = navbar_height + "px";
});
// DOMContentLoaded  end
