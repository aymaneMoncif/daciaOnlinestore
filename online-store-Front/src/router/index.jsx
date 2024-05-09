import { createBrowserRouter } from 'react-router-dom';
import Home from '../pages/home';
import Modele from '../pages/modele';
import Version from '../pages/version';
import VersionColor from '../pages/couleur';
import Interieure from '../pages/interieure';
import Equipement from '../pages/equipements';
import Recapitulatif from '../pages/recapitulatif';
import CreateAccount from '../pages/creatAccount';
import Steps from '../layout/steps';
import Layout from '../layout/layout';
import Simulateur from '../pages/simulateur';
import ApiComponent from '../pages/insert';
import NotFound from '../pages/notFound';

export const CLIENT_PSW_CHANGE = '/ChangePassword';
export const CLIENT_SWV_CMD = '/suiviCommande';

export const router = createBrowserRouter([
    {
        element: <Layout />,
        children: [
            {
                path: '/',
                element: <Home />
            },
            {
                path: '*',
                element: <NotFound />
            },
            {
                element: <Steps />,
                children: [
                    {
                        path: '/Modele',
                        element: <Modele />
                    },
                    {
                        path: '/version',
                        element: <Version />
                    },
                    {
                        path: '/VersionCouleur',
                        element: <VersionColor />
                    },
                    {
                        path: '/VersionInterieure',
                        element: <Interieure />
                    },
                    {
                        path: '/VersionEquipement',
                        element: <Equipement />
                    },
                    {
                        path: '/Recapitulatif',
                        element: <Recapitulatif />
                    },
                    {
                        path: '/Simulateur',
                        element: <Simulateur />
                    },
                    {
                        path: '/CreateAccount',
                        element: <CreateAccount />
                    },
                ]
            }
        ]
    },
    {
        path: 'insertIDS',
        element: <ApiComponent />
    }
]);


