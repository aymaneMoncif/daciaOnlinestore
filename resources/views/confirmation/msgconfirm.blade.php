﻿    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="format-detection" content="telephone=no">
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <script src="../js/jquery.min.js"></script>
        <style type="text/css">
            #myTable tr:nth-child(even) {
                background: #f4f4f4
            }

            #myTable tr:nth-child(odd) {
                background: #fff
            }

            #myTable tr td {
                width: 200px;
                padding: 5px;
                border: 1px solid #ccc;
                text-align: left;
            }

            .tdgras {
                font-weight: bold;
                font-family: Calibri;
                font-size: 15px;
            }

            * {
                font-family: Calibri;
            }

            .buttonlg {
                background: #DF6537;
                border: 1px solid #DF6537;
                /*border-radius: 6px;*/
                width: 70px;
                height: 40px;
                color: #fff;
                font-family: calibri;
                font-size: 17px;
                margin-top: -5px;
                margin-left: 1px;
                text-align: center;
            }

            .buttonlghaut {
                background: #fff;
                border: 1px solid #fff;
                /*border-radius: 6px;*/
                width: 110px;
                height: 40px;
                color: #fff;
                font-family: calibri;
                font-size: 12px;
                /* margin-top: -5px;*/
                margin-left: 1px;
                text-align: center;
                color: #000;
            }

            .col-xs-12 {
                text-align: center;
            }

            .row {
                margin-top: 0px !important;
                margin-left: -20px !important;
            }
        </style>
        <script type="text/javascript">
            function msgnumerofr($idmsg) {
                var msg = "Transaction non aboutie. Merci de r&eacute;essayer.";
                switch (num) {
                    case "0":
                        msg = "Transaction effectu&eacute;e avec succ&egrave;s.L'accus&eacute; de paiement n'a pas &eacute;t&eacute; envoy&eacute;.";
                        break;
                    case "1ok":
                        msg = "Transaction effectu&eacute;e avec succ&egrave;s.<br/> Un accus&eacute; de paiement a &eacute;t&eacute; envoy&eacute;  &agrave;  l'adresse:<br/> ";
                        break;
                    case "2":
                        msg = "Transaction non aboutie. Merci de r&eacute;essayer.";
                        break;
                    case "3ko":
                        msg = "Transaction non aboutie. Merci de r&eacute;essayer.";
                }
                return msg;
            }
        </script>

        <script>
            function init() {
                var lg = 'FR';

                if (lg == "EN") {
                    $('#liengw').html("This page is unfortunately not available");
                } else {
                    $('#liengw').html("Cette page n'est malheureusement pas disponible");
                }

                var reg = /[?&]+([^=&]+)=?([^&]*)/gi,
                href = window.location.search;

                getUrlVars = function() {
                    var map = {};
                        href.replace(reg, function(match, key, value) {
                        key = decodeURIComponent(key);
                        value = value ? decodeURIComponent(value) : true;
                        map[key] ? map[key] instanceof Array ? map[key].push(value) : map[key] = [map[key], value] : map[key] = value;
                    });
                    return map;
                }

                getUrlVar = function(param) {
                    var reg = new RegExp("&" + param + "=([^&]*)", "gi"),
                    res;
                    href.replace(reg, function(match, value) {
                        value = value ? decodeURIComponent(value) : true;
                        res ? res instanceof Array ? res.push(value) : res = [res, value] : res = value;
                    });
                    return res;
                }

                c = '';
                o = getUrlVars();


                var dataent = o['idmsg'];
                var emailent = o['email'];


                var data = "<?php echo $idmsg; ?>";
                var email = "<?php echo $email; ?>";

                if (data.indexOf('1ok') != -1 && data.length == 3) {
                    $('#liengw').html(msglg(data) + "<u>" + email + "</u>");
                    $('#iconload').hide();
                    $('#iconvalid').show();
                    $('#detailtrs').show();
                    $('#bttntelech').show();
                    $('#bttnexit').show();
                    $('#iconerror').hide();
                    $('#iconops').hide();
                } else {
                    if (data.indexOf('3ko') != -1 && data.length == 3) {
                        $('#liengw').html(msglg(data));
                        $('#iconload').hide();
                        $('#iconvalid').hide();
                        $('#detailtrs').hide();
                        $('#bttntelech').hide();
                        $('#bttnexit').hide();
                        $('#iconerror').show();
                        $('#iconops').hide();
                    } else {
                        if (lg == "EN") {
                            $('#liengw').html("This page is unfortunately not available");
                        } else {
                            $('#liengw').html("Cette page n'est malheureusement pas disponible..");
                        }
                        $('#iconload').hide();
                        $('#iconops').show();
                        $('#iconerror').hide();
                        $('#iconvalid').hide();
                    }
                }
            }
            window.onload = init;
        </script>

        <style type="text/css">
            @media screen and (max-width: 992px) {
                body {
                    /* position: fixed;*/
                    font-size: 27px !important;
                }

                #footer {
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

                #bttneng {
                    margin-right: 0px !important;
                }

                #powerlog {
                    margin-right: 0px !important;
                }

                #divlng {
                    text-align: right !important;
                }

                .tdgras {
                    font-size: 22px !important;
                }

                #rowpadding {
                    padding: 15px !important;
                }
            }

            @media screen and (max-width: 600px) {
                body {
                    /* position: fixed;*/
                    font-size: 27px !important;
                }

                #footer {
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

                #bttneng {
                    margin-right: 0px !important;
                }

                #powerlog {
                    margin-right: 0px !important;
                }

                #divlng {
                    text-align: right !important;
                }

                .tdgras {
                    font-size: 22px !important;
                }

                .resp {
                    font-size: 24px !important;
                }

                .respp {}

                #rowpadding {
                    padding: 15px !important;
                }
            }
        </style>

    </head>

    <body style="height: 100%;width: 100%; overflow: hidden;overflow-y: scroll !important;">
        <div class="container-fluid" style="width: 100% !important;" id="contenu">
            <div class="row" style="background: #000;padding-top: 25px;padding-bottom: 25px;">
                <div class="col-xs-12 col-md-4">
                </div>
                <div class="col-xs-12 col-md-4">
                </div>
                <div class="col-xs-12 col-md-4 col-md-offset-6">
                    <img src="../images/poweredBy.png" style=" float: right;" id="powerlog">
                </div>
            </div>
            <div class="row" style="background:#df6537; padding:5px">
                <div class="col-xs-12">
                </div>
            </div>

            <br><br>

            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2" style="text-align:left;">
                </div>
            </div>
            <div class="row" style="/*margin-top:40px*/">
                <div class="col-xs-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <form name="frm1" id="frm1" method="POST" style="margin-bottom: 27px;">
                        <div id="contenu" style="margin-top: 50px;border-radius: 5px;padding-left: 50px;box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding-right: 50px;margin: 0 auto;text-align: center;vertical-align: center;/* font-size: 16px; */padding-top: 10px;padding-bottom: 10px;">
                            <img src="../images/valide.png" style=" display:none;width: 40px; height: 40px; " id="iconvalid">
                            <img src="../images/close.png" style=" display:none;width: 40px; height: 40px; " id="iconerror">
                            <img src="../images/ops.png" style=" display:none; width: 40px; height: 40px; " id="iconops">
                            <img src="../images/loading3.gif" style="  width: 100px; height: 80px; " id="iconload">
                            <br /><br />
                            <p id="liengw" style=" width: 60%;margin: 0 auto;font-size: 20px ; font-family: calibri; /* margin-top: 54px; */ " class="resp">Traitement en cours. Veuillez patienter</p>
                            <br />
                            <div id="detailtrs" style=" display:none;">


                                        <!-- version Fr -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <table id="myTable" style="    border: 1px #0000003d solid; margin-bottom:20px;    float: left;" class="col-xs-12 col-md-12 col-lg-12">
                                                    <tr>
                                                        <td class="tdgras">Nom et <?php echo utf8_encode("Pr&eacute;nom") ?> </td>
                                                        <td><?php echo $_SESSION['nomprenom']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras">Email </td>
                                                        <td><?php echo $_SESSION['emailrd']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras"><?php echo utf8_encode("Commer&ccedil;ant "); ?></td>
                                                        <td><?php echo $_SESSION['nom_cmr']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras"><?php echo utf8_encode("N&deg; commande "); ?> </td>
                                                        <td style=""><?php echo $_SESSION['id_commande']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras"><?php echo utf8_encode("N&deg; transaction "); ?> </td>
                                                        <td><?php echo $_SESSION['numTrans']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras"><?php echo utf8_encode("N&deg; autorisation "); ?> </td>
                                                        <td><?php echo $_SESSION['numautorisation']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras">Date et Heure transaction </td>
                                                        <td><?php echo $_SESSION['dateTran'] . " - " . $_SESSION['heureTrans']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras"><?php echo utf8_encode("Num&eacute;ro de carte "); ?></td>
                                                        <td><?php echo $_SESSION['numCarte']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras">Type de carte </td>
                                                        <td><?php echo $_SESSION['typecarte']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="tdgras">Montant TTC</td>
                                                        <td><?php echo str_replace(",", " ", $_SESSION['montant']) . " DH "; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <br />
                                            <p style="font-size: 20px ;font-family: Calibri;" class="resp"><?php echo utf8_encode("Merci d'avoir utilis&eacute; la solution de paiement e-commerce by NAPS"); ?></p>
                                        </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" style="height: 130px;">
                <div class="col-xs-12 col-md-4 col-md-offset-5 col-lg-4 col-lg-offset-5">

                    <!--  <a href="<php echo URL . "pdf/recu.php" ?>" ><button class="buttonlg" class="resp" id="bttntelech" style="display:none;float: right;    width: 130px;border-radius: 20px;" onclick="">
                     echo "Download";
                    else echo "T&eacute;l&eacute;charger";  ?> --></button>
                    </a>
                    <a href="#"><button class="buttonlg" class="resp" id="bttnexit" style="display:none;float: right;width: 130px;border-radius: 20px;margin-right: 10px;" onclick="window.location.href='../index.php';">
                            <?php echo "Retour au site";  ?>
                        </button>
                    </a>
                    <br /><br />
                </div>
            </div>
            <div style="    bottom: -20px;/*height: 150px*/;position: fixed;width:100%;" id="footer">
                <div class="row" style="padding: 0px;" id="rowpadding">
                    <div class=" col-xs-4 col-xs-offset-2 col-md-4 col-md-offset-2" style="/*padding-bottom: 25px;*/">
                    </div>
                    <div class=" col-xs-2 col-md-2 col-lg-2">
                    </div>
                    <div class=" col-xs-0 col-md-1">
                    </div>
                    <div class="col-xs-2 col-md-2">
                    </div>
                </div>
                <br />
                <div class="row" style="background: #000;padding-top: 25px;padding-bottom: 25px;">
                    <div class="col-xs-4 col-md-2 col-md-offset-2 ">
                        <p style="color:#fff;font-size: 15px !important;font-family: calibri; ">
                            <img src="../images/logosMaster.png" style="height:25px;">
                        </p>
                    </div>
                    <div class="col-xs-4 col-md-4" style="color:#fff;text-align: center;">

                        Copyright &copy; 2019 <img src="../images/logo_naps_footer.png"> <br />All right reserved
                    </div>
                    <div class="col-xs-2 col-xs-offset-2 col-md-3 col-md-offset-1">
                        <p style="   ">
                            <a href="https://www.naps.ma" target="_blank" style="color:#fff; font-size: 17px !important;font-family: calibri;">
                                www.naps.ma
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
        function changelg(lg) {
            jQuery.ajax({
                type: "POST",
                url: 'changelang.php',
                data: 'lang=' + lg,
                success: function(msg) {
                    window.location.reload();
                    //   $(this).css('text-decoration', "underline");
                }
            });
            var langg = 'fr';
            // alert(langg);
        }
    </script>
    <script>
        // $(document).ready( setfooter );

        // $(window).resize(function()
        // {
        //         setfooter();
        // });

        // function setfooter()
        // {
        //         if ( $(window).height() > $("#contenu").outerHeight( true ) )
        //         {
        //                 footertop = $(window).height() - $("#footer").outerHeight( true );
        //         }
        //         else
        //         {
        //                 footertop = $("#contenu").outerHeight( true );
        //         }

        //         $("#footer").css('margin-top', footertop + "px");
        // }
    </script>

</html>