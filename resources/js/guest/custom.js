$(document).ready(function () {
    $("img.lazy").lazyload();
    $('div.lazy').lazyload();
});
$('.hart-icon').on('click', function () {
    $(this).toggleClass('fas');
});
$('.operators-slider.owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    nav: false,
    center: true,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: false,
    smartSpeed: 1500,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 3
        }
    }
});
window.applyTelephoneMask = function (inputId){ 
    document.getElementById(inputId).addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
}