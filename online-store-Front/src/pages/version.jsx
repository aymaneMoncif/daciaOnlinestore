import React, { useEffect, useState } from 'react';
import { axiosClient } from '../Api/axios.js';
import '../style/version.css';
import VersionForm from './versionForm.jsx';
import VersionsRP from './versionsRP.jsx';
import { useLocation } from 'react-router-dom';


export default function Version() {

    const location = useLocation();
    const searchParams = new URLSearchParams(location.search);
    const id = searchParams.get('id');

    const [isLoading, setIsLoading] = useState(true);
    const [modele, setModele] = useState([]);
    const [versions, setVersions] = useState([]);
    const [selectedVersionImage, setSelectedVersionImage] = useState({});
    const [selectedRemiseType, setSelectedRemiseType] = useState("");
    const [currentStep, setCurrentStep] = useState(0);

    useEffect(() => {
        const fetchVersions = async () => {
            try {
                axiosClient.get('/api/csrf-token');
                const response = await axiosClient.get(`/api/modeles/${id}`);
                setVersions(response.data.versions);
                setModele(response.data.modele);
                setIsLoading(false);
            } catch (error) {
                console.error('Error fetching versions:', error);
                setIsLoading(false); // Ensure isLoading is set to false even on error
            }
        };

        if (id) {
            fetchVersions();
        }
    }, [id]);

    useEffect(() => {
        if (!isLoading && versions.length > 0) {
            // Dynamically load Owl Carousel script
            const script = document.createElement('script');
            script.src = 'src/scripts/owl.carousel.min.js'; // Adjust the script path as needed
            script.async = true;
            script.onload = () => {
                initializeCarousel();
            };
            document.body.appendChild(script);
        }
    }, [isLoading, versions]);

    const initializeCarousel = () => {
        $(document).ready(function () {
            $("#carousel3").owlCarousel({
                items: 3,
                loop: false,
                margin: 30,
                nav: true,
                responsive: {
                    1440: {
                        items: 3
                    },
                    1024: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                    500: {
                        items: 1
                    },
                    0: {
                        items: 1
                    },
                }
            });
        });
    };
    
    const handleStepDone = ()=>{
        setCurrentStep(currentStep + 1);
    }

    //get the selected version from versioRP component
    const getSelectedVersion = (versionImage, typeRemise) => {
        setSelectedVersionImage(versionImage);
        setSelectedRemiseType(typeRemise);
        setCurrentStep(currentStep + 1);
    };

    const receiveGuestInfo = (guestInfoData) => {
        setGuestInfo(guestInfoData);
        setSelectedData((prevData) => ({ ...prevData, guestInfo: guestInfoData }));
    };

    return ( 
        <>
            {currentStep !== 0 ? (
                <>
                    {currentStep === 1 && <VersionForm selectedVersionImage={selectedVersionImage} selectedRemiseType={selectedRemiseType} onGuestInfoReceived={receiveGuestInfo}  handleStepDone={handleStepDone} />}
                    {currentStep === 2 && <VersionsRP versions={versions} modele={modele} selectedRemiseType={selectedRemiseType}  getSelectedVersion={getSelectedVersion} />}
                </>
            ) : (
                <>
                    <div className="row_1i">
                        <div className="mainTitle">
                            <p className="title">Choisissez votre version</p>
                        </div>
                    </div>

                    <div className="row_1i">
                        <div className="owl-carousel3-container">
                            <div className="owl-carousel" id="carousel3">
                                {versions.map(version => (
                                    <div className="item" key={version.id}>
                                        <div className="list_Version">
                                            <div className="card3">
                                                <img className="card-img-top" src={`http://localhost:8000/storage/${version.image.replace(/\\/g, '/')}`} alt="Card image cap" />
                                                <div className="card-body">
                                                    <p className="card_title">{modele.nommodele} {version.nomversion}</p>
                                                    {version.carburant ?
                                                        <div className="hybrid">
                                                            <p className="hybrid_full">{version.carburant}</p>
                                                        </div>: ""
                                                    }
                                                    <p className="apartirde">à partir de :</p>
                                                    <p className="card_Prix">{(version.prixversion ? version.prixversion.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') : '')} DHS/TTC</p>
                                                    <hr />
                                                    <div>
                                                        <ul className="card_équipements">
                                                            <p>Équipements principaux</p>
                                                            {version.equipements.map(equipement => (
                                                                <li key={equipement.id}>-&nbsp;{equipement.nomequipement}</li>
                                                            ))}
                                                        </ul>
                                                    </div>
                                                    <div className="buttons">
                                                        <button className="remise_button" onClick={() => getSelectedVersion(version.image, 'remise')}>Afficher le prix avec remise</button>
                                                        <button className="remiseReprise_button" onClick={() => getSelectedVersion(version.image, 'remiseReprise')}>Afficher le prix avec reprise</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </>
            )}                 
        </>
    );
}