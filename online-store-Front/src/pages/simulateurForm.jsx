import { useContext, useState } from 'react';
import { DataContext } from '../../contexts/dataContext';

export default function SimulateurForm(){

    const context = useContext(DataContext);
    const { updateSteps } = useContext(DataContext);
    const price = parseFloat(context.version.prixversion);
    const discount = parseFloat(context.version.remise);
    // Calculate the discounted price
    const discountedPrice = price - discount;

    const [nom, setNom] = useState('');
    const [prenom, setPrenom] = useState('');
    const [email, setEmail] = useState('');
    const [tele, setTele] = useState('');
    const [conditionsChecked, setConditionsChecked] = useState(false);

    const [nomError, setNomError] = useState('');
    const [prenomError, setPrenomError] = useState('');
    const [emailError, setEmailError] = useState('');
    const [teleError, setTeleError] = useState('');
    const [conditionsCheckedError, setConditionsCheckedError] = useState("");

    // Regular expression for email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const teleRegex = /^[0-9]{10}$/;
    const phonePattern = /^(06|07|05)\d{8}$/;

    const testInputs = (e) => {
        const value = e.target.value;
        const name = e.target.name;
        console.log(name);
    
        switch (name) {
            case 'nom':
                setNom(value);
                setNomError(value.trim() ? '' : "Nom field is required");
                break;
            case 'prenom':
                setPrenom(value);
                setPrenomError(value.trim() ? '' : "Prenom field is required");
                break;
            case 'email':
                setEmail(value);
                setEmailError(value.trim() ? '' : "Email field is required");
                setEmailError(emailRegex.test(value) ? '' : "Invalid email format");
                break;
            case 'tele':
                setTele(value);
                setTeleError(value.trim() ? '' : "Telephone field is required");
                setTeleError(teleRegex.test(value) ? '' : "Invalid telephone number format (should be 10 digits)");
                setTeleError(phonePattern.test(value) ? '' : "Invalid telephone number format (should start with 06 OR 07 OR 07)");
                break;
            default:
                break;
        }
    
        if(name === 'conditions'){
            if (!conditionsChecked ) {
                setConditionsCheckedError("accept the conditions");
            } else {
                setConditionsCheckedError('');
            }
        }
        
    }

    /*const handleSubmit = () => {
        //__Call the contactPhysique API
        fetch('https://rci-bo.orcaformation.com/api/addContactPhysique', {
            method: 'POST',
            headers: {
                Authorization: `Bearer ${globalToken}`,
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                nomClient: nom,
                prenomClient: prenom,
                mailClient: email,
                telClient: tele,
                typeClientId: 1,
                sourceId: 2
            }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('failed to add contact physique');
                }
                return response.json();
            })
            .then(contactinfo => {
                const clientID = contactinfo.clientId;
                callSimulateurLogicAPI(60, 50, findMyVersion.VersionId, findMyVersion.PrixRemise, clientID);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        setShowPage2(true);
    };*/

    return(
        <>
        <div id="page1">
            <div className="row_1i">
                <div className="card-car show-on-desktop" id="carCardInfodesktop">
                    <div className="el-col el-col-12">
                        <div className="content" >
                            <p className="name">RENAULT <span>{context.modele.nommodele}</span></p>
                            <p className="model">{context.version.nommodele}</p>
                            <div className="price">
                                <p className="text-remise">Prix avec remise</p> 
                                <p className="prix">{discountedPrice}<span>DH / TTC</span></p> 
                            </div>
                        </div>
                    </div>
                    <div className="white-background el-col el-col-12">
                        <img src={`http://localhost:8000/storage/${context.version.image.replace(/\\/g, '/')}`} alt={context.modele.nommodele} />
                    </div>            
                </div>

                <div className="card-car show-on-mobile">
                    <div className="content" id="carCardInfoMobile">
                        <p className="name">RENAULT <strong>{context.modele.nommodele}</strong></p>
                        <p className="model">{context.version.nommodele}</p>
                        <img src={`http://localhost:8000/storage/${context.version.image.replace(/\\/g, '/')}`} alt={context.version.nommodele} />
                        <div className="price">
                            <p className="text-remise">Prix avec remise</p> 
                            <p className="prix">{discountedPrice}<span>DH / TTC</span></p> 
                        </div>
                    </div>
                </div>
            </div>

            <div className="row_1i">
                <div className="PersonnelInfosForm">
                    <h2>Veuillez compléter le formulaire suivant pour commencer la simulation</h2>
                    <form className="el-form">
                        <div className="el-row">                              
                            <div className="el-input">
                                <input type="text" autoComplete="off" name='nom' placeholder="Nom *" className="el-input__inner" id="nom" onChange={(e)=> testInputs(e)} /> 
                                <span style={{color:'red'}}>{nomError}</span>
                            </div>

                            <div className="el-input">
                                <input type="text" autoComplete="off" name='prenom' placeholder="Prénom *" className="el-input__inner" id="prenom" onChange={(e)=> testInputs(e)} />
                                <span style={{color:'red'}}>{prenomError}</span>
                            </div>       
                        </div>
                        <div className="el-row">                               
                            <div className="el-input">
                                <input type="email" autoComplete="off" name='email' placeholder="Email *" className="el-input__inner" id="email" onChange={(e)=>testInputs(e)} />
                                <span style={{color:'red'}}>{emailError}</span>
                            </div>                                                                  
                                    
                            <div className="el-input">
                                <input type="tel" autoComplete="off" name='tele' placeholder="Téléphone *" className="el-input__inner" id="tele" onChange={(e)=>testInputs(e)} />
                                <span style={{color:'red'}}>{teleError}</span>
                            </div>
                        </div>
                        
                        <div className="el-form-item conditions is-required">
                            <div className="el-form-item__content">
                                <input type="checkbox" aria-hidden="false" name="conditions" className="inputCondition" id="conditions" checked={conditionsChecked} onChange={e => setConditionsChecked(e.target.checked)} />
                                <label htmlFor="conditions" className="labelCondition"></label>
                                <span className="el-checkbox__label">
                                    J'ai lu et j'accepte 
                                    <a href="https://www.mobilize-fs.ma/mentions-legales" target="_blank" className="el-link el-link--primary is-underline">
                                        <span className="el-link--inner">les conditions générales d'utilisation</span>
                                    </a> **
                                </span>
                            </div>
                            <span style={{color:'red'}}>{conditionsCheckedError}</span>
                        </div>

                        <div className="el-form-button_zone">
                            <button type="button" className="el-button" id="submitBTN">
                                <span>Je simule mon crédit</span>
                            </button>
                        </div>

                        <p className="text_secondary_ChampsOb">(<span style={{color: '#f45000'}}>*</span>) Champs obligatoires</p>
                        {/*<!--<p className="smaller"></p>-->*/}
                    </form>
                </div>
            </div>
        </div>
        </>
    )
}