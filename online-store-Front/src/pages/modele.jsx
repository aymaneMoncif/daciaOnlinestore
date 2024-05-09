import React, { useContext, useEffect, useState } from 'react';
import { axiosClient } from "../Api/axios";
import Version from "./version";
import '../style/modeleList.css';
import { Link } from 'react-router-dom';
import { DataContext } from '../contexts/dataContext.jsx';

export default function Modele() {
    const [modeles, setModeles] = useState([]);
    const [selectedModele, setSelectedModele] = useState({});
    const [showModele, setShowModele] = useState(true);

    const[showMore, setShowMore] = useState(false);
    const maxVisibleCards = 3;
    const visibleModels = showMore ? modeles : modeles.slice(0, maxVisibleCards);

    const handleShowMore = () => {
        setShowMore(true);
    };

    useEffect(() => {
        axiosClient.get('/api/csrf-token');
        axiosClient.get('/api/modeles')
            .then(response => {
                setModeles(response.data);
            })
            .catch(error => {
                console.error('Error fetching modeles:', error);
            });
    }, []);

    //const sendModelId = (id, nommodele) => {
    //    setSelectedModele({ id, nommodele });
    //    setShowModele(false);
    //};

    const { updateSteps } = useContext(DataContext);

    const handleStepInsertion = () => {
        updateSteps('List versions', 1);
    };

    const { setModele } = useContext(DataContext);
    const handleModeleSelection = (modele) =>{
        setModele(modele);
        handleStepInsertion();
    }

    return (
        <>

            <div className="row_1i">
                <div className="mainTitle">
                    <p className="title">Choisissez votre modèle</p>
                </div>
            </div>

            {/*<!-- modele PARTICULIERS -->*/}
            <div className="todispear">
                <div className="cars-section1 active">
                    <div className="row_3i">
                        {/*<!-- card_detail -->*/}
                        {modeles.map(modele => (
                        <div className="cars_card"  key={modele.id}>
                            <div className="card">
                                <img className="card-img-top" src={modele.image_url} alt={modele.nommodele} />
                                <div className="card-body">
                                    <p className="card-title">{modele.nommodele}</p>
                                    <p className="card-text">à partir de : {modele.prixmodele} DHS/TTC</p>
                                    <Link to={`/version?id=${modele.id}`} onClick={()=>handleModeleSelection(modele)} className="cardButton">
                                        Commandez
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" version="1.1" viewBox="0 0 100 100" width={18} height={18} fill='#ff671b'>
                                            <polygon className="cls-1" points="88.61 44 51.61 12.94 45.65 20.04 75.87 45.42 5.11 45.42 5.11 54.7 75.87 54.7 45.65 80.07 51.61 87.18 88.61 56.11 95.82 50.06 88.61 44"/>
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                        ))}
                        {/*<!-- end card_detail-->*/}
                    </div>
                </div>
            </div>
            {/*<!-- end modele PARTICULIERS -->*/}

            {/*<!----------------showing cars in the tablet screen------------------>*/}
            <div className="row_1i">
                <div className="cars-section-tablet">
                    <div id="accordion">
                        <div className="card">
                            <div id="collapseOne" className="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div className="card-body">
                                    <div className="cars-section1 active">
                                        <div className="row_3i">
                                            {visibleModels.map(modele => (
                                            <div className="cars_card"  key={modele.id}>
                                                <div className="card">
                                                    <img className="card-img-top" src={modele.image_url} alt={modele.nommodele} />
                                                    <div className="card-body">
                                                        <p className="card-title">{modele.nommodele}</p>
                                                        <p className="card-text">à partir de : {modele.prixmodele} DHS/TTC</p>
                                                        <Link to={`/version?id=${modele.id}`} onClick={()=>handleModeleSelection(modele)} className="cardButton">
                                                            Commandez
                                                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" version="1.1" viewBox="0 0 100 100" width={18} height={18} fill='#ff671b'>
                                                                <polygon className="cls-1" points="88.61 44 51.61 12.94 45.65 20.04 75.87 45.42 5.11 45.42 5.11 54.7 75.87 54.7 45.65 80.07 51.61 87.18 88.61 56.11 95.82 50.06 88.61 44"/>
                                                            </svg>
                                                        </Link>
                                                    </div>
                                                </div>
                                            </div>
                                            ))}
                                            {!showMore && (
                                                <button id="showMoreButton1" className="showMorecarsBTN" onClick={handleShowMore}>
                                                    Affichez en plus
                                                </button>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {/*<!---------------- END showing cars in the tablet screen------------------>*/}

        </>
    );
}
