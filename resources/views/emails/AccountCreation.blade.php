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

    <div class="header" style="background-color: #646b52;display: flex;justify-content: space-between;padding: 30px;align-items: center;">
        <div style="display: flex;align-items: center;color: white;gap: 15px;align-items: center;">
            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" version="1.1" viewBox="0 0 207.27 62.31" style="fill: black; width: 180px;">
                <path class="cls-1" d="M51.94,32.26c-.8.81-1.65,1.7-2.52,2.55-2.05,2.02-4.11,4.04-6.19,6.04-.23.22-.58.43-.87.43-8.54.02-17.08.01-25.61,0-.05,0-.1-.02-.23-.05v-5.72c1.59,0,3.18,0,4.77,0,5.84-.03,11.69-.06,17.53-.13.4,0,.88-.2,1.17-.48.93-.87,1.78-1.83,2.73-2.81-.98-1.06-1.98-2.19-3.04-3.26-.18-.18-.59-.18-.89-.18-7.2,0-14.41.01-21.61.02-.21,0-.41-.02-.67-.03v-5.67c.27-.01.52-.04.78-.04,8.22,0,16.44,0,24.65-.03.58,0,.99.15,1.4.57,2.84,2.93,5.71,5.84,8.61,8.8Z"/>
                <path class="cls-1" d="M95.69,31.9c2.7-2.75,5.66-5.78,8.65-8.79.18-.18.52-.26.79-.26,8.4,0,16.8.02,25.21.04.15,0,.31.03.5.06v5.64c-.36,0-.67,0-.98,0-7.12-.01-14.24-.03-21.37-.01-.37,0-.82.2-1.08.46-.98.98-1.89,2.02-2.77,2.97,1.02,1.07,1.99,2.13,3.01,3.13.18.18.59.18.9.19,7.12.06,14.24.1,21.36.15.26,0,.52,0,.9,0v5.75c-.21,0-.49,0-.77,0-8.27,0-16.54,0-24.81-.03-.42,0-.95-.21-1.24-.51-2.81-2.92-5.58-5.88-8.31-8.77Z"/>
                <path class="cls-1" d="M73.68,31.87c-.88.87-1.65,1.61-2.39,2.36-2.19,2.22-4.36,4.47-6.57,6.67-.28.28-.77.49-1.16.49-2.45.03-4.91,0-7.36-.02-.31,0-.62-.03-1.11-.05,6.22-6.55,12.33-12.98,18.53-19.5,6.26,6.48,12.49,12.93,18.83,19.49-.38.03-.6.07-.83.07-2.75,0-5.5.03-8.24-.02-.41,0-.93-.24-1.22-.54-2.67-2.73-5.3-5.49-7.93-8.25-.2-.21-.35-.47-.53-.71Z"/>
                <path class="cls-1" d="M173.83,32.35c-2.4,2.27-4.8,4.54-7.19,6.82-.79.75-1.42,1.84-2.36,2.23-.93.39-2.15.12-3.24.13-1.84,0-3.68,0-5.52,0-.05,0-.1-.03-.28-.09,6.15-6.49,12.25-12.94,18.42-19.45,6.27,6.49,12.48,12.93,18.84,19.51-.41.02-.68.04-.95.04-2.69,0-5.39-.01-8.08.01-.55,0-.94-.16-1.32-.56-2.64-2.79-5.31-5.55-7.96-8.33-.18-.19-.33-.42-.49-.63.04.11.08.22.12.33Z"/>
                <path class="cls-1" d="M147.21,40.81h-5.74v-17.69h5.74v17.69Z"/>
            </svg>
        </div>
        <img src="{{asset('webStyle/assets/logos/m-automoyive_logo_white.png')}}" alt="" style="height: 50px;">
    </div>
    <div class="content" style="margin: 40px;">

        <p style="font-family: NouvelRBold;">Félicitations {{$name}}</p>

        <p style="font-family: NouvelRRegular;">Votre espace personnel M-AUTOMOTIV a été créé avec succès, plus qu'une étape pour réserver votre voiture.</p>

        <p style="font-family: NouvelRRegular;">Afin de poursuivre votre parcours achat, nous vous invitons à récupérer ci-dessous vos accès provisoires et à rejoindre votre espace personnel sur le lien suivant :</p>

        <a href="http://127.0.0.1:8000/page/login" style="font-family: NouvelRRegular;
                          margin: 28px auto;
                          height: 46px;
                          display: flex;
                          align-items: center;
                          justify-content: center;
                          width: 200px;
                          background-color: #646b52;
                          color: white;
                          text-decoration: none;">
            Cliquez Ici
        </a><br>

        <span style="font-family: NouvelRRegular;">Email :</span> <span style="font-family: NouvelRBold;">{{$email}}</span><br>
        <span style="font-family: NouvelRRegular;">Mot de passe :</span> <span style="font-family: NouvelRBold;">{{$password}}</span><br>

        <p style="font-family: NouvelRRegular;">Rendez-vous sur votre espace client pour finaliser les prochaines étapes de votre commande.</p>
    </div>
    <div class="footer" style="background-color: #646b52;
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





<!--
    <mjml>
  <mj-body background-color="#d6dde5">

    <mj-section background-color="#646b52">
      <mj-column width="30%">
        <mj-svg href="https://mjml.io" src="http://191n.mj.am/img/191n/3s/x4u.png" alt="Racoon logo" 		             align="left" padding="10px"></mj-svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 20" class="DaciaMainHeaderV2__logoSvg"><path d="M127.109 19.62h7.678V0h-7.678v19.62zM88.459 1.06 80.62 9.01c-.28.302-.431.54-.431.8 0 .259.15.496.431.799l7.838 7.952c.82.821 1.382 1.059 2.59 1.059h25.823v-6.634H93.036L89.668 9.81l3.368-3.176h23.836V0H91.05c-1.21 0-1.77.238-2.591 1.059zM28.413 18.562l7.838-7.952c.28-.303.431-.54.431-.8 0-.259-.15-.497-.431-.8l-7.838-7.95C27.593.238 27.031 0 25.823 0H0v6.634h23.836l3.368 3.176-3.368 3.177H0v6.634h25.822c1.21 0 1.77-.238 2.591-1.059zm141.605 1.059H180L161.173.448c-.3-.299-.536-.448-.794-.448-.257 0-.494.15-.794.448L140.758 19.62h9.897l9.66-9.939 9.703 9.939zm-102.37 0h9.982L58.804.448c-.3-.299-.537-.448-.795-.448-.257 0-.493.15-.794.448L38.39 19.62h9.896l9.66-9.939 9.703 9.939z"></path>
        </svg>
      </mj-column>
      <mj-column width="30%">
        <mj-image href="https://mjml.io" src="http://191n.mj.am/img/191n/3s/x4u.png" alt="Racoon logo" align="right" padding="10px"></mj-image>
      </mj-column>
    </mj-section>


    <mj-section padding-top="30px" background-color="#ffffff">
      <mj-column width="100%">
        <mj-text>
          <p>Félicitations aymane</p>
          <p> Votre espace personnel M-AUTOMOTIV a été créé avec succès, plus qu'une étape pour réserver votre voiture.</p>
          <p>Without further ado, let's dive into AI for medecine, sound recognition models and bo</p>
        </mj-text>

        <mj-button background-color="#000" color="#ffffff" font-size="16px" align="center" padding="15px 30px" border-radius="3px" href="https://mjml.io" padding-left="25px" padding-right="25px" padding-bottom="10px">SHOP NOW</mj-button>

        <mj-text>
          <p>Email :</p>
          <p>Mot de passe :</p>
          <p>Rendez-vous sur votre espace client pour finaliser les prochaines étapes de votre commande.</p>
        </mj-text>

      </mj-column>
    </mj-section>

    <mj-section background-color="#646b52" padding-bottom="20px" padding-top="20px">
      <mj-column>
        <mj-text align="center" color="#fff" font-size="13px" padding-left="25px" padding-right="25px" 											padding-bottom="0px" padding-top="0">
          <p style="font-size: 15px;font-weight: bold;">© M-AUTOMOTIV 2024</p>
          <p>Tous les droits sont réservés.</p>
          <p>Cet email automatique, merci de ne pas répondre.</p>
          <p>www.renault.m-automotiv.ma</p>
        </mj-text>
      </mj-column>
    </mj-section>

    <mj-section background-color="#fa8739" padding-bottom="20px" padding-top="0">
      <mj-column>
        <mj-social padding-top="20px">
          <mj-social-element name="facebook" href="[[SHORT_PERMALINK]]"></mj-social-element>
          <mj-social-element name="twitter" href="[[SHORT_PERMALINK]]"></mj-social-element>
          <mj-social-element name="google" href="[[SHORT_PERMALINK]]"></mj-social-element>
        </mj-social>
      </mj-column>
    </mj-section>

  </mj-body>
</mjml>
-->
