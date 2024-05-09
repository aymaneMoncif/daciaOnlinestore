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

        <p style="font-family: NouvelRBold;">Bonjour <span style="font-family: NouvelRRegular;">{{$ComptableName}}</span></p>

        <p style="font-family: NouvelRBold;">Nom client : &nbsp;<span style="font-family: NouvelRRegular;">{{$name}}&nbsp;{{$prenom}}</span></p>

        <p style="font-family: NouvelRBold;">Montant : &nbsp;<span style="font-family: NouvelRRegular;">{{$Montant}}</span></p>

        <p style="font-family: NouvelRBold;">Date de réservation : &nbsp;<span style="font-family: NouvelRRegular;">{{$DateCreation}}</span></p>


        <p style="font-family: NouvelRBold;"> Prière de vous connecter pour visualisation. </p>

        <p style="color: white;font-family: NouvelRRegular;">Cet email automatique, merci de ne pas répondre.</p>
        <hr style="width: 70px;border: 1px solid #e5d500;">
        <p style="color: white;font-family: NouvelRRegular;">www.renault.m-automotiv.ma</p>
    </div>

</body>
</html>