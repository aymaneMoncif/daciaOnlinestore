import { useContext, useEffect, useState } from 'react';
import { axiosClient } from "../Api/axios";
import { DataContext } from '../contexts/dataContext';
import '../style/versionForm.css';


export default function VersionForm({selectedVersionImage, selectedRemiseType, handleStepDone}){

    const { setGuestInfo, updateSteps } = useContext(DataContext);
    const context = useContext(DataContext);
    const [csrfToken, setCsrfToken] = useState('');

    //get the csrfToken
    useEffect(() => {
        const isGuestInfoEmpty = Object.keys(context.guestInfo).length === 0;
        if (!isGuestInfoEmpty){
            handleStepDone('VersionForm');
        }
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


    //** Fetch CSRF token from Laravel backend **//
    const[nom,setNom]= useState("");
    const[prenom,setPrenom]= useState("");
    const[email,setEmail]= useState("");
    const[tele,setTele]= useState("");
    const[ville,setVille]= useState("");
    const[testDrive,setTestDrive]= useState(false);
    const [nomError, setNomError] = useState("");
    const [prenomError, setPrenomError] = useState("");
    const [villeError, setVilleError] = useState("");
    const [emailError, setEmailError] = useState("");
    const [teleError, setTeleError] = useState("");
    const [conditionsError, setConditionsError] = useState("");
    const [contactError, setContactError] = useState("");
    const [etape, setEtape] = useState("Fomulaire de remise");

    //** validation of the inputs **//
    const handleRequiredChange = (e) => {
        const value = e.target.value;
        const name = e.target.name;

        if (name === 'nom') {
            if (value.length < 1) {
                setNomError("Veuillez indiquer votre nom");
                setNom("");
            } else {
                setNomError("");
                setNom(value);
            }
        } else if (name === 'prenom') {
            if (value.length < 1) {
                setPrenomError("Veuillez indiquer votre prénom");
                setPrenom("");
            } else {
                setPrenomError("");
                setPrenom(value);

            }
        } else if (name === 'ville') {
            if (value.length < 1) {
                setVilleError("Veuillez indiquer votre ville");
                setVille("");
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
        if (!value.match(/^(06|07|05)\d{8}$/) || value.length !== 10) {
            setTeleError("Veuillez saisir un numéro de téléphone valide");
            setTele("");
        } else {
            setTeleError("");
            setTele(value);
        }
    };
    const handleEmailChange = (e) => {
        const value = e.target.value;
        if (!value.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)) {
            setEmailError("Veuillez saisir un email valide");
            setEmail("");
        } else {
            setEmailError("");
            setEmail(value);
        }
    };
    //** END validation of the inputs **//

    const handleTestDriveChange = (e) => {
        setTestDrive(e.target.checked);
    };

    const handleStepInsertion = () => {
        updateSteps('formulaire', 1);
    };

    const submitForm = async () => {
        const guestInfo = {
            'nom': nom,
            'prenom': prenom,
            'email': email,
            'tele': tele,
            'ville': ville,
            'testDrive': testDrive,
            'Etape': etape,
        };

        try {
            const acceptConditionsCheckbox = document.getElementById('acceptConditions');
            const contactPermissionCheckbox = document.getElementById('contactPermission');

            // Check if checkboxes are checked
            if (!acceptConditionsCheckbox.checked) {
                setConditionsError("Veuillez accepter les conditions générales d'utilisation");
                return;
            }
            if (!contactPermissionCheckbox.checked) {
                setContactError("Veuillez accepter d'être contacté par e-mail, SMS et Téléphone");
                return;
            }

            // Proceed with form submission
            const response = await axiosClient.post('/api/store-guest', {
                nom: nom,
                prenom: prenom,
                email: email,
                tele: tele,
                ville: ville,
                testDrive: testDrive,
                Etape: etape,
                modele: context.modele.nommodele,
                RemiseType: selectedRemiseType
            }, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
            // Extract ID from the response
            const userId = response.data.guest.id;

            const updatedGuestInfo = { ...guestInfo, id: userId };

            setGuestInfo(updatedGuestInfo);
            handleStepDone('VersionForm');
            handleStepInsertion();

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
            <div class="row_1i">
                <div class="mainTitle">
                    <p class="title">Découvrez votre prix remisé</p>
                    <p className="page_sub_title">Merci de remplir le formulaire pour débloquer votre remise</p>
                </div>
            </div>

            <div className="page_form">
                <div className="body" id="formPart1">
                    <div className="content">

                        <form method="post">
                            <div className="bottomSection">
                                <div className="lefside">
                                <input placeholder="Nom *" type="text" id="nom" name="nom" onChange={handleRequiredChange} />
                                {nomError && <span style={{color:'red',fontFamily: 'DaciaBlock', fontSize: '12px'}}>{nomError}</span>}
                                <input placeholder="Prénom *" type="text" id="prenom" name="prenom" onChange={handleRequiredChange} />
                                {prenomError && <span style={{color:'red',fontFamily: 'DaciaBlock', fontSize: '12px'}}>{prenomError}</span>}
                                <input placeholder="Email *" type="email" id="email" name="email" onChange={handleEmailChange} />
                                {emailError && <span style={{color:'red',fontFamily: 'DaciaBlock', fontSize: '12px'}}>{emailError}</span>}
                                <input placeholder="Téléphone *" type="tel" id="telephone" name="tele" onChange={handleTeleChange} />
                                {teleError && <span style={{color:'red',fontFamily: 'DaciaBlock', fontSize: '12px'}}>{teleError}</span>}
                                <input placeholder="Ville *" type="text" id="ville" name="ville" onChange={handleRequiredChange} />
                                {villeError && <span style={{color:'red',fontFamily: 'DaciaBlock', fontSize: '12px'}}>{villeError}</span>}

                                <div className="testDrive_container">
                                    <input type="checkbox" id="testDrive_input" name="testDrive" onChange={handleTestDriveChange}/>
                                    <label htmlFor="testDrive_input" className="checkbox_testDrive"></label>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="25" height="25" fill='#4E5844'>
                                        <path className="cls-1" d="M69.14,69.14H30.86v5.01c0,1.84-1.63,3.38-3.47,3.38h-10.21c-1.84,0-3.27-1.53-3.27-3.38v-22.82c0-3.07,1.33-7.37,5.21-10.34l-5.41-2.35v-3.58h8.06c2.86-7.67,5.51-12.59,11.64-12.59h33.17c6.12,0,8.78,4.91,11.64,12.59h8.06v3.58l-5.41,2.35c3.88,2.97,5.21,7.26,5.21,10.34v22.82c0,1.84-1.43,3.38-3.27,3.38h-10.21c-1.84,0-3.47-1.53-3.47-3.38v-5.01ZM77.3,43.65H22.7c-2.14,1.13-4.63,5.42-4.63,7.68v22.1h8.61v-8.39h46.65v8.39h8.57v-22.1c0-2.25-2.45-6.55-4.59-7.68ZM30.96,59.21c-5.51-1.53-8.57-2.66-8.57-6.86v-4.5h12.55v3.68h-8.98v.41c0,1.33,0,1.94,5,3.48v3.79ZM65.97,26.57h-31.95c-4.8,0-6.74,4.2-9.19,13.1h50.32c-2.45-8.9-4.39-13.1-9.19-13.1ZM51.48,47.85l2.35,4.5-2.35,4.1h-3.27l-2.35-4.1,2.35-4.5h3.27ZM74.04,51.95v-.41h-8.98v-3.68h12.56v4.5c0,4.2-3.06,5.32-8.57,6.86v-3.79c5-1.53,5-2.15,5-3.48Z"/>
                                    </svg>
                                    <p className="testDrive">Je profite de mon test drive gratuit</p>
                                </div>

                                <p className="note_label">* Champs obligatoires</p>

                                <div className="checkbox_wrap" id="checkbox_wrap_lu">
                                <input className="input_condition" type="checkbox" id="acceptConditions" name="acceptConditions" onChange={handleRequiredChange} />
                                <label htmlFor="acceptConditions" className="label">
                                    J'ai lu et j'accepte les conditions générales d'utilisation
                                    <span className="lireSpan">
                                        <a className="linkcondition" href="https://renault.m-automotiv.ma/pages/informations_legales?/fr/pages/informations_legales" >( Lire ) </a>
                                    </span>
                                </label>
                                {conditionsError && <span style={{color:'red',fontFamily: 'DaciaBlock', fontSize: '12px'}}>{conditionsError}</span>}
                            </div>



                            <div className="checkbox_wrap" id="checkbox_wrap_sms">
                                <input className="input_condition" type="checkbox" id="contactPermission" name="contactPermission" required />
                                <label htmlFor="contactPermission" className="label">
                                    <p>
                                        J’accepte d’être contacté par e-mail, SMS et Téléphone
                                        pour recevoir les offres et promotions relatives aux
                                        services et produits Renault de la part de Renault Maroc,
                                        de ses filiales et des membres de son réseau commercial.
                                    </p>
                                </label>
                                {contactError && <span style={{color:'red',fontFamily: 'DaciaBlock', fontSize: '12px'}}>{contactError}</span>}
                            </div>

                            </div>
                                <div className="righside">
                                    <img style={{marginBottom: '15px'}} src={`http://localhost:8000/storage/${selectedVersionImage.replace(/\\/g, '/')}`} alt="" />
                                    <p>
                                        <span>Par le biais de ce formulaire, <br/></span>
                                        MOROCCO AUTOMOTIVE RETAIL collecte vos données personnelles dans le cadre de la gestion des clients conformément à
                                        la délibération N° 32-2015 du 13/02/2015 portant modèle de déclaration type concernant les traitements de données à
                                        caractère personnel. Ce traitement a fait l'objet d'une déclaration auprès de la CNDP sous le numéro D-GC-1038/2023.
                                        Vous pouvez exercer vos droits d'accès, de rectification et d'opposition conformément aux dispositions de la loi 09-08
                                        en vous adressant à : MOROCCO AUTOMOTIVE RETAIL, 44 avenue Khalid Ibnou El Oualid, Ain Sebaa, Casablanca.
                                    </p>
                                </div>
                            </div>
                            <div className="footer">
                                <a className="submitBtn" id="submitForm" onClick={submitForm}>Découvrir</a>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </>
    )
}
