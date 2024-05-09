
@extends('layout')

@section('title', 'suiviCommande')


@section('popUp')
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

        <div class="overlay"></div>

        <div class="popUp_MDPchange">
            <div class="close">
                <a href="/">X</a>
            </div>
@if($commandeID && $isExpired == null)
            <p class="Main_title">Bonjour</p>
            <p class="Main_sous-title">Bienvenue dans votre espace de précommande M-AUTOMOTIV</p>
            @if(null !== Auth::user() && Auth::user()->passwordChanged === "false")
                <div class="contentMDPChange" id="contentMDPChange">
                    <div class="carCard">
                        <p class="title">Votre {{$version->nomversion}} est prête.</p>
                        <div class="carImage">
                            <img src="{{ asset('storage/' . $version->image) }}" alt="">
                        </div>
                        <p class="sous-title-card">*Images non contractuelles</p>
                    </div>

                    <div class="formMDP">
                        <p class="title">Veuillez saisir votre nouveau mot de passe pour accéder à votre précommande.</p>
                        <form method="POST" action="{{ route('update.user', Auth::user()->id) }}" onsubmit="return validateForm()">
                            @csrf
                            @method('PATCH')
                            <input type="password" id="password" name="password" placeholder="Nouveau mot de passe" required>
                            @error('password')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';">{{ $message }}</p>
                            @enderror
                            <input type="password" id="Confpassword" name="Confpassword" placeholder="Confirmation de mot de passe" required>
                            @error('Confpassword')
                                <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';">{{ $message }}</p>
                            @enderror
                            <input type="text" name="passwordChanged"  value="true" style="display: none">

                            <button type="submit" class="submitformMDP">Enregistrer</button>
                        </form>
                    </div>
                </div>
            @elseif(null !== Auth::user() && $version)
            <!-------------------------------------------------------->
            <div class="StepsContent" id="StepsContent">
                <div class="carCard">
                    <p class="title">Votre {{$version->nomversion}} est prête.</p>
                    <div class="carImage">
                        <img src="{{ asset('storage/' . $version->image) }}" alt="">
                    </div>
                    <p class="sous-title-card">*Images non contractuelles</p>
                </div>

                <div class="CMDsuivi">
                    <p class="title"> Suivi ma commande :</p>
                    <div class="steps">
                        <div class="step">
                            <p class="stepNum active">1</p><span>Validation de commande</span>
                        </div>
                        <div class="step">
                            @if($allDossierAchat)
                                <p class="stepNum active">2</p><span>Validation dossier d'achat</span>
                            @else
                                <p class="stepNum">2</p><span>Validation dossier d'achat</span>
                            @endif
                        </div>
                        <div class="step">
                            @if($allPaiement)
                                <p class="stepNum active">3</p><span>Validation de paiement</span>
                            @else
                                <p class="stepNum">3</p><span>Validation de paiement</span>
                            @endif
                        </div>
                        <div class="step">
                            @if($PaiementValidation)
                                <p class="stepNum active">4</p><span>Livraison</span>
                            @else
                                <p class="stepNum">4</p><span>Livraison</span>
                            @endif
                        </div>
                    </div>
                    @if(Auth::check() && Auth::user()->id !== null)
                        <button class="ConsultBTN" onclick="window.location.href='{{ route('sendIdCommande', Auth::user()->id) }}'">Consulter ma commande</button>
                    @endif
                </div>
            </div>
            @endif
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
            <!-------------------------------------------------------->
            <div class="deconnecter">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="20" height="20">
                        <path class="cls-1" d="M40.72,45.55c-.79.15-1.55.34-2.31.53.73.48,1.5.91,2.31,1.29v-1.82Z"/>
                        <path class="cls-1" d="M60.01,47.37c.82-.38,1.59-.82,2.32-1.3-.76-.19-1.52-.37-2.32-.52v1.82Z"/>
                        <path class="cls-2" d="M38.41,46.08c-14.87,3.71-22.98,15.09-22.98,33.58v11.19h5.73v-10.9c0-19.29,10.49-29.77,29.22-29.77s29.21,10.34,29.21,29.77v10.9h5.73v-11.19c0-18.62-7.99-29.89-22.98-33.58M62.33,46.07c5.13-3.38,8.02-9.15,8.02-16.74,0-12.58-7.41-20.27-19.99-20.27s-19.99,7.55-19.99,20.27c0,7.59,2.9,13.36,8.03,16.74M36.11,29.33c0-9.36,5.17-14.67,14.26-14.67s14.26,5.31,14.26,14.67-5.17,14.4-14.26,14.4-14.26-5.17-14.26-14.4Z"/>
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

@endsection
