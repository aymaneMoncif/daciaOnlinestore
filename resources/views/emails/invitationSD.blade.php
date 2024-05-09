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

        <p style="font-family: NouvelRBold;">Bonjour '{$name}'</p>

        <p style="font-family: NouvelRRegular;">Merci de compléter votre dossier d'achat en téléversant les documents mentionnés sur votre espace.</p>
        
        <a href="" style="font-family: NouvelRRegular;
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
        </a>

        <p style="font-family: NouvelRRegular;">
            Pour toute demande, merci de prendre contact avec notre service 
            relation client au numéro suivant : <span style="font-family: NouvelRBold;">05 20 48 20 02</span>
        </p>
        <p style="font-family: NouvelRRegular;">Merci</p>
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
            <p style="color: white;font-family: NouvelRRegular;">© M-AUTOMOTIV 2024</p>
            <p style="color: white;font-family: NouvelRRegular;">tous les droits sont réservés.</p>
        </div>
        <p style="color: white;font-family: NouvelRRegular;">Cet email automatique, merci de ne pas répondre.</p>
        <hr style="width: 70px;border: 1px solid #e5d500;">
        <p style="color: white;font-family: NouvelRRegular;">www.renault.m-automotiv.ma</p>
    </div>

</body>
</html>