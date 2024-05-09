import '../style/interieure.css';
import '../style/jquery.bxslider.css';
import { useContext, useEffect, useState } from 'react';
import { axiosClient } from '../Api/axios.js';
import { Link, useLocation } from 'react-router-dom';
import { DataContext } from '../contexts/dataContext.jsx';


export default function Interieure(){
    useEffect(() => {
        const script = document.createElement('script');
        script.src = 'src/scripts/jquery.bxslider.min.js';
        script.async = true;
        script.onload = () => {
            initializeCarousel();
        };
        document.body.appendChild(script);
    }, []);

    const initializeCarousel = () => {
        $(".carDetail_carousel").bxSlider({
            pagerCustom: '#bx-pager'
        });
    }


    const context = useContext(DataContext);

    const location = useLocation();
    const searchParams = new URLSearchParams(location.search);
    const idVersion = searchParams.get('idversion');

    const [interieurrImg, setInterieureImg] = useState();
    const [pathfolderInter, setPathfolderInter] = useState();

    useEffect(() => {
        const fetchVersions = async () => {
            try {
                const response = await axiosClient.get(`/api/versions/${idVersion}`);
                const findTheInterieure = response.data.imagesInterieur.find(img => img.version_id == idVersion)?.image;

                setInterieureImg(findTheInterieure);
                if (findTheInterieure) {
                    const basePath = `http://localhost:3000/src/assets/Interieure/${findTheInterieure}/`;
                    setPathfolderInter(basePath);
                }
            } catch (error) {
                console.error('Error fetching versions:', error);
            }
        };
        if (idVersion) {
            fetchVersions();
        }
    }, [idVersion]);

    const { updateSteps } = useContext(DataContext);
    const handleStepInsertion = () => {
        updateSteps('Interieure', 4);
        updateGuestSteps()
    };

    const updateGuestSteps = async () => {
        try {
            // Fetch CSRF token
            const response = await axiosClient.get('/api/csrf-token');
            const csrfToken = response.data.csrfToken;

            // Update guest steps
            const updateResponse = await axiosClient.post('/api/update-guest', {
                id: context.guestInfo.id,
                Etape: 'Interieure'
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
            <div className="mainTitle">
                <p className="title">Découvrez l'interieur de votre voiture</p>
            </div>
        </div>

        <div className='row_1i'>
            <div className="images_carousel version163  show">
                <div className="bx-wrapper" style={{maxWidth: '100%'}}>
                    <div className="bx-viewport" aria-live="polite" style={{width: '100%', overflow: 'initial', position: 'relative'}}>
                        <ul className="carDetail_carousel" style={{width: '4215%', position: 'relative', transitionDuration: '0.5s', transform: 'translate3d(-1511.98px, 0px, 0px)'}}>

                            <li className="skeleton-loading-item" style={{float: 'left', listStyle: 'none', position: 'relative'}}>
                                <div className="skeleton-loading-content"></div>
                            </li>

                            <li style={{float: 'left', listStyle: 'none', position: 'relative', width: '2%'}} className="bx-clone" aria-hidden="true">
                                <img src={pathfolderInter + 'inter_3.jpg'} alt="" />
                            </li>
                            <li style={{float: 'left', listStyle: 'none', position: 'relative', width: '1207.02px'}} aria-hidden="true">
                                <img src={pathfolderInter + 'inter_1.jpg'} alt="" />
                            </li>
                            <li aria-hidden="false" style={{float: 'left', listStyle: 'none', position: 'relative', width: '2%'}}>
                                <img src={pathfolderInter + 'inter_2.jpg'} alt="" />
                            </li>
                            <li aria-hidden="true" style={{float: 'left', listStyle: 'none', position: 'relative', width: '2%'}} >
                                <img src={pathfolderInter + 'inter_3.jpg'} alt="" />
                            </li>
                            <li style={{float: 'left', listStyle: 'none', position: 'relative', width: '2%'}} aria-hidden="true">
                                <img src={pathfolderInter + 'inter_1.jpg'} alt="" />
                            </li>
                            <li style={{float: 'left', listStyle: 'none', position: 'relative', width: '2%'}} className="bx-clone" aria-hidden="true">
                                <img src={pathfolderInter + 'inter_2.jpg'} alt="" />
                            </li>
                        </ul>
                    </div>
                    <div className="bx-controls bx-has-controls-direction">
                        <div className="bx-controls-direction">
                            <a className="bx-prev">Prev</a>
                            <a className="bx-next">Next</a>
                        </div>
                    </div>
                </div>
                <div className="thumbnails" id="bx-pager">
                    <a data-slide-index="1" className="">
                        <img src={pathfolderInter + 'inter_1.jpg'} />
                    </a>
                    <a data-slide-index="2" className="">
                        <img src={pathfolderInter + 'inter_2.jpg'} />
                    </a>
                    <a data-slide-index="3" className="active">
                        <img src={pathfolderInter + 'inter_3.jpg'} />
                    </a>
                    {/*<a data-slide-index="4" className="">
                        <img src="https://renault.m-automotiv.ma/assets/uploads/renault/2d437-arkana6.jpeg" />
                    </a>*/}
                </div>
            </div>
        </div>

        <div className="SelectionnerBTNdiv">
            {/*<button className="SelectionnerBTN" onClick={movetonextStep}>Suivant</button>*/}
            <Link to={`/VersionEquipement?idversion=${idVersion}`} onClick={handleStepInsertion} className="SelectionnerBTN">Suivant</Link>

        </div>
    </>


    )
}
