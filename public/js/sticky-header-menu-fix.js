document.addEventListener("DOMContentLoaded", function () {
    // add padding top to show content behind navbar
    let navbar_height = document.querySelector("#navbar_top").offsetHeight;
    let sticky_element = document.querySelector("#sticky-header-menu");
    // let sticky_pos = sticky_element.getBoundingClientRect();
    let currRem = convertRemToPixels(1) * 1.5; // pt-4

    function convertRemToPixels(rem) {
        return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
    }

    const onScroll = () => {
        // console.log(`navbar_height: ${navbar_height}, sticky_pos.top: ${sticky_pos.top}, window.pageYOffset: ${window.pageYOffset}, currRem ${currRem}`)
        if (window.pageYOffset > navbar_height) {
            sticky_element.style.paddingTop = navbar_height + "px";
        }
        else {
            sticky_element.style.paddingTop = window.pageYOffset + "px";
        }
    };

    window.addEventListener("scroll", onScroll);
});
// DOMContentLoaded  end
