// Retrieve the creation date from the data attribute
const creationDateString = document.getElementById("creationDate").dataset.creation;

// Convert the creation date string to a JavaScript Date object
const creationDate = new Date(creationDateString);

// Function to update the elapsed time
function updateElapsedTime() {
    const currentTime = new Date();
    const elapsedTime = currentTime - creationDate;

    const seconds = Math.floor((elapsedTime / 1000) % 60);
    const minutes = Math.floor((elapsedTime / (1000 * 60)) % 60);
    const hours = Math.floor((elapsedTime / (1000 * 60 * 60)) % 24);
    const days = Math.floor(elapsedTime / (1000 * 60 * 60 * 24));

    // Update the HTML elements with the elapsed time
    document.getElementById("days").innerText = days.toString().padStart(2, '0');
    document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
    document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
    document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');

    document.getElementById("daysM").innerText = days.toString().padStart(2, '0');
    document.getElementById("hoursM").innerText = hours.toString().padStart(2, '0');
    document.getElementById("minutesM").innerText = minutes.toString().padStart(2, '0');
    document.getElementById("secondsM").innerText = seconds.toString().padStart(2, '0');

    // Check if comptableValidation is 1 and stop counting if true
    if (comptableValidation === 1) {
        clearInterval(interval);
    }
}


// Update the elapsed time every second
const interval = setInterval(updateElapsedTime, 1000);

// Initial update
updateElapsedTime();




//----loader-----\\
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const form1 = document.getElementById('virementContent');
    const loader = document.getElementById('loader');

    form.addEventListener('submit', function() {
        loader.style.display = 'block';
        form.style.display = 'none';
    });
    form1.addEventListener('submit', function() {
        loader.style.display = 'block';
        form1.style.display = 'none';
    });
});



// -------signature logic-----------------------------------------------
var modal = document.getElementById("myModal");

// Get the close button element inside the modal
if(modal){
    var closeBtn = modal.querySelector(".close");
}
// When the user clicks on the close button, close the modal
if(closeBtn){
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }
}
// Function to open the modal
function openModal() {
    modal.style.display = "block";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var telechargerBtn = document.getElementById('telechargerBtn');
if(telechargerBtn){
    telechargerBtn.addEventListener('click', function() {
        // Show the loader when the button is clicked
        document.querySelector('.loader').style.display = 'inline-block';

        // Hide the loader after 60 seconds
        setTimeout(function() {
            document.querySelector('.loader').style.display = 'none';
        }, 7000);
    });
}
// -------signature logic ENDS-----------------------------------------------


// ------- payer en ligne ---------------------------------------------------
$('#payer').click(function(){
    //récupération des éléments de la commande
    var nomprenom =$('#nomprenom').val();
    var idcommande=$('#idcommande').val();
    var montant=$('#montant').val();
    var email =$('#email').val();
    var langue =$('#langue').val();
    var successURL =$('#successURL').val();
    var recallURL =$('#recallURL').val();

    var failURL =$('#failURL').val();
    var timeoutURL =$('#timeoutURL').val();
    var tel =$('#tel').val();
    var address=$('#address').val();
    var city=$('#city').val();
    var state =$('#state').val();
    var postcode =$('#postcode').val();
    var clepub =$('#clepub').val();
    var cmr =$('#cmr').val();
    var gal =$('#gal').val();
    var detailoperation =$('#detailoperation').val();

    var  mxgateway= new MXGateway(cmr, gal,clepub,langue);

    //cryptage trame 1
    var encrypteddata1=mxgateway.cryptageTrame1(nomprenom, idcommande, montant, email,detailoperation);
    //Cryptage trame 2
    var encrypteddata2=mxgateway.cryptageTrame2(successURL, timeoutURL);
    //cryptage trame 3
    var encrypteddata3=mxgateway.cryptageTrame3(failURL, recallURL);
    //cryptage trame 4
    var encrypteddata4=mxgateway.cryptageTrame4(tel, address, city, state, "MA", postcode);

    //génération lien de paiement
    var lien_gateway =mxgateway.generateLien(encrypteddata1, encrypteddata2,encrypteddata3,encrypteddata4);

    // redirection vers la page de paiement
    if (nomprenom=="" || idcommande=="" || montant=="0" || montant=="" || montant=="0.00"  || montant=="0.0"  || gal=="" || successURL=="" || clepub=="" || cmr=="" || gal=="" )
    {
        $('#chmpoblg').show();
    }else{
        $('#chmpoblg').hide();
        window.top.location.href = lien_gateway;
    }
});


// ------- switc between card and virement ---------------------------------------
const card = document.getElementById('card');
const virement = document.getElementById('virement');
const cardContent = document.getElementById('cardPContent');
const virementContent = document.getElementById('virementContent');

card.addEventListener('click', function(){
    cardContent.style.display = 'block';
    virementContent.style.display = 'none';

    card.classList.add('active');
    virement.classList.remove('active');
});

virement.addEventListener('click', function(){
    virementContent.style.display = 'block';
    cardContent.style.display = 'none';

    virement.classList.add('active');
    card.classList.remove('active');
});
