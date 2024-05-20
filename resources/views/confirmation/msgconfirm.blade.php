@extends('layout')

@section('headScript')
    <script type="text/javascript" src="{{asset('scripts/api/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('scripts/api/jsencrypt.js')}}"></script>
    <script type="text/javascript" src="{{asset('scripts/api/tramegatewaynapsv4.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript">
        $(document).ready(function() {
            console.log('idmsg : ');
            var idmsg = "{{ $idmsg }}"; // Encapsulate PHP variable in quotes
            var email = "{{ $email }}"; // Encapsulate PHP variable in quotes

            var msg = "Transaction non aboutie. Merci de réessayer.";
            switch (idmsg) {
                case "0":
                    $('#msg').html("Transaction effectuée avec succès. L'accusé de paiement n'a pas été envoyé.");
                    $('#OK').hide();
                    $('#ko').show();
                    break;
                case "1ok":
                    $('#msg').html("Transaction effectuée avec succès.<br/> Un accusé de paiement a été envoyé à l'adresse: " + email);
                    $('#OK').show();
                    break;
                case "2":
                    $('#msg').html("Transaction non aboutie. Merci de réessayer.");
                    $('#OK').hide();
                    $('#ko').show();
                    break;
                case "3ko":
                    $('#msg').html("Transaction non aboutie. Merci de réessayer.");
                    $('#OK').hide();
                    $('#ko').show();
                    break;
                default:
                    $('#msg').html(msg); // Default message
                    $('#OK').hide();
                    $('#ko').show();
            }
        });
    </script>

@stop

@section('popUp')
<!-------------------------------------------------------->
<div class="overlay"></div>
<div class="popUp_commandeValid">
    <div class="close">
        <a href="/">X</a>
    </div>


    <div class="CMDsuivi" style="width: 100%">
        <div id="ko" style="display: none">
            <div style="display: flex;margin: 45px 0;justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                    <path class="cls-1" d="M44.24,5.52h12.25c10.68,0,18.09,7.55,18.09,18.37,0,6.69-2.56,11.53-14.1,22.36-2.27,2.14-2.71,2.71-2.71,3.7s.43,1.57,2.71,3.7c11.54,10.82,14.1,15.66,14.1,22.36,0,10.83-7.4,18.37-18.09,18.37h-12.25c-10.67,0-18.08-7.55-18.08-18.37,0-6.69,2.56-11.53,14.1-22.36,2.28-2.14,2.71-2.71,2.71-3.7s-.43-1.57-2.71-3.7c-11.54-10.82-14.1-15.66-14.1-22.36,0-10.83,7.4-18.37,18.08-18.37ZM55.78,88.69c6.98,0,12.53-5.84,12.53-12.96,0-6.12-1.71-8.97-11.96-19.22-2.57-2.56-3.71-4.41-3.71-6.55s1.14-3.99,3.71-6.55c10.25-10.25,11.96-13.1,11.96-19.22,0-7.12-5.55-12.96-12.53-12.96h-10.82c-6.98,0-12.54,5.84-12.54,12.96,0,6.12,1.71,8.97,11.97,19.22,2.56,2.56,3.7,4.41,3.7,6.55s-1.14,3.99-3.7,6.55c-10.26,10.25-11.97,13.1-11.97,19.22,0,7.12,5.56,12.96,12.54,12.96h10.82ZM61.9,75.16c0,4.27-2.85,7.68-8.12,7.68h-6.84c-5.27,0-8.12-3.42-8.12-7.68,0-5.13,4.7-10.26,11.54-16.38,6.84,6.12,11.54,11.25,11.54,16.38ZM39.97,29.31h20.79c-1.71,3.7-5.56,7.55-10.4,11.96-4.84-4.41-8.69-8.26-10.39-11.96Z"/>
                </svg>
            </div>

            <div style="display: flex;">
                <p id="msg" style="margin: 0 auto;font-size: 20px !important; font-family: DaciaBlock;">
                    <!--response-->Cette page n'est malheureusement pas disponible<!--response-->
                </p>
            </div>
        </div>

        <div id="OK" style="display: none">

            <p id="msg" style="margin: 0 auto;font-size: 20px !important; font-family: DaciaBlock; display: flex;
            justify-content: center;
            text-align: center;">
                Transaction effectuée avec succès. <br/> Un accusé de paiement a été envoyé à l'adresse: {{$data?->emailrd}}
            </p>

            <div class="steps" >
                <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50" style="margin: auto;">
                    <path class="cls-1" d="M46.74,92.03h-6.36c-10.39-14.11-20.93-30.55-30.24-48.08l5.74-3.42c8.68,16.13,17.99,30.87,27.45,44.05,15.35-26.21,27.45-49.32,40.48-76.62l6.05,2.95c-13.96,29.32-26.36,52.89-43.11,81.11Z"/>
                </svg>
                <div class="step">
                    <p class="stepNum active">1</p><span>Nom et prénom : {{$data?->nomprenom}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">2</p><span>Email : {{$data?->emailrd}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">3</p><span>Commerçant : {{$data?->nom_cmr}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">4</p><span>N° commande : {{$data?->id_commande}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">5</p><span>N° transaction : {{$data?->numTrans}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">6</p><span>N° autorisation : {{$data?->numautorisation}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">5</p><span>Date et Heure de la transaction : {{$data?->created_at}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">7</p><span>Numéro de carte : {{$data?->numCarte}}</span>
                </div>
                <div class="step">
                    <p class="stepNum active">8</p><span>Montant TTC : {{$data?->montant}} DHS</span>
                </div>
            </div>

            <p style="font-size: 20px !important; font-family: DaciaBlock;" class="resp">Merci d'avoir choisi la solution de paiement e-commerce par NAPS.</p>
        </div>

        <button class="ConsultBTN" onclick="window.location.href='{{ route('sendIdCommande')}}'">Suivant</button>

    </div>


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

<script src={{ asset('scripts/myscript.js') }}></script>

@stop

