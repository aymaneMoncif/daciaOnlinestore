import { Outlet } from "react-router-dom";
import { useContext, useEffect, useState } from "react";
import { axiosClient } from "../Api/axios";

export default function Layout(){
    const [user, setUser] = useState(null);

    useEffect(() => {
        const fetchUser = async () => {
            try {
                const response = await axiosClient('/api/user');
                setUser(response.data);
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    console.log('User is not authenticated.');
                } else {
                    console.error('Error fetching user:', error);
                }
            }
        };
        fetchUser();
    }, []);



    const [isScrollingDown, setIsScrollingDown] = useState(false);

    const [VU, setVU] = useState("");
    const [VP, setVP] = useState("");
    const [mobileMenu, setMobileMenu] = useState("");
    const [liOpenVP, setLiOpenVP]= useState("");
    const [liOpenVU, setLiOpenVU]= useState("");
    const [VPM, setVPM]= useState("");
    const [VUM, setVUM]= useState("");
    const [serclient, setSerclient]= useState("");
    const [reseau, setReseau]= useState("");
    const [outilAchat, setOutilAchat]= useState("");


    useEffect(() => {
        const handleClickOutside = (event) => {
            if (!event.target.closest('.header_container')) {
                setVU('');
                setVP('');
            }
        };
        document.body.addEventListener('click', handleClickOutside);
        return () => {
            document.body.removeEventListener('click', handleClickOutside);
        };
    }, []);

    const showMenuVU = () =>{
        setVU(prevStatus => (prevStatus === 'show-menu' ? '' : 'show-menu'));
        setVP('');
    }

    const showMenuVP = () =>{
        setVP(prevStatus => (prevStatus === 'show-menu' ? '' : 'show-menu'));
        setVU('');
    }

    const showMenuMobile = () =>{
        setMobileMenu(prevStatus => (prevStatus === 'show_m_menu' ? '' : 'show_m_menu'));
    }
    const closeMenuMobile = () =>{
        setMobileMenu('');
    }

    const openVPlist = () =>{
        if(mobileMenu === 'show_m_menu'){
            setLiOpenVP(prevStatus => (prevStatus === 'liOpen' ? '' : 'liOpen'));
            setLiOpenVU('');
            setVPM(prevStatus => (prevStatus === 'show-menu2' ? '' : 'show-menu2'));
            setVUM('');
            setVP('');
            setVU('');
        }
    }
    const openVUlist = () =>{
        if(mobileMenu === 'show_m_menu'){
            setLiOpenVU(prevStatus => (prevStatus === 'liOpen' ? '' : 'liOpen'));
            setLiOpenVP('');
            setVUM(prevStatus => (prevStatus === 'show-menu2' ? '' : 'show-menu2'));
            setVPM('');
            setVP('');
            setVU('');
        }
    }

    const showFooter1 = () =>{
        console.log('here');
        setSerclient(prevStatus => (prevStatus === 'show' ? '' : 'show'));
        setReseau('');
        setOutilAchat('');
    }
    const showFooter3 = () =>{
        setOutilAchat(prevStatus => (prevStatus === 'show' ? '' : 'show'));
        setReseau('');
        setSerclient('');
    }
    const showFooter2 = () =>{
        setReseau(prevStatus => (prevStatus === 'show' ? '' : 'show'));
        setOutilAchat('');
        setSerclient('');
    }

    useEffect(() => {
        const handleScroll = () => {
            const scrollTop = window.scrollY;
            const navContainer = document.querySelector('.header_container');
            const left_logo = document.querySelector('.left_logo');
            const right_logo = document.querySelector('.right_logo_img');

            if (scrollTop > 350 && !isScrollingDown) {

                left_logo.classList.add('InScroll');
                right_logo.src = "src/assets/menuCars/M.png";
                right_logo.style.width = "52px";
                right_logo.classList.add('M');

                navContainer.classList.add('fixed');

                left_logo.classList.add('logoInScroll');

                setIsScrollingDown(true);
            } else if (scrollTop <= 110 && isScrollingDown) {

                left_logo.classList.remove('InScroll');
                right_logo.src = "src/assets/menuCars/m-automotiv.png";
                right_logo.style.width = "100%";
                right_logo.classList.remove('M');

                navContainer.classList.remove('fixed');

                left_logo.classList.remove('logoInScroll');

                setIsScrollingDown(false);
            }
        };

        window.addEventListener('scroll', handleScroll);

        return () => {
            window.removeEventListener('scroll', handleScroll);
        };
    }, [isScrollingDown]);

    return(
        <>
            <header>

                <div className="header_container">
                    <div id="megaMenuVP" className={`mega_menu_desktop ${VP}`}>
                        <div className="menu_carlist">
                            <div className="menu_row">
                                <div className="menu_carcard">
                                    <a href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouveau_duster">
                                        <img src="src/assets/menuCars/Duster.png" alt="" />
                                        <div>
                                            <p className="carName">DUSTER</p>
                                            <p className="carPrice">à partire de 210 000 MAD</p>
                                        </div>
                                     </a>
                                </div>
                                <div className="menu_carcard">
                                    <a href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouvelle-sandero-streetway">
                                        <img src="src/assets/menuCars/Streetway.png" alt="" />
                                        <div>
                                            <p className="carName">SANDERO STREETWAY</p>
                                            <p className="carPrice">à partire de 150 000 MAD</p>
                                        </div>
                                    </a>
                                </div>
                                <div className="menu_carcard">
                                    <a href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouvelle-logan">
                                        <img src="src/assets/menuCars/Logan.png" alt="" />
                                        <div>
                                            <p className="carName">LOGAN</p>
                                            <p className="carPrice">à partire de 132 000 MAD</p>
                                        </div>
                                    </a>
                                </div>
                                <div className="menu_carcard">
                                    <a href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouvelle-stepway">
                                        <img src="src/assets/menuCars/Stepway.png" alt="" />
                                        <div>
                                            <p className="carName">SANDERO STEPWAY</p>
                                            <p className="carPrice">à partire de 141 000 MAD</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div className="menu_row">
                                <div className="menu_carcard">
                                    <a href="https://dacia.m-automotiv.ma/fr/gamme/modele/spring">
                                        <img src="src/assets/menuCars/Spring.png" alt="" />
                                        <div>
                                            <p className="carName">SPRING</p>
                                            <p className="carPrice">à partire de 200 000 MAD</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="header_left">
                        <a className="left_logo" href="https://dacia.m-automotiv.ma">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" version="1.1" viewBox="0 0 207.27 62.31" style={{ fill: '#646b52', width: '180px'}}>
                                <path className="cls-1" d="M51.94,32.26c-.8.81-1.65,1.7-2.52,2.55-2.05,2.02-4.11,4.04-6.19,6.04-.23.22-.58.43-.87.43-8.54.02-17.08.01-25.61,0-.05,0-.1-.02-.23-.05v-5.72c1.59,0,3.18,0,4.77,0,5.84-.03,11.69-.06,17.53-.13.4,0,.88-.2,1.17-.48.93-.87,1.78-1.83,2.73-2.81-.98-1.06-1.98-2.19-3.04-3.26-.18-.18-.59-.18-.89-.18-7.2,0-14.41.01-21.61.02-.21,0-.41-.02-.67-.03v-5.67c.27-.01.52-.04.78-.04,8.22,0,16.44,0,24.65-.03.58,0,.99.15,1.4.57,2.84,2.93,5.71,5.84,8.61,8.8Z"/>
                                <path className="cls-1" d="M95.69,31.9c2.7-2.75,5.66-5.78,8.65-8.79.18-.18.52-.26.79-.26,8.4,0,16.8.02,25.21.04.15,0,.31.03.5.06v5.64c-.36,0-.67,0-.98,0-7.12-.01-14.24-.03-21.37-.01-.37,0-.82.2-1.08.46-.98.98-1.89,2.02-2.77,2.97,1.02,1.07,1.99,2.13,3.01,3.13.18.18.59.18.9.19,7.12.06,14.24.1,21.36.15.26,0,.52,0,.9,0v5.75c-.21,0-.49,0-.77,0-8.27,0-16.54,0-24.81-.03-.42,0-.95-.21-1.24-.51-2.81-2.92-5.58-5.88-8.31-8.77Z"/>
                                <path className="cls-1" d="M73.68,31.87c-.88.87-1.65,1.61-2.39,2.36-2.19,2.22-4.36,4.47-6.57,6.67-.28.28-.77.49-1.16.49-2.45.03-4.91,0-7.36-.02-.31,0-.62-.03-1.11-.05,6.22-6.55,12.33-12.98,18.53-19.5,6.26,6.48,12.49,12.93,18.83,19.49-.38.03-.6.07-.83.07-2.75,0-5.5.03-8.24-.02-.41,0-.93-.24-1.22-.54-2.67-2.73-5.3-5.49-7.93-8.25-.2-.21-.35-.47-.53-.71Z"/>
                                <path className="cls-1" d="M173.83,32.35c-2.4,2.27-4.8,4.54-7.19,6.82-.79.75-1.42,1.84-2.36,2.23-.93.39-2.15.12-3.24.13-1.84,0-3.68,0-5.52,0-.05,0-.1-.03-.28-.09,6.15-6.49,12.25-12.94,18.42-19.45,6.27,6.49,12.48,12.93,18.84,19.51-.41.02-.68.04-.95.04-2.69,0-5.39-.01-8.08.01-.55,0-.94-.16-1.32-.56-2.64-2.79-5.31-5.55-7.96-8.33-.18-.19-.33-.42-.49-.63.04.11.08.22.12.33Z"/>
                                <path className="cls-1" d="M147.21,40.81h-5.74v-17.69h5.74v17.69Z"/>
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 189.5 66.53" style={{ fill: '#646b52', width: '100px' }}>
                                <path className="cls-1" d="M107.23,33.84c-2.32,2.35-4.77,4.9-7.29,7.38-5.94,5.85-11.89,11.68-17.9,17.46-.65.63-1.67,1.24-2.53,1.24-24.7.06-49.39.04-74.09.02-.15,0-.29-.07-.66-.16v-16.55c4.59,0,9.2.02,13.8,0,16.9-.1,33.8-.19,50.7-.38,1.15-.01,2.55-.59,3.39-1.38,2.68-2.53,5.16-5.28,7.9-8.14-2.83-3.06-5.74-6.32-8.81-9.43-.52-.52-1.7-.53-2.57-.53-20.84,0-41.68.04-62.51.07-.6,0-1.2-.05-1.93-.09V6.94c.77-.04,1.51-.1,2.26-.1,23.77-.02,47.54-.02,71.31-.09,1.67,0,2.87.43,4.04,1.64,8.22,8.48,16.5,16.89,24.89,25.44Z"/>
                                <path className="cls-1" d="M83.12,32.78c7.81-7.96,16.38-16.73,25.01-25.44.51-.51,1.51-.76,2.28-.76,24.3,0,48.61.06,72.91.12.45,0,.9.1,1.45.16v16.31c-1.05,0-1.94,0-2.83,0-20.6-.03-41.2-.09-61.8-.04-1.06,0-2.38.57-3.13,1.33-2.83,2.83-5.48,5.84-8,8.58,2.95,3.11,5.75,6.17,8.71,9.07.53.52,1.71.53,2.59.54,20.6.17,41.2.3,61.8.43.76,0,1.51,0,2.6,0v16.63c-.61,0-1.42,0-2.24,0-23.92-.01-47.84,0-71.76-.09-1.21,0-2.75-.61-3.57-1.47-8.13-8.45-16.15-17.01-24.03-25.37Z"/>
                            </svg>
                        </a>
                    </div>

                    <div id="MobileMenu1" className={`header_right ${mobileMenu}`}>
                        <div id="closeMenu1" className="closeMenu1 mobileDisplay" onClick={()=>closeMenuMobile()}>
                            <p>X</p>
                        </div>
                        <div className="mobile_arrange">
                            <ul className="nav_list">
                                <li className="mobileDisplay">Dacia Maroc</li>
                                <div className="mobileDisplay decoline">
                                </div>
                                <li id="carListVP" className={liOpenVP} onClick={()=>{showMenuVP();openVPlist()}}>
                                    VÉHICULES PARTICULIERS
                                    <span>
                                        <svg viewBox="0 0 74.94 100" style={{enableBackground: 'new 0 0 74.94 100', fill: 'black'}} xmlSpace="preserve">
                                            <style type="text/css">{/* Any styles can be placed here */}</style>
                                            <g>
                                                <g>
                                                    <g>
                                                        <polygon className="st0" points="16.08,2.44 8.2,9.84 50.98,50 8.2,90.16 16.08,97.56 58.86,57.4 66.74,50 58.86,42.6"></polygon>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </li>

                                <div id="megaMenuVPMobile" className={`mega_menu_mobile ${VPM}`}>
                                    <div className="menu_carlist">
                                        <div className="menu_carcard">
                                            <a className="carLink" href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouveau_duster">
                                                <img src="src/assets/menuCars/Duster.png" alt="" />
                                                <div>
                                                    <p className="carName">DUSTER</p>
                                                    <p className="carPrice">à partire de 210 000 MAD</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div className="menu_carcard">
                                            <a className="carLink" href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouvelle-sandero-streetway">
                                                <img src="src/assets/menuCars/Streetway.png" alt="" />
                                                <div>
                                                    <p className="carName">SANDERO STREETWAY</p>
                                                    <p className="carPrice">à partire de 150 000 MAD</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div className="menu_carcard">
                                            <a className="carLink" href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouvelle-logan">
                                                <img src="src/assets/menuCars/Logan.png" alt="" />
                                                <div>
                                                    <p className="carName">LOGAN</p>
                                                    <p className="carPrice">à partire de 132 000 MAD</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div className="menu_carcard">
                                            <a className="carLink" href="https://dacia.m-automotiv.ma/fr/gamme/modele/nouvelle-stepway">
                                                <img src="src/assets/menuCars/Stepway.png" alt="" />
                                                <div>
                                                    <p className="carName">SANDERO STEPWAY</p>
                                                    <p className="carPrice">à partire de 141 000 MAD</p>
                                                </div>
                                            </a>
                                        </div>

                                        <div className="menu_carcard">
                                            <a className="carLink" href="https://dacia.m-automotiv.ma/fr/gamme/modele/spring">
                                                <img src="src/assets/menuCars/Spring.png" alt="" />
                                                <div>
                                                    <p className="carName">SPRING</p>
                                                    <p className="carPrice">à partire de 200 000 MAD</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <li>
                                    <a href="https://renault.m-automotiv.ma/Gammevo">
                                        VÉHICULES D'OCCASION
                                        <span>
                                            <svg viewBox="0 0 74.94 100" style={{enableBackground: 'new 0 0 74.94 100'}} xmlSpace="preserve">
                                                <style type="text/css">{/* Any styles can be placed here */}</style>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <polygon className="st0" points="16.08,2.44 8.2,9.84 50.98,50 8.2,90.16 16.08,97.56 58.86,57.4 66.74,50 58.86,42.6"></polygon>
                                                            </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="https://renault.m-automotiv.ma/RepriseModel">
                                        REPRISE VÉHICULE
                                        <span>
                                            <svg viewBox="0 0 74.94 100" style={{enableBackground: 'new 0 0 74.94 100'}} xmlSpace="preserve">
                                                <style type="text/css">{/* Any styles can be placed here */}</style>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <polygon className="st0" points="16.08,2.44 8.2,9.84 50.98,50 8.2,90.16 16.08,97.56 58.86,57.4 66.74,50 58.86,42.6"></polygon>
                                                            </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://dacia.m-automotiv.ma/fr/apres-vente">
                                        SERVICE APÈS&nbsp;VENTE
                                        <span>
                                            <svg viewBox="0 0 74.94 100" style={{enableBackground: 'new 0 0 74.94 100'}} xmlSpace="preserve">
                                                <style type="text/css">{/* Any styles can be placed here */}</style>
                                                <g>
                                                    <g>
                                                        <g>
                                                            <polygon className="st0" points="16.08,2.44 8.2,9.84 50.98,50 8.2,90.16 16.08,97.56 58.86,57.4 66.74,50 58.86,42.6"></polygon>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            </ul>

                            <div className="header_contact">
                                <svg className="right_logo mobileDisplay" xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" version="1.1" viewBox="0 0 173.68 32.66" style={{ fill: '#646b52', strokeWidth: '0px', width: '100%' }}>
                                    <g>
                                        <rect className="cls-1" x="38.23" y="13.77" width="4.19" height="4.19"/>
                                        <g>
                                        <path className="cls-1" d="M54.04,9.06l6.02,13.92h-2.7l-1.41-3.37h-6.52l-1.41,3.37h-2.59l6.02-13.92h2.59ZM50.37,17.39h4.65l-2.33-5.48-2.33,5.48Z"/>
                                        <path className="cls-1" d="M62.83,21.61c-1.07-1.06-1.61-2.56-1.61-4.5v-8.04h2.48v7.96c0,1.28.31,2.24.93,2.9.62.66,1.54.99,2.76.99s2.12-.33,2.75-.99c.63-.66.95-1.63.95-2.9v-7.96h2.48v8.04c0,1.94-.54,3.44-1.61,4.5-1.07,1.06-2.59,1.59-4.57,1.59s-3.49-.53-4.57-1.59Z"/>
                                        <path className="cls-1" d="M75.53,11.34v-2.28h12.46v2.28h-4.98v11.63h-2.48v-11.63h-5Z"/>
                                        <path className="cls-1" d="M101.72,10.88c1.36,1.36,2.03,3.07,2.03,5.14s-.68,3.8-2.03,5.15c-1.36,1.35-3.07,2.02-5.14,2.02s-3.79-.67-5.14-2.02c-1.36-1.35-2.03-3.07-2.03-5.15s.68-3.79,2.03-5.14c1.35-1.36,3.07-2.03,5.14-2.03s3.79.68,5.14,2.03ZM99.92,19.56c.86-.9,1.28-2.08,1.28-3.54s-.43-2.65-1.28-3.56c-.86-.91-1.97-1.36-3.35-1.36s-2.49.45-3.35,1.36c-.85.91-1.28,2.09-1.28,3.56s.43,2.65,1.28,3.54c.86.9,1.97,1.35,3.35,1.35s2.49-.45,3.35-1.35Z"/>
                                        <path className="cls-1" d="M112.57,21.82l-3.41-9.02-.98,10.18h-2.39l1.3-13.92h3.15l3.61,9.78,3.61-9.78h3.09l1.33,13.92h-2.52l-1-10.33-3.37,9.18h-2.41Z"/>
                                        <path className="cls-1" d="M136.22,10.88c1.36,1.36,2.03,3.07,2.03,5.14s-.68,3.8-2.03,5.15c-1.36,1.35-3.07,2.02-5.14,2.02s-3.79-.67-5.14-2.02c-1.36-1.35-2.03-3.07-2.03-5.15s.68-3.79,2.03-5.14c1.35-1.36,3.07-2.03,5.14-2.03s3.79.68,5.14,2.03ZM134.43,19.56c.86-.9,1.28-2.08,1.28-3.54s-.43-2.65-1.28-3.56c-.86-.91-1.97-1.36-3.35-1.36s-2.49.45-3.35,1.36c-.85.91-1.28,2.09-1.28,3.56s.43,2.65,1.28,3.54c.86.9,1.97,1.35,3.35,1.35s2.49-.45,3.35-1.35Z"/>
                                        <path className="cls-1" d="M139.67,11.34v-2.28h12.46v2.28h-4.98v11.63h-2.48v-11.63h-5Z"/>
                                        <path className="cls-1" d="M154.41,9.06h2.48v13.92h-2.48v-13.92Z"/>
                                        <path className="cls-1" d="M165.04,22.98l-6-13.92h2.74l4.63,11,4.61-11h2.65l-6,13.92h-2.63Z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <path className="cls-1" d="M.81,31.85h31.04V.81H.81v31.04ZM32.66,32.66H0V0h32.66v32.66Z"/>
                                        <polygon className="cls-1" points="8.95 9.17 13.31 9.17 16.61 18.86 16.65 18.86 19.77 9.17 24.13 9.17 24.13 23.26 21.23 23.26 21.23 13.27 21.19 13.27 17.74 23.26 15.35 23.26 11.89 13.37 11.85 13.37 11.85 23.26 8.95 23.26 8.95 9.17"/>
                                    </g>
                                </svg>
                                <div className="contact_itemList">
                                    <a href="https://dacia.m-automotiv.ma/fr/succursales">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" style={{ fill: '#646b52', strokeWidth: '0px', width: "26px" }}>
                                            <path className="cls-1" d="M78.4,39.5c0,15.43-8.89,31.49-26.06,49.15h-4.82c-17.04-17.66-25.93-33.71-25.93-49.15,0-17.41,11.23-28.16,28.4-28.16s28.4,10.74,28.4,28.16ZM50,84.45c16.18-18.52,22.85-31.98,22.85-44.95s-8.65-23.09-22.85-23.09-22.84,9.88-22.84,23.09,6.67,26.42,22.84,44.95ZM49.87,26.91c7.66,0,12.97,5.31,12.97,12.97s-5.31,12.84-12.97,12.84-12.72-5.31-12.72-12.84,5.31-12.97,12.72-12.97ZM49.87,31.85c-4.45,0-7.53,3.33-7.53,8.03s3.09,7.9,7.53,7.9,7.78-3.21,7.78-7.9-3.21-8.03-7.78-8.03Z"/>
                                        </svg>
                                    </a>
                                    <a href="https://dacia.m-automotiv.ma/index.php/fr/AllForm/contact">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" style={{ fill: '#646b52', strokeWidth: '0px', width: "26px" }}>
                                            <path className="cls-1" d="M46.61,88.65c-3.39,0-5.49-1.76-6.08-4.81-11.22-2.11-17.88-8.9-18.81-18.97-6.66-1.05-10.63-6.44-10.63-14.64,0-9.25,4.79-14.53,13.21-14.53h1.52v-1.28c0-14.76,9-23.08,24.18-23.08s24.3,8.32,24.3,23.08v1.28h1.52c8.3,0,13.09,5.39,13.09,14.53s-5.26,14.87-13.67,14.87h-5.73v-30.68c0-11.83-6.78-18.27-19.51-18.27s-19.39,6.56-19.39,18.27v30.68h-3.86c.82,7.5,5.37,11.95,14.02,13.59.82-2.58,2.69-3.87,5.84-3.87,5.49,0,8.29,2.34,8.29,7.03s-2.92,6.8-8.29,6.8ZM25.82,60.19v-19.56h-1.52c-5.72,0-8.42,3.16-8.42,9.6s2.92,9.95,8.42,9.95h1.52ZM74.3,40.63v19.56h.94c5.84,0,8.88-3.51,8.88-9.95s-2.92-9.6-8.88-9.6h-.94Z"/>
                                        </svg>
                                    </a>
                                    {
                                        user?
                                        <a href="http://localhost:8000/SuiviCommande">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="20" height="20" fill="#646b52">
                                                <path className="cls-1" d="M40.72,45.55c-.79.15-1.55.34-2.31.53.73.48,1.5.91,2.31,1.29v-1.82Z" fill="#646b52"></path>
                                                <path className="cls-1" d="M60.01,47.37c.82-.38,1.59-.82,2.32-1.3-.76-.19-1.52-.37-2.32-.52v1.82Z" fill="#646b52"></path>
                                                <path className="cls-2" d="M38.41,46.08c-14.87,3.71-22.98,15.09-22.98,33.58v11.19h5.73v-10.9c0-19.29,10.49-29.77,29.22-29.77s29.21,10.34,29.21,29.77v10.9h5.73v-11.19c0-18.62-7.99-29.89-22.98-33.58M62.33,46.07c5.13-3.38,8.02-9.15,8.02-16.74,0-12.58-7.41-20.27-19.99-20.27s-19.99,7.55-19.99,20.27c0,7.59,2.9,13.36,8.03,16.74M36.11,29.33c0-9.36,5.17-14.67,14.26-14.67s14.26,5.31,14.26,14.67-5.17,14.4-14.26,14.4-14.26-5.17-14.26-14.4Z" fill="#646b52"></path>
                                            </svg>
                                        </a>
                                        :
                                        <a href="http://localhost:8000/login">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="20" height="20" fill="#646b52">
                                                <path className="cls-1" d="M40.72,45.55c-.79.15-1.55.34-2.31.53.73.48,1.5.91,2.31,1.29v-1.82Z" fill="#646b52"></path>
                                                <path className="cls-1" d="M60.01,47.37c.82-.38,1.59-.82,2.32-1.3-.76-.19-1.52-.37-2.32-.52v1.82Z" fill="#646b52"></path>
                                                <path className="cls-2" d="M38.41,46.08c-14.87,3.71-22.98,15.09-22.98,33.58v11.19h5.73v-10.9c0-19.29,10.49-29.77,29.22-29.77s29.21,10.34,29.21,29.77v10.9h5.73v-11.19c0-18.62-7.99-29.89-22.98-33.58M62.33,46.07c5.13-3.38,8.02-9.15,8.02-16.74,0-12.58-7.41-20.27-19.99-20.27s-19.99,7.55-19.99,20.27c0,7.59,2.9,13.36,8.03,16.74M36.11,29.33c0-9.36,5.17-14.67,14.26-14.67s14.26,5.31,14.26,14.67-5.17,14.4-14.26,14.4-14.26-5.17-14.26-14.4Z" fill="#646b52"></path>
                                            </svg>
                                        </a>
                                    }
                                </div>
                            </div>
                            <a href="https://m-automotiv.ma" className="right_logo desktopDisplay">
                                <img src="src/assets/menuCars/m-automotiv.png" className="right_logo_img" xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" version="1.1" viewBox="0 0 173.68 32.66" style={{ fill: '#646b52', strokeWidth: '0px', width: '100%' }} />
                            </a>
                        </div>
                    </div>

                    <svg id="menuBurger1" className="burger_menu" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" onClick={()=>showMenuMobile()} style={{ fill: '#646b52', strokeWidth: '0px', width: '40px', height: '41px' }}>
                        <path fillRule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                    </svg>
                </div>

            </header>


            <main>
                <Outlet />
            </main>


            <footer>
                <div className="footer_container">
                    <div className="f_top_section">
                        <div className="f_top_section_content desktopDisplay">
                            <div className="footer_block">
                                <p className="f_section_title">Service</p>
                                <a href="https://dacia.m-automotiv.ma/index.php/fr/AllForm/contact">Nous contacter</a>
                                <a href="https://dacia.m-automotiv.ma/fr/apres-vente">Service apres vente</a>
                            </div>

                            <div className="footer_block">
                                <p className="f_section_title">Outils d'achat</p>
                                <a href="https://dacia.m-automotiv.ma/index.php/fr/AllForm/brochure">Demander une brochure</a>
                                <a href="https://dacia.m-automotiv.ma/index.php/fr/AllForm/essai">Réserver un essai</a>
                            </div>

                            <div className="footer_block">
                                <p className="f_section_title">Accès rapide</p>
                                <a href="https://www.dacia.ma">Visitez Dacia.ma</a>
                                <a href="https://dacia.m-automotiv.ma/fr/succursales">Trouver nos Succursales</a>
                            </div>

                            <div className="footer_block">
                                <p className="f_section_title">Restons connectés</p>
                                <div className="social_btns">
                                    <a href="https://www.facebook.com/M.Automotiv?_rdc=1&_rdr"><img src="https://renault.m-automotiv.ma/front_renault/assets/img/socialBtns/Facebook.png" alt="" /></a>
                                    <a href="https://www.instagram.com/m.automotiv.maroc/"><img src="https://renault.m-automotiv.ma/front_renault/assets/img/socialBtns/Instagram.png" alt="" /></a>
                                    <a href="https://www.youtube.com/@mautomotiv"><img src="https://renault.m-automotiv.ma/front_renault/assets/img/socialBtns/Youtube.png" alt="" /></a>
                                </div>

                                <div className="tagSession">
                                    <div className="imageZone">
                                        <img src="src/assets/menuCars/tag.png" alt="" />
                                    </div>
                                    <div className="textzone">
                                        <p>
                                            étude Approche Client - Inspire Research <br />
                                            réalisée du 28 Aout au 18 Novembre 2023 <br />
                                            plus d'informations sur www.escda.ma
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="f_top_section_content_mobile mobileDisplay">
                            <div className="footer_m_block">
                                <p className="f_section_m_title" onClick={()=>showFooter1()}>
                                    Service
                                    <span>
                                        <svg viewBox="0 0 74.94 100" style={{enableBackground: 'new 0 0 74.94 100'}} xmlSpace="preserve" width={'12px'} fill={'white'}>
                                            <style type="text/css">{/* Any styles can be placed here */}</style>
                                            <g>
                                                <g>
                                                    <g>
                                                        <polygon className="st0" points="16.08,2.44 8.2,9.84 50.98,50 8.2,90.16 16.08,97.56 58.86,57.4 66.74,50 58.86,42.6"></polygon>
                                                        </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </p>
                                <ul className={`q_content ${serclient}`}>
                                    <li><a href="https://dacia.m-automotiv.ma/index.php/fr/AllForm/contact">Nous contacter</a></li>
                                    <li><a href="https://dacia.m-automotiv.ma/fr/apres-vente">Service apres vente</a></li>
                                </ul>
                            </div>

                            <div className="footer_m_block">
                                <p className="f_section_m_title" onClick={()=>showFooter2()}>
                                    Accès rapide
                                    <span>
                                        <svg viewBox="0 0 74.94 100" style={{enableBackground: 'new 0 0 74.94 100'}} xmlSpace="preserve" width={'12px'} fill={'white'}>
                                            <style type="text/css">{/* Any styles can be placed here */}</style>
                                            <g>
                                                <g>
                                                    <g>
                                                        <polygon className="st0" points="16.08,2.44 8.2,9.84 50.98,50 8.2,90.16 16.08,97.56 58.86,57.4 66.74,50 58.86,42.6"></polygon>
                                                        </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </p>
                                <ul className={`q_content ${reseau}`}>
                                    <li><a href="https://www.dacia.ma/">Visitez Dacia.ma</a></li>
                                    <li><a href="https://dacia.m-automotiv.ma/fr/succursales">Trouver nos Succursales</a></li>
                                </ul>
                            </div>

                            <div className="footer_m_block">
                                <p className="f_section_m_title" onClick={()=>showFooter3()}>
                                    Outils d'achat
                                    <span>
                                        <svg viewBox="0 0 74.94 100" style={{enableBackground: 'new 0 0 74.94 100'}} xmlSpace="preserve" width={'12px'} fill={'white'}>
                                            <style type="text/css">{/* Any styles can be placed here */}</style>
                                            <g>
                                                <g>
                                                    <g>
                                                        <polygon className="st0" points="16.08,2.44 8.2,9.84 50.98,50 8.2,90.16 16.08,97.56 58.86,57.4 66.74,50 58.86,42.6"></polygon>
                                                        </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </p>
                                <ul className={`q_content ${outilAchat}`}>
                                    <li><a href="https://dacia.m-automotiv.ma/index.php/fr/AllForm/brochure">Demander une brochure</a></li>
                                    <li><a href="https://dacia.m-automotiv.ma/index.php/fr/AllForm/essai">Réserver un essai</a></li>
                                </ul>
                            </div>

                            <div className="footer_block">
                                <div>
                                    <p className="f_section_title">Restons connectés</p>
                                    <div className="social_btns">
                                        <a href="https://web.facebook.com/M.Automotiv"><img src="https://renault.m-automotiv.ma/front_renault/assets/img/socialBtns/Facebook.png" alt="m-automotiv" /></a>
                                        <a href="https://www.instagram.com/m.automotiv.maroc"><img src="https://renault.m-automotiv.ma/front_renault/assets/img/socialBtns/Instagram.png" alt="m-automotiv" /></a>
                                        <a href="https://www.youtube.com/@mautomotiv"><img src="https://renault.m-automotiv.ma/front_renault/assets/img/socialBtns/Youtube.png" alt="m-automotiv" /></a>
                                    </div>
                                </div>

                                <div className="tagSession">
                                    <div className="imageZone">
                                        <img src="src/assets/menuCars/tag.png" alt="" />
                                    </div>
                                    <div className="textzone">
                                        <p>
                                            étude Approche Client - Inspire Research <br />
                                            réalisée du 28 Aout au 18 Novembre 2023 <br />
                                            plus d'informations sur www.escda.ma
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="f_bottom_section">
                        <div>
                            <a href="https://dacia.m-automotiv.ma/fr/pages/informations_legales">Informations légales site</a>
                            <a href="https://dacia.m-automotiv.ma/fr/pages/cookies">Cookies</a>
                        </div>

                        <div className="copyrightSection">
                            <p>© M-AUTOMOTIV - DACIA MAROC 2024</p>
                        </div>
                    </div>
                </div>

            </footer>
        </>
    )
}
