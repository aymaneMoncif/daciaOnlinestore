import { useContext, useEffect, useState } from 'react';
import '../style/simulateur.css';
import { DataContext } from '../contexts/dataContext';
import { axiosClient } from '../Api/axios';
import { Link } from 'react-router-dom';
import axios from 'axios';

export default function Simulateur(){

    const context = useContext(DataContext);
    const { setSimulateurInfo, updateSteps } = useContext(DataContext);

    //const [closeDuree, setCloseDuree] = useState([]);
    //const [closeApport, setCloseApport] = useState([]);
    //const [equalDuree, setEqualDuree] = useState([]);
    //const [equalApport, setEqualApport] = useState([]);

    const [infos, setInfos] = useState(null);
    const [SimulationsLogique, setSimulationsLogique] = useState(null);
    const [addContactPhysique, setaddContactPhysique] = useState(null);
    const [token, setToken] = useState(null);
    const [loading, setLoading] = useState(true);
    //const [error, setError] = useState(null);

    const [Apport, setApport] = useState(null);
    const [selectedType, setSelectedType] = useState('');
    const [prix, setPrix] = useState(null);
    const [Duree, setDuree] = useState(null);
    const [Taux, setTaux] = useState(null);
    //const [fraisDossier, setFraisDossier] = useState(null);
    //const [valeurResiduelle, setValeurResiduelle] = useState(null);

    const [nom, setNom] = useState(context.guestInfo.nom);
    const [prenom, setPrenom] = useState(context.guestInfo.prenom);
    const [email, setEmail] = useState(context.guestInfo.email);
    const [tele, setTele] = useState(context.guestInfo.tele);
    const [typeClientId, setTypeClientId] = useState(1);
    const [sourceId, setSourceId] = useState(2);
    const [typeSimulationId, setTypeSimulationId] = useState(5);


    const totalCarPrix = context.total ;
    const frias = context.modele.fraisImmatriculation + 3235;
    const carPrice = totalCarPrix - frias ;

    useEffect(() => {
        const fetchData = async () => {
            try {
                // Step 1: Get hashed password from the first API
                const callForHashedPassword = await axios.post('https://rci-bo.orcaformation.com/api/getHashedPwd', null, {
                    params: {
                        mdp: 'Y3Zpi5mC3',
                    },
                });
        
                const hashedPassword = callForHashedPassword.data;
        
                // Step 2: Use the hashed password in the second API to get the token
                const callForGetToken = await axios.post(`https://rci-bo.orcaformation.com/api/getToken?login=promor&mdp=${hashedPassword}&version=web`);
        
                setToken(callForGetToken.data.token);

                const token = callForGetToken.data.token;
        
                // Step 3: Call the getInfos API
                const getInfo = await axios.post('https://rci-bo.orcaformation.com/api/getInfos', null, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
        
                setInfos(getInfo.data);
        
                // Step 4: Call the Contact Physique API
                const contactPhysique = await axios.post('https://rci-bo.orcaformation.com/api/addContactPhysique', null, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                    params: {
                        nomClient: nom,
                        prenomClient: prenom,
                        mailClient: email,
                        telClient: tele,
                        typeClientId: typeClientId,
                        sourceId: sourceId,
                    },
                });
                
                setaddContactPhysique(contactPhysique.data);
                
            } catch (error) {
                console.error('Error fetching data:', error);
            } finally {
                setLoading(false);
            }
        };
    
        fetchData();
    }, []);    

    useEffect(() => {
        updateDisplayedValue(50);
        const script = document.createElement('script');
        script.src = 'src/scripts/simulateur.js'; 
        script.async = true;
        document.body.appendChild(script);

        return () => {
            document.body.removeChild(script);
        };
    }, []);

    const handleStepInsertion = () => {
        updateSteps('Simulateur', 7);
        updateGuestSteps();
        setSimulateurInfo(selectedType);
    };
    const updateGuestSteps = async () => {
        try {
            // Fetch CSRF token
            const response = await axiosClient.get('/api/csrf-token');
            const csrfToken = response.data.csrfToken;
    
            // Update guest steps
            const updateResponse = await axiosClient.post('/api/update-guest', {
                id: context.guestInfo.id,
                Etape: 'Simulateur'
            }, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
            });
        } catch (error) {
            console.error('Error updating guest steps:', error);
        }
    };

    const clear = () => {
        rangeInput.value = 0;
    }

    const updateDisplayedValue = (value) => {
        const slider = document.querySelector('.slider');
        const fieldMIN = document.querySelector('.fieldMIN');
        const orangeLine = document.querySelector(".slider .progress");

        const percent = value;
        const Price = carPrice * percent / 100;
        setPrix(`${Price.toFixed(0)} DH - `);
        setApport(`${percent.toFixed(0)}`);
    
        // Calculate the left position of the fieldMIN div
        const sliderWidth = slider.offsetWidth;
        const dotPosition = (percent / 85) * sliderWidth;
        fieldMIN.style.marginLeft = `${dotPosition}px`;
        orangeLine.style.left = `${dotPosition}px`;
    };

    function scrollinput(e){
        updateDisplayedValue(parseInt(e.target.value));
    }

    const getsimulateur = (event) =>{
        event.preventDefault();
    
        // Step 6: call simulations logique api
        const simulationslogiqueAPi = axios.post('https://rci-bo.orcaformation.com/api/getSimulationsLogiqueBox', null, {
            headers: {
              Authorization: `Bearer ${token}`,
            },
            params: {
              periode: Duree,
              apport: Apport,
              versionId: context.version.id_simulateur,
              prixRemise: carPrice,
              clientId: addContactPhysique.clientId,
              typeSimulationId: typeSimulationId,
              sourceId: 8
            }
          });
    
        simulationslogiqueAPi.then(response => {
            setSimulationsLogique(response.data);
            //findCloseOffer(response.data);
        }).catch(error => {
            console.error("Error:", error);
        });
    
    }

    const chooseType = (e, type) => {
        const keySelected = e.target.value;
        let selectedSimulation;
    
        if (keySelected === 'Gratuit') {
            selectedSimulation = SimulationsLogique.result[type]['0%'];
        } else {
            selectedSimulation = SimulationsLogique.result[type][keySelected];
        }
    
        selectedSimulation[0].type = type;
        setSelectedType(selectedSimulation[0]);
    }

    return(
        <>
        <div className="row_1i">
            <div className="simulateurLogo">
                <img src="src/assets/logos/rci.5c345646.svg" alt="" />
            </div>
        </div>

        <div className="row_1i">
            <div className="topElements">
                <div className="titlePart">
                    <h1 className="titleofSimulateur"><span className="text-secondary">SIMULATEUR</span> DE FINANCEMENT</h1>
                </div>

                <div className="toGrayBare">
                    <div className="firstStep">
                        {/*<!--The 1 icon-->*/}
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" className="bi bi-1-circle" viewBox="0 0 16 16">
                            <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z"/>
                        </svg>
                        {/*<!--The list icon-->*/}
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 384 512">
                            <path d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM72 272a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm104-16H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H176c-8.8 0-16-7.2-16-16s7.2-16 16-16zM72 368a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm88 0c0-8.8 7.2-16 16-16H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H176c-8.8 0-16-7.2-16-16z"/>
                        </svg>
                    
                        <p>Choisir un apport et une durée</p>
                    </div>
                    {/*<!--The flesh icon-->*/}
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" className="bi bi-chevron-right" viewBox="0 0 16 16" style={{color: '#f45000'}}>
                        <path fillRule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>

                    {/*<div className="secondStep">
                        <!--The 2 icon-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" className="bi bi-2-circle" viewBox="0 0 16 16">
                            <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306"/>
                        </svg>

                        {/*<!--The settings icon-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512">
                            <path d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192 128a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32 64C14.3 64 0 78.3 0 96s14.3 32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z"/>
                        </svg>

                        <p>Choisir un apport et une durée</p>
                    </div>*/}
                </div>
            </div>
        </div>

        {/*!showPage2 ? (
            <SimulateurForm></SimulateurForm>
        ) : (*/}
        
        <div id="page2">
            <div className="row_1i">
                <div className="card_s2" id="carCardPage2">
                    <p className="name">
                        renault <strong>{context.modele.nommodele}</strong>
                    </p>
                    <p className="model">
                        {context.version.nommodele}
                    </p>
                    <img id="photo" src={`http://localhost:8000/storage/${context.version.image.replace(/\\/g, '/')}`} alt="Electrique Technic Gen.I Ph1" />
                    <div className="price">
                        <p className="text">
                            <span>Prix </span>{carPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ')}<small>DH / TTC</small>
                        </p>
                    </div>
                </div>

                <div className="card_s2">
                    <form onSubmit={getsimulateur}>
                        <div className="apport">
                            <div className="el-row">
                                <div className="el-col">
                                    <h2>Apport</h2>
                                </div>

                                <button type="button" id="clearButton" className="el-button el-tooltip el-button--primary is-circle" aria-describedby="el-tooltip-7201" tabIndex="0">  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" className="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fillRule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                    </svg>                          
                                </button>
                            </div>
                            <div className="dropdown_content_range" id="content_range">
                                <div className="price-input">
                                    <div className="fieldMIN">
                                        <p id="minValue" className="min">{prix?`${prix}`:'0DH - '}<span id="percent">{Apport?`${Apport}%`:'0%'}</span></p>
                                    </div>
                                </div>
                                <div className="slider">
                                    <div className="progress"></div>
                                </div>
                                <div className="range-input">
                                    <input type="range" id="rangeInputID" className="rangeInput" min="0" max="80" step="1" onChange={(e)=>scrollinput(e)} />
                                </div>
                            </div>
                        </div>

                        <div className="duree">
                            <h2>Durée</h2>
                        
                            <div className="owl-carousel" id="carouselDuree">
                                <div className="item" id="1" >
                                    <div className="agile__slides">
                                        <label className="content" htmlFor="duree24">
                                            <p>24<span>Mois</span></p>
                                        </label>
                                        <input type="radio" id="duree24" value='24' name="duree" style={{display: 'none'}} onChange={(e)=>setDuree(e.target.value)} />
                                    </div>                            
                                </div>
                                <div className="item" id="2" >
                                    <div className="agile__slides">
                                        <label className="content" htmlFor="duree36">
                                            <p>36<span>Mois</span></p>
                                        </label>
                                        <input type="radio" id="duree36" value="36" name="duree" style={{ display: 'none' }} onChange={(e) => setDuree(e.target.value)} />      
                                    </div>     
                                </div>
                                <div className="item" id="3" >
                                    <div className="agile__slides">
                                        <label className="content" htmlFor="duree48">
                                            <p>48<span>Mois</span></p>
                                        </label>
                                        <input type="radio" id="duree48" value='48' name="duree" style={{display: 'none'}} onChange={(e)=>setDuree(e.target.value)} />      
                                    </div>           
                                </div>
                                <div className="item" id="4">
                                    <div className="agile__slides">
                                        <label className="content agile__slide--active" htmlFor="duree60">
                                            <p>60<span>Mois</span></p>
                                        </label>
                                        <input type="radio" id="duree60" value='60' name="duree" style={{display: 'none'}} onChange={(e)=>setDuree(e.target.value)} />      
                                    </div>                    
                                </div> 
                                <div className="item" id="5" >
                                    <div className="agile__slides last-child">
                                        <label className="content" htmlFor="duree72">
                                            <p>72<span>Mois</span></p>
                                        </label>
                                        <input type="radio" id="duree72" value='72' name="duree" style={{display: 'none'}} onChange={(e)=>setDuree(e.target.value)} />      
                                    </div>                    
                                </div>                            
                            </div>

                            <button className="calculbtn" id="calculbtn" type='submit'>CALCULER</button>
                        </div>
                    </form>
                </div>
            </div>

            <div className="row_1i">
                <div className="results">
                    <h1>Faites votre choix</h1>
                    <h2>Full</h2>
                    
                    <div className="credit free">
                        {SimulationsLogique && SimulationsLogique.result && Object.keys(SimulationsLogique.result.full).map((key) => {
                            const simulations = SimulationsLogique.result.full[key];
                            if (simulations && simulations.length > 0) {
                                const simulation = simulations[0];
                                return (
                                    <div key={key}>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td className="el-tooltip" aria-describedby="el-tooltip-844" tabIndex="0">
                                                    <label className="el-checkbox is-checked">
                                                        <span className="el-checkbox__input is-checked">
                                                            <span className="el-checkbox__inner"></span>
                                                            <input type="radio" value={key === "0%" ? "Gratuit" : key} name='selectedType' onChange={(e)=>chooseType(e,'full')} style={{margin:'0',height:'20px',width:'20px'}}/>
                                                        </span><span className="el-checkbox__label">Option</span>
                                                    </label>
                                                    <div className="content">
                                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAhCAYAAABTERJSAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA4BpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpkMTc1ODYxYS1lYjE4LTRmMDAtYjMwZi00NGY0OTk1ZDdlMDciIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RTM0NEQ4NzRCMjBCMTFFOTgyQ0Q4MUE5MzU4MEYyODMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RTM0NEQ4NzNCMjBCMTFFOTgyQ0Q4MUE5MzU4MEYyODMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo4ODU4ZGIzMy0zZGI3LTQ3MzUtYWFhZi1hZTBiY2VjYzliNzIiIHN0UmVmOmRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDpkYWRiYWQzOC05ODE1LWQxNGMtYTBhZS0yMWMwZWMwOTk0OTAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4fuqs6AAAD20lEQVR42qyXe2iOURzHn807Y5hLLmVzK5cMY2GruS3CiJdNE5oUhfwhEa1GJOXaRsgUckmjd8qyssRWM2ZYm7n/YWNCImkX28z2+v7W981xep53z553pz7ve57fOef3/M45v/P7ncfwer1GF5AMckGV919pAq/AGTDFjh6XEVhZC7JAGHgK8kA5qAVDwVSQBMpAMBgA7lpqC2A1LnAFboAxNvpngJvKczAIUfs4NSSfhsx2MDYHHGJdjAkKxJgzNGS8IhsO+lj0lxf2V56PcfwcvW9nDZlERSmK7JbitJtMxvwAWZosm/0DMuYLeK48X6ZSN9jHeozJKkSb6JKS7tSYSCqYrynM1Z73sx7F59UW+m6DBqfG7DBZWt/Mpe0a6yPYVgse+9EXy/7DnBjjAV/9OPQvsIyy05R186MviH02OzHmPii0aHMp9Ql8yTobOluUbW2PinZLCyOtWfmj1CUSF4FLfF4KEizGBYFWJxH4HLfCX58sxa8kvlQqxz5b6xtGeZKTbVrFwb0s2qdr2+M79hIQ41hPVfqvoSzUiTHdOXi7RbtXOz0fQLXWnqm1vw0k6ElMaTWRF/Fl4YrMTZkkx6egUTn249i2KNBE6WWy041cYdI3gasjKzZKkTfRQCNQY1JoULLDjF+i+4qP9vTtoMwDDWAgqAQ1NsbIZasURIIo8NrqchVOB3Uyy0QwixndrE88uMrVkCQbYaVPfrbRuaS0gXrwEuzW7iSDtHuJmQNXMUrLteIh+Ea56NzV0eRkm0qwQHFgJ+gNQsF6MAjsAVtAhLKYEjELwGFwT5GPBovBWOqRbfzIPk/s7L0YU8l6tCLfBjJZf0CF1UwHsbxkh4OXIAdUgPegDjTT4C8dvHsD2Ap6gFPgpMGQXWGSoeu5NVbLugQUe/2XZrBAGSNZ/KjSngeOsF5mMAqWmvhATSccuR8NH86ANpEBrUC5CaYrRniUicb4/MpgUCrSlBfTGbviA8+jGJGhXTdeUH5cPl1cdNhmbT/NZFalJ68NwzhGrhNtvHL8BCPZTw7Ed9bTwEHwFSwEd0ToolM2ai/oDn7bNEZefp4BMIwOGcp/4R0PgBgSAwpBX3CAp/W/oNfK+6u6tNXcb6MLOcstKQeTzfoE8xu4TpttPeVpnLks+XWwnDGkMyVR5gw28ijL6jyz+taWstckC/uKfFNfBJ8VWRXvJnP9rESE8hksEXmwnQjsy5QfuQK/wEQmwOma74wCqcANpinyfPAI/ABDwEwwh20rgcduBBbFM5hVfY73CZwAbzoYH8+tczMbh/BESbS+wijeanc//wowABrygZuhO8w0AAAAAElFTkSuQmCC" alt="free" />
                                                        {key === "0%" ? "Gratuit" : key}
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>Apport <strong>{simulation.apport_per}%</strong></p>
                                                </td>
                                                <td>
                                                    <p>Taux<strong>{simulation.taux}%</strong></p>
                                                </td>
                                                <td>
                                                    <p>Durée / Mois<strong>{simulation.duree}</strong></p>
                                                </td>
                                                <td>
                                                    <p>Frais de dossier<strong>{simulation.frais_dossier} DH</strong></p>
                                                </td>
                                                <td>
                                                    <p>Valeur résiduelle (VR)<strong>{simulation.vr} DH</strong></p>
                                                </td>
                                                <td>
                                                    <p>Mensualité avec assurances + contrat d'entretien<strong className="colered">{simulation.output.mensualite_all_inclusive} DH</strong></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                );    
                            }
                            return null;
                        })}

                        {/*<div className="asteriks">
                            <strong className="show-on-desktop free">Offrez-vous &amp; votre famille la mobilité à 0%</strong>
                            <strong>* ASSURANCES INCLUSES :</strong>                                <ul>
                                <li>
                                    <span className="text-secondary">* Assurances : </span>ASSURANCE DI : 67.55 DH / MOIS, ASSURANCE AUTO MASS MARKET D (HORS STE) : 195.75 DH / MOIS, ASSISTANCE CONFORT : 7.06 DH / MOIS
                                </li>
                            </ul>
                        </div>*/}
                    </div>
                    
                    <div>
                        <h2>Relax</h2>
                        <div className="credit zen">
                            {SimulationsLogique && SimulationsLogique.result &&Object.keys(SimulationsLogique.result.relax).map((key) => {
                                const simulations = SimulationsLogique.result.relax[key];

                                if (simulations && simulations.length > 0) {
                                    const simulation = simulations[0];

                                    return (
                                        <div key={key}>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td className="el-tooltip" aria-describedby="el-tooltip-844" tabIndex="0">
                                                        <label className="el-checkbox is-checked">
                                                            <span className="el-checkbox__input is-checked">
                                                                <span className="el-checkbox__inner"></span>
                                                                <input type="radio" name='selectedType' value={key === "0%" ? "Gratuit" : key} onChange={(e)=>chooseType(e,'relax')} style={{margin:'0',height:'20px',width:'20px'}}/>
                                                            </span><span className="el-checkbox__label">Option</span>
                                                        </label>
                                                        <div className="content">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAhCAYAAABTERJSAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA4BpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpkMTc1ODYxYS1lYjE4LTRmMDAtYjMwZi00NGY0OTk1ZDdlMDciIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RTM0NEQ4NzRCMjBCMTFFOTgyQ0Q4MUE5MzU4MEYyODMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RTM0NEQ4NzNCMjBCMTFFOTgyQ0Q4MUE5MzU4MEYyODMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo4ODU4ZGIzMy0zZGI3LTQ3MzUtYWFhZi1hZTBiY2VjYzliNzIiIHN0UmVmOmRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDpkYWRiYWQzOC05ODE1LWQxNGMtYTBhZS0yMWMwZWMwOTk0OTAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4fuqs6AAAD20lEQVR42qyXe2iOURzHn807Y5hLLmVzK5cMY2GruS3CiJdNE5oUhfwhEa1GJOXaRsgUckmjd8qyssRWM2ZYm7n/YWNCImkX28z2+v7W981xep53z553pz7ve57fOef3/M45v/P7ncfwer1GF5AMckGV919pAq/AGTDFjh6XEVhZC7JAGHgK8kA5qAVDwVSQBMpAMBgA7lpqC2A1LnAFboAxNvpngJvKczAIUfs4NSSfhsx2MDYHHGJdjAkKxJgzNGS8IhsO+lj0lxf2V56PcfwcvW9nDZlERSmK7JbitJtMxvwAWZosm/0DMuYLeK48X6ZSN9jHeozJKkSb6JKS7tSYSCqYrynM1Z73sx7F59UW+m6DBqfG7DBZWt/Mpe0a6yPYVgse+9EXy/7DnBjjAV/9OPQvsIyy05R186MviH02OzHmPii0aHMp9Ql8yTobOluUbW2PinZLCyOtWfmj1CUSF4FLfF4KEizGBYFWJxH4HLfCX58sxa8kvlQqxz5b6xtGeZKTbVrFwb0s2qdr2+M79hIQ41hPVfqvoSzUiTHdOXi7RbtXOz0fQLXWnqm1vw0k6ElMaTWRF/Fl4YrMTZkkx6egUTn249i2KNBE6WWy041cYdI3gasjKzZKkTfRQCNQY1JoULLDjF+i+4qP9vTtoMwDDWAgqAQ1NsbIZasURIIo8NrqchVOB3Uyy0QwixndrE88uMrVkCQbYaVPfrbRuaS0gXrwEuzW7iSDtHuJmQNXMUrLteIh+Ea56NzV0eRkm0qwQHFgJ+gNQsF6MAjsAVtAhLKYEjELwGFwT5GPBovBWOqRbfzIPk/s7L0YU8l6tCLfBjJZf0CF1UwHsbxkh4OXIAdUgPegDjTT4C8dvHsD2Ap6gFPgpMGQXWGSoeu5NVbLugQUe/2XZrBAGSNZ/KjSngeOsF5mMAqWmvhATSccuR8NH86ANpEBrUC5CaYrRniUicb4/MpgUCrSlBfTGbviA8+jGJGhXTdeUH5cPl1cdNhmbT/NZFalJ68NwzhGrhNtvHL8BCPZTw7Ed9bTwEHwFSwEd0ToolM2ai/oDn7bNEZefp4BMIwOGcp/4R0PgBgSAwpBX3CAp/W/oNfK+6u6tNXcb6MLOcstKQeTzfoE8xu4TpttPeVpnLks+XWwnDGkMyVR5gw28ijL6jyz+taWstckC/uKfFNfBJ8VWRXvJnP9rESE8hksEXmwnQjsy5QfuQK/wEQmwOma74wCqcANpinyfPAI/ABDwEwwh20rgcduBBbFM5hVfY73CZwAbzoYH8+tczMbh/BESbS+wijeanc//wowABrygZuhO8w0AAAAAElFTkSuQmCC" alt="free" />
                                                            {key === "0%" ? "Gratuit" : key}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>Apport <strong>{simulation.apport_per}%</strong></p>
                                                    </td>
                                                    <td>
                                                        <p>Taux<strong>{simulation.taux}%</strong></p>
                                                    </td>
                                                    <td>
                                                        <p>Durée / Mois<strong>{simulation.duree}</strong></p>
                                                    </td>
                                                    <td>
                                                        <p>Frais de dossier<strong>{simulation.frais_dossier} DH</strong></p>
                                                    </td>
                                                    <td>
                                                        <p>Valeur résiduelle (VR)<strong>{simulation.vr} DH</strong></p>
                                                    </td>
                                                    <td>
                                                        <p>Mensualité avec assurances*<strong className="colered">{simulation.output.mensualite_all_inclusive} DH</strong></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    );    
                                }
                                return null;
                            })}
                            {/*<div className="asteriks">
                                <strong className="show-on-desktop zen">Pour acheter une voiture, Plus besoin de serrer la ceinture</strong>
                                <strong>* ASSURANCES INCLUSES :</strong>
                                <ul>
                                    <li>
                                        <span className="text-secondary">* Assurances : </span>
                                        ASSURANCE DI : 67.55 DH / MOIS, ASSURANCE AUTO MASS MARKET D (HORS STE) : 195.75 DH / MOIS, ASSISTANCE CONFORT : 7.06 DH / MOIS
                                    </li>
                                </ul>
                            </div>*/}
                        </div>
                    </div>
                    
                    <div className="suivantBTN_CTN">
                        <Link to={'/CreateAccount'} className="suivantBTN" onClick={handleStepInsertion} >Suivant</Link>
                    </div>
                </div>
            </div>
        </div>

        <div className="row_1i">
            <div className="results">
                <div className="footertext_CNT">
                    <p className="footerText">
                        Conformément à la loi n° 09-08 promulguée par le Dahir 1-09-15 du 18 février 2009, relative à la protection des personnes physiques à l'égard du traitement des données à caractère personnel, vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent, que vous pouvez exercer en vous adressant à : 
                        <strong> Finance Maroc, 89 BOULEVARD MOULAY ISMAIL. CASABLANCA. MAROC </strong> 
                    </p>
                    <p>
                        <strong>Email:</strong> <span>contact.rcimaroc@rcibanque.com</span>
                    </p>
                </div>

                <div className="footerBar_CNT">
                    <p>© 2024 RCI FINANCE MAROC. Tous les droits réservés.</p>
                </div>

                <div className="keep-scroll">
                    <i className="el-icon-arrow-down"></i>
                </div>
            </div>
        </div>

        </>
    )
}