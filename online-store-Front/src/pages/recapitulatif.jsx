import { useContext, useEffect, useState } from 'react';
import '../style/recapitulatif.css';
import React360Viewer from 'react-360-view';
import { Link, useLocation } from 'react-router-dom';
import { DataContext } from '../contexts/dataContext';
import { axiosClient } from '../Api/axios';

export default function Recapitulatif(){
    //--handel the threeSixtyError
    useEffect(() => {
        const container = document.getElementById("threeSixty_size");
        if (container) {
            const wheelHandler = (event) => {
                event.stopPropagation();
            };
            container.addEventListener("wheel", wheelHandler);
            return () => {
                container.removeEventListener("wheel", wheelHandler);
            };
        }
    }, []);

    const context = useContext(DataContext);
    const { updateSteps, setTotal, setSimulateurInfo } = useContext(DataContext);

    const [folowstepsError, setFolowstepsError]=useState(false);

    const [modele, setModele]=useState(context.modele);
    const [version, setVersion]=useState(context.version);
    const [color, setColor]=useState(context.color);
    const [equipement, setEquipement]=useState(context.equipements);
    const [pathfolder, setPathfolder] = useState(context.pathImages);

    const [prixTotal, setPrixTotal] = useState(null);

    useEffect(() => {
        const FraisMatriculation = modele.fraisImmatriculation;
        const FraisMiseService = 3235;

        if (version && version.prixversion) {
            const carPrix = version.prixversion - version.remise;
            const colorPrix = color && color.pivot && color.pivot.prix ? color.pivot.prix : 0;
            const equipementPrix = equipement && Object.keys(equipement).length > 0 ? (
                Object.keys(equipement).reduce((total, equipementId) => {
                    const equipement1 = equipement[equipementId];
                    return total + (equipement1 && equipement1.pivot && equipement1.pivot.prix ? equipement1.pivot.prix : 0);
                }, 0)
            ) : 0;

            let total;
            if(equipementPrix !== 0){
                total = (carPrix + colorPrix + equipementPrix + FraisMatriculation + FraisMiseService).toFixed(2);
            }else{
                const pack_accessoires = parseInt(modele && modele.pack_accessoires ? modele.pack_accessoires : 0);
                total = (carPrix + colorPrix + equipementPrix + pack_accessoires + FraisMatriculation + FraisMiseService).toFixed(2);
            }

            setPrixTotal(total);
            setTotal(total);
        } else {
            setFolowstepsError("Please follow the steps")
        }

    }, [context.color, context.equipements, context.version]);

    const showTwoButtons = () =>{
        const btns = document.getElementById('down_buttonsID');
        const hiden_buttonsID = document.getElementById('hiden_buttonsID');
        btns.style.display = 'flex';
        hiden_buttonsID.style.display = 'none';
    }

    const handleStepInsertion = () => {

        updateSteps('Recapitulatif', 6);
        updateGuestSteps();
        setSimulateurInfo({});
    };

    const updateGuestSteps = async () => {
        try {
            // Fetch CSRF token
            const response = await axiosClient.get('/api/csrf-token');
            const csrfToken = response.data.csrfToken;

            // Update guest steps
            const updateResponse = await axiosClient.post('/api/update-guest', {
                id: context.guestInfo.id,
                Etape: 'Récapitulatif'
            }, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
        } catch (error) {
            console.error('Error updating guest steps:', error);
        }
    };

    return(
        <>

        <div className="row_1i">
            <div className="cardetailsAndCarousel">
             {folowstepsError === false ? (
                <>
                {/*<!---------section 1----------->*/}
                <div className="todispear2">
                    <div className="nouvelleCar">
                        <p>Votre nouvelle Renault Clio</p>
                    </div>

                    <div className="text">
                        <p>Cliquez sur un des bouton ci-dessous <br /> pour continuer votre achat</p>
                    </div>

                    <div className="threeSixty_size" id='threeSixty_size'>
                        <div className="handCircle">
                            <svg className="white-svg" xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="60" style={{fill: 'white'}}>
                                <path className="cls-1" d="M44.58,11.35c2.58,0,4.3,1.68,4.42,4.31l.03.35v6.87c.58-.38,1.29-.61,2.12-.61,2.3,0,3.84,1.6,4.05,4.13.61-.38,1.29-.61,2.15-.61,2.3,0,3.81,1.61,4.05,4.12.61-.38,1.29-.61,2.06-.61,2.42,0,3.99,1.68,4.11,4.31v7.3c0,7.69-.92,11.3-3.81,14.78l-.31.35-1.44,1.68v5.42h-2.76v-6.42l1.69-1.91c2.85-3.24,3.9-6.33,3.96-12.08v-8.77c0-1.3-.61-2.06-1.75-2.06-1.07,0-1.66.66-1.75,1.79v4.93h-2.67v-8.18c0-1.3-.61-2.06-1.78-2.06-1.04,0-1.66.66-1.75,1.79v7.06h-2.67v-10.31c0-1.3-.61-2.06-1.75-2.06-1.07,0-1.69.66-1.75,1.79v9.2h-2.7v-19.86c0-1.3-.58-2.06-1.75-2.06-1.07,0-1.66.66-1.75,1.79v26.77l-2.67.76-4.88-9.09c-.4-.76-.92-1.14-1.47-1.14-.98,0-1.81.69-1.81,1.6,0,.39.09.79.31,1.37l.12.31,10.4,19.32v7.48h-2.67v-6.95l-10.16-18.94c-.4-.69-.71-1.83-.71-2.6,0-2.29,1.99-4.2,4.51-4.2,1.6,0,2.7.74,3.71,2.47l.18.36,2.46,4.51v-21.77c0-2.75,1.84-4.66,4.42-4.66ZM26.66,45.61l1.04.08,1.26,1.86-.21.56-.25.55.09.16c-.06.02-.12.05-.18.07-.98,2.47-2.24,4.96-3.93,7.64l-.55.9-1.47-2.21c1.63-2.42,2.61-3.84,3.38-5.15-6.69,3.33-10.46,7.71-10.46,12.29,0,7.74,10.68,14.65,26.11,16.95l.77.11-.4,2.85c-17.55-2.43-29.37-10.43-29.37-19.92,0-5.65,4.27-10.92,11.85-14.75-1.69.03-3.44.13-5.19.31l-1.35.14-1.47-2.15c3.62-.39,6.51-.53,10.34-.29ZM72.54,45.88c9.97,3.89,15.71,9.9,15.71,16.48,0,11.47-17.22,20.46-39.28,20.61,1.87,1.07,3.81,2.07,5.86,3.01l.15,2.59c-3.59-1.68-6.29-3.15-9.85-5.7l-.12-2.24c2.67-2.14,5.65-4.02,9.42-5.85l.09,2.65c-2.61,1.24-4.17,1.94-5.52,2.66,19.76-.15,36.36-8.2,36.36-17.73,0-5.25-5.19-10.41-13.87-13.79l1.04-2.68Z"/>
                            </svg>
                        </div>

                        <React360Viewer
                            amount={24}
                            imagePath={pathfolder}
                            fileName="Car_{index}.jpeg"
                            spinReverse
                        />

                        <div className="ulANDtext">
                            <p className="text-TreeSixty">*Images non contractuelles</p>
                         </div>


                    </div>

                    <div className="down_buttons">
                        <button className="precommande" id='hiden_buttonsID' onClick={showTwoButtons}>Je précommande !</button>
                    </div>
                    <div className="down_buttons" id='down_buttonsID' style={{display:'none'}}>
                        <Link to={'/CreateAccount'} className="achete_button" onClick={handleStepInsertion} >J'achète au comptant</Link>
                        <Link to={'/Simulateur'} className="finance_button" onClick={handleStepInsertion} >Je finance mon achat</Link>
                    </div>
                </div>

                <div className="carDetails">
                    <div className="recapitulatif">
                        <p>Récapitulatif</p>
                    </div>
                    <div className="version">
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
                </>
                ):(
                    <p style={{fontFamily:'NouvelRBold', margin: 'auto', fontSize: '22px'}}>{folowstepsError}</p>
                )
            }
            </div>
        </div>
        </>
    )
}
