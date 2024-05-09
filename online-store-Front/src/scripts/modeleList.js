/*document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.show-more-button').forEach(function(button) {
        button.addEventListener('click', function () {
            showAllCards(button.id);
        });
    });
});

export function toggleSections(activeSection, buttonclicked, showMoreButtonId) {

    // If already active, do nothing
    if (document.querySelector(`.${activeSection}`).classList.contains('active')) {
        return;
    }

    // Hide all sections
    document.querySelectorAll('.cars-section1, .cars-section2').forEach(section => {
        section.classList.remove('active');
    });

    document.querySelectorAll('.type_button1, .type_button2').forEach(section => {
        section.classList.remove('active');
    });

    // Show the selected section
    document.querySelector(`.${activeSection}`).classList.add('active');
    document.querySelector(`.${buttonclicked}`).classList.add('active');

    // Show all cards when switching sections
    showAllCards(showMoreButtonId);
}*/
