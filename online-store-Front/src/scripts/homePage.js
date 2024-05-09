//---------------------- questions part script -------------------------//
$(document).ready(function () {
    // Event for when a collapse is shown or hidden
    $(document).on('show.bs.collapse hide.bs.collapse', '.collapse', function () {
        var card = $(this).closest('.card');
        var isCollapsed = $(this).hasClass('show');

        card.find('.card-header1').toggleClass('bg-black', !isCollapsed).toggleClass('bg-white', isCollapsed);
    });
});

//-//---------------------- How to -------------------------//-//
document.addEventListener('DOMContentLoaded', function () {
    var accordionItems = document.querySelectorAll('.accordion__item');

    accordionItems.forEach(function (item) {
        item.addEventListener('click', function () {
            accordionItems.forEach(function (otherItem) {
                otherItem.classList.remove('show');
            });
            this.classList.add('show');
        });
    });
});