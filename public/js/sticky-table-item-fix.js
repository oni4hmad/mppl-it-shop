document.addEventListener("DOMContentLoaded", function () {
    // add padding top to show content behind navbar
    // let navbar_height = document.querySelector("#navbar_top").offsetHeight;
    let header_menu = document.querySelector("#sticky-header-menu");
    // let header_menu_height = document.querySelector("#sticky-header-menu").offsetHeight;
    let sticky_elements = document.querySelectorAll(".--sticky-table-item");
    let currRem = convertRemToPixels(1); // pt-3

    function convertRemToPixels(rem) {
        return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
    }

    const onScroll = () => {
        sticky_elements.forEach(s_element => {
            let header_bottom = header_menu.getBoundingClientRect().bottom;
            let s_top = s_element.getBoundingClientRect().top;
            if (s_top < header_bottom) {
                let temp = s_element.parentElement.parentElement.offsetHeight;
                let paddingBefore = parseInt(s_element.style.paddingTop, 10);
                s_element.style.paddingTop = header_bottom - s_top + currRem + "px";
                if (temp < s_element.parentElement.parentElement.offsetHeight) {
                    s_element.style.paddingTop = paddingBefore + "px";
                }
            }
            else {
                s_element.style.paddingTop = "0px";
            }
        });
    };

    window.addEventListener("scroll", onScroll);
});
// DOMContentLoaded  end
