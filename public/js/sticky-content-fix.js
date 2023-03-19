document.addEventListener("DOMContentLoaded", function () {
    // add padding top to show content behind navbar
    let navbar_height = document.querySelector("#navbar_top").offsetHeight;
    let sticky_element = document.querySelector("#sticky-fix");
    let first_container = document.querySelector("body > .container");
    let currRem = convertRemToPixels(1) * 1.5; // pt-4
    sticky_element.style.zIndex = "0";

    function convertRemToPixels(rem) {
        return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
    }
    function onScrollCallback(event) {
        // console.log({
        //     'sticky_element.offsetHeight+(currRem*2)': sticky_element.offsetHeight+(currRem*2),
        //     'first_container.offsetHeight': first_container.offsetHeight
        // });
        if (sticky_element.offsetHeight+(currRem*2) >= first_container.offsetHeight)
            return;
        if (window.scrollY > navbar_height + currRem)
            sticky_element.style.paddingTop = navbar_height + currRem + "px";
        else sticky_element.style.paddingTop = window.scrollY + "px";
    }

    let window_height = window.innerHeight;
    window.addEventListener("resize", (event) => {
        window_height = window.innerHeight;
        window.removeEventListener("scroll", onScrollCallback);
        window.addEventListener("scroll", onScrollCallback);
    });
    window.addEventListener("scroll", onScrollCallback);
});
