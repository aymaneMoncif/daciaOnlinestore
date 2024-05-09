import { useContext, useEffect, useState } from 'react';
import '../style/createAccount.css';
import { DataContext } from '../contexts/dataContext';
import { axiosClient } from "../Api/axios";
import Loader from './elements/loader';

export default function CreateAccount(){

     //** Fetch CSRF token from Laravel backend **// 
    const context = useContext(DataContext);
    const { setCmptCreated } = useContext(DataContext);
    const [csrfToken, setCsrfToken] = useState('');
    const creationDone = context.cmptCreated;

    const [loading, setLoading] = useState(false);
    const[nom,setNom]= useState(context.guestInfo.nom);
    const[prenom,setPrenom]= useState(context.guestInfo.prenom);
    const[email,setEmail]= useState(context.guestInfo.email);
    const[tele,setTele]= useState(context.guestInfo.tele);
    const[ville,setVille]= useState(context.guestInfo.ville);
    const[testDrive,setTestDrive]= useState(context.guestInfo.testDrive);
    const [nomError, setNomError] = useState("");
    const [prenomError, setPrenomError] = useState("");
    const [villeError, setVilleError] = useState("");
    const [emailError, setEmailError] = useState("");
    const [teleError, setTeleError] = useState("");
    const [conditionsError, setConditionsError] = useState("");
    const [contactError, setContactError] = useState("");

    const [modele, setModele]=useState(context.modele);
    const [version, setVersion]=useState(context.version);
    const [color, setColor]=useState(context.color);
    const [equipement, setEquipement]=useState(context.equipements);
    const [pathfolder, setPathfolder] = useState(context.pathImages);
    const [prixTotal, setPrixTotal] = useState(null);

    //get the csrfToken
    useEffect(() => {
        const fetchCsrfToken = async () => {
            try {
                const response = await axiosClient.get('/api/csrf-token');
                setCsrfToken(response.data.csrfToken);
            } catch (error) {
                console.error('Error fetching CSRF token:', error);
            }
        };
        fetchCsrfToken(); 
    }, [context.userInfo]);
 
     //** validation of the inputs **//
     const handleRequiredChange = (e) => {
         const value = e.target.value;
         const name = e.target.name;
     
         if (name === 'nom') {
            setNom(value);
             if (value.length < 1) {
                 setNomError("Veuillez indiquer votre nom");
             } else {
                 setNomError("");
                 setNom(value);
             }
         } else if (name === 'prenom') {
            setPrenom(value);
             if (value.length < 1) {
                 setPrenomError("Veuillez indiquer votre prénom");
             } else {
                 setPrenomError("");
                 setPrenom(value);
 
             }
         } else if (name === 'ville') {
            setVille(value);
             if (value.length < 1) {
                 setVilleError("Veuillez indiquer votre ville");
             } else {
                 setVilleError("");
                 setVille(value);
             }
         }
         else if (name === 'acceptConditions') {
             const isChecked = e.target.checked;
             if (!isChecked) {
                 setConditionsError("Veuillez accepter conditions générales d'utilisation");
             } else {
                 setConditionsError("");
             }
         }
     };
     const handleTeleChange = (e) => {
         const value = e.target.value;
         setTele(value)
         if (!value.match(/^(06|07|05)\d{8}$/) || value.length !== 10) {
             setTeleError("Veuillez saisir un numéro de téléphone valide");
         } else {
             setTeleError("");
             setTele(value);
         }
     };  
     const handleEmailChange = (e) => {
         const value = e.target.value;
         setEmail(value);
         if (!value.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)) {
             setEmailError("Veuillez saisir un email valide");
         } else {
             setEmailError("");
             setEmail(value);
         }
     };
     //** END validation of the inputs **//
 
     const handleTestDriveChange = (e) => {
         setTestDrive(e.target.checked);
     };

    useEffect(() => {
        const FraisMatriculation = modele.fraisImmatriculation;
        const FraisMiseService = 3235;
        const carPrix = version.prixversion - version.remise;
        const colorPrix = color.pivot.prix;
        const pack_accessoires = parseInt(modele.pack_accessoires);
        const equipementPrix = Object.keys(equipement).length > 0 ? (
            Object.keys(equipement).reduce((total, equipementId) => {
                const equipement1 = equipement[equipementId];
                return total + equipement1.pivot.prix; 
            }, 0)
        ) : 0; 

        let total;
        if(equipementPrix !== 0){
            total = (carPrix + colorPrix + equipementPrix + FraisMatriculation + FraisMiseService).toFixed(2);
        }else{
            total = (carPrix + colorPrix + equipementPrix + pack_accessoires + FraisMatriculation + FraisMiseService).toFixed(2);
        }

        setPrixTotal(total);
        
    }, [context.color, context.equipements, context.version]);

    const handelSubmitForm = async () => {
        const ClientInfo = {
            'nom': nom,
            'prenom': prenom,
            'email': email,
            'tele': tele,
            'ville': ville,
            'testDrive': testDrive,
        };
        
        try {
            const acceptConditionsCheckbox = document.getElementById('acceptConditions');
            const contactPermissionCheckbox = document.getElementById('contactPermission');
            
            // Check if checkboxes are checked
            if (!acceptConditionsCheckbox.checked) {
                setConditionsError("Veuillez accepter les conditions générales d'utilisation");
                setLoading(false);
                return;
            }
            if (!contactPermissionCheckbox.checked) {
                setContactError("Veuillez accepter d'être contacté par e-mail, SMS et Téléphone");
                setLoading(false);
                return;
            }
    
            //Proceed with form submission (create user)
            const newUserResponse = await axiosClient.post('/api/client', {
                name: nom,
                prenom: prenom,
                email: email,
                tele: tele,
                ville: ville,
                testDrive: testDrive,
            }, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });        
            setLoading(true);
            // Obtain the newly created user's ID (get the id of the user)
            const userId = newUserResponse.data.user.id;
            
            // Submit the form along with the user's ID (create commande)
            const formattedTotal = parseFloat(context.total);

            const response = await axiosClient.post('/api/Commande', {
                client_id: userId, 
                modele_id : context.modele.id,
                version_id : context.version.id,
                couleur_id : context.color.id,
                equipements : context.equipements,
                total : formattedTotal,
            },{
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            // Obtain the newly created user's ID (get the id of the commande)
            const commandeId = response.data.commande.id;

            if(Object.keys(context.simulateurInfo).length > 0){
                // Submit the form along with the user's ID (create simulateur)
                await axiosClient.post('/api/simulateur', {
                    type: context.simulateurInfo.type, 
                    apport : context.simulateurInfo.apport_per,
                    durree : context.simulateurInfo.duree,
                    taux : context.simulateurInfo.taux,
                    fraisdossier : context.simulateurInfo.frais_dossier,
                    mensualite : context.simulateurInfo.output.mensualite_all_inclusive,
                    command_id : commandeId,
                    client_id : userId,
                },{
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                });
            }
            
            setCmptCreated(true);
            setLoading(false);
        } catch (error) {
            // Handle errors
            if (error.response && error.response.data && error.response.data.errors) {
                const { errors } = error.response.data;
                // Update state variables for each error type
                setNomError(errors.nom ? errors.nom[0] : "");
                setPrenomError(errors.prenom ? errors.prenom[0] : "");
                setEmailError(errors.email ? errors.email[0] : "");
                setTeleError(errors.tele ? errors.tele[0] : "");
                setVilleError(errors.ville ? errors.ville[0] : "");
            } else {
                console.error('Error submitting form:', error);
            }
        }
    };
    
    return(
        <>
        <div className="row_1i">
            <div className="cardetailsAndCarousel">

            {creationDone == true?(
                <div className="todispear3">
                    <div className="felisitasion_part1">
                        <div className="emailsvg_Space">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" viewBox="0 0 100 100" width="50" height="50">
                                <defs>
                                    <style>
                                        {`.cls-1 {
                                            fill-rule: evenodd;
                                            stroke-width: 0px;
                                        }`}
                                    </style>
                                </defs>
                                <path className="cls-1" d="M7.96,80.54h84.81V19.37H7.96v61.17ZM15.88,76.13h68.98l-20.13-19.9,3.51-3.05,20.02,19.9V27.17c-13.8,12.67-23.18,19.9-36.19,28.38h-3.39c-13-8.48-22.39-15.72-36.19-28.38v45.91l20.02-19.9,3.51,3.05-20.13,19.9ZM50.37,51.03c11.99-7.8,22.5-15.83,34.83-27.25H15.54c12.32,11.42,22.95,19.56,34.83,27.25Z"/>
                            </svg>
                        </div>
                        <p className="title">
                            Félicitation ! <br />
                            Votre espace personnel a bien été créé.
                        </p>
                        <p className="sous-title">
                            Vous pouvez dès à présent consulter votre boîte mail <br />
                            à l'adresse suivante : <strong style={{color: 'black'}}>{email}</strong> pour <br />
                            activer votre espace et continuer votre achat.<br />
                        </p>
                    </div>
                    <div className="felisitasion_part2">
                        <p className="title">
                            Vous n'avez pas reçu d'e-mail d'activation ?
                        </p>
                        <button className="renvoiMailBtn">Renvoyer le mail</button>
                        <div className="remarque">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="50" height="50">
                                <path className="cls-1" d="M59.68,68.57h-18.62c-1.69-17.45-17.71-19.66-17.71-36.72,0-14.71,11.07-22.79,26.82-22.79s27.21,8.07,27.21,22.79c0,17.06-16.01,19.27-17.71,36.72ZM45.61,63.24h9.5c4.17-15.1,16.93-18.88,16.93-31.38s-8.33-17.58-21.87-17.58-21.48,5.47-21.48,17.58,12.76,16.28,16.93,31.38ZM41.06,79.51h18.49v-5.34h-18.49v5.34ZM41.06,89.02v-3.91h18.62v3.91c-2.47,1.17-5.86,1.82-9.37,1.82s-6.77-.65-9.24-1.82ZM50.3,24.82v-4.95c9.9,0,16.15,3.91,16.15,13.28h-5.08c-.39-6.51-4.56-8.33-11.07-8.33Z"/>
                            </svg>
                            <p>
                                Remarque : si vous ne recevez pas le mail <br />
                                de confirmation juste après votre <br />
                                inscription, veuillez vérifier dans votre boîte SPAM <br />
                                et nous ajouter à votre carnet d'adresses. <br />
                            </p>
                        </div>
                    </div>
                </div>
           
            ):(
           
                
            <div className="todispear3">
                <div className="titleOfForm">
                    <p className="title">Création de compte</p>
                    <p className="sous-title">Pour suivre votre création de compte, veuillez remplir les informations ci-dessous</p>
                </div>
                {
                 loading ? (
                    <Loader />
                    ) : (

                    <form >   
                        <input 
                            placeholder="Nom *" 
                            type="text" 
                            id="nom" 
                            name="nom" 
                            onChange={handleRequiredChange} 
                            value={nom}
                        />
                        {nomError && <span style={{color:'red',fontFamily: 'NouvelRRegular'}}>{nomError}</span>}
                        <input 
                            placeholder="Prénom *" 
                            type="text" 
                            id="prenom" 
                            name="prenom" 
                            onChange={handleRequiredChange} 
                            value={prenom} 
                        />
                        {prenomError && <span style={{color:'red',fontFamily: 'NouvelRRegular'}}>{prenomError}</span>}
                        <input 
                            placeholder="Email *" 
                            type="email" 
                            id="email" 
                            name="email" 
                            onChange={handleEmailChange} 
                            value={email} 
                        />
                        {emailError && <span style={{color:'red',fontFamily: 'NouvelRRegular'}}>{emailError}</span>}
                        <input 
                            placeholder="Téléphone *" 
                            type="tel" 
                            id="telephone" 
                            name="tele" 
                            onChange={handleTeleChange} 
                            value={tele}
                        />
                        {teleError && <span style={{color:'red',fontFamily: 'NouvelRRegular'}}>{teleError}</span>}
                        <input 
                            placeholder="Ville *" 
                            type="text" 
                            id="ville" 
                            name="ville" 
                            onChange={handleRequiredChange}  
                            value={ville}
                        />
                        {villeError && <span style={{color:'red',fontFamily: 'NouvelRRegular'}}>{villeError}</span>}


                        <div className="testDrive_container">
                            <input type="checkbox" id="testDrive_input" name="testDrive" onChange={handleTestDriveChange} checked={testDrive} />     
                            <label htmlFor="testDrive_input" className="checkbox_testDrive"></label>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="25" height="25" fill='#4E5844'>
                                <path className="cls-1" d="M69.14,69.14H30.86v5.01c0,1.84-1.63,3.38-3.47,3.38h-10.21c-1.84,0-3.27-1.53-3.27-3.38v-22.82c0-3.07,1.33-7.37,5.21-10.34l-5.41-2.35v-3.58h8.06c2.86-7.67,5.51-12.59,11.64-12.59h33.17c6.12,0,8.78,4.91,11.64,12.59h8.06v3.58l-5.41,2.35c3.88,2.97,5.21,7.26,5.21,10.34v22.82c0,1.84-1.43,3.38-3.27,3.38h-10.21c-1.84,0-3.47-1.53-3.47-3.38v-5.01ZM77.3,43.65H22.7c-2.14,1.13-4.63,5.42-4.63,7.68v22.1h8.61v-8.39h46.65v8.39h8.57v-22.1c0-2.25-2.45-6.55-4.59-7.68ZM30.96,59.21c-5.51-1.53-8.57-2.66-8.57-6.86v-4.5h12.55v3.68h-8.98v.41c0,1.33,0,1.94,5,3.48v3.79ZM65.97,26.57h-31.95c-4.8,0-6.74,4.2-9.19,13.1h50.32c-2.45-8.9-4.39-13.1-9.19-13.1ZM51.48,47.85l2.35,4.5-2.35,4.1h-3.27l-2.35-4.1,2.35-4.5h3.27ZM74.04,51.95v-.41h-8.98v-3.68h12.56v4.5c0,4.2-3.06,5.32-8.57,6.86v-3.79c5-1.53,5-2.15,5-3.48Z"/>
                            </svg>
                            <p className="testDrive">Je profite de mon test drive gratuit</p>
                        </div>
                                
                        <p className="note_label">* Champs obligatoires</p>

                        
                        <div className="checkbox_wrap" id="checkbox_wrap_lu">
                            <input className="input_condition" type="checkbox" id="acceptConditions" name="acceptConditions" required="" />
                            <label htmlFor="acceptConditions" className="label">J'ai lu et j'accepte les conditions générales d'utilisation <span className="lireSpan">
                                <a className="linkcondition" href="https://renault.m-automotiv.ma/pages/informations_legales?/fr/pages/informations_legales">( Lire )</a></span> 
                            </label>
                            {conditionsError && <span style={{color:'red',fontFamily: 'NouvelRRegular'}}>{conditionsError}</span>}
                        </div>

                        <div className="checkbox_wrap" id="checkbox_wrap_sms">
                            <input className="input_condition" type="checkbox" id="contactPermission" name="contactPermission" required="" />
                            <label htmlFor="contactPermission" className="label">
                                <p>
                                    J’accepte d’être contacté par e-mail, SMS et Téléphone
                                    pour recevoir les offres et promotions relatives aux
                                    services et produits Renault de la part de Renault Maroc,
                                    de ses filiales et des membres de son réseau commercial.
                                </p>
                            </label>
                            {contactError && <span style={{color:'red',fontFamily: 'NouvelRRegular'}}>{contactError}</span>}
                        </div>
                            
                            <button type='button' className="creatButton" id="submitForm" onClick={handelSubmitForm}>Créer mon compte</button>
                    </form>
                )}
            </div>
            
            )}
    

            

                {/*<!-------section DETAILS--------->*/}
                <div className="carDetails">
                    <div className="recapitulatif">
                        <p>Récapitulatif</p>
                    </div>
                    <div className="version2">
                        <img src={`http://localhost:8000/storage/${version.image.replace(/\\/g, '/')}`} alt="" />
                        <p className="title">Version</p>
                        <div className="nomComplet_prix">
                            <p className="nomComplet">{version.nomversion}</p>
                            <p className="prix">{version.prixversion} DHS</p>
                        </div>
                    </div>

                    <div className="remise">
                        <p className="title">Remise</p>
                        <div className="remisename_prix">
                            <p className="remisename">Remise spéciale web</p>
                            <p className="prix">-{version.remise} DHS</p>
                        </div>
                    </div>

                    <div className="design">
                        <p className="title">Design extérieur</p>
                        <div className="nomComplet_prix">
                            <p className="nomComplet"><strong>Couleur</strong> <br /> {color.nomcouleur}</p>
                            <p className="prix">+{color.pivot.prix} DHS</p>
                        </div>
                    </div>

                    <div className="equipement">
                        <p className="title">Accessoires</p>
                        <div className='equip_zone'>
                            {Object.keys(equipement).length > 0 ? (
                                <>
                                    {Object.keys(equipement).map((equipementId, index) => {
                                        const equipement1 = equipement[equipementId];
                                        return (
                                            <div className="nomComplet_prix_EQIP" key={index}>
                                                <p className="nomComplet">{equipement1.nomequipement}</p>
                                                <p className="prix">+{equipement1.pivot.prix} DHS</p>
                                            </div>
                                        );
                                    })}
                                </>
                            ) : (
                                <div className="nomComplet_prix_EQIP">
                                    <p className="nomComplet">Pack Accessoires</p>
                                    <p className="prix">+{modele.pack_accessoires} DHS</p>
                                </div>
                            )}
                        </div>
                    </div>

                    <div className="Frais">
                        <div className="nomComplet_prix">
                            <p className="nomComplet">Frais d'immatriculation</p>
                            <p className="prix">+{modele.fraisImmatriculation} DHS</p>
                        </div>
                    </div>

                    <div className="Frais">
                        <div className="nomComplet_prix">
                            <p className="nomComplet">Frais de mise en service</p>
                            <p className="prix">+3 235 DHS</p>
                        </div>
                    </div>

                    <div className="totalPrix">
                        <p className="title">Prix total</p>
                        <div className="nomComplet_prix">
                            <p className="partirde">à partir de :</p>
                            <p className="prix">{prixTotal ? prixTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') : 'wrong!'} DHS</p>
                        </div>
                    </div>

                </div>
                {/*<!-------ENDsectionDETAILS-------->*/}
            </div>
        </div>
        </>
    )
}