@php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    //echo $actual_link."<br/>";
    if(strpos($actual_link, "validationCommande")==true){
        $liensuccess=str_replace('validationCommande', 'successURL', $actual_link);
        $lienrecall=str_replace('validationCommande', 'recall.php', $actual_link);
        $failurl=str_replace('validationCommande', 'failURL.php', $actual_link);
    }
@endphp

@extends('layout')

@section('headScript')
    <script type="text/javascript" src="{{asset('scripts/api/tramegatewaynapsv4.js')}}"></script>
    <script type="text/javascript" src="{{asset('scripts/api/jsencrypt.js')}}"></script>
@stop

@section('popUp')
<!-------------------------------------------------------->
<div class="overlay"></div>
<div class="popUp_commandeValid">
    <div class="close">
        <a href="/">X</a>
    </div>

    <div class="lineButtons">
        <div class="etapsContainer">
            <button class="etapBTN active">1. Validation de la commande</button>
            @if(1 == $comptableValidation && $simulateur)
                <a href="{{ route('sendInfoDA') }}" class="etapBTN">2. Dossier d'achat</a>
            @elseif($simulateur)
                <button class="etapBTN inactive">2. Dossier d'achat</button>
            @endif
            @if($done || !$simulateur)
                <a href="{{ route('sendInfoPaiement') }}" class="etapBTN">3. Paiement</a>
            @else
            <button class="etapBTN inactive">3. Paiement</button>
            @endif

            <button class="etapBTN inactive">4. Livraison</button>
        </div>
    </div>

@if($commandeID && $isExpired == null)
    <div id="creationDate" data-creation="{{ $commandeCreationDate }}"></div>

    <div class="content">

        <div class="leftSide">
            <div class="time">
                <div class="timeItem">
                    <p id="days">04</p><p class="text">Jours</p>
                </div> :
                <div class="timeItem">
                    <p id="hours">22</p><p class="text">Heures</p>
                </div> :
                <div class="timeItem">
                    <p id="minutes">30</p><p class="text">Minutes</p>
                </div> :
                <div class="timeItem">
                    <p id="seconds">48</p><p class="text">Seconds</p>
                </div>
            </div>

            <div class="miniCarCard">
                <p class="title">Votre {{$version?->nomversion}} est prête.</p>
                <div class="carImage">
                    <img src="{{ asset('storage/' . $version?->image) }}" alt="">
                </div>
                <p class="sous-title-card">*Images non contractuelles</p>
            </div>

            <div class="details">
                @if($simulateur)
                    <p>Mensualité : <span class="Prix">{{$simulateur->mensualite}} TTC/MOIS**</span></p>
                    <p>Durée : <span class="Duree">{{$simulateur->durree}} Mois</span></p>
                    <p>Apport : <span class="Apport">{{$simulateur->apport}} %</span></p>
                    <hr>
                @endif

                <p class="miniTitle">Pack &amp; équipements</p>
                @if($equipements)
                    @foreach ($equipements as $equipement)
                        <p>{{$equipement->nomequipement}}</p>
                    @endforeach
                @endif
            </div>

            <p class="SousReserve">**Sous réserve d'acceptation du dossier crédit par RCI Finance Maroc</p>

        </div>

        @if(session('success'))
            <div class="alert show">
                <div class="three-body">
                    <div class="three-body__dot"></div>
                    <div class="three-body__dot"></div>
                    <div class="three-body__dot"></div>
                </div>
                {{ session('success') }}
            </div>
        @endif

        @if(!$apport)
            <div class="rightSide">
                <div class="rightSideContent">
                    <div class="CMDvalidation">
                        <p class="title">Validation de la commande</p>
                        <p class="Main_sous-title">
                            Afin de valider votre commande et réserver votre véhicule, merci d'effectuer un
                            virement / versement bancaire d'un montant de 1 000DHS* au compte bancaire suivant :
                        </p>
                    </div>

                    <div class="miniDetailsCard">
                        <p>Titulaire du compte : <span>MOROCCO AUTOMOTIVE RETAIL</span></p>
                        <p>Nom de banque : <span>CRÉDIT DU MAROC</span></p>
                        <p>RIB : <span>021 780 0000 027030093441 89</span></p>
                    </div>

                    <div class="typeVirement_cont">

                        <div class="typeVirement">
                            <p class="type active">VIREMENT / VERSEMENT</p>
                            <p class="type">PAIEMENT PAR CARTE</p>
                        </div>
                        <p class="Main_sous-title">
                            Une fois effectué, vous êtes sollicités à remplir les
                            champs demandés ci-dessous pour continuer votre achat.
                        </p>

                        <!--/*  loader */-->
                        <div class="dot-spinner" id="loader" style="display: none">
                            <div class="dot-spinner__dot"></div>
                            <div class="dot-spinner__dot"></div>
                            <div class="dot-spinner__dot"></div>
                            <div class="dot-spinner__dot"></div>
                            <div class="dot-spinner__dot"></div>
                            <div class="dot-spinner__dot"></div>
                            <div class="dot-spinner__dot"></div>
                            <div class="dot-spinner__dot"></div>
                        </div>
                        <!--/*  loader */-->




                        <div data-repeater-list="" style="display: none">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>ID commerçant *&nbsp;&nbsp;&nbsp;:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="cmr" value="1010101">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label style="margin-left: 30px">ID Galerie *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control"  id="gal" value="9999">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div data-repeater-list="" style="display: none">
                            <form>
                                <label>Clé publique * :</label>
                                <textarea class="form-control" id="clepub">MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAh2q4viqQwzVWCKT1KRPvsiixEoNm8dg95gE7h4OUVuERp9csLKYHM9I9EaQ/SUYwgBBLHOslpe5qbvX3x1oAcksO5BT8SYHmtbgUpH1yZjcU1lI2/M3qyRUb03NQaF6vgxCOLGlLpDQqdg0jxl4ySDYu3bcMQto6J2eRAnIPIZkC/h4GQMwhBheFEHf7uMCqj8uNkNf5yU1Js9/Yj8FGbS1fSYwQ1ZQ7Jr94eUhCuTgjFKYUxD18QIPgYEnYbir4mKagtnF8fv3S1+COsVlUXkix77KGW5SYMbeJJYtOVTs1/Cr+/8eHRf5al5249binOJxWLkANpsZtLNI60i9UUQIDAQAB</textarea>
                            </form>
                        </div>
                        <div data-repeater-list="" style="margin-top: 30px;">
                            <form>
                                <label>Nom & Prénom * :</label>
                                <input type="text" class="form-control" id="nomprenom">

                                <label>Email * :</label>
                                <input type="text" class="form-control" id="email">
                            </form>
                        </div>
                        <div data-repeater-list="" >
                            <form>
                                <label style="margin-left: 30px">ID command* :</label>
                                <input type="text" class="form-control" id="idcommande">

                                <label style="margin-left: 30px">Montant * :</label>
                                <input type="text" class="form-control" id="montant">
                            </form>
                        </div>
                        <div data-repeater-list="" style="display: none">
                            <form>
                                <input type="text" class="form-control" id="langue">
                                <input type="text" class="form-control" id="tel">
                            </form>
                        </div>
                        <div data-repeater-list="" style="display: none">
                            <form>
                                <input type="text" class="form-control" id="failURL" value="http://localhost/API_PHP_4T/failURL.php">
                                <input type="text" class="form-control" id="timeoutURL" >
                            </form>
                        </div>
                        <div data-repeater-list="" style="display: none">
                            <form>
                                <input type="text" class="form-control" id="successURL" value="{{$liensuccess}}">
                                <input type="text" class="form-control" id="address">
                            </form>
                        </div>
                        <div data-repeater-list="" style="display: none">
                            <form>
                                <input type="text" class="form-control"  id="state">
                                <input type="text" class="form-control" id="country">
                            </form>
                        </div>
                        <div data-repeater-list="" style="display: none">
                            <form>
                                <input type="text" class="form-control" id="recallURL" value="">
                                <input type="text" class="form-control" id="postcode">
                            </form>
                        </div>
                        <div data-repeater-list="" style="display: none">
                            <form>
                                <input type="text" class="form-control" id="city" style=" margin-bottom: 25px; ">
                                <input type="text" class="form-control" id="detailoperation" style=" margin-bottom: 25px; ">
                            </form>
                        </div>
                        <div data-repeater-list="">
                            <form>
                                <div class="form-group col-md-12" style="margin-top: 20px;">
                                    <button class="btn waves-effect waves-light btn-block btn-info" type="button" id="payer"  style="width: 110px;background-color: #f37121;border-color: #f37121!important;color: white !important;margin-top: -35px; border-radius: 30px;margin-bottom: 10px;font-size: 16px; font-family: Helvetica Neue,Helvetica,Arial,sans-serif">Valider</button>
                                </div>
                            </form>
                        </div>





                        <form method="post" action="{{ route('aport.store') }}" enctype="multipart/form-data" style="display: none">
                            @csrf
                            <input type="text" name="nombanque" placeholder="Nom de la banque" id="nomBanque">
                            @error('nombanque')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';font-size:13px;">Veuillez indiquer le nom de la banque</p>
                            @enderror
                            <input type="text" name="numerotransaction" placeholder="Numéro de transaction" id="numTransaction">
                            @error('numerotransaction')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';font-size:13px;">Veuillez indiquer le numéro de transaction</p>
                            @enderror
                            <div class="champ">
                                <div class="inputZone_imagerecu">
                                    <label for="imagerecu" class="custom-file-upload">
                                        <span>Ajouter un fichier</span>
                                        <input type="file" name="imagerecu" id="imagerecu" onchange="updateFileName(this)">
                                    </label>
                                    <span id="file-name">Image reçue de paiement</span>
                                </div>
                            </div>
                            @error('imagerecu')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';font-size:13px;">Veuillez sélectionner une image</p>
                            @enderror

                            <button class="EnvoyerBTN" type="submit">Envoyer</button>
                        </form>

                    </div>
                </div>
                <p class="SousReserve">**L'apport est remboursable en cas d'annulation de votre commande</p>
            </div>
        @endif
        <!----------------------------------------------------------------------------------->
        @if($apport && ($comptableValidation == null || $comptableValidation == 0))
            <div class="rightSide">
                <div class="rightSideContent afterForm">
                    <div class="part1">
                        <p class="title">Validation de la commande</p>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                            <path class="cls-1" d="M44.24,5.52h12.25c10.68,0,18.09,7.55,18.09,18.37,0,6.69-2.56,11.53-14.1,22.36-2.27,2.14-2.71,2.71-2.71,3.7s.43,1.57,2.71,3.7c11.54,10.82,14.1,15.66,14.1,22.36,0,10.83-7.4,18.37-18.09,18.37h-12.25c-10.67,0-18.08-7.55-18.08-18.37,0-6.69,2.56-11.53,14.1-22.36,2.28-2.14,2.71-2.71,2.71-3.7s-.43-1.57-2.71-3.7c-11.54-10.82-14.1-15.66-14.1-22.36,0-10.83,7.4-18.37,18.08-18.37ZM55.78,88.69c6.98,0,12.53-5.84,12.53-12.96,0-6.12-1.71-8.97-11.96-19.22-2.57-2.56-3.71-4.41-3.71-6.55s1.14-3.99,3.71-6.55c10.25-10.25,11.96-13.1,11.96-19.22,0-7.12-5.55-12.96-12.53-12.96h-10.82c-6.98,0-12.54,5.84-12.54,12.96,0,6.12,1.71,8.97,11.97,19.22,2.56,2.56,3.7,4.41,3.7,6.55s-1.14,3.99-3.7,6.55c-10.26,10.25-11.97,13.1-11.97,19.22,0,7.12,5.56,12.96,12.54,12.96h10.82ZM61.9,75.16c0,4.27-2.85,7.68-8.12,7.68h-6.84c-5.27,0-8.12-3.42-8.12-7.68,0-5.13,4.7-10.26,11.54-16.38,6.84,6.12,11.54,11.25,11.54,16.38ZM39.97,29.31h20.79c-1.71,3.7-5.56,7.55-10.4,11.96-4.84-4.41-8.69-8.26-10.39-11.96Z"></path>
                        </svg>
                        <p class="text">Votre commande est en cours de validation, merci de patienter.</p>
                    </div>

                    <div class="part2">
                        <p>Validation de votre conseiller : <span>En attente</span></p>
                        <p>Validation de votre apport : <span>En attente</span></p>
                    </div>
                </div>
            </div>
        @elseif(1 == $comptableValidation)
            <!----------------------------------------------------------------------------------->
            <div class="rightSide">
                <div class="rightSideContent aftervalidation">
                    <div class="part1">
                        <p class="title">Validation de la commande</p>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                            <path class="cls-1" d="M46.74,92.03h-6.36c-10.39-14.11-20.93-30.55-30.24-48.08l5.74-3.42c8.68,16.13,17.99,30.87,27.45,44.05,15.35-26.21,27.45-49.32,40.48-76.62l6.05,2.95c-13.96,29.32-26.36,52.89-43.11,81.11Z"></path>
                        </svg>
                        <p class="text">Félicitations, votre commande à été validé.</p>
                    </div>
                    <div class="part2">
                        <p>Validation de votre conseiller : <span>Validé</span></p>
                        <p>Validation de votre apport : <span>Validé</span></p>
                    </div>
                    <hr>
                    <div class="telecharger">
                        <p>Votre bon de commande est prêt, merci de cliquer sur le bouton ci-dessous pour le télécharger</p>
                        <a id="telechargerBtn" href="{{ route('download.pdf') }}" class="telechargerBTN">
                            Télécharger
                            <div class="loader" style="display: none;"></div>
                        </a>
                    </div>

                    <hr>
                    <div class="signer">
                        <p>Merci de signer virtuellement votre bon de commande en cliquant sur le bouton signer</p>
                        <button class="signerBTN" onclick="openModal()">Signer</button>
                    </div>
                    <div id="myModal" class="modal">
                        <form action="{{route('custom.signature.update' ,$allapport->id)}}" method="post">
                            @csrf
                            @method('patch')
                                <div class="modal-content">
                                <span class="close2">&times;</span>
                                <iframe id="pdfViewer" src="{{ route('show.pdf') }}"></iframe>
                                <input type="text" name="signature" value="Accepter" hidden>
                                <button id="acceptButton" type="submit">Accepter</button>
                            </div>
                        </form>
                    </div>
                </div>

                <a href="{{ route('sendInfoDA') }}" class="suivantBTN">Suivant</a>
            </div>
        @endif

        <div class="time mobile">
            <div class="timeItem">
                <p id="daysM" class="days">04</p><p class="text">Jours</p>
            </div> :
            <div class="timeItem">
                <p id="hoursM" class="hours">22</p><p class="text">Heures</p>
            </div> :
            <div class="timeItem">
                <p id="minutesM" class="minutes">30</p><p class="text">Minutes</p>
            </div> :
            <div class="timeItem">
                <p id="secondsM" class="seconds">48</p><p class="text">Seconds</p>
            </div>
        </div>

    </div>
    <p class="SousReserve mobile" style="display: none;">**Sous réserve d'acceptation du dossier crédit par RCI Finance Maroc</p>
@else
    <div class="content">
        <div style="margin: 40px auto;gap: 30px;display: flex;flex-direction: column;align-items: center;">
            <p style="font-family: 'NouvelRBold';font-size: 20px;margin: auto;">
                Votre réservation de 24 heures a expiré.<br> veuillez renouveler votre commande
            </p>
            <a href="http://localhost:3000/Modele" style="display: flex;flex-direction: column;align-items: center;justify-content: center;" class="EnvoyerBTN">Je commande mon véhicule</a>
        </div>
    </div>
@endif


    <div class="deconnecter">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="20" height="20">
                <path class="cls-1" d="M40.72,45.55c-.79.15-1.55.34-2.31.53.73.48,1.5.91,2.31,1.29v-1.82Z"></path>
                <path class="cls-1" d="M60.01,47.37c.82-.38,1.59-.82,2.32-1.3-.76-.19-1.52-.37-2.32-.52v1.82Z"></path>
                <path class="cls-2" d="M38.41,46.08c-14.87,3.71-22.98,15.09-22.98,33.58v11.19h5.73v-10.9c0-19.29,10.49-29.77,29.22-29.77s29.21,10.34,29.21,29.77v10.9h5.73v-11.19c0-18.62-7.99-29.89-22.98-33.58M62.33,46.07c5.13-3.38,8.02-9.15,8.02-16.74,0-12.58-7.41-20.27-19.99-20.27s-19.99,7.55-19.99,20.27c0,7.59,2.9,13.36,8.03,16.74M36.11,29.33c0-9.36,5.17-14.67,14.26-14.67s14.26,5.31,14.26,14.67-5.17,14.4-14.26,14.4-14.26-5.17-14.26-14.4Z"></path>
            </svg>
        </span>
        <span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="MDPoublie">Se déconnecter</button>
            </form>
        </span>
    </div>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
    if({{ $comptableValidation }} == 1){
        var comptableValidation = {{ $comptableValidation }}
    }

    //----loader-----\\
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const loader = document.getElementById('loader');

        form.addEventListener('submit', function() {
            loader.style.display = 'block';
            form.style.display = 'none';
        });
    });

    // -------signature logic-----
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
    // -------signature logic ENDS-----


    // ------- payer en ligne -----
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
            var sessionData = {
                userId: 'user123',
                transactionId: 'trans456',
            };
            $('#chmpoblg').hide();
            window.top.location.href = lien_gateway;
        }
    });
</script>

<script src={{ asset('scripts/myscript.js') }}></script>

@stop
