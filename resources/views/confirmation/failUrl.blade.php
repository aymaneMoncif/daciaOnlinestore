@extends('layout')

@section('popUp')
<!-------------------------------------------------------->
<div class="overlay"></div>
<div class="popUp_commandeValid">
    <div class="close">
        <a href="/">X</a>
    </div>

    <p id="liengw" style="margin: 0 auto;font-size: 20px !important; font-family: DaciaBlock;display: flex;flex-direction: column;align-items: center;">
        Vous avez annulé le paiement.

        <a href="http://localhost:8000/validationCommande" class="EnvoyerBTN" type="submit" style="display: flex;align-items: center;justify-content: center;width: 75%;">
            Essayer à nouveau
        </a>
    </p>



    <div class="deconnecter">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="20" height="20">
                <path class="cls-1" d="M40.72,45.55c-.79.15-1.55.34-2.31.53.73.48,1.5.91,2.31,1.29v-1.82Z"></path>
                <path class="cls-1" d="M60.01,47.37c.82-.38,1.59-.82,2.32-1.3-.76-.19-1.52-.37-2.32-.52v1.82Z"></path>
                <path class="cls-2" d="M38.41,46.08c-14.87,3.71-22.98,15.09-22.98,33.58v11.19h5.73v-10.9c0-19.29,10.49-29.77,29.22-29.77s29.21,10.34,29.21,29.77v10.9h5.73v-11.19c0-18.62-7.99-29.89-22.98-33.58M62.33,46.07c5.13-3.38,8.02-9.15,8.02-16.74,0-12.58-7.41-20.27-19.99-20.27s-19.99,7.55-19.99,20.27c0,7.59,2.9,13.36,8.03,16.74M36.11,29.33c0-9.36,5.17-14.67,14.26-14.67s14.26,5.31,14.26,14.67-5.17,14.4-14.26,14.4-14.26-5.17-14.26-14.4Z"></path>
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
