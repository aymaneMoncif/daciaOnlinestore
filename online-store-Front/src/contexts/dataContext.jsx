import { createContext, useState, useEffect } from 'react';
import Cookies from 'js-cookie';

export const DataContext = createContext({
    modele: {},
    setModele: () => {},
    version: {},
    setVersion: () => {},
    color: {},
    setColor: () => {},
    equipements: {},
    setEquipements: () => {},
    pathImages: {},
    setPathImages: () => {},
    guestInfo: {},
    setGuestInfo: () => {},
    total: {},
    setTotal: () => {},
    
    cmptCreated: {},
    setCmptCreated: () => {},

    simulateurInfo: {},
    setSimulateurInfo: () => {},
    
    steps: {},
    setSteps: () => {},
});

export default function FirstDataContext({ children }) {
    const [modele, setModele] = useState(() => {
        const cookieValue = Cookies.get('modele');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [version, setVersion] = useState(() => {
        const cookieValue = Cookies.get('version');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [color, setColor] = useState(() => {
        const cookieValue = Cookies.get('color');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [equipements, setEquipements] = useState(() => {
        const cookieValue = Cookies.get('equipements');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [pathImages, setPathImages] = useState(() => {
        const cookieValue = Cookies.get('pathImages');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [guestInfo, setGuestInfo] = useState(() => {
        const cookieValue = Cookies.get('guestInfo');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [steps, setSteps] = useState(() => {
        const cookieValue = Cookies.get('steps');
        return cookieValue ? JSON.parse(cookieValue) : [];
    });
    const [total, setTotal] = useState(() => {
        const cookieValue = Cookies.get('total');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [cmptCreated, setCmptCreated] = useState(() => {
        const cookieValue = Cookies.get('cmptCreated');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });
    const [simulateurInfo, setSimulateurInfo] = useState(() => {
        const cookieValue = Cookies.get('simulateurInfo');
        return cookieValue ? JSON.parse(cookieValue) : {};
    });

    // Reset color and equipment contexts when version context changes
    useEffect(() => {
        // Check if color exists and if the version ID has changed compared to the one stored in color context
        if (color && color.pivot && version.id !== color.pivot.version_id) {
            setColor({}); // Reset color context
            setPathImages({}); // Reset pathImages context
        }

        // Check if equipements exist
        if (equipements) {
            Object.values(equipements).forEach(equipement => {
                if (equipement.pivot && version.id !== equipement.pivot.version_id) {
                    setEquipements({}); // Reset equipements context
                }
            });
        }
    }, [version, color, equipements]);


    useEffect(() => {
        Cookies.set('modele', JSON.stringify(modele), { expires: 7 });
        Cookies.set('version', JSON.stringify(version), { expires: 7 });
        Cookies.set('color', JSON.stringify(color), { expires: 7 });
        Cookies.set('equipements', JSON.stringify(equipements), { expires: 7 });
        Cookies.set('pathImages', JSON.stringify(pathImages), { expires: 7 });
        Cookies.set('guestInfo', JSON.stringify(guestInfo), { expires: 7 });
        Cookies.set('total', JSON.stringify(total), { expires: 7 });
        Cookies.set('cmptCreated', JSON.stringify(cmptCreated), { expires: 7 });
        Cookies.set('simulateurInfo', JSON.stringify(simulateurInfo), { expires: 7 });
    }, [modele, version, color, equipements, pathImages, guestInfo,simulateurInfo, total, cmptCreated]);

    const updateSteps = (stepName, stepNumber) => {
        const existStep = steps.findIndex(step=>step.number === stepNumber);

        if(existStep === -1){
            const updatedSteps = [...steps, { step: stepName, number: stepNumber }];
            Cookies.set('steps', JSON.stringify(updatedSteps), { expires: 7 });
            setSteps(updatedSteps);
        }
    };

    return (
        <DataContext.Provider value={{
            modele,
            setModele,
            version,
            setVersion,
            color,
            setColor,
            equipements,
            setEquipements,
            pathImages,
            setPathImages,
            guestInfo,
            setGuestInfo,
            simulateurInfo,
            setSimulateurInfo,
            steps,
            updateSteps,
            total,
            setTotal,
            cmptCreated,
            setCmptCreated,
        }}>
            {children}
        </DataContext.Provider>
    );
}
