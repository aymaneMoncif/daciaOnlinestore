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
            var cle_priv='MIIEuwIBADANBgkqhkiG9w0BAQEFAASCBKUwggShAgEAAoIBAQCHari+KpDDNVYIpPUpE++yKLESg2bx2D3mATuHg5RW4RGn1ywspgcz0j0RpD9JRjCAEEsc6yWl7mpu9ffHWgBySw7kFPxJgea1uBSkfXJmNxTWUjb8zerJFRvTc1BoXq+DEI4saUukNCp2DSPGXjJINi7dtwxC2jonZ5ECcg8hmQL+HgZAzCEGF4UQd/u4wKqPy42Q1/nJTUmz39iPwUZtLV9JjBDVlDsmv3h5SEK5OCMUphTEPXxAg+BgSdhuKviYpqC2cXx+/dLX4I6xWVReSLHvsoZblJgxt4kli05VOzX8Kv7/x4dF/lqXnbj1uKc4nFYuQA2mxm0s0jrSL1RRAgMBAAECggEAd/HWm1JWkSGwB84c/PqUqGiUl0Jer76K7SyQTvMENIP8wH69uPqCjKsevn6OM9gA454K+h1qZnQsQAaMJz6YAKRtFydjY7S05qabWitnZhRJ16BQ5lF6MgwJbpzITvn3Wg8S71GA13wBVDlFQ9JxlTaxAl+9c4WaVwbMEa93qZh0h/epXTffnRTHpBHeyRU/56KeKs5FfNokOrzTq7tH86SaiiMsRHTNu2us52OnA/jVDSx+UN9h2wWwCpn+9G/HKwZOZCur0DinjqKwXqEt9YPUuiHwgm3FjfMq1PuvNS6qwUG8KyUeVANsq4429BLtJcD40jF38mqynAl4sUfm8QKBgQDJhfa3KFUXC52MvlIqaoKOAxVA22fST2AH62lKi+HKgNSqJlOYzPozSHEqSAgGEIJl7ICC0wOoPcEWKrm0AdzejXC6s0C8z40b95n0NsCg1NJNaRR535AU4e6hk2frl34dIdPudn6HnwWuJuc/IB6i6VuBslkavmJ7zKJQYogDdQKBgQCsBf1B7Fh7fCTX/KgEQ6CfqDTh9zHWsk+mTWC8gOuwKSrvRtHl0uinD9+MsQscisrt3bGPpJ2ThmYltmKnhg1fXLKawunVv9W5OJBzMm/BcpoDAHSt8/mBZ0CBrhQApy1kEkMSZvpcUyZ7e/V/eTzaalSdjk3YC+tifsDD/8R97QKBgQCERbHSNl7jaXRX1PQJcy+OFuf0Ug6rM/5MNHA/xeDGEhmENPPZ73CqCHp+zhi2Ik/0pm8Tb32PCDmcWx7Y0AAw85VydgWf6HsuSC585RM6fXYr6TTPabYgfssqsp4bPKxCYtnAQ3Z5fh80V8Sg4mw5cgHl9zIVI7FwoLhJGuM7oQJ/evfNElLg7WTQ8ZSqhmHRcE/Nfbo25kKQrVCi1h1SXZsQFfuKD7+0j7fJFcl5J+4PIfpX81a5TbvFSTAXVal95a1d/0NV5HY9USoeGDr1qFNDxOGOhsrgkKA+fHTz14Op7t8fEwiJ73WBDMSPuY/w8DESS45uFwJuQPpa0cEDtQKBgGU3JzakWLGXJJGGtiY0r9iDM7BHdX/on2oye9WBZIUhqrYkIHYO8iz+eHmGQ3z320lLuJ9qsfWBXy8jw5tq2xMGwXoqsxETBnmoHWCejTarpiOLqg5OZnfvHSp4RhBSTN011NXVG1oCvaNL84Dr2OBgtZEg0sdwXVgozobu7pJY';
            var mxgateway= new MXGateway("1010101 ", "9999");
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
            <form method="POST" action="{{ route('logoutUser') }}">
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
