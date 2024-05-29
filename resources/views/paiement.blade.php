@extends('layout')

@section('popUp')
<div class="overlay"></div>
<div class="popUp_MDPchange">
    <div class="close">
        <a href="/">X</a>
    </div>

    <div class="lineButtons">
        <div class="etapsContainer">
            <a href="{{ route('sendIdCommande') }}" class="etapBTN">1. Validation de la commande</a>

            @if($simulateur)
                <a href="{{ route('sendInfoDA') }}" class="etapBTN">2. Dossier d'achat</a>
            @endif

            <button class="etapBTN active">3. Paiement</button>

            @if(1 == $PaiementValidation)
                <a href="{{ route('sendInfoLivraison') }}" class="etapBTN">4. Livraison</a>
            @else
                <button class="etapBTN inactive">4. Livraison</button>
            @endif

        </div>
    </div>

@if($commandeID)
    <div class="content">

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


        <div class="leftSide">
            <div class="miniCarCard">
                <p class="title">Votre {{$version->nomversion}} est prête.</p>
                <div class="carImage">
                    <img src="{{ asset('storage/' . $version->image) }}" alt="">
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
                <p class="miniTitle">Pack & équipements</p>
                @foreach ($equipements as $equipement)
                    <p>{{$equipement->nomequipement}}</p>
                @endforeach
            </div>
        </div>

        @if(!$Paiement)
            <div class="rightSide">
                <div class="rightSideContent">
                    <div class="CMDvalidation">
                        <p class="title" style="margin-bottom: 30px;">Paiement</p>
                    </div>

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

                    <div class="paiement" id="formzone">
                        <form method="post" action="{{ route('paiement.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="champ">
                                <label for="">Mode de paiement</label>
                                <select name="modepaiement">
                                    @if($simulateur)
                                        <option value="MOBILIZE" selected>
                                            MOBILIZE FINANCIAL SERVICES
                                        </option>
                                    @else()
                                        <option value="comptant" selected>
                                            Comptant
                                        </option>
                                    @endif
                                </select>
                            </div>
                            @error('modepaiement')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';">{{ $message }}</p>
                            @enderror
                            <hr>

                            <p class="text">
                                Félicitations ! votre dossier est validé, pour continuer votre achat, <br>
                                merci de choisir méthode de paiement souhaitée :
                            </p>

                            <div class="champ">
                                <select class="fullWidthSelect" name="methodepaiement">
                                    <option value="Virement" selected>Virement</option>
                                </select>
                            </div>
                            @error('methodepaiement')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';">{{ $message }}</p>
                            @enderror

                            <p class="text">
                                Merci d'effectuer un virement / versement bancaire au compte Bancaire suivant :
                            </p>

                            <div class="miniDetailsCard">
                                <p>Titulaire du compte : <span>MOROCCO AUTOMOTIVE RETAIL</span></p>
                                <p>Nom de banque : <span>CRÉDIT DU MAROC</span></p>
                                <p>RIB : <span>021 780 0000 027030093441 89</span></p>
                            </div>

                            <p class="text">
                                    Une fois effectué, vous etes sollicité a remplir les champs <br>
                                    demandés ci-dessous pour continuer votre achat
                            </p>

                            <input type="text" name="nombanque" placeholder="Nom de la banque" id="nomBanque">
                            @error('nombanque')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';">{{ $message }}</p>
                            @enderror
                            <input type="text" name="numtransaction" placeholder="Numéro de transaction" id="numTransaction">
                            @error('numtransaction')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';">{{ $message }}</p>
                            @enderror
                            <div class="inputZoneEX">
                                <label for="imagerecu" class="custom-file-upload">
                                    <span>Ajouter un fichier</span>
                                    <input type="file" name="imagerecu" id="imagerecu" onchange="updateFileName(this)">
                                </label>
                                <span id="file-name">Image reçu de Paiement</span>
                            </div>
                            @error('imagerecu')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';">{{ $message }}</p>
                            @enderror


                            <button type="submit" class="EnvoyerBTN">Envoyer</button>
                        </form>

                    </div>
                </div>
            </div>



        @elseif($Paiement && ($PaiementValidation == 0 || $PaiementValidation == 'refuser'))
            <div class="rightSide">
                <div class="rightSideContent afterForm">
                    <div class="part1">
                        <p class="title">Paiement</p>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                            <path class="cls-1" d="M44.24,5.52h12.25c10.68,0,18.09,7.55,18.09,18.37,0,6.69-2.56,11.53-14.1,22.36-2.27,2.14-2.71,2.71-2.71,3.7s.43,1.57,2.71,3.7c11.54,10.82,14.1,15.66,14.1,22.36,0,10.83-7.4,18.37-18.09,18.37h-12.25c-10.67,0-18.08-7.55-18.08-18.37,0-6.69,2.56-11.53,14.1-22.36,2.28-2.14,2.71-2.71,2.71-3.7s-.43-1.57-2.71-3.7c-11.54-10.82-14.1-15.66-14.1-22.36,0-10.83,7.4-18.37,18.08-18.37ZM55.78,88.69c6.98,0,12.53-5.84,12.53-12.96,0-6.12-1.71-8.97-11.96-19.22-2.57-2.56-3.71-4.41-3.71-6.55s1.14-3.99,3.71-6.55c10.25-10.25,11.96-13.1,11.96-19.22,0-7.12-5.55-12.96-12.53-12.96h-10.82c-6.98,0-12.54,5.84-12.54,12.96,0,6.12,1.71,8.97,11.97,19.22,2.56,2.56,3.7,4.41,3.7,6.55s-1.14,3.99-3.7,6.55c-10.26,10.25-11.97,13.1-11.97,19.22,0,7.12,5.56,12.96,12.54,12.96h10.82ZM61.9,75.16c0,4.27-2.85,7.68-8.12,7.68h-6.84c-5.27,0-8.12-3.42-8.12-7.68,0-5.13,4.7-10.26,11.54-16.38,6.84,6.12,11.54,11.25,11.54,16.38ZM39.97,29.31h20.79c-1.71,3.7-5.56,7.55-10.4,11.96-4.84-4.41-8.69-8.26-10.39-11.96Z"/>
                        </svg>
                        <p class="text">
                            Votre paiement est en cours de validation, <br>
                            Merci de patienter
                        </p>
                    </div>
                </div>
            </div>
        @elseif('valider' == $PaiementValidation)
            <div class="rightSide">
                <div class="rightSideContent aftervalidation">
                    <div class="part1">
                        <p class="title">Paiement</p>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                            <path class="cls-1" d="M46.74,92.03h-6.36c-10.39-14.11-20.93-30.55-30.24-48.08l5.74-3.42c8.68,16.13,17.99,30.87,27.45,44.05,15.35-26.21,27.45-49.32,40.48-76.62l6.05,2.95c-13.96,29.32-26.36,52.89-43.11,81.11Z"/>
                        </svg>
                        <p class="text">Félicitations! vous avez complété votre achat avec succès, <br>
                            votre conseiller Renault va vous contacter très prochainement <br>
                            pour vous communiquer les modalités de livraison de votre véhicule.
                        </p>
                    </div>
                </div>

                <a href="{{ route('sendInfoLivraison') }}" class="suivantBTN">Suivant</a>
            </div>
        @else
            <p style="margin: auto;
            font-family: 'NouvelRBold';
            font-size: 20px;">please folow the steps !</p>
        @endif

        <div class="rightSide" id="livraison" style="display: none;">
            <div class="rightSideContent aftervalidation">
                <div class="part1">
                    <p class="title">Livraison</p>
                    <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                        <path class="cls-1" d="M46.74,92.03h-6.36c-10.39-14.11-20.93-30.55-30.24-48.08l5.74-3.42c8.68,16.13,17.99,30.87,27.45,44.05,15.35-26.21,27.45-49.32,40.48-76.62l6.05,2.95c-13.96,29.32-26.36,52.89-43.11,81.11Z"/>
                    </svg>
                    <p class="text">Votre véhicule a bien été livré, <br>
                         nous vous remercions pour votre confiance <br>
                         et nous vous souhaitons une excellente route.
                         <br>
                         <br>
                         <br>
                         À bientôt !
                    </p>
                </div>
            </div>
        </div>

    </div>
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
                <path class="cls-1" d="M40.72,45.55c-.79.15-1.55.34-2.31.53.73.48,1.5.91,2.31,1.29v-1.82Z"/>
                <path class="cls-1" d="M60.01,47.37c.82-.38,1.59-.82,2.32-1.3-.76-.19-1.52-.37-2.32-.52v1.82Z"/>
                <path class="cls-2" d="M38.41,46.08c-14.87,3.71-22.98,15.09-22.98,33.58v11.19h5.73v-10.9c0-19.29,10.49-29.77,29.22-29.77s29.21,10.34,29.21,29.77v10.9h5.73v-11.19c0-18.62-7.99-29.89-22.98-33.58M62.33,46.07c5.13-3.38,8.02-9.15,8.02-16.74,0-12.58-7.41-20.27-19.99-20.27s-19.99,7.55-19.99,20.27c0,7.59,2.9,13.36,8.03,16.74M36.11,29.33c0-9.36,5.17-14.67,14.26-14.67s14.26,5.31,14.26,14.67-5.17,14.4-14.26,14.4-14.26-5.17-14.26-14.4Z"/>
            </svg>
        </span>
        <span>
            <form method="POST" action="{{ route('logoutUser') }}">
                @csrf
                <button type="submit" class="MDPoublie">Se déconnecter</button>
            </form>
        </span>
    </div>

</div>


<script>
    //----loader-----\\
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formzone');
        const loader = document.getElementById('loader');

        form.addEventListener('submit', function() {
            loader.style.display = 'block';
            form.style.display = 'none';
        });
    });
</script>

@stop


