/**API MXGATEWAY
 @name tramegatewaynaps.js
 @author M2MGroup raziki/lfriche
 @version 1.0.0 (2019-05-28)
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
function MXGateway(cmr, galerie,clepub,langue="F", successURL="", failURL="", timeoutURL="",lien_paie ="https://pa2.naps.ma:8441/GW_PAIEMENT/faces/vues/paiement/gateway.xhtml") 

{
              this.cmr = cmr;
              this.galerie = galerie;
              this.clepub = clepub;
              this.successURL = successURL;
              this.failURL = failURL;
              this.timeoutURL = timeoutURL;
              this.lien_paie = lien_paie;
              this.langue = langue;
     
     /**
      @name : trame1
      @function 
      @param nomprenom : nom et prénom {String}
      @param idcommande : id commande {String}
      @param montant : montant {String}
      @param email : email {String}
      @return data1 : trame1  {String}
      @description de la fonction : préparation de la trame1 contenant les parametres précédents.
     **/
          this.trame1 = function(nomprenom, idcommande, montant, email) {
              this.nomprenom =nomprenom;
              this.idcommande=idcommande;
              this.montant=montant;
              this.email =email;

this.data1 = 'nomprenom='+nomprenom+'&idcommande='+idcommande+'&montant='+montant+'&email='+email+'&langue='+this.langue+'&successURL='+this.successURL+'&failURL='+this.failURL+'&timeoutURL='+this.timeoutURL+'&fin';
 return this.data1;
};

 /**
      @name : trame2
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
        this.trame2 = function(tel, address, city, state, country="MA", postcode,recallURL,detailoperation) {
            this.tel =tel;
            this.address=address;
            this.city=city;
            this.state =state;
            this.postcode =postcode;
            this.recallURL=recallURL;
            this.detailoperation=detailoperation;
            
this.data2 = ""+'tel='+tel+'&address='+address+'&city='+city+'&state='+state+'&country='+country+'&postcode='+postcode+'&recallURL='+recallURL+'&detailoperation='+detailoperation+'&fin1'+""; 
  return this.data2;
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
      this.cryptageTrame1 = function(nomprenom, idcommande, montant, email) {
          var data1= this.trame1(nomprenom, idcommande, montant, email);
          var encrypt = new JSEncrypt();
          encrypt.setPublicKey(this.clepub);
          this.encrypteddata1 = encrypt.encrypt(data1);
 return this.encrypteddata1;
};

 /**
      @name : cryptageTrame2
      @function 
      @param tel : numéro de telephone {String}
      @param address : address {String}
      @param city : ville {String}
      @param state : state {String}
      @param country : pays {String}
      @param postcode : code post {String}
      @param recallURL : recall URL {String}
       @param detailoperation : detail operation  {String}
      
      @return encrypteddata2 : la trame2 cryptée {String}
      @description de la fonction : cryptage de la trame 2.
     **/
      this.cryptageTrame2 = function(tel, address, city, state, country="MA", postcode,recallURL,detailoperation) {
          var data2 = this.trame2(tel, address, city, state, country="MA", postcode,recallURL,detailoperation);
          var encrypt = new JSEncrypt();
          encrypt.setPublicKey(clepub);
          this.encrypteddata2 = encrypt.encrypt(data2);
 return this.encrypteddata2;
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
      @return lien_gateway : generation de lien de paiement {String}
      @description de la fonction : redirection vers la page de paiement MXGateway.
     **/
      this.generateLien = function(encrypteddata1, encrypteddata2) {
          
          this.lien_gateway = this.lien_paie+"?data="+encodeURIComponent(encrypteddata1)+"&data1="+encodeURIComponent(encrypteddata2)+"&cmr="+this.cmr+"&gal="+this.galerie;
                
 return this.lien_gateway;  
};
}








