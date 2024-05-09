import { useContext, useEffect, useState } from 'react';
import '../style/equipement.css';
import { axiosClient } from '../Api/axios';
import { Link, useLocation } from 'react-router-dom';
import { DataContext } from '../contexts/dataContext';

export default function Equipement(){

    const context = useContext(DataContext);
    const { setEquipements, updateSteps } = useContext(DataContext);

    const backendEnvIMG = 'http://localhost:8000/storage';
    const [selectedEquipements, setSelectedEquipements] = useState(context.equipements);
    const [equipements, setEquipementsLocal] = useState([]);

    const location = useLocation();
    const searchParams = new URLSearchParams(location.search);
    const idVersion = searchParams.get('idversion');

    
    useEffect(() => {
        const fetchVersions = async () => {
            try {
                const response = await axiosClient.get(`/api/versions/${idVersion}`);
                setEquipementsLocal(response.data.version.equipements);
            } catch (error) {
                console.error('Error fetching versions:', error);
            }
        };
        if (idVersion) {
            console.log('call');
            fetchVersions();
        }
    }, [idVersion]);

    const handleCheckboxChange = (equip) =>{
        setSelectedEquipements(prevCheckedItems =>{
            const updateChechkedItem = {...prevCheckedItems};
            if(updateChechkedItem[equip.id]){
                delete updateChechkedItem[equip.id];
            }else{
                updateChechkedItem[equip.id]= equip;
            }
            return updateChechkedItem;
        })
    }

    const handleStepInsertion = () => {
        updateSteps('Equipements', 5);
    };

    const handelEquipementsChange = (equipement) =>{
        setEquipements(equipement);
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
                Etape: 'Equipements'
            }, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
        } catch (error) {
            console.error('Error updating guest steps:', error);
        }
    };
    
    return (
        <>
            <div className="row_1i">
                <p className="page_title_main">Sélectionner les accessoires <br /> pour votre voiture</p>
            </div>

            <div className="accessoires_container">
                <div className="items_list">
                    {equipements.map((equip) => (
                        <div className="item_card" key={equip.id}> 
                            <div className="image_checkbox">
                                <input type="checkbox" 
                                    id={`accessoireInput${equip.id}`} 
                                    className="accessoireInput" 
                                    checked={!!selectedEquipements[equip.id]} 

                                    onChange={()=>handleCheckboxChange(equip)} 
                                />
                                <label htmlFor={`accessoireInput${equip.id}`} className="accessoireLabel"></label>
                                <img className="card-img-top" src={`${backendEnvIMG}/${equip.imageequipement.replace(/\\/g, '/')}`} alt={equip.nomequipement} />
                            </div>
                            <p className="title">{equip.nomequipement}</p>
                            <p className="price">{(equip.pivot.prix ? equip.pivot.prix.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') : '')} DHS<span>TTC</span></p>
                        </div>
                    ))}
                    <div className="footer">
                        {/*<a className="submitBtn" onClick={movetonextStep} id="submitapvhtmlForm">Suivant</a>*/}
                        <Link 
                            to={`/Recapitulatif?idversion=${idVersion}`} 
                            className="SelectionnerBTN"
                            onClick={()=>handelEquipementsChange(selectedEquipements)}>
                            suivant
                        </Link>
                    </div>
                </div>
            </div>
        </>
    );

}