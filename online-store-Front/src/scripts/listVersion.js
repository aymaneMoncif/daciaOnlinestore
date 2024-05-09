//-//----carousel---//-//
$(document).ready(function () {
    $("#carousel3").owlCarousel({
        items: 3,
        loop: true,
        margin: 30,
        nav: true,
        responsive: {
            1440: {
                items: 3
            },
            1024: {
                items: 2
            },
            768: {
                items: 2
            },
            500: {
                items: 1
            },
            0: {
                items: 1
            },   
        }
    });
});
