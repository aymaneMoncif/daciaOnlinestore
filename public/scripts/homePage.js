//-//--------------------carousel Pourquoi renault occasion--------------------//-//
$(document).ready(function () {
    $("#carousel5").owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        responsive: {
            768: {
                items: 4, 
            },
            500: {
                items: 3, 
            },
            425: {
                items: 2, 
            },
            375: {
                items: 2,
            },
            320: {
                items: 1, 
            },
            
        },
    });




    $("#carousel6").owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        responsive: {
            768: {
                items: 4, 
            },
            500: {
                items: 3, 
            },
            425: {
                items: 2, 
            },
            375: {
                items: 2,
            },
            320: {
                items: 2, 
            },
            
        },
    });
});

//---------------------- questions part script -------------------------//
$(document).ready(function () {
    // Event for when a collapse is shown or hidden
    $(document).on('show.bs.collapse hide.bs.collapse', '.collapse', function () {
        var card = $(this).closest('.card');
        var isCollapsed = $(this).hasClass('show');

        card.find('.card-header').toggleClass('bg-black', !isCollapsed).toggleClass('bg-white', isCollapsed);
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



function validateForm() {
    // Get password and confirmation password input fields
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('Confpassword').value;

    // Check if password and confirmation password match
    if (password !== confirmPassword) {
        alert("Password and confirmation password do not match");
        return false; // Prevent form submission
    }

    // If all validations pass, return true to allow form submission
    return true;
}


function ValidateCMD() {
    // Get password and confirmation password input fields
    const hidepop = document.getElementById('StepsContent');
    const showpop = document.getElementById('validateCMD');

    hidepop.style.display = 'none';
    showpop.style.display = 'flex';
    
}

//file inputs managment
function updateFileName(input) {
    var fileName = input.files[0].name;
    var fileNameSpan = input.parentElement.nextElementSibling;
    fileNameSpan.textContent = fileName;
}

/*show the wqit message after insert aport
function stepWaitValidateCMD(){
    const bankName = document.getElementById('nomBanque');
    const numberTransaction = document.getElementById('numTransaction');
    const imageRecu = document.getElementById('imagerecu');

    if(bankName.value && numberTransaction.value && imageRecu.value){
        
    }
}*/



