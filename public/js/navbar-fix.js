document.addEventListener("DOMContentLoaded", function () {
    // document.getElementById("navbar_top").classList.add("fixed-top");
    document.getElementById("navbar_top").classList.add("sticky-top");
    document.getElementById("navbar_top").classList.add("bg-white");

    // let navbar_height = document.querySelector("#navbar_top").offsetHeight;
    // let currRem = convertRemToPixels(1) * 1.5; // pt-4
    // let first_container = document.querySelector("body > .container");
    // if (first_container) first_container.style.paddingTop = navbar_height + "px";
    //
    // function convertRemToPixels(rem) {
    //   return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
    // }

    // add padding top to show content behind navbar
    // navbar_height = document.querySelector("#navbar_top").offsetHeight;
    // document.body.style.paddingTop = navbar_height + "px";
});
// DOMContentLoaded  end
