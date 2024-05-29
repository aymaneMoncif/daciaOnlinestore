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

            <a href="{{ route('sendInfoPaiement') }}" class="etapBTN">3. Paiement</a>

            <button class="etapBTN active">4. Livraison</button>
        </div>
    </div>

    <div class="content">

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
                    <p>Mensualité : <span class="Prix">2 807,85 TTC/MOIS**</span></p>
                    <p>Durée : <span class="Duree">{{$simulateur->durree}} Mois</span></p>
                    <p>Apport : <span class="Apport">36 498,00 DHS</span></p>
                    <hr>
                @endif
                <p class="miniTitle">Pack & équipements</p>
                @foreach ($equipements as $equipement)
                    <p>{{$equipement->nomequipement}}</p>
                @endforeach
            </div>
        </div>

        @if($Paiement)
            <div class="rightSide" id="livraison">
                <div class="rightSideContent aftervalidation">
                    <div class="part1">
                        <p class="title">Livraison</p>
                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                            <path class="cls-1" d="M46.74,92.03h-6.36c-10.39-14.11-20.93-30.55-30.24-48.08l5.74-3.42c8.68,16.13,17.99,30.87,27.45,44.05,15.35-26.21,27.45-49.32,40.48-76.62l6.05,2.95c-13.96,29.32-26.36,52.89-43.11,81.11Z"/>
                        </svg>
                        <p class="text"> Votre véhicule a bien été livré, <br>
                            nous vous remercions pour votre confiance
                            <br>
                            <br>
                            <br>
                            À bientôt !
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>

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

@stop
