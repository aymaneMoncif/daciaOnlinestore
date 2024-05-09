// src/components/ApiComponent.js
import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';

const ApiComponent = () => {

  const [CarVersionSelected, setCarVersionSelected] = useState([]);
  const [ModelId, setModelId] = useState(null);
  const [Marque, setMARQUE] = useState([]);
  const [CarImage, setCarImage] = useState([]);
  const [AllVersions, setAllVersions] = useState([]);

  const [infos, setInfos] = useState(null);
  const [addContactPhysique, setaddContactPhysique] = useState(null);
  const [token, setToken] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const isInitialMount = useRef(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        // Step 1: Get hashed password from the first API
        const callForHachPassword = await axios.post('https://rci-bo.orcaformation.com/api/getHashedPwd', null, {
          params: {
            mdp: 'Y3Zpi5mC3',
          },
        });

        const hashedPassword = callForHachPassword.data;

        // Step 2: Use the hashed password in the second API to get the token
        const CallForGetToken = await axios.post(`https://rci-bo.orcaformation.com/api/getToken?login=promor&mdp=${hashedPassword}&version=web`);

        setToken(CallForGetToken.data.token);

        const token = CallForGetToken.data.token;

        // Step 3: call the getInfos api
        const GetInfo = await axios.post('https://rci-bo.orcaformation.com/api/getInfos', null, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        const filteredCars = GetInfo.data.marques.filter((e) => {
            return e.LibelleMarque === 'DACIA';
        });

        setMARQUE(filteredCars);
        setInfos(GetInfo.data);

      } catch (error) {
        setError(error.response.data);
      } finally {
        setLoading(false);
      }
    };



    fetchData();
  }, []);


  const getCars = (idCar) => {
    const cars = [];

    Marque.forEach((e) => {
      e.RefModeles.forEach((models) => {
        if (models.ModeleId === idCar) {
          setCarImage(models.ModelePhoto);
          setModelId(models.ModeleId);
          cars.push(...models.Versions);
        }
      });
    });

    setAllVersions(cars);
  };


  //choose the version of the car you selected
  const chooseCarVersion = (id) => {
    AllVersions.filter((version)=>{
        if(version.VersionId == id.target.value){
            setCarVersionSelected(version);
        }
    })
  }

  const handleFormSubmit = (event) => {
    event.preventDefault();

    // Basic validation
    if (!/^\d+$/.test(tele)) {
      alert('Téléphone doit contenir uniquement des chiffres.');
      return;
    }

    if (!email.includes('@gmail')) {
      alert("L'email doit contenir '@gmail'.");
      return;
    }

    //Step 5: call Contact Physique api
    const contactPhysique = axios.post('https://rci-bo.orcaformation.com/api/addContactPhysique', null, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
        params: {
            nomClient: nom,
            prenomClient: prenom,
            mailClient: email,
            telClient: tele,
            typeClientId: typeClientId,
            sourceId: sourceId
        },
    });

    contactPhysique.then(response => {
        setaddContactPhysique(response.data);
    }).catch(error => {
        console.error("Error:", error);
    });
  };



  return (
    <div style={{padding: '60px'}}>
      {
        AllVersions.length === 0 ? (
            <div>
                <h1>Infos Cars</h1>
                <div style={{ textAlign: 'left' }}>
                    {Marque.map((e) => (
                    <div key={e.IdRefMarque}>
                        <p>{e.LibelleMarque}</p>
                        <div>
                        {e.RefModeles.map((model) => (
                            <div
                            key={model.ModeleId}
                            style={{ textAlign: 'left', border: '1px solid red' }}
                            onClick={() => getCars(model.ModeleId)}
                            >
                            <img src={model.ModelePhoto} alt={model.ModeleLibelle} style={{ width: '300px' }} />
                            <p>{model.ModeleLibelle}</p>
                            <p>{model.motorisation}</p>
                            </div>
                        ))}
                        </div>
                    </div>
                    ))}
                </div>
            </div>
        ) : CarVersionSelected.length === 0 ?(
            <table style={{ borderCollapse: 'collapse', width: '100%' }}>
                <thead>
                    <tr style={{ borderBottom: '1px solid black' }}>
                        <th style={{ borderRight: '1px solid black', padding: '0px',width: '300px' }}>Image</th>
                        <th style={{ borderRight: '1px solid black', padding: '8px' }}>Nom</th>
                        <th style={{ padding: '8px' }}>ID Simulateur</th>
                    </tr>
                </thead>
                <tbody>
                    {AllVersions.map((version, index) => (
                        <tr key={index} style={{ borderBottom: '1px solid black' }}>
                            <td style={{ borderRight: '1px solid black', padding: '8px' }}><img src={CarImage} alt="Car" style={{ width: '240px' }} /></td>
                            <td style={{ borderRight: '1px solid black', padding: '8px' }}>{version.Libelle}</td>
                            <td style={{ padding: '8px', fontSize: '20px', fontWeight: 'bold', textAlign: 'center' }}>{version.VersionId}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        ) : ""
    }
    </div>
  );

};

export default ApiComponent;
