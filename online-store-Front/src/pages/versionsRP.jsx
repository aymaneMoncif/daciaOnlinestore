import '../style/version.css';
import '../style/owl.carousel.min.css';
import '../style/owl.theme.default.min.css';
import '../scripts/owl.carousel.min.js';
import { useContext, useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { DataContext } from '../contexts/dataContext.jsx';

export default function VersionsRP({ versions, modele, selectedRemiseType }){

    const [selectedVersion, setSelectedVersion] = useState(null);

    const calculatePriceAfterDiscount = (prix, remise, remise_reprise) => {
        let prixAfterDiscount;

        if (selectedRemiseType === "remise"){
            console.log('remise :', remise);
            const prixNum = parseFloat(prix);
            const remiseNum = parseFloat(remise);
            prixAfterDiscount = (prixNum - remiseNum).toFixed(2);
        }else{
            const prixNum = parseFloat(prix);
            console.log('remise_reprise :', remise_reprise);
            const remiseNum = remise_reprise ? parseFloat(remise_reprise) : 0;
            prixAfterDiscount = (prixNum - remiseNum).toFixed(2);
        }
        
        // Format the number with spaces every three digits
        const formattedPrice = prixAfterDiscount.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    
        return formattedPrice;
    };
    

    const { setVersion, updateSteps } = useContext(DataContext);
    
    const handleStepInsertion = () => {
        updateSteps('remise versions', 2);
    };

    const handleVersionSelection = (version) => {
        setSelectedVersion(version);
        setVersion(version); 
        handleStepInsertion();
    };

    useEffect(() => {
        if (versions.length > 0) {
            // Versions fetched, initialize Owl Carousel
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
        }
    }, [versions]);

    return(
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
                                            <p className="card_title">{modele.nommodele} {version.nomversion.split(' ').slice(1).join(' ')}</p>
                                            <p className="apartirde">Prix avec remise à partir de :</p>
                                            <p className="card_Prix">{calculatePriceAfterDiscount(version.prixversion, version.remise , version.remise_reprise)} DHS/TTC</p>
                                            <p className="apartirde">au lieu de : <span className='oldPrix'>{version.prixversion} DHS/TTC</span></p>
                                            <hr />
                                            <div>
                                                <ul className="card_équipements">
                                                    <p>équipements principaux</p>
                                                    {version.equipements.map(equipement => (
                                                        <li key={equipement.id}>-&nbsp;{equipement.nomequipement}</li>
                                                    ))}
                                                </ul>
                                            </div>    
                                        </div>
                                        <div className="buttons2">
                                            <Link className="remiseReprise_button" to={`/VersionCouleur?versionId=${version.id}`} onClick={() => handleVersionSelection(version)}>Continuer</Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </>
    )
}