<?php
 session_start();
 ini_set('display_errors', '0');
 function formatdate($date)
{
    $datecp=explode("-",$date);
    $datef=$datecp[2]."/".$datecp[1]."/".$datecp[0];
    return $datef;
}



$repauto=$_POST['repauto'];
$email=$_POST['email'];

$_SESSION['repauto']=$repauto;
$_SESSION['emailrd']=$email;

$montant=$_POST['montant'];
$id_commande=$_POST['id_commande'];

$_SESSION['nomprenom']=$_POST['nomprenom'];

$_SESSION['id_commande']=$_POST['id_commande'];

$numTrans=$_POST['numTrans'];
$numTrans = str_replace('signature',' ',$numTrans);
$_SESSION['numTrans']=$numTrans;

$nmtrx=$_POST['numAuto'];
$numtrx = str_replace('signature',' ',$nmtrx);
$_SESSION['numautorisation']=$numtrx;
$_SESSION['dateTran']=$_POST['dateTran'];
$_SESSION['heureTrans']=$_POST['heureTrans'];
$_SESSION["lg"]="fr";

$signature=$_POST['signature'];
$_SESSION['signature']=$signature;

$clepub="MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAh2q4viqQwzVWCKT1KRPvsiixEoNm8dg95gE7h4OUVuERp9csLKYHM9I9EaQ/SUYwgBBLHOslpe5qbvX3x1oAcksO5BT8SYHmtbgUpH1yZjcU1lI2/M3qyRUb03NQaF6vgxCOLGlLpDQqdg0jxl4ySDYu3bcMQto6J2eRAnIPIZkC/h4GQMwhBheFEHf7uMCqj8uNkNf5yU1Js9/Yj8FGbS1fSYwQ1ZQ7Jr94eUhCuTgjFKYUxD18QIPgYEnYbir4mKagtnF8fv3S1+COsVlUXkix77KGW5SYMbeJJYtOVTs1/Cr+/8eHRf5al5249binOJxWLkANpsZtLNI60i9UUQIDAQAB";
$msgahash=$id_commande.$clepub;
$hashagegenere=MD5($msgahash);

//type carte
$_SESSION['numCarte']=$_POST['numCarte'];
$typecrt = substr($_SESSION['numCarte'], 0, 1);
$bincart = substr($_SESSION['numCarte'], 0, 6);
$bincmi=array('505823','601506','601586','602586','604851','621983','627695','639412');
if (in_array($bincart, $bincmi))
{
  $_SESSION['typecarte'] = "CMI";
}else{
 switch ($typecrt) {
        case "4":
          $_SESSION['typecarte'] = "VISA";

          break;
        case "5":
          $_SESSION['typecarte'] = "MASTERCARD";

          break;
        case "6":
         $_SESSION['typecarte'] = "MAESTRO";
          break;
        default:
          $_SESSION['typecarte'] = "";
          break;
      }
    }

    $_SESSION['montant']=number_format($_POST['montant'],2);

$_SESSION['codecmr']=$_POST['codecmr'];
$date=date("Y-m-d H:i:s");
$codecmr=$_POST['codecmr'];




//echo $hashagegenere." == ".$signature;

 // if( $repauto == "00" && $hashagegenere == $signature ) // paiement ok
    if( $repauto == "91" && ($hashagegenere == $signature || $hashagegenere == "0".$signature) ) // paiement ok
    { //update BD
      //envoi mail
      //envoi SMS

      $_SESSION['idmsg']="1ok";
      echo "1ok";
    }
    else //paiement ko
    {
      //update BD
      $_SESSION['idmsg']="3ko";
      echo "3ko $repauto ";
    }

?>
