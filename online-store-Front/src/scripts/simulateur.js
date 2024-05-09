//const calculbtn = document.getElementById('calculbtn');
//const page1 = document.getElementById('page1');
//const page2 = document.getElementById('page2');
//let page = page2;
//let globalToken; 
//let RenaultModels;
//let findMyVersion;
//let clientID;


/* Step 1: Get hashed password from the first API
fetch('https://rci-bo.orcaformation.com/api/getHashedPwd?mdp=Y3Zpi5mC3', {
    method: 'POST',
})
.then(response => {
    if (!response.ok) {
        throw new Error('Failed to fetch hashed password');
    }
    return response.json();
})
.then(hashedPassword => {
    // Step 2: Use the hashed password in the second API to get the token
    return fetch(`https://rci-bo.orcaformation.com/api/getToken?login=promor&mdp=${hashedPassword}&version=web`, {
        method: 'POST',
    });
})
.then(response => {
    if (!response.ok) {
        throw new Error('Failed to fetch token');
    }
    return response.json();
})
.then(tokenData => {
    globalToken = tokenData.token;
    // Call the get info API
    return fetch(`https://rci-bo.orcaformation.com/api/getInfos`, {
        method: 'POST',
        headers: {
            Authorization: `Bearer ${globalToken}`,
        },
    });
})
.then(response => {
    if (!response.ok) {
        throw new Error('Failed to get info');
    }
    return response.json();
})
.catch(error => {
    console.error('Error:', error.message);
});*/




/*function callSimulateurLogicAPI(periode, apport, versionId, prixRemise, clientId) {
    fetch('https://rci-bo.orcaformation.com/api/getSimulationsLogiqueBox', {
        method: 'POST', 
        headers: {
            Authorization: `Bearer ${globalToken}`, 
            'Content-Type': 'application/x-www-form-urlencoded', 
        },
        body: new URLSearchParams({ 
            periode: periode,
            apport: apport,
            versionId: versionId,
            prixRemise: prixRemise,
            clientId: clientId,
            typeSimulationId: 5,
            sourceId: 8
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('failed to get simulations logique box');
        }
        return response.json();
    })
    .then(simulationData => {
        console.log(simulationData.result);
    })
    .catch(error => {
        console.error('Error:', error.message);
    });
}*/

$(document).ready(function () {
    var carousel = $("#carouselDuree");
    
    carousel.owlCarousel({
        items: 5,
        loop: false,
        margin: 0,
        nav: true,
        responsive: {
            1440: {
                items: 3
            },
            1024: {
                items: 3
            },
            768: {
                items: 3
            },
            500: {
                items: 3
            },
            425: {
                items: 2
            },
            320: {
                items: 2
            },
        }
    });
    
    carousel.find('.item').click(function () {
        carousel.find('.item').removeClass('agile__slide--active');
        $(this).addClass('agile__slide--active');
            
        var index = parseInt($(this).attr('id'));
        if(index !== 1 && index !== 5){
            carousel.trigger('to.owl.carousel', [index, 500]);
            // Scroll to the clicked item to the center of the carousel
            carousel.trigger('scrollTo.owl.carousel', [index, 400, true]);
        }
    });
        
});

    
    
/*calculbtn.addEventListener('click', function(){
    const ApportInput = document.getElementById('rangeInputID');
    const DureeInputs = document.querySelectorAll('input[name="duree"]');

    let selectedDuree = null;
    DureeInputs.forEach(input=>{
        if(input.checked){
            selectedDuree = input;
        }
    })

    console.log(" AportInputs: ", selectedDuree.value);

    callSimulateurLogicAPI(
        selectedDuree.value,
        ApportInput.value,
        findMyVersion.VersionId,
        findMyVersion.PrixRemise,
        clientID
    );
})*/






 





