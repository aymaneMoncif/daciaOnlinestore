var menuBurger1 = document.getElementById("menuBurger1");
var MobileMenu1 = document.getElementById("MobileMenu1");

var closeMenu1 = document.getElementById("closeMenu1");

var carListVP = document.getElementById("carListVP");
var megaMenuVP = document.getElementById("megaMenuVP");
var megaMenuVPMobile = document.getElementById("megaMenuVPMobile");


closeMenu1.addEventListener("click", function() {
    // Check the screen width
    var screenWidth = window.innerWidth;

    // Toggle the class based on screen width
    if (screenWidth < 921) {
        MobileMenu1.classList.toggle("show_m_menu");
    }
});


menuBurger1.addEventListener("click", function() {
    // Check the screen width
    var screenWidth = window.innerWidth;

    // Toggle the class based on screen width
    if (screenWidth < 921) {
        MobileMenu1.classList.toggle("show_m_menu");
    }
});
carListVP.addEventListener("click", function(event) {
    // Check the screen width
    var screenWidth = window.innerWidth;

    // Toggle the class based on screen width
    if (screenWidth > 921) {
        megaMenuVP.classList.toggle("show-menu");
    } else {
        megaMenuVPMobile.classList.toggle("show-menu2");
        carListVP.classList.toggle("liOpen");
    }

    // Add event listener to close the menu if clicked outside
    document.body.addEventListener("click", closeMenuOnClickOutsideVP);
    event.stopPropagation(); // Prevent immediate propagation to avoid closing immediately

});

function closeMenuOnClickOutsideVP(event) {
    // Check if the clicked element is outside of megaMenuVP
    if (!megaMenuVP.contains(event.target)) {
        megaMenuVP.classList.remove("show-menu");
        document.body.removeEventListener("click", closeMenuOnClickOutsideVP);
    }

}

//  Accordion
document.addEventListener('DOMContentLoaded', function () {
    const footerCards = document.querySelectorAll('.footer_m_block');
    footerCards.forEach(footerCard => {
        const [title, content, icon] = [footerCard.querySelector('.f_section_m_title'), footerCard.querySelector('.q_content'), footerCard.querySelector('span')];

        title.addEventListener('click', () => {
            footerCards.forEach(otherQuestion => {
                if (otherQuestion !== footerCard) {
                    const otherTitle = otherQuestion.querySelector('.f_section_m_title');
                    const otherContent = otherQuestion.querySelector('.q_content');
                    const otherIcon = otherQuestion.querySelector('span');

                    otherContent.classList.remove('show');
                    otherTitle.style.borderBottom = 'var(--white) solid 1px';  // Corrected line
                    otherIcon.textContent = '>';
                    otherIcon.style.color = 'var(--white)';
                    otherIcon.style.transition = 'all 0.1s';
                }
            });

            content.classList.toggle('show');
            const isMaxHeightZero = window.getComputedStyle(content).maxHeight === '0px';
            title.style.borderBottom = !isMaxHeightZero ? 'var(--yellow) solid 1px' : 'var(--white) solid 1px';  // Corrected line
            icon.textContent = !isMaxHeightZero ? '<' : '>';
            icon.style.color = 'var(--yellow)';
            icon.style.transition = 'all 0.1s';
        });
    });
});


//-------------------------------------------------------------------->>
//------------------ menu transition in the scroll -------------------//
//-------------------------------------------------------------------->>
document.addEventListener("DOMContentLoaded", function () {
    var navContainer = document.querySelector('.header_container');
    var left_logo = document.querySelector('.header_left');
    var right_logo = document.querySelector('.right_logo_img');

    var isScrollingDown = false;
    var logo = document.querySelector('.left_logo');

    window.addEventListener('scroll', function () {
        var scrollTop = window.scrollY;

        if (scrollTop > 110 && !isScrollingDown) {

            left_logo.classList.add('InScroll');
            right_logo.src = "/menuCars/M.png";
            right_logo.style.width = "52px";
            right_logo.classList.add('M');

            navContainer.classList.add('fixed');

            isScrollingDown = true;

            logo.classList.add('logoInScroll');


        } else if (scrollTop <= 110 && isScrollingDown) {

            left_logo.classList.remove('InScroll');
            right_logo.src = "menuCars/m-automotiv.png";
            right_logo.style.width = "100%";
            right_logo.classList.remove('M');

            navContainer.classList.remove('fixed');

            isScrollingDown = false;

            logo.classList.remove('logoInScroll');


        }
    });
});



