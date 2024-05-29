/**API MXGATEWAY
 @name tramegatewaynaps.js
 @author M2MGroup raziki/lfriche
 @version 4.0.0 (2020-03-30)
 **/


 /**
 @ Class MXGateway
 @name : MXGateway
 @param  cmr :code commerçant {numerique}
 @param  galerie : galerie commerçant {numerique}
 @param  clepub : la clé publique {String}
 @param  langue : la langue {String}
 @param  successURL : success URL {String}
 @param  failURL : faild URL {String}
 @param  timeoutURL : time out {String}
 @param  lien_paie : lien de paiement {String}
**/
function MXGateway(cmr, galerie,clepub,langue="F",lien_paie ="https://pa2.naps.ma:8441/GW_PAIEMENT/faces/vues/paiement/gatenaps.xhtml")

{
              this.cmr = cmr;
              this.galerie = galerie;
              this.clepub = clepub;
              this.lien_paie = lien_paie;
              this.langue = langue;

     /**
      @name : trame1 :data1 = nomprenom=&idcommande=&montant=&email=&langue=&detailoperation=&fin1;
      @function
      @param nomprenom : nom et prénom {String}
      @param idcommande : id commande {String}
      @param montant : montant {String}
      @param email : email {String}
      @return data1 : trame1  {String}
      @description de la fonction : préparation de la trame1 contenant les parametres précédents.
     **/
        this.trame1 = function(nomprenom, idcommande, montant, email,detailoperation) {
              this.nomprenom =nomprenom;
              this.idcommande=idcommande;
              this.montant=montant;
              this.email =email;
               this.email =email;
              this.detailoperation=detailoperation;

            this.data1 = 'nomprenom='+nomprenom+'&idcommande='+idcommande+'&montant='+montant+'&email='+email+'&langue='+this.langue+'&detailoperation='+detailoperation+'&fin1';

            return this.data1;
        };


     /**
      @name : trame2 :data2= successURL=&timeoutURL=&fin2;
      @function
      @param successURL : Success URL {String}
      @param timeoutURL : Timeout URL {String}

      @description de la fonction : préparation de la trame2 contenant les parametres précédents.
     **/
        this.trame2 = function(successURL, timeoutURL) {
              this.successURL =successURL;
              this.timeoutURL=timeoutURL;


            this.data2 = 'successURL='+successURL+'&timeoutURL='+timeoutURL+'&fin2';

            return this.data2;
        };

  /**
      @name : trame3 : data3= failURL=&recallURL=&fin3;
      @function
      @param recallURL : Recall URL {String}
      @param failURL : Fail URL {String}

      @description de la fonction : préparation de la trame2 contenant les parametres précédents.
     **/
        this.trame3 = function(failURL, recallURL) {
              this.failURL =failURL;
              this.recallURL=recallURL;


            this.data3 = 'failURL='+failURL+'&recallURL='+recallURL+'&fin3';

            return this.data3;
        };

 /**
      @name : trame4 data4 = tel=&address=&city=&state=&country=&postcode=&fin4;

      @function
      @param tel : numéro de telephone {numérique}
      @param address : addresse {String}
      @param city : ville {String}
      @param state : state {String}
      @param country : pays {String}
      @param postcode : code postal {String}
      @param  recallURL : recall URL {String}
      @param  detailoperation : operation detail {String}

      @return data2 : trame2  {String}
      @description de la fonction : préparation de la trame2 contenant les parametres précédents.
     **/
        this.trame4 = function(tel, address, city, state, country="MA", postcode) {
            this.tel =tel;
            this.address=address;
            this.city=city;
            this.state =state;
            this.postcode =postcode;

            this.data4 = ""+'tel='+tel+'&address='+address+'&city='+city+'&state='+state+'&country='+country+'&postcode='+postcode+'&fin4'+"";
            return this.data4;
        };

 /**
      @name : cryptageTrame1
      @function
      @param nomprenom : nom et prénom {String}
      @param idcommande : id commande {String}
      @param montant : montant {String}
      @param email : email {String}
      @return encrypteddata1 : la trame1 cryptée {String}
      @description de la fonction : cryptage de la trame 1.
     **/
    this.cryptageTrame1 = function(nomprenom, idcommande, montant, email,detailoperation) {
          var data1= this.trame1(nomprenom, idcommande, montant, email,detailoperation);
          var encrypt = new JSEncrypt();
          encrypt.setPublicKey(this.clepub);
          this.encrypteddata1 = encrypt.encrypt(data1);
        return this.encrypteddata1;
    };

 /**
      @name : cryptageTrame2
      @function
      @param successURL : success URL {String}
      @param timeoutURL :  timeout URL {String}

      @return encrypteddata2 : la trame2 cryptée {String}
      @description de la fonction : cryptage de la trame 2.
     **/
    this.cryptageTrame2 = function(successURL, timeoutURL) {
          var data2= this.trame2(successURL, timeoutURL);
          var encrypt = new JSEncrypt();
          encrypt.setPublicKey(this.clepub);
          this.encrypteddata2 = encrypt.encrypt(data2);
        return this.encrypteddata2;
    };


 /**
      @name : cryptageTrame3
      @function
      @param failURL : fail URL {String}
      @param recallURL :  recall URL {String}

      @return encrypteddata3 : la trame3 cryptée {String}
      @description de la fonction : cryptage de la trame 3.
     **/
        this.cryptageTrame3 = function(failURL, recallURL) {
            var data3= this.trame3(failURL, recallURL);
            var encrypt = new JSEncrypt();
            encrypt.setPublicKey(this.clepub);
            this.encrypteddata3 = encrypt.encrypt(data3);
            return this.encrypteddata3;
        };

 /**
      @name : cryptageTrame4
      @function
      @param tel : numéro de telephone {String}
      @param address : address {String}
      @param city : ville {String}
      @param state : state {String}
      @param country : pays {String}
      @param postcode : code post {String}
      @return encrypteddata4 : la trame4 cryptée {String}
      @description de la fonction : cryptage de la trame 4.
     **/
        this.cryptageTrame4 = function(tel, address, city, state, country="MA", postcode) {
            var data4 = this.trame4(tel, address, city, state, country="MA", postcode);
            var encrypt = new JSEncrypt();
            encrypt.setPublicKey(clepub);
            this.encrypteddata4 = encrypt.encrypt(data4);
            return this.encrypteddata4;
        };
/**
      @name : decryptage
      @function
      @param trame_rep : trame de réponse{String}
      @param cle_priv : clé privée{String}
      @description de la fonction : décryptage de la trame  de réponse.
     **/
        this.decryptage = function(data,cle_priv) {
            var decrypt = new JSEncrypt();
            decrypt.setPrivateKey(cle_priv);
            var decryptdata= decrypt.decrypt(data);
            return decryptdata;
        };
/**
      @name : generateLien
      @function
      @param encrypteddata1 : la trame 1 cryptée {String}
      @param encrypteddata2 : la trame 2 cryptée {String}
      @param encrypteddata3 : la trame 3 cryptée {String}
      @param encrypteddata4 : la trame 4 cryptée {String}
      @return lien_gateway : generation de lien de paiement {String}
      @description de la fonction : redirection vers la page de paiement MXGateway.
     **/
        this.generateLien = function(encrypteddata1, encrypteddata2,encrypteddata3,encrypteddata4) {

            this.lien_gateway = this.lien_paie+"?data1="+encodeURIComponent(encrypteddata1)+"&data2="+encodeURIComponent(encrypteddata2)+"&data3="+encodeURIComponent(encrypteddata3)+"&data4="+encodeURIComponent(encrypteddata4)+"&cmr="+this.cmr+"&gal="+this.galerie;

            return this.lien_gateway;
        };
}








