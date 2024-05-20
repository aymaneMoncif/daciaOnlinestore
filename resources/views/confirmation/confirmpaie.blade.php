@extends('layout')

@section('headScript')
    <script type="text/javascript" src="{{asset('scripts/api/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('scripts/api/jsencrypt.js')}}"></script>
    <script type="text/javascript" src="{{asset('scripts/api/tramegatewaynapsv4.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript">
        function msgnumero(num){
            var msg="";
            switch (num) {
                case "0":
                    msg = "Une erreur est survenue.Vérifier vos données.";
                    break;
                case "1":
                    msg = "Un mail contenant les détails de paiement vous a été envoyé.";
                    break;
                case "2":
                    msg = "Une erreur est survenue. Veuillez Vérifier vos données.";
                    break;
                case "3":
                    msg = "Le paiement n'est pas effectué,Veuillez réessayer.";

            }
            return msg;
        }
    </script>

    <script >
        var  l="";
        var email="";
        function init() {
            var reg = /[?&]+([^=&]+)=?([^&]*)/gi,
            href = window.location.search;

            getUrlVars = function(){
                var map = {};
                href.replace(reg, function(match, key, value) {
                    key = decodeURIComponent(key);
                    value = value ? decodeURIComponent(value) : true;
                    map[key] ? map[key] instanceof Array ? map[key].push(value) : map[key] = [map[key], value] :  map[key] = value;
                });
                return map;
            }

            getUrlVar = function(param){
                var reg = new RegExp("&"+param+"=([^&]*)", "gi"),
                res;
                href.replace(reg, function(match, value) {
                    value = value ? decodeURIComponent(value) : true;
                    res ? res instanceof Array ? res.push(value) : res = [res, value] :  res = value;
                });
                return res;
            }

            c = '';
            o = getUrlVars();

            //for (i in o) c+=' key:'+i+' value:'+decrytdata(o[i])+'\n';
            // alert(c);

            var data = o['data'];
            var cle_priv='MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDQgIULOTD0UQBX6SETTbdnEML/CwbwDYCfLtrhR49d9NYTX4ld4cihctfBcYdrwnKsTj1j0OhYciA0V09cVR+1Pz6B0jvmDYc8bbXXp3jLIAqlZ+pZmSZvGQ5rRRMScFk/RYRTy5AjpcopyIE+WsBfU72ZUeqgsELFQVLmKaDvEmYjJ5Ue1wdt3Z5orLg92aoTkaxB+e37HzndkkMDWJeHEkAvKWjZHl1XTrjh+KNLkjO/I3x1DRQmbK/Qe7dguhbBUfSR9eESGb8prd1dbWtxGd8CtHvmsP5yfj3CmBdJu0Vao/RY66N2XTuWrZTbXs7tUWcq95EgOTp0OzILTzB3AgMBAAECggEAXUEeQGbT/nI8NRWQNZIM9YwJqwjDkZp4bLoIK7pV5TAcj42rYtIZahxzY5Hjf874exiDXKGTSfvBa6ehVyq7g9VFn8rn/30Nf3mSW2IMJM2v9UsFBg35orcSO+gpH5YgVKxDAzeIwGjmgsmrBLiSUhCiPHDm//fV5WPSMB9uW36QR4rCq1oo1oXug1idSTk0vs5kU1VvqTs2HK3atjUAEbSpbKJmh/thyEP9nkiB3NG3uu+GFMns9AmOpRyWY7YvoN8Y3oJfQl7igYOKgVqlqZOF3fyY54PR2WMR3xCUrWUzFU4WtD4tsdJl53AfeRz7i0lVBXVzu4kgSAg8mmO4AQKBgQDyfEXAMaR1AgmzXzz95nRhIzxL+c5KVR7nrggfRO2rTuQbaYQfe6fcO2vQdfoiASr1q/9r8n/pT6UZE1H09sT8CJzYJRklF3R2xD8McBKmNnmEoAa5H7tgaLxj6Gac9gtHwOUYfiKy3R4RKi60mOCvmaShQIlkSEChRd4uu52iKQKBgQDcH2EvARFq3pA9rkPYOrFR86jpfVNMdqzDcb2jbcqWpCgJpszOBod3kywUR5vZR3ABmPJPEy4hWsZyjvOUk8TdmCjeZwjpNng+nG/UPPXRfTOAhU/vvKW+wt36z9TMgrFiQonu1rCbxxR6aGP8Z/kw3JNWjhygrYSnAUsWA2TRnwKBgBK6spCDxRYckC9Ane9mi3qtRA0CQILRTE/My2fO5SSkNU5AuinMXUzPciZp1mYl/PF41YO6+VJGCpSDP4NSRCjLaYHwa57HzwEVa2FEjswzzPMHgT1vTAPIUzTMUJCzGG/0YD2iEIAMQDRHM9BTNpeZoHOsDnCmfAd45A5sA2LxAoGATED2mqDlFr94+lUXHZ3fdYNSHWiT5aYq3R3W0vmit6KwV/+XbTunzA2ItJHF9HQh4fvI3QnI7jcTDfZlfS/ff+BJMBpDZP7AkvgAaWagxWx43enQsj0IsdexrEQ49IvFxUNFox5uWdiSSIFHOdYO5hVTWSWr1yGlFXGGQF72mwMCgYAnVcA6desT8L3U/bSx/J2KwkIK9vz34xsi46pDAiSB9OtydSVyLBE+GVTnJarnToBALVsAj52im6mlmkuy1vdQVF4hYjTEw6Y556ocbapPdRkuR0U4x9Bof5XFELwQ5LJuMZjh+LBdFjwmZ9qqYjDycafkEo2U3z26KaPy1ChSIg==';
            var mxgateway= new MXGateway("2240803 ", "0190");
            var dataencrypt=mxgateway.decryptage(data,cle_priv);

            var tab =dataencrypt.split("&");

            c="<br/></br><center><table><th style='text-align: left;'>Clé</th><th  style='text-align: left;'>Valeur</th>";
                var signature = ""; // Declare signature variable only once
                var email = ""; // Declare email variable only once

                for (v in tab) {
                    var element = tab[v].split("=");

                    if (element['0'] == "email") {
                        email = element['1'];
                    }
                    if (element['0'] == "numTrans") {
                        signature = element['2'];
                    }
                    c += "<tr><td width='200px' style='color: #4D4DA0; font-weight: bold;'><label>" + element['0'] + " </label></td><td><label name='" + element['0'] + "'>" + element['1'] + "</label></td></tr>";
                    l += element['0'] + "=" + element['1'] + "&";
                }

                c += "</table></center>";

                var codecmr = '<?php echo $codecmr; ?>';

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Function to send AJAX request
                function sendAjaxRequest(csrfToken) {
                    $.ajax({
                        type: "POST",
                        url: "envoimailconfirmation",
                        data: l + 'codecmr=' + codecmr + '&signature=' + signature,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Use the correct header for CSRF token
                        },
                        success: function (response) {
                            console.log("response :", response);
                            if (response == '1ok') {
                                // Construct URL with email variable
                                var redirectUrl = `msgconfirm/1ok/${email}`;
                                window.location.href = redirectUrl;
                            } else {
                                window.location.href = "msgconfirm?idmsg=3ok";
                            }
                        }
                    });
                }

            // Get CSRF token from cookies and then make AJAX request

            if (csrfToken) {
                sendAjaxRequest(csrfToken);
            } else {
                console.error('CSRF token not found in cookies.');
            }
        }
        window.onload = init;
    </script>
@stop

@section('popUp')
<!-------------------------------------------------------->
<div class="overlay"></div>
<div class="popUp_commandeValid">
    <div class="close">
        <a href="/">X</a>
    </div>

    <div class="dot-spinner" id="loader">
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
        <div class="dot-spinner__dot"></div>
    </div>

    <p id="liengw" style="margin: 0 auto;font-size: 20px !important; font-family: DaciaBlock;">
        Traitement en cours. Veuillez patienter.
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
