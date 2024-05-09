<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'NouvelRBold';
            src: url('{{ asset("webStyle/assets/fonts/NouvelRBold.ttf") }}') format('woff2');
        }

        @font-face {
            font-family: 'NouvelRRegular';
            src: url('{{ asset("webStyle/assets/fonts/NouvelRRegular.ttf") }}') format('woff2');
        }
    </style>
</head>
<body>
    
    <div class="header" style="background-color: black;display: flex;justify-content: space-between;padding: 30px;align-items: center;">
        <div style="display: flex;align-items: center;color: white;gap: 15px;align-items: center;">
            <img src="{{asset('webStyle/assets/logos/renault_logo_white.png')}}" alt="" style="width: 60px;">
            <p style="font-family: NouvelRBold;">RENAULT</p>
        </div>
        <img src="{{asset('webStyle/assets/logos/m-automoyive_logo_white.png')}}" alt="" style="height: 50px;">
    </div>
    <div class="content" style="margin: 40px;">

        <p style="font-family: NouvelRBold;">Félicitations {{$name}}</p>

        <p style="font-family: NouvelRRegular;">Votre espace personnel M-AUTOMOTIV a été créé avec succès, plus qu'une étape pour réserver votre Renault Nouvelle Clio version Explore.</p>

        <p style="font-family: NouvelRRegular;">Afin de poursuivre votre parcours achat, nous vous invitons à récupérer ci-dessous vos accès provisoires et à rejoindre votre espace personnel sur le lien suivant :</p>

        <a href="http://127.0.0.1:8000/page/login" style="font-family: NouvelRRegular;
                          margin: 28px auto;
                          height: 46px;
                          display: flex;
                          align-items: center;
                          justify-content: center;
                          width: 200px;
                          background-color: black;
                          color: white;
                          text-decoration: none;">
            Cliquez Ici 
        </a><br>

        <span style="font-family: NouvelRRegular;">Email :</span> <span style="font-family: NouvelRBold;">{{$email}}</span><br>
        <span style="font-family: NouvelRRegular;">Mot de passe :</span> <span style="font-family: NouvelRBold;">{{$password}}</span><br>

        <p style="font-family: NouvelRRegular;">Rendez-vous sur votre espace client pour finaliser les prochaines étapes de votre commande.</p>
    </div>
    <div class="footer" style="background-color: black;
    display: flex;
    justify-content: space-between;
    padding: 30px;
    flex-direction: column;
    align-items: center;">
        <div style="    display: flex;
        flex-direction: column;
        align-items: center;
        line-height: 0;
    "> 
            <p style="color: white;font-family: NouvelRRegular;margin: 10px;">© M-AUTOMOTIV 2024</p>
            <p style="color: white;font-family: NouvelRRegular;margin: 10px;">tous les droits sont réservés.</p>
        </div>
        <p style="color: white;font-family: NouvelRRegular;">Cet email automatique, merci de ne pas répondre.</p>
        
        <p style="color: white;font-family: NouvelRRegular;">www.renault.m-automotiv.ma</p>
    </div>
    <div style="display: flex;
    justify-content: center;
    align-items: center;
    margin: 21px;
    gap: 15px;">

        <a href="https://www.facebook.com/M.Automotiv?_rdc=1&_rdr">
            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width='20' height=20px>
                <path class="cls-1" d="M50,100C22.43,100,0,77.57,0,50S22.43,0,50,0s50,22.43,50,50-22.43,50-50,50ZM50,4.65C24.99,4.65,4.65,24.99,4.65,50s20.35,45.36,45.35,45.36,45.35-20.35,45.35-45.36S75.01,4.65,50,4.65Z"/>
                <path class="cls-1" d="M54.2,38.71v-4.52c0-2.2,1.47-2.71,2.5-2.71h6.34v-9.67l-8.73-.04c-9.69,0-11.89,7.22-11.89,11.84v5.1h-5.6v11.3h5.65v28.24h11.29v-28.24h8.38l1.03-11.3h-8.98Z"/>
            </svg>
        </a>
        
        <a href="https://www.instagram.com/m.automotiv.maroc/">
            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width='20' height=20px>
                <path class="cls-1" d="M50,100.01C22.43,100.01,0,77.57,0,50.01S22.43,0,50,0s50,22.43,50,50.01-22.43,50-50,50ZM50,4.64C24.99,4.64,4.64,24.99,4.64,50.01s20.35,45.36,45.36,45.36,45.36-20.35,45.36-45.36S75.01,4.64,50,4.64Z"/>
                <g>
                <path class="cls-1" d="M36.35,73.13h0,0ZM63.65,24.8h0,0Z"/>
                <path class="cls-1" d="M50,67.03c9.39,0,17.03-7.63,17.03-17.02s-7.64-17.03-17.03-17.03-17.03,7.64-17.03,17.03,7.64,17.02,17.03,17.02ZM37.1,50.01c0-7.12,5.79-12.91,12.9-12.91s12.9,5.79,12.9,12.91-5.79,12.9-12.9,12.9-12.9-5.79-12.9-12.9Z"/>
                <path class="cls-1" d="M66.98,78.28h-33.96c-6.37,0-11.56-5.19-11.56-11.56v-33.45c0-6.37,5.19-11.56,11.56-11.56h33.96c6.38,0,11.56,5.19,11.56,11.56v33.45c0,6.37-5.19,11.56-11.56,11.56ZM33.02,25.94c-4.05,0-7.34,3.29-7.34,7.34v33.45c0,4.05,3.29,7.34,7.34,7.34h33.96c4.05,0,7.34-3.29,7.34-7.34v-33.45c0-4.05-3.29-7.34-7.34-7.34h-33.96Z"/>
                </g>
                <path class="cls-1" d="M67.26,31.03c-1.49,0-2.69,1.21-2.69,2.69s1.2,2.68,2.69,2.68,2.69-1.2,2.69-2.68-1.21-2.69-2.69-2.69Z"/>
            </svg>
        </a>

        <a href="https://www.youtube.com/@mautomotiv?themeRefresh=1">
            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width='20' height=20px>
                <path class="cls-1" d="M50,100C22.43,100,0,77.57,0,50S22.43,0,50,0s50,22.43,50,50-22.43,50.01-50,50.01ZM50,4.65C24.99,4.65,4.65,24.99,4.65,50s20.35,45.36,45.35,45.36,45.35-20.35,45.35-45.36S75.01,4.65,50,4.65Z"/>
                <path class="cls-1" d="M62.19,32.41h-24.37c-6.52,0-11.81,5.29-11.81,11.81v11.58c0,6.52,5.29,11.81,11.81,11.81h24.37c6.52,0,11.81-5.29,11.81-11.81v-11.58c0-6.52-5.29-11.81-11.81-11.81ZM59.75,50.11l-16.02,8.66c-.54.29-1.18-.1-1.18-.71v-17.38c0-.61.64-1,1.18-.71l16.03,8.73c.56.31.56,1.11,0,1.41Z"/>
            </svg>
        </a>
    </div>

</body>
</html>