<?php
    ini_set('display_errors', '0');
    session_start();

    echo "<pre>";
    echo print_r($_REQUEST);
    echo "<pre>";

    if($_REQUEST)
    {
        $data=$_GET["data"];
        $codecmr=$_GET["codecmr"];
        $_SESSION['codecmr'] = $codecmr;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <script src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jsencrypt.js"></script>
    <script type="text/javascript" src="../js/tramegatewaynapsv4.js"></script>

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

            console.log(href);

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

            c='';
            o=getUrlVars();
            //for (i in o) c+=' key:'+i+' value:'+decrytdata(o[i])+'\n';
            // alert(c);

            var data =o['data'];
            var cle_priv='MIIEuwIBADANBgkqhkiG9w0BAQEFAASCBKUwggShAgEAAoIBAQCHari+KpDDNVYIpPUpE++yKLESg2bx2D3mATuHg5RW4RGn1ywspgcz0j0RpD9JRjCAEEsc6yWl7mpu9ffHWgBySw7kFPxJgea1uBSkfXJmNxTWUjb8zerJFRvTc1BoXq+DEI4saUukNCp2DSPGXjJINi7dtwxC2jonZ5ECcg8hmQL+HgZAzCEGF4UQd/u4wKqPy42Q1/nJTUmz39iPwUZtLV9JjBDVlDsmv3h5SEK5OCMUphTEPXxAg+BgSdhuKviYpqC2cXx+/dLX4I6xWVReSLHvsoZblJgxt4kli05VOzX8Kv7/x4dF/lqXnbj1uKc4nFYuQA2mxm0s0jrSL1RRAgMBAAECggEAd/HWm1JWkSGwB84c/PqUqGiUl0Jer76K7SyQTvMENIP8wH69uPqCjKsevn6OM9gA454K+h1qZnQsQAaMJz6YAKRtFydjY7S05qabWitnZhRJ16BQ5lF6MgwJbpzITvn3Wg8S71GA13wBVDlFQ9JxlTaxAl+9c4WaVwbMEa93qZh0h/epXTffnRTHpBHeyRU/56KeKs5FfNokOrzTq7tH86SaiiMsRHTNu2us52OnA/jVDSx+UN9h2wWwCpn+9G/HKwZOZCur0DinjqKwXqEt9YPUuiHwgm3FjfMq1PuvNS6qwUG8KyUeVANsq4429BLtJcD40jF38mqynAl4sUfm8QKBgQDJhfa3KFUXC52MvlIqaoKOAxVA22fST2AH62lKi+HKgNSqJlOYzPozSHEqSAgGEIJl7ICC0wOoPcEWKrm0AdzejXC6s0C8z40b95n0NsCg1NJNaRR535AU4e6hk2frl34dIdPudn6HnwWuJuc/IB6i6VuBslkavmJ7zKJQYogDdQKBgQCsBf1B7Fh7fCTX/KgEQ6CfqDTh9zHWsk+mTWC8gOuwKSrvRtHl0uinD9+MsQscisrt3bGPpJ2ThmYltmKnhg1fXLKawunVv9W5OJBzMm/BcpoDAHSt8/mBZ0CBrhQApy1kEkMSZvpcUyZ7e/V/eTzaalSdjk3YC+tifsDD/8R97QKBgQCERbHSNl7jaXRX1PQJcy+OFuf0Ug6rM/5MNHA/xeDGEhmENPPZ73CqCHp+zhi2Ik/0pm8Tb32PCDmcWx7Y0AAw85VydgWf6HsuSC585RM6fXYr6TTPabYgfssqsp4bPKxCYtnAQ3Z5fh80V8Sg4mw5cgHl9zIVI7FwoLhJGuM7oQJ/evfNElLg7WTQ8ZSqhmHRcE/Nfbo25kKQrVCi1h1SXZsQFfuKD7+0j7fJFcl5J+4PIfpX81a5TbvFSTAXVal95a1d/0NV5HY9USoeGDr1qFNDxOGOhsrgkKA+fHTz14Op7t8fEwiJ73WBDMSPuY/w8DESS45uFwJuQPpa0cEDtQKBgGU3JzakWLGXJJGGtiY0r9iDM7BHdX/on2oye9WBZIUhqrYkIHYO8iz+eHmGQ3z320lLuJ9qsfWBXy8jw5tq2xMGwXoqsxETBnmoHWCejTarpiOLqg5OZnfvHSp4RhBSTN011NXVG1oCvaNL84Dr2OBgtZEg0sdwXVgozobu7pJY';
            var  mxgateway= new MXGateway("1010101 ", "9999");
            var dataencrypt=mxgateway.decryptage(data,cle_priv);

            var tab =dataencrypt.split("&");
            c="<br/></br><center><table><th  style='text-align: left;'>Clé</th><th  style='text-align: left;'>Valeur</th>";
            var signature="";

            for(v in tab) {
                var element=tab[v].split("=");

                if (element['0']=="email") { email=element['1'];}
                if (element['0']=="numTrans") { signature=element['2']; }

                c+="<tr><td width='200px' style='color: #4D4DA0; font-weight: bold;'><label>"+element['0']+" </label></td><td><label name='"+element['0']+"'>"+element['1']+"</label></td></tr>";
                l+=element['0']+"="+element['1']+"&";
            }
            c+="</table></center>";

            var codecmr ='<?php echo $_SESSION['codecmr']; ?>';
            /*$.ajax({
                type: "POST",
                url: "envoimailconfirmation",
                data: l+'codecmr='+codecmr+'&signature='+signature,

                success: function(response){
                    if (response.indexOf('1ok') != -1) {
                        window.location.href="msgconfirm?idmsg=1ok&email="+email;
                    }else{
                        window.location.href="msgconfirm?idmsg=3ok";
                    }
                }
            });*/
        }
        window.onload = init;
    </script>


<style type="text/css">
@media  screen and (max-width: 992px){
    body{
    position: fixed;
    }
    #footer{
        bottom: 0;
        margin-top: 350px;
        position: fixed;
        bottom: 0;
        left: 0;
        height: 195px;
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
    }
    #bttneng{
        margin-right: 0px !important;
    }
    #powerlog{
        margin-right: 0px !important;
    }
    #divlng{
        text-align: right !important;
    }
}
</style>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
</head>

<body style="height: 100%;width: 100%; overflow: hidden;overflow-y: scroll !important;">
    <div class="container-fluid" style="width: 100% !important;"  id="contenu">
        <div  class="row"  style="background: #000;padding-top: 25px;padding-bottom: 25px;">
            <div class="col-xs-12 col-md-4">

            </div>
            <div class="col-xs-12 col-md-4">

            </div>
            <div class="col-xs-12 col-md-4 col-md-offset-6">
                <img src="../images/poweredBy.png" style=" float: right;" id="powerlog">
            </div>
        </div>
        <div  class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <form name="frm1" id="frm1" method="POST" style="margin-bottom: 100px;margin-top: 150px;" class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <div  id="contenu" style="border: 1px solid #dddddd;border-radius: 20px;box-shadow: 10px 10px 10px #f7f0f0;text-align: center;background: #FDFDFD !important;">
                        <br/><br/>
                        <img src="../images/loading3.gif" style=" max-height: 100px; " id="iconops" >
                        <br/><br/><br/>
                        <p id="liengw" style=" width: 60%;margin: 0 auto;font-size: 20px !important; font-family: calibri !important; /* margin-top: 54px; */ ">
                            Traitement en cours. Veuillez patienter.
                        </p>
                        <br/><br/>
                    </div>
                    <br/><br/>
                </form>
            </div>
        </div>

        <div style="    bottom: 0;height: 135px;position: fixed;width:100%;" id="footer">
            <div  class="row" style="padding: 15px;">
                <div class=" col-xs-4 col-xs-offset-2 col-md-4 col-md-offset-2" style="/*padding-bottom: 25px;*/">

                </div>
                <div class=" col-xs-2 col-md-2 col-lg-2">

                </div>
                <div class=" col-xs-0 col-md-1">

                </div>
                <div class="col-xs-2 col-md-2">

                </div>
            </div>
            <br/>
            <div  class="row"  style="background: #000;padding-top: 25px;padding-bottom: 25px;">
                <div class="col-xs-4 col-md-2 col-md-offset-2 ">
                    <p style="  color:#fff;font-size: 15px !important;font-family: calibri; ">
                        <img src="../images/logosMaster.png" style="height:25px;">
                    </p>
                </div>
                <div class="col-xs-4 col-md-4" style="color:#fff;text-align: center;">
                    Copyright &copy; 2019 <img src="logo_naps_footer.png"> All right reserved.
                </div>
                <div class="col-xs-2 col-xs-offset-2 col-md-3 col-md-offset-1">
                    <p>
                        <a href="https://www.naps.ma" target="_blank" style="color:#fff; font-size: 15px !important;font-family: calibri;">www.naps.ma</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
