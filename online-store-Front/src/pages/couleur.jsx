import '@fortawesome/fontawesome-free/css/all.min.css';
import '../style/versionCouleur.css';
import { useContext, useEffect, useState } from 'react';
import { axiosClient } from '../Api/axios.js';
import React360Viewer from 'react-360-view';
import { Link, useLocation } from 'react-router-dom';
import { DataContext } from '../contexts/dataContext.jsx';
import Loader from './elements/loader.jsx';


export default function VersionColor(){

    const BaseURL = 'http://localhost:3000';
    const context = useContext(DataContext);
    const { setColor, setPathImages, updateSteps } = useContext(DataContext);

    const [loading, setLoading] = useState(true);
    const [imagesLoaded, setImagesLoaded] = useState(false);
    const [colors, setColors] = useState([]);
    const [images, setImages] = useState([]);
    const [pathfolder, setPathfolder] = useState('');
    const [selectedCouleur,setSelectedCouleur]= useState(null); //the iD
    const [currentIndex, setCurrentIndex] = useState(0);

    const location = useLocation();
    const searchParams = new URLSearchParams(location.search);
    const idVersion = searchParams.get('versionId');

    const handleImageChange = (newIndex) => {
        setCurrentIndex(newIndex);
    };

    //threeSixty Stop the Error
    useEffect(() => {
        const container = document.getElementById("ThreeSixtyColorPage");
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

    useEffect(() => {
        const fetchVersions = async () => {
            setLoading(true);

            try {
                const response = await axiosClient.get(`/api/versions/${idVersion}`);
                let fetchedColors = response.data.stockColors;
                setColors(fetchedColors);

                let selectedId = null;
                if (Object.values(context.color).length === 0) {
                    selectedId = fetchedColors.length > 0 ? fetchedColors[0].id : null;
                } else {
                    selectedId = context.color.id;
                }

                setSelectedCouleur(selectedId);
                setImages(response.data.images);

                const firstImagePath = response.data.images.find(img => img.couleur_id === selectedId)?.image;
                if (firstImagePath) {
                    const basePath = `${BaseURL}/src/assets/ThreeSixty/${firstImagePath}/`;
                    setPathfolder(basePath);
                }

                setLoading(false);
            } catch (error) {
                console.error('Error fetching versions:', error);
                setLoading(false);
            }
        };

        if (idVersion) {
            fetchVersions();
        }
    }, [idVersion, context.color]);

    const colorChange = (colorID) => {
        setSelectedCouleur(colorID);
        const newChooseImagePath = images.find(img => img.couleur_id === colorID)?.image;
        const basePath = `${BaseURL}/src/assets/ThreeSixty/${newChooseImagePath}/`;
        setPathfolder(basePath);
    };

    const handleStepInsertion = () => {
        updateSteps('Couleur', 3);
    };

    const handelCouleurChange = (selectedCouleur) => {
        setColor(colors.find(clr => clr.id === selectedCouleur));
        setPathImages(pathfolder);
        handleStepInsertion();
        updateGuestSteps();
    }

    const updateGuestSteps = async () => {
        try {
            // Fetch CSRF token
            const response = await axiosClient.get('/api/csrf-token');
            const csrfToken = response.data.csrfToken;

            // Update guest steps
            const updateResponse = await axiosClient.post('/api/update-guest', {
                id: context.guestInfo.id,
                Etape: 'couleur'
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

            <div className="titlerow_1i">
                <div className="mainTitle">
                    <p className="title">Choisissez votre Couleur</p>
                    <p className="semititle">*Images non contractuelles</p>
                </div>
            </div>
            {/*<img src={`${pathfolder}car_0.jpeg`} alt=""/>*/}

                    {/*section 1----------->*/}
                    <div className="todispearColorPage">
                        <div className="threeSixty_size ColorPage">
                            <div className="handCircle">
                                <svg className="white-svg" xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="60" style={{fill: 'white'}}>
                                    <path className="cls-1" d="M44.58,11.35c2.58,0,4.3,1.68,4.42,4.31l.03.35v6.87c.58-.38,1.29-.61,2.12-.61,2.3,0,3.84,1.6,4.05,4.13.61-.38,1.29-.61,2.15-.61,2.3,0,3.81,1.61,4.05,4.12.61-.38,1.29-.61,2.06-.61,2.42,0,3.99,1.68,4.11,4.31v7.3c0,7.69-.92,11.3-3.81,14.78l-.31.35-1.44,1.68v5.42h-2.76v-6.42l1.69-1.91c2.85-3.24,3.9-6.33,3.96-12.08v-8.77c0-1.3-.61-2.06-1.75-2.06-1.07,0-1.66.66-1.75,1.79v4.93h-2.67v-8.18c0-1.3-.61-2.06-1.78-2.06-1.04,0-1.66.66-1.75,1.79v7.06h-2.67v-10.31c0-1.3-.61-2.06-1.75-2.06-1.07,0-1.69.66-1.75,1.79v9.2h-2.7v-19.86c0-1.3-.58-2.06-1.75-2.06-1.07,0-1.66.66-1.75,1.79v26.77l-2.67.76-4.88-9.09c-.4-.76-.92-1.14-1.47-1.14-.98,0-1.81.69-1.81,1.6,0,.39.09.79.31,1.37l.12.31,10.4,19.32v7.48h-2.67v-6.95l-10.16-18.94c-.4-.69-.71-1.83-.71-2.6,0-2.29,1.99-4.2,4.51-4.2,1.6,0,2.7.74,3.71,2.47l.18.36,2.46,4.51v-21.77c0-2.75,1.84-4.66,4.42-4.66ZM26.66,45.61l1.04.08,1.26,1.86-.21.56-.25.55.09.16c-.06.02-.12.05-.18.07-.98,2.47-2.24,4.96-3.93,7.64l-.55.9-1.47-2.21c1.63-2.42,2.61-3.84,3.38-5.15-6.69,3.33-10.46,7.71-10.46,12.29,0,7.74,10.68,14.65,26.11,16.95l.77.11-.4,2.85c-17.55-2.43-29.37-10.43-29.37-19.92,0-5.65,4.27-10.92,11.85-14.75-1.69.03-3.44.13-5.19.31l-1.35.14-1.47-2.15c3.62-.39,6.51-.53,10.34-.29ZM72.54,45.88c9.97,3.89,15.71,9.9,15.71,16.48,0,11.47-17.22,20.46-39.28,20.61,1.87,1.07,3.81,2.07,5.86,3.01l.15,2.59c-3.59-1.68-6.29-3.15-9.85-5.7l-.12-2.24c2.67-2.14,5.65-4.02,9.42-5.85l.09,2.65c-2.61,1.24-4.17,1.94-5.52,2.66,19.76-.15,36.36-8.2,36.36-17.73,0-5.25-5.19-10.41-13.87-13.79l1.04-2.68Z"/>
                                </svg>
                            </div>
                            <div className='ThreeSixtyROW1'>
                                <div className='ThreeSixtyColorPage' id='ThreeSixtyColorPage'>
                                {loading ? (
                                    <Loader />
                                ) : (
                                    pathfolder ? (
                                        <>
                                        <React360Viewer
                                            key={pathfolder}
                                            amount={24}
                                            imagePath={pathfolder}
                                            fileName="Car_{index}.jpeg"
                                            spinReverse
                                            //frame={currentIndex}
                                            onChange={setCurrentIndex}
                                        />
                                        </>
                                    ) : (
                                        <p style={{ textAlign: "center" }}>No images available for the selected color.</p>
                                    )
                                )}
                                </div>
                            </div>
                            <div className="colorsBar">
                                {colors.map((color) => (
                                    <div className="color" key={color.id} onClick={()=>colorChange(color.id)}>
                                        <div className="imageColor">
                                            <img src={`${color.imagecouleur}`} alt="" />
                                        </div>
                                        {selectedCouleur === color.id && (
                                            <div className="name_price">
                                                <p>{color.nomcouleur}</p>
                                                <p>+ {color.pivot.prix} DHS/TTC</p>
                                            </div>
                                        )}
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>

            <div className="SelectionnerBTNdiv">
                {/*<button className="SelectionnerBTN" onClick={movetonextStep}>Sélectionner</button>*/}
                <Link to={`/VersionInterieure?idversion=${idVersion}`} onClick={()=>handelCouleurChange(selectedCouleur)} className="SelectionnerBTN">Sélectionner</Link>
            </div>
        </>
    )
}
