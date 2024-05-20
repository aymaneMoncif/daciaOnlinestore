import { NavLink, Outlet } from "react-router-dom";
import '../style/stepsStyle.css';
import '../scripts/homePage.js';
import { Link, useLocation } from 'react-router-dom';
import { useContext, useEffect, useState } from "react";
import { DataContext } from "../contexts/dataContext";

export default function Steps(){

    const [selectedEquipement, setSelectedEquipement] = useState({});
    const [stepsStatus, setStepsStatus] = useState("close");

    const context = useContext(DataContext);
    //console.log('---------------------------------');
    //console.log('selected Modele :',context.modele);
    //console.log('selected version :',context.version);
    //console.log('selected color :',context.color);
    //console.log('selected Equipement :',context.equipements);
    //console.log('selected pathImages :',context.pathImages);
    //console.log('user info :',context.guestInfo);
    //console.log('steps :',context.steps.length);
    //console.log('simulateurInfo :',context.simulateurInfo.output.mensualite_all_inclusive);
    //console.log('---------------------------------');

    // Event handler for the PRECEDENT button
    const handlePrecedentClick = (e) => {
        e.preventDefault();
        window.history.back();
    };

    // Event handler for the SUIVANT button
    const handleSuivantClick = (e) => {
        e.preventDefault();
        window.history.forward();
    };

    const stepsMobile = () => {
        setStepsStatus(prevStatus => (prevStatus === 'open' ? 'close' : 'open'));
    };

    return(
        <>

            <div className="breadcrumb_Container">
                <div className="breadcrumb">
                    <a href="https://renault.m-automotiv.ma">Renault accueil</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="ff671b" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" className="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <a href="https://achatenligne.dacia.m-automotiv.ma">Online Store</a>
                </div>
            </div>

            <div className="breadcrumb_Container">
                <div className="retour">
                <div className="PRECEDENT" onClick={handlePrecedentClick}>
                    <svg className="PRECEDENTSVG" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ff671b" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" viewBox="0 0 16 16">
                        <path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    <a href="">PRÉCÉDENT</a>
                </div>

                <div className="SUIVANT" onClick={handleSuivantClick}>
                    <a href="">SUIVANT</a>
                    <svg className="SUIVANTSVG" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="ff671b" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" viewBox="0 0 16 16">
                        <path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>

                </div>
            </div>

            <div className="lineButtonsMobile">
                <button className={`shwoSteps ${stepsStatus}`} onClick={()=>stepsMobile()}>
                    2.Version
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fillRule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                    </svg>
                </button>
                <div className={`etapsContainerMobile ${stepsStatus}`}>
                    <NavLink className="etapBTNMobile" activeclassname="active" exact="true"  to="/modele" onClick={()=>stepsMobile()}>
                        1.Modèle
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 1 ? "etapBTNMobile inactive" : "etapBTNMobile"}
                        activeclassname="active"
                        to={context.steps.length <= 0 ? '#' : `/Version?id=${context.modele.id}`}
                    >
                        2. Version
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 2 ? "etapBTNMobile inactive" : "etapBTNMobile"}
                        activeclassname="active"
                        to={context.steps.length <= 1 ? '#' : `/VersionCouleur?versionId=${context.version.id}`}>
                        3. Couleur
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 3 ? "etapBTNMobile inactive" : "etapBTNMobile"}
                        activeclassname="active"
                        to={context.steps.length <= 2 ? '#' : `/VersionInterieure?idversion=${context.version.id}`}>
                        4. Vue intérieure
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 4 ? "etapBTNMobile inactive" : "etapBTNMobile"}
                        activeclassname="active"
                        to={context.steps.length <= 3 ? '#' : `VersionEquipement?idversion=${context.version.id}`}>
                        5. Équipements
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 5 ? "etapBTNMobile inactive" : "etapBTNMobile"}
                        activeclassname="active"
                        to={context.steps.length <= 4 ? '#' : `Recapitulatif?idversion=${context.version.id}`}>
                        6. Récapitulatif
                    </NavLink>
                </div>
            </div>

            <div className="lineButtons">
                <div className="etapsContainer">
                    <NavLink className="etapBTN" activeclassname="active" exact="true" to="/modele">
                        1. Modèle
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 1 ? "etapBTN inactive" : "etapBTN"}
                        activeclassname="active"
                        to={context.steps.length <= 0 ? '#' : `/Version?id=${context.modele.id}`}
                    >
                        2. Version
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 2 ? "etapBTN inactive" : "etapBTN"}
                        activeclassname="active"
                        to={context.steps.length <= 1 ? '#' : `/VersionCouleur?versionId=${context.version.id}`}>
                        3. Couleur
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 3 ? "etapBTN inactive" : "etapBTN"}
                        activeclassname="active"
                        to={context.steps.length <= 2 ? '#' : `/VersionInterieure?&idversion=${context.version.id}`}>
                        4. Vue intérieure
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 4 ? "etapBTN inactive" : "etapBTN"}
                        activeclassname="active"
                        to={context.steps.length <= 3 ? '#' : `VersionEquipement?idversion=${context.version.id}`}>
                        5. Équipements
                    </NavLink>

                    <NavLink
                        className={context.steps.length < 5 ? "etapBTN inactive" : "etapBTN"}
                        activeclassname="active"
                        to={context.steps.length <= 4 ? '#' : `Recapitulatif?idversion=${context.version.id}`}>
                        6. Récapitulatif
                    </NavLink>
                </div>
            </div>



            <main>
                <Outlet />
            </main>



            <div className="infoConatiner">
                <div className="backToTop">
                    <p className="MentionsLegales">
                    <span>Mentions légales :</span><br/>
                        Dans le cadre de sa politique d’amélioration continue des produits, Renault se réserve le droit, à tout moment,
                        d’apporter des modifications aux spécifications et aux véhicules et accessoires décrits et représentés.
                        Ces modifications sont notifiées aux concessionnaires dans les meilleurs délais. Selon les pays de commercialisation,
                        les versions peuvent différer, certains équipements peuvent ne pas être disponibles (en série, en options ou en accessoires).
                        Selon version certains parties centrales de l'assise et du dossier, sont faites du cuir d'origine bovine.
                        Veuillez consulter votre concessionnaire local pour recevoir les informations les plus récentes. En raison des limites techniques,
                        les couleurs reprises sur ce configurateur peuvent légèrement différer des couleurs réelles de peinture ou des matières de garniture intérieure.
                        Visuels non contractuels. Tous droits réservés.
                    </p>
                </div>
            </div>

            <div className="row_1i">
                <div className="backToTop">
                    <hr />
                    <a href="#">retour en haut de page</a><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-chevron-up" viewBox="0 0 16 16">
                        <path fillRule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg></span>
                </div>
            </div>

        </>
    )
}
