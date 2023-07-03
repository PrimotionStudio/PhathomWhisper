if (localStorage.getItem("theme") == "light") {
    document.body.setAttribute("data-layout-mode", "light");
} else if (localStorage.getItem("theme") == "dark") {
    document.body.setAttribute("data-layout-mode", "dark");
} else {
    localStorage.getItem("theme") == "light";
}

!function(e) {
    "use strict";
    var o, t;
    e(".dropdown-menu a.dropdown-toggle").on("click", function(t) {
        return e(this).next().hasClass("show") || e(this).parents(".dropdown-menu").first().find(".show").removeClass("show"),
        e(this).next(".dropdown-menu").toggleClass("show"),
        !1
    }),
    [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(t) {
        return new bootstrap.Tooltip(t)
    }),
    [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function(t) {
        return new bootstrap.Popover(t)
    }),
    o = document.getElementsByTagName("body")[0],
    (t = document.querySelectorAll(".light-dark-mode")) && t.length && t.forEach(function(t) {
        t.addEventListener("click", function(t) {
            o.hasAttribute("data-layout-mode") && "dark" == o.getAttribute("data-layout-mode") ? setlight() : setdark()
        })
    }),
    Waves.init()
}(jQuery);

function setlight() {
    document.body.setAttribute("data-layout-mode", "light");
    localStorage.setItem("theme", "light")
}

function setdark() {
    document.body.setAttribute("data-layout-mode", "dark");
    localStorage.setItem("theme", "dark")
}