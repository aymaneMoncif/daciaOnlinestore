@extends('layout1')

@section('title')
Home - Online Store
@stop

@section('content')

    <div class="main_container">
        <div class="breadcrumb_Container">
            <div class="breadcrumb">
                <a href="">Renault accueil</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                <a href="">Online Store</a>
            </div>
        </div>

        <div class="header_image">
            <div class="row_1i">
                <div class="page_headerTitle">
                    <div class="title">
                        <p class="title_text">ONLINE STORE</p>
                    </div>
                </div>
            </div>
        </div>


    <!-------------------------section1------------------------>
    @yield('popUp')
    <!-------------------------section1------------------------>


        <!------------------------------------carousel5-------------------------------------->
        <div class="M-auto-renault_containerT">
            <div class="M-auto-renault">
                <div class="owl-carousel" id="carousel5">
                        <div class="item">
                            <div class="mini-card">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100" style="fill: #000000;" >
                                    <path class="cls-1" d="M24.58,63.88c.84-2.53,3.18-4.31,5.8-4.31s5.08,1.78,5.93,4.31h19.46c.84-2.53,3.18-4.31,5.8-4.31s5.05,1.78,5.9,4.31h1.5c2.06,0,2.53-.38,2.53-1.97,0-1.31-.84-3.94-1.4-4.78s-1.31-1.5-2.9-1.88l-6.55-1.69c-2.43-.66-5.61-3.66-9.64-5.25-3.09-1.22-5.89-1.69-12.26-1.69-3.4,0-7.49.38-11.13.84l-3.56-2.16-.09-.94c.09,0,9.17-1.59,15.34-1.59s9.82.66,13.29,1.97c4.4,1.69,7.02,4.6,8.89,5.16l6.36,1.78c2.9.84,4.68,2.06,5.52,3.47,1.31,2.25,1.97,5.91,1.97,7.41,0,3.38-2.9,5.16-6.74,5.16h-1.12c-.75,3-3.37,4.51-5.9,4.51-2.34,0-5.05-1.5-5.8-4.51h-19.46c-.75,3-3.4,4.51-5.93,4.51-2.34,0-5.02-1.6-5.86-4.6h-.22c-3.65,0-7.48-2.25-7.48-7.03v-4.69c0-1.97.56-3.75,4.43-7.6l3.27,1.78c-3.37,3.66-4.05,4.41-4.05,6.28v3.85c0,2.34,1.15,3.66,3.84,3.66h.28ZM24.71,40.81c0-1.97.75-3.57,4.58-7.41l3.06,1.59c-2.71,2.9-3.62,4.03-3.9,5.25l-3.74.56ZM33.22,65.85c0-1.5-1.15-2.81-2.84-2.81-1.47,0-2.62,1.31-2.62,2.81,0,1.59,1.15,2.81,2.62,2.81,1.68,0,2.84-1.22,2.84-2.81ZM75.23,39.87l-6.55-1.41c-2.15-.47-5.71-3.66-9.73-5.25-3.09-1.22-5.89-1.69-12.35-1.69-3.37,0-7.48.37-11.13.84l-3.56-2.06-.09-.94c.09,0,9.17-1.59,15.34-1.59s9.73.75,13.19,2.06c4.4,1.6,7.67,4.69,8.98,4.97l6.55,1.5c2.62.56,4.4,2.06,5.24,3.47,1.31,2.25,2.06,6.19,2.06,7.69,0,3.38-2.9,5.06-6.74,5.06h-.37c-1.12-1.69-2.34-2.72-4.77-3.66h5.52c2.06,0,2.71-.38,2.71-1.97,0-1.31-.94-4.31-1.5-5.16-.56-.85-1.22-1.5-2.81-1.88ZM64.38,65.85c0-1.5-1.12-2.81-2.81-2.81-1.5,0-2.62,1.31-2.62,2.81,0,1.59,1.12,2.81,2.62,2.81,1.68,0,2.81-1.22,2.81-2.81Z"/>
                                </svg>
                                <p class="minicard-title">1. CHOISISSEZ VOTRE RENAULT</p>
                                <p class="minicard-desc"> Votre showroom à domicile, ouvert 24h/24, 7j/7 Configurez votre véhicule en choisissant votre modèle, version, couleur et équipements.</p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="mini-card">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100" style="fill: #000000;">
                                    <path class="cls-1" d="M30.62,29.7c0-3.72,1.78-5.5,5.5-5.5h27.75c3.72,0,5.5,1.78,5.5,5.5v40.61c0,3.72-1.78,5.5-5.5,5.5h-27.75c-3.72,0-5.5-1.78-5.5-5.5V29.7ZM36.51,72.63h26.97c2.01,0,2.79-.85,2.79-2.87V30.24c0-2.01-.77-2.87-2.79-2.87h-26.97c-2.01,0-2.79.85-2.79,2.87v39.53c0,2.01.77,2.87,2.79,2.87ZM37.13,43.57h25.66v-12.87h-25.66v12.87ZM37.21,53.25h6.35v-3.18h-6.35v3.18ZM37.21,59.69h6.35v-3.18h-6.35v3.18ZM37.21,66.12h6.35v-3.18h-6.35v3.18ZM40.23,40.55h19.45v-6.82h-19.45v6.82ZM46.82,53.25h6.36v-3.18h-6.36v3.18ZM46.82,59.69h6.36v-3.18h-6.36v3.18ZM46.82,66.12h6.36v-3.18h-6.36v3.18ZM56.51,53.25h6.43v-3.18h-6.43v3.18ZM56.51,59.69h6.43v-3.18h-6.43v3.18ZM56.51,66.12h6.43v-3.18h-6.43v3.18Z"/>
                                </svg>
                                <p class="minicard-title">2. SIMULEZ VOTRE FINANCEMENT</p>
                                <p class="minicard-desc">Choisissez la formule de paiement qui vous convient en calculant votre mensualité une fois que vous avez choisi votre véhicule.</p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="mini-card">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100" style="fill: #000000;">
                                    <path class="cls-1" d="M30.58,74.73c-3.57,0-5.27-1.71-5.27-5.27v-26.51c0-3.56,1.71-5.27,5.27-5.27h38.83c3.56,0,5.27,1.71,5.27,5.27v26.51c0,3.56-1.71,5.27-5.27,5.27H30.58ZM69.05,71.68c1.86,0,2.6-.89,2.6-2.82v-25.39c0-1.93-.74-2.82-2.6-2.82H30.95c-1.86,0-2.6.89-2.6,2.82v25.39c0,1.93.74,2.82,2.6,2.82h38.09ZM31.4,25.27h8.84c3.79,0,5.35.37,7.28,2.6l3.04,3.49h17.97v3.04h-19.53l-3.12-3.86c-1.48-1.86-2.38-2.23-5.64-2.23h-5.79v6.09h-3.04v-9.13ZM34.52,49.93h24.72v-3.04h-24.72v3.04ZM34.52,56.09h12.4v-3.04h-12.4v3.04Z"/>
                                </svg>
                                <p class="minicard-title">3. COMPLÉTEZ VOTRE DOSSIER D'ACHAT</p>
                                <p class="minicard-desc"> Renseignez les documents nécessaires pour compléter votre dossier d'achat via votre espace personnel et depuis chez vous.</p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="mini-card">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100" style="fill: #000000;">
                                    <path class="cls-1" d="M27.39,72.43l-3.23,2.4-1.93-2.4,3.23-2.39c3.77-2.78,6.55-3.86,10.48-3.86,5.47,0,10.55,2.55,18.56,2.7l19.1-13.12c.77-.54,1.08-1,1.08-1.54,0-1-.77-1.78-1.77-1.78-.54,0-.85.15-1.46.54l-8.55,5.71c-.69,1.78-2.39,3.01-4.62,3.01h-11.17v-3.09h11.17c1.31,0,1.77-.54,1.77-1.7s-.46-1.7-1.77-1.7h-20.56c-5.24,0-7.4.69-11.02,3.55l-2.54,2.01-1.85-2.47,2.54-2.01c4.24-3.32,7.32-4.17,12.94-4.17h20.49c2.08,0,3.78,1.16,4.54,2.86l7.32-4.86c.92-.62,1.61-.85,2.62-.85,3.24,0,5.01,2.55,5.01,5.02,0,1.54-.85,2.86-3.08,4.4l-19.26,13.36c-8.32,0-13.63-2.78-19.33-2.78-3.54,0-5.47.77-8.71,3.17ZM30.63,42.55c.69-2.08,2.62-3.55,4.78-3.55s4.16,1.47,4.85,3.55h16.02c.69-2.08,2.62-3.55,4.78-3.55s4.16,1.47,4.85,3.55h1.24c1.69,0,2.08-.31,2.08-1.62,0-1.08-.69-3.25-1.15-3.94-.46-.69-1.08-1.24-2.39-1.55l-5.39-1.39c-2-.54-4.62-3.01-7.93-4.32-2.54-1-4.85-1.39-10.09-1.39-2.77,0-6.16.31-9.17.69l-2.93-1.78-.08-.77c.08,0,7.55-1.31,12.63-1.31s8.09.54,10.94,1.62c3.62,1.39,5.78,3.78,7.32,4.25l5.24,1.47c2.39.69,3.85,1.7,4.54,2.86,1.08,1.86,1.62,4.87,1.62,6.1,0,2.78-2.39,4.25-5.55,4.25h-.92c-.62,2.47-2.77,3.71-4.85,3.71-1.93,0-4.16-1.24-4.78-3.71h-16.02c-.62,2.47-2.77,3.71-4.85,3.71-1.93,0-4.16-1.31-4.85-3.78h-.16c-3,0-6.16-1.85-6.16-5.79v-3.86c0-1.62.46-3.09,3.62-6.26l2.7,1.47c-2.78,3.01-3.31,3.63-3.31,5.17v3.17c0,1.93.93,3.01,3.16,3.01h.23ZM37.72,44.17c0-1.24-.93-2.32-2.31-2.32-1.23,0-2.16,1.08-2.16,2.32,0,1.31.93,2.32,2.16,2.32,1.38,0,2.31-1,2.31-2.32ZM63.36,44.17c0-1.24-.92-2.32-2.31-2.32-1.24,0-2.16,1.08-2.16,2.32,0,1.31.92,2.32,2.16,2.32,1.38,0,2.31-1,2.31-2.32Z"/>
                                </svg>
                                <p class="minicard-title">4. NOUS VOUS LIVRONS LÀ OÙ VOUS ÊTES.</p>
                                <p class="minicard-desc"> Recevez votre véhicule où que vous soyez sans vous déplacer.</p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!------------------------------------END carousel5-------------------------------------->
        <div class="M-auto-renault_container" >
            <div class="M-auto-renault" >
                <div class="row6i">

                    <div class="mini-card">
                        <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100">
                            <path class="cls-1" d="M24.58,63.88c.84-2.53,3.18-4.31,5.8-4.31s5.08,1.78,5.93,4.31h19.46c.84-2.53,3.18-4.31,5.8-4.31s5.05,1.78,5.9,4.31h1.5c2.06,0,2.53-.38,2.53-1.97,0-1.31-.84-3.94-1.4-4.78s-1.31-1.5-2.9-1.88l-6.55-1.69c-2.43-.66-5.61-3.66-9.64-5.25-3.09-1.22-5.89-1.69-12.26-1.69-3.4,0-7.49.38-11.13.84l-3.56-2.16-.09-.94c.09,0,9.17-1.59,15.34-1.59s9.82.66,13.29,1.97c4.4,1.69,7.02,4.6,8.89,5.16l6.36,1.78c2.9.84,4.68,2.06,5.52,3.47,1.31,2.25,1.97,5.91,1.97,7.41,0,3.38-2.9,5.16-6.74,5.16h-1.12c-.75,3-3.37,4.51-5.9,4.51-2.34,0-5.05-1.5-5.8-4.51h-19.46c-.75,3-3.4,4.51-5.93,4.51-2.34,0-5.02-1.6-5.86-4.6h-.22c-3.65,0-7.48-2.25-7.48-7.03v-4.69c0-1.97.56-3.75,4.43-7.6l3.27,1.78c-3.37,3.66-4.05,4.41-4.05,6.28v3.85c0,2.34,1.15,3.66,3.84,3.66h.28ZM24.71,40.81c0-1.97.75-3.57,4.58-7.41l3.06,1.59c-2.71,2.9-3.62,4.03-3.9,5.25l-3.74.56ZM33.22,65.85c0-1.5-1.15-2.81-2.84-2.81-1.47,0-2.62,1.31-2.62,2.81,0,1.59,1.15,2.81,2.62,2.81,1.68,0,2.84-1.22,2.84-2.81ZM75.23,39.87l-6.55-1.41c-2.15-.47-5.71-3.66-9.73-5.25-3.09-1.22-5.89-1.69-12.35-1.69-3.37,0-7.48.37-11.13.84l-3.56-2.06-.09-.94c.09,0,9.17-1.59,15.34-1.59s9.73.75,13.19,2.06c4.4,1.6,7.67,4.69,8.98,4.97l6.55,1.5c2.62.56,4.4,2.06,5.24,3.47,1.31,2.25,2.06,6.19,2.06,7.69,0,3.38-2.9,5.06-6.74,5.06h-.37c-1.12-1.69-2.34-2.72-4.77-3.66h5.52c2.06,0,2.71-.38,2.71-1.97,0-1.31-.94-4.31-1.5-5.16-.56-.85-1.22-1.5-2.81-1.88ZM64.38,65.85c0-1.5-1.12-2.81-2.81-2.81-1.5,0-2.62,1.31-2.62,2.81,0,1.59,1.12,2.81,2.62,2.81,1.68,0,2.81-1.22,2.81-2.81Z"/>
                        </svg>
                        <p class="minicard-title">1. CHOISISSEZ VOTRE RENAULT</p>
                        <p class="minicard-desc">Votre showroom à domicile, ouvert 24h/24, 7j/7 Configurez votre véhicule en choisissant votre modèle, version, couleur et équipements.</p>
                    </div>
                    <div class="mini-card">
                        <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100">
                            <path class="cls-1" d="M30.62,29.7c0-3.72,1.78-5.5,5.5-5.5h27.75c3.72,0,5.5,1.78,5.5,5.5v40.61c0,3.72-1.78,5.5-5.5,5.5h-27.75c-3.72,0-5.5-1.78-5.5-5.5V29.7ZM36.51,72.63h26.97c2.01,0,2.79-.85,2.79-2.87V30.24c0-2.01-.77-2.87-2.79-2.87h-26.97c-2.01,0-2.79.85-2.79,2.87v39.53c0,2.01.77,2.87,2.79,2.87ZM37.13,43.57h25.66v-12.87h-25.66v12.87ZM37.21,53.25h6.35v-3.18h-6.35v3.18ZM37.21,59.69h6.35v-3.18h-6.35v3.18ZM37.21,66.12h6.35v-3.18h-6.35v3.18ZM40.23,40.55h19.45v-6.82h-19.45v6.82ZM46.82,53.25h6.36v-3.18h-6.36v3.18ZM46.82,59.69h6.36v-3.18h-6.36v3.18ZM46.82,66.12h6.36v-3.18h-6.36v3.18ZM56.51,53.25h6.43v-3.18h-6.43v3.18ZM56.51,59.69h6.43v-3.18h-6.43v3.18ZM56.51,66.12h6.43v-3.18h-6.43v3.18Z"/>
                        </svg>
                        <p class="minicard-title">2. SIMULEZ VOTRE FINANCEMENT</p>
                        <p class="minicard-desc">Choisissez la formule de paiement qui vous convient en calculant votre mensualité une fois que vous avez choisi votre véhicule.</p>
                    </div>
                    <div class="mini-card">
                        <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100">
                            <path class="cls-1" d="M30.58,74.73c-3.57,0-5.27-1.71-5.27-5.27v-26.51c0-3.56,1.71-5.27,5.27-5.27h38.83c3.56,0,5.27,1.71,5.27,5.27v26.51c0,3.56-1.71,5.27-5.27,5.27H30.58ZM69.05,71.68c1.86,0,2.6-.89,2.6-2.82v-25.39c0-1.93-.74-2.82-2.6-2.82H30.95c-1.86,0-2.6.89-2.6,2.82v25.39c0,1.93.74,2.82,2.6,2.82h38.09ZM31.4,25.27h8.84c3.79,0,5.35.37,7.28,2.6l3.04,3.49h17.97v3.04h-19.53l-3.12-3.86c-1.48-1.86-2.38-2.23-5.64-2.23h-5.79v6.09h-3.04v-9.13ZM34.52,49.93h24.72v-3.04h-24.72v3.04ZM34.52,56.09h12.4v-3.04h-12.4v3.04Z"/>
                        </svg>
                        <p class="minicard-title">3. COMPLÉTEZ VOTRE DOSSIER D'ACHAT</p>
                        <p class="minicard-desc"> Renseignez les documents nécessaires pour compléter votre dossier d'achat via votre espace personnel et depuis chez vous.</p>
                    </div>
                    <div class="mini-card">
                        <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="100" height="100">
                            <path class="cls-1" d="M27.39,72.43l-3.23,2.4-1.93-2.4,3.23-2.39c3.77-2.78,6.55-3.86,10.48-3.86,5.47,0,10.55,2.55,18.56,2.7l19.1-13.12c.77-.54,1.08-1,1.08-1.54,0-1-.77-1.78-1.77-1.78-.54,0-.85.15-1.46.54l-8.55,5.71c-.69,1.78-2.39,3.01-4.62,3.01h-11.17v-3.09h11.17c1.31,0,1.77-.54,1.77-1.7s-.46-1.7-1.77-1.7h-20.56c-5.24,0-7.4.69-11.02,3.55l-2.54,2.01-1.85-2.47,2.54-2.01c4.24-3.32,7.32-4.17,12.94-4.17h20.49c2.08,0,3.78,1.16,4.54,2.86l7.32-4.86c.92-.62,1.61-.85,2.62-.85,3.24,0,5.01,2.55,5.01,5.02,0,1.54-.85,2.86-3.08,4.4l-19.26,13.36c-8.32,0-13.63-2.78-19.33-2.78-3.54,0-5.47.77-8.71,3.17ZM30.63,42.55c.69-2.08,2.62-3.55,4.78-3.55s4.16,1.47,4.85,3.55h16.02c.69-2.08,2.62-3.55,4.78-3.55s4.16,1.47,4.85,3.55h1.24c1.69,0,2.08-.31,2.08-1.62,0-1.08-.69-3.25-1.15-3.94-.46-.69-1.08-1.24-2.39-1.55l-5.39-1.39c-2-.54-4.62-3.01-7.93-4.32-2.54-1-4.85-1.39-10.09-1.39-2.77,0-6.16.31-9.17.69l-2.93-1.78-.08-.77c.08,0,7.55-1.31,12.63-1.31s8.09.54,10.94,1.62c3.62,1.39,5.78,3.78,7.32,4.25l5.24,1.47c2.39.69,3.85,1.7,4.54,2.86,1.08,1.86,1.62,4.87,1.62,6.1,0,2.78-2.39,4.25-5.55,4.25h-.92c-.62,2.47-2.77,3.71-4.85,3.71-1.93,0-4.16-1.24-4.78-3.71h-16.02c-.62,2.47-2.77,3.71-4.85,3.71-1.93,0-4.16-1.31-4.85-3.78h-.16c-3,0-6.16-1.85-6.16-5.79v-3.86c0-1.62.46-3.09,3.62-6.26l2.7,1.47c-2.78,3.01-3.31,3.63-3.31,5.17v3.17c0,1.93.93,3.01,3.16,3.01h.23ZM37.72,44.17c0-1.24-.93-2.32-2.31-2.32-1.23,0-2.16,1.08-2.16,2.32,0,1.31.93,2.32,2.16,2.32,1.38,0,2.31-1,2.31-2.32ZM63.36,44.17c0-1.24-.92-2.32-2.31-2.32-1.24,0-2.16,1.08-2.16,2.32,0,1.31.92,2.32,2.16,2.32,1.38,0,2.31-1,2.31-2.32Z"/>
                        </svg>
                        <p class="minicard-title">4. NOUS VOUS LIVRONS LÀ OÙ VOUS ÊTES.</p>
                        <p class="minicard-desc"> Recevez votre véhicule où que vous soyez sans vous déplacer.</p>
                    </div>
                </div>
            </div>
        </div>
    <!------------------------------------END section1-------------------------------------->

        <div class="button_container">
            <div class="button_zone">
                <button class="comande_vehicule" onclick="window.location.href = 'http://localhost:3000/Modele';">Je commande mon véhicule</button>
            </div>
        </div>

        <!----------------------Pourquoi acheter en ligne Mobile---------------------->
        <div class="prqEnLigne_conatiner mobile">
            <div class="prqEnLigne_zone">
                <div class="mainTitle">
                    <p class="title">Pourquoi acheter en ligne</p>
                </div>
                <div class="icons_text_container">
                    <div class="owl-carousel" id="carousel6">
                        <div class="item">
                            <div class="svg_containerANDtext">
                                <div class="svg_container">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                        <path class="cls-1" d="M50,78.3c-16.18,0-26.97-12.15-26.97-28.26s10.79-28.33,26.97-28.33,26.96,12.23,26.96,28.33-10.79,28.26-26.96,28.26ZM50,75.49c14.38,0,24.01-10.93,24.01-25.46s-9.64-25.53-24.01-25.53-24.02,10.93-24.02,25.53,9.71,25.46,24.02,25.46ZM41.01,48.81c-3.89,0-6.04-2.95-6.04-7.77s2.15-7.77,6.04-7.77,6.04,2.95,6.04,7.77-2.16,7.77-6.04,7.77ZM38.14,41.05c0,3.45.86,5.03,2.88,5.03s2.88-1.58,2.88-5.03-.86-5.03-2.88-5.03-2.88,1.58-2.88,5.03ZM40.94,66.5l15.17-32.94h2.88l-15.1,32.94h-2.95ZM58.99,66.79c-3.88,0-6.04-2.95-6.04-7.77s2.16-7.77,6.04-7.77,6.04,2.95,6.04,7.77-2.15,7.77-6.04,7.77ZM56.11,59.02c0,3.45.86,5.03,2.88,5.03s2.88-1.58,2.88-5.03-.86-5.03-2.88-5.03-2.88,1.58-2.88,5.03Z"/>
                                    </svg>
                                </div>
                                <p class="text">
                                    Remise Spéciale <br> Web
                                </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="svg_containerANDtext">
                                <div class="svg_container">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                        <path class="cls-1" d="M50,76.66c-15.24,0-25.4-11.45-25.4-26.62s10.16-26.69,25.4-26.69,25.4,11.52,25.4,26.69-10.16,26.62-25.4,26.62ZM38.75,48.61c.07-4.13.41-7.86,1.09-11.11-3.39.27-6.71.61-10.03,1.15-1.42,2.91-2.24,6.3-2.44,9.96h11.38ZM39.84,62.43c-.68-3.25-1.02-6.91-1.09-11.04h-11.38c.2,3.59,1.01,6.98,2.37,9.89,3.32.54,6.71.88,10.09,1.15ZM44.31,73.34c-1.63-1.83-2.91-4.68-3.86-8.2-3.05-.2-6.03-.47-9.08-.88,2.98,4.54,7.45,7.79,12.94,9.08ZM31.44,35.67c2.98-.41,5.96-.68,9.01-.88.88-3.52,2.17-6.23,3.8-8.13-5.42,1.29-9.89,4.54-12.81,9.01ZM42.68,37.37c-.68,3.32-1.08,7.18-1.15,11.25h16.94c-.07-4.06-.47-7.92-1.15-11.25-2.44-.13-4.88-.2-7.32-.2s-4.88.07-7.32.2ZM57.32,62.56c.68-3.32,1.08-7.18,1.15-11.18h-16.94c.07,4,.47,7.86,1.15,11.18,2.44.14,4.88.2,7.32.2s4.88-.07,7.32-.2ZM48.71,25.99c-2.3.88-4.13,4.13-5.35,8.6,2.17-.07,4.4-.14,6.64-.14s4.47.07,6.64.14c-1.22-4.47-3.05-7.72-5.35-8.6h-2.57ZM43.36,65.34c1.22,4.61,3.18,7.93,5.55,8.67h2.1c2.44-.75,4.4-4.07,5.62-8.67-2.17.07-4.4.14-6.64.14s-4.47-.07-6.64-.14ZM55.69,73.34c5.55-1.29,10.03-4.54,12.94-9.08-2.98.41-6.03.68-9.08.88-.95,3.52-2.24,6.37-3.86,8.2ZM68.63,35.67c-2.98-4.47-7.38-7.72-12.87-9.01,1.56,1.9,2.91,4.61,3.79,8.13,3.05.21,6.03.47,9.08.88ZM72.63,48.61c-.21-3.66-1.02-7.04-2.37-9.96-3.39-.54-6.71-.88-10.09-1.15.68,3.25,1.02,6.98,1.08,11.11h11.38ZM60.16,62.43c3.39-.27,6.77-.61,10.09-1.15,1.35-2.91,2.17-6.3,2.37-9.89h-11.38c-.07,4.13-.41,7.79-1.08,11.04Z"/>
                                    </svg>
                                </div>
                                <p class="text">
                                    Commande <br> 100% digitalisée
                                </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="svg_containerANDtext">
                                <div class="svg_container">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                        <path class="cls-1" d="M47.68,76.52c-2.33,0-3.77-1.21-4.17-3.3-7.7-1.45-12.27-6.11-12.91-13.02-4.57-.72-7.3-4.42-7.3-10.05,0-6.35,3.29-9.97,9.06-9.97h1.04v-.88c0-10.13,6.17-15.83,16.6-15.83s16.68,5.71,16.68,15.83v.88h1.04c5.69,0,8.98,3.7,8.98,9.97s-3.61,10.21-9.38,10.21h-3.93v-21.06c0-8.12-4.65-12.54-13.39-12.54s-13.31,4.5-13.31,12.54v21.06h-2.65c.56,5.14,3.69,8.2,9.62,9.32.56-1.77,1.84-2.65,4.01-2.65,3.77,0,5.69,1.61,5.69,4.82s-2,4.66-5.69,4.66ZM33.4,56.99v-13.42h-1.04c-3.93,0-5.77,2.17-5.77,6.59s2,6.83,5.77,6.83h1.04ZM66.68,43.57v13.42h.64c4.01,0,6.09-2.41,6.09-6.83s-2-6.59-6.09-6.59h-.64Z"/>
                                    </svg>
                                </div>
                                <p class="text">
                                    Une équipe <br> à votre écoute
                                </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="svg_containerANDtext">
                                <div class="svg_container">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                        <path class="cls-1" d="M27.86,73.86l-3.17,2.35-1.89-2.35,3.17-2.34c3.7-2.72,6.41-3.78,10.26-3.78,5.36,0,10.33,2.49,18.18,2.65l18.71-12.85c.75-.53,1.06-.98,1.06-1.51,0-.98-.75-1.74-1.73-1.74-.53,0-.83.15-1.43.53l-8.37,5.59c-.68,1.74-2.34,2.95-4.53,2.95h-10.94v-3.02h10.94c1.28,0,1.74-.53,1.74-1.66s-.45-1.66-1.74-1.66h-20.14c-5.13,0-7.24.68-10.79,3.48l-2.49,1.97-1.81-2.42,2.49-1.97c4.15-3.25,7.17-4.08,12.67-4.08h20.06c2.04,0,3.7,1.13,4.45,2.8l7.17-4.76c.91-.6,1.58-.83,2.56-.83,3.17,0,4.9,2.49,4.9,4.91,0,1.51-.83,2.8-3.02,4.31l-18.86,13.08c-8.15,0-13.35-2.72-18.93-2.72-3.47,0-5.36.76-8.53,3.1ZM29.07,28.65l1.36-2.34c2.34-4.01,8.45-2.87,15.16.98,6.34,3.63,8.9,7.49,6.64,11.42l9.35,5.37-1.58,2.72-9.28-5.45c-2.56,4.16-7.01,3.55-13.2,0-6.72-3.86-10.94-8.39-8.45-12.7ZM32.99,27.89l-1.28,2.27c-1.36,2.27,2.19,5.6,7.32,8.62,4.6,2.65,7.62,3.4,9.05.83l1.28-2.19c1.43-2.42-.6-4.84-5.2-7.49-5.28-3.02-9.88-4.23-11.16-2.04ZM35.86,33.48c-.98-.53-1.43-1.97-.91-2.95.6-.98,2.04-1.29,3.02-.68,1.13.6,1.36,1.74.68,2.87-.6,1.06-1.66,1.44-2.79.76Z"/>
                                    </svg>
                                </div>
                                <p class="text">
                                    Livraison <br> à domicile
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------------------END Pourquoi acheter en ligne Mobile-------------------->
        <div class="prqEnLigne_conatiner">
            <div class="prqEnLigne_zone">
                <div class="mainTitle">
                    <p class="title">Pourquoi acheter en ligne</p>
                </div>
                <div class="icons_text_container">
                    <div class="svg_containerANDtext">
                        <div class="svg_container">
                            <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                <path class="cls-1" d="M50,78.3c-16.18,0-26.97-12.15-26.97-28.26s10.79-28.33,26.97-28.33,26.96,12.23,26.96,28.33-10.79,28.26-26.96,28.26ZM50,75.49c14.38,0,24.01-10.93,24.01-25.46s-9.64-25.53-24.01-25.53-24.02,10.93-24.02,25.53,9.71,25.46,24.02,25.46ZM41.01,48.81c-3.89,0-6.04-2.95-6.04-7.77s2.15-7.77,6.04-7.77,6.04,2.95,6.04,7.77-2.16,7.77-6.04,7.77ZM38.14,41.05c0,3.45.86,5.03,2.88,5.03s2.88-1.58,2.88-5.03-.86-5.03-2.88-5.03-2.88,1.58-2.88,5.03ZM40.94,66.5l15.17-32.94h2.88l-15.1,32.94h-2.95ZM58.99,66.79c-3.88,0-6.04-2.95-6.04-7.77s2.16-7.77,6.04-7.77,6.04,2.95,6.04,7.77-2.15,7.77-6.04,7.77ZM56.11,59.02c0,3.45.86,5.03,2.88,5.03s2.88-1.58,2.88-5.03-.86-5.03-2.88-5.03-2.88,1.58-2.88,5.03Z"/>
                            </svg>
                        </div>
                        <p class="text">
                            Remise Spéciale <br> Web
                        </p>
                    </div>

                    <div class="svg_containerANDtext">
                        <div class="svg_container">
                            <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                <path class="cls-1" d="M50,76.66c-15.24,0-25.4-11.45-25.4-26.62s10.16-26.69,25.4-26.69,25.4,11.52,25.4,26.69-10.16,26.62-25.4,26.62ZM38.75,48.61c.07-4.13.41-7.86,1.09-11.11-3.39.27-6.71.61-10.03,1.15-1.42,2.91-2.24,6.3-2.44,9.96h11.38ZM39.84,62.43c-.68-3.25-1.02-6.91-1.09-11.04h-11.38c.2,3.59,1.01,6.98,2.37,9.89,3.32.54,6.71.88,10.09,1.15ZM44.31,73.34c-1.63-1.83-2.91-4.68-3.86-8.2-3.05-.2-6.03-.47-9.08-.88,2.98,4.54,7.45,7.79,12.94,9.08ZM31.44,35.67c2.98-.41,5.96-.68,9.01-.88.88-3.52,2.17-6.23,3.8-8.13-5.42,1.29-9.89,4.54-12.81,9.01ZM42.68,37.37c-.68,3.32-1.08,7.18-1.15,11.25h16.94c-.07-4.06-.47-7.92-1.15-11.25-2.44-.13-4.88-.2-7.32-.2s-4.88.07-7.32.2ZM57.32,62.56c.68-3.32,1.08-7.18,1.15-11.18h-16.94c.07,4,.47,7.86,1.15,11.18,2.44.14,4.88.2,7.32.2s4.88-.07,7.32-.2ZM48.71,25.99c-2.3.88-4.13,4.13-5.35,8.6,2.17-.07,4.4-.14,6.64-.14s4.47.07,6.64.14c-1.22-4.47-3.05-7.72-5.35-8.6h-2.57ZM43.36,65.34c1.22,4.61,3.18,7.93,5.55,8.67h2.1c2.44-.75,4.4-4.07,5.62-8.67-2.17.07-4.4.14-6.64.14s-4.47-.07-6.64-.14ZM55.69,73.34c5.55-1.29,10.03-4.54,12.94-9.08-2.98.41-6.03.68-9.08.88-.95,3.52-2.24,6.37-3.86,8.2ZM68.63,35.67c-2.98-4.47-7.38-7.72-12.87-9.01,1.56,1.9,2.91,4.61,3.79,8.13,3.05.21,6.03.47,9.08.88ZM72.63,48.61c-.21-3.66-1.02-7.04-2.37-9.96-3.39-.54-6.71-.88-10.09-1.15.68,3.25,1.02,6.98,1.08,11.11h11.38ZM60.16,62.43c3.39-.27,6.77-.61,10.09-1.15,1.35-2.91,2.17-6.3,2.37-9.89h-11.38c-.07,4.13-.41,7.79-1.08,11.04Z"/>
                            </svg>
                        </div>
                        <p class="text">
                            Commande <br> 100% digitalisée
                        </p>
                    </div>

                    <div class="svg_containerANDtext">
                        <div class="svg_container">
                            <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                <path class="cls-1" d="M47.68,76.52c-2.33,0-3.77-1.21-4.17-3.3-7.7-1.45-12.27-6.11-12.91-13.02-4.57-.72-7.3-4.42-7.3-10.05,0-6.35,3.29-9.97,9.06-9.97h1.04v-.88c0-10.13,6.17-15.83,16.6-15.83s16.68,5.71,16.68,15.83v.88h1.04c5.69,0,8.98,3.7,8.98,9.97s-3.61,10.21-9.38,10.21h-3.93v-21.06c0-8.12-4.65-12.54-13.39-12.54s-13.31,4.5-13.31,12.54v21.06h-2.65c.56,5.14,3.69,8.2,9.62,9.32.56-1.77,1.84-2.65,4.01-2.65,3.77,0,5.69,1.61,5.69,4.82s-2,4.66-5.69,4.66ZM33.4,56.99v-13.42h-1.04c-3.93,0-5.77,2.17-5.77,6.59s2,6.83,5.77,6.83h1.04ZM66.68,43.57v13.42h.64c4.01,0,6.09-2.41,6.09-6.83s-2-6.59-6.09-6.59h-.64Z"/>
                            </svg>
                        </div>
                        <p class="text">
                            Une équipe <br> à votre écoute
                        </p>
                    </div>

                    <div class="svg_containerANDtext">
                        <div class="svg_container">
                            <svg xmlns="http://www.w3.org/2000/svg" id="icon" data-name="Calque 1" viewBox="0 0 100 100" width="65" height="65">
                                <path class="cls-1" d="M27.86,73.86l-3.17,2.35-1.89-2.35,3.17-2.34c3.7-2.72,6.41-3.78,10.26-3.78,5.36,0,10.33,2.49,18.18,2.65l18.71-12.85c.75-.53,1.06-.98,1.06-1.51,0-.98-.75-1.74-1.73-1.74-.53,0-.83.15-1.43.53l-8.37,5.59c-.68,1.74-2.34,2.95-4.53,2.95h-10.94v-3.02h10.94c1.28,0,1.74-.53,1.74-1.66s-.45-1.66-1.74-1.66h-20.14c-5.13,0-7.24.68-10.79,3.48l-2.49,1.97-1.81-2.42,2.49-1.97c4.15-3.25,7.17-4.08,12.67-4.08h20.06c2.04,0,3.7,1.13,4.45,2.8l7.17-4.76c.91-.6,1.58-.83,2.56-.83,3.17,0,4.9,2.49,4.9,4.91,0,1.51-.83,2.8-3.02,4.31l-18.86,13.08c-8.15,0-13.35-2.72-18.93-2.72-3.47,0-5.36.76-8.53,3.1ZM29.07,28.65l1.36-2.34c2.34-4.01,8.45-2.87,15.16.98,6.34,3.63,8.9,7.49,6.64,11.42l9.35,5.37-1.58,2.72-9.28-5.45c-2.56,4.16-7.01,3.55-13.2,0-6.72-3.86-10.94-8.39-8.45-12.7ZM32.99,27.89l-1.28,2.27c-1.36,2.27,2.19,5.6,7.32,8.62,4.6,2.65,7.62,3.4,9.05.83l1.28-2.19c1.43-2.42-.6-4.84-5.2-7.49-5.28-3.02-9.88-4.23-11.16-2.04ZM35.86,33.48c-.98-.53-1.43-1.97-.91-2.95.6-.98,2.04-1.29,3.02-.68,1.13.6,1.36,1.74.68,2.87-.6,1.06-1.66,1.44-2.79.76Z"/>
                            </svg>
                        </div>
                        <p class="text">
                            Livraison <br> à domicile
                        </p>
                    </div>

                </div>
            </div>
        </div>


        <div class="row_1i">
            <div class="mainTitle">
                <p class="title">Nos garanties</p>
            </div>
        </div>

        <div class="Garanties_card_hide">
            <div class="Garanties_card_zone">
                <div class="twoCards">
                    <div class="Garanties_card">
                        <div class="card3">
                            <div class="card-body">
                                <p class="card-title">Acheter en ligne et limiter vos déplacements</p>
                                <hr>
                                <p class="card-text">Pour garantir la sécurité de ses clients et futurs clients,
                                    M-AUTOMOTIV Renault assurent un processus d'achat de votre véhicule complètement digitalisé à travers la plateforme en ligne d'achat garantie par M-AUTOMOTIV Renault Maroc.
                                    Toutes les démarches d'achat d'un véhicule sont présentées sur cette plateforme. les documents nécessaires à la vente peuvent être directement scannés au niveau de notre site afin que vous puissiez éviter les déplacements. Encore plus, nous vous assurons un pick up des documents et une livraison jusqu'à votre domicile si vous le souhaitez.</p>
                            </div>
                        </div>
                    </div>
                    <div class="Garanties_card">
                        <div class="card3">
                            <div class="card-body">
                                <p class="card-title">Vivez votre propre expérience</p>
                                <hr>
                                <p class="card-text">Pour vous assurer une expérience customisée, M-AUTOMOTIV Renault mettent à votre disposition tout au long de ce parcours la possibilité de discuter avec votre conseiller commercial afin de vous rassurez sur vos choix tout au long de votre parcours.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="twoCards">
                    <div class="Garanties_card">
                        <div class="card3">
                            <div class="card-body">
                                <p class="card-title">Comme si vous étiez au Showroom</p>
                                <hr>
                                <p class="card-text">Depuis le choix de votre véhicule jusqu'à sa livraison, nous vous assurons une expérience semblable à celle de nos showrooms comme si vous y étiez. Une vue intérieure et extérieure de nos véhicules vous est présentée ainsi qu'une large panoplie d'accessoires adaptés à votre offre. Vous pourrez aussi simuler votre financement à crédit sur notre simulateur RCI dédié.</p>
                            </div>
                        </div>
                    </div>
                    <div class="Garanties_card">
                        <div class="card3">
                            <div class="card-body">
                                <p class="card-title">Sécurité <br> et Transparence</p>
                                <hr>
                                <p class="card-text">Toutes les procédures mises en place sur cette plateforme respectent nos conditions de vente en vigueur et vous assurent une sécurité de vos données personnelles en suivant les règles adoptées par le CNDP. Vous serez en contact permanent avec nos équipes commerciales pour une transparence et un accompagnement tout au long de ce processus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!----------------START (Tablet screen)------------------>
        <div class="row_1i">
            <div class="owl-carousel3-container">
                <div class="owl-carousel" id="carousel3">
                    <div class="item">
                        <div class="Garanties_card">
                            <div class="card3">
                                <div class="card-body">
                                    <p class="card-title">Acheter en ligne et limiter vos déplacements</p>
                                    <hr>
                                    <p class="card-text">Pour garantir la sécurité de ses clients et futurs clients,
                                        M-AUTOMOTIV Renault assurent un processus d'achat de votre véhicule complètement digitalisé à travers la plateforme en ligne d'achat garantie par M-AUTOMOTIV Renault Maroc.
                                        Toutes les démarches d'achat d'un véhicule sont présentées sur cette plateforme. les documents nécessaires à la vente peuvent être directement scannés au niveau de notre site afin que vous puissiez éviter les déplacements. Encore plus, nous vous assurons un pick up des documents et une livraison jusqu'à votre domicile si vous le souhaitez.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="Garanties_card">
                            <div class="card3">
                                <div class="card-body">
                                    <p class="card-title">Vivez votre propre expérience</p>
                                    <hr>
                                    <p class="card-text">Pour vous assurer une expérience customisée, M-AUTOMOTIV Renault mettent à votre disposition tout au long de ce parcours la possibilité de discuter avec votre conseiller commercial afin de vous rassurez sur vos choix tout au long de votre parcours.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="Garanties_card">
                            <div class="card3">
                                <div class="card-body">
                                    <p class="card-title">Comme si vous étiez au Showroom</p>
                                    <hr>
                                    <p class="card-text">Depuis le choix de votre véhicule jusqu'à sa livraison, nous vous assurons une expérience semblable à celle de nos showrooms comme si vous y étiez. Une vue intérieure et extérieure de nos véhicules vous est présentée ainsi qu'une large panoplie d'accessoires adaptés à votre offre. Vous pourrez aussi simuler votre financement à crédit sur notre simulateur RCI dédié.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="Garanties_card">
                            <div class="card3">
                                <div class="card-body">
                                    <p class="card-title">Sécurité <br> et Transparence</p>
                                    <hr>
                                    <p class="card-text">Toutes les procédures mises en place sur cette plateforme respectent nos conditions de vente en vigueur et vous assurent une sécurité de vos données personnelles en suivant les règles adoptées par le CNDP. Vous serez en contact permanent avec nos équipes commerciales pour une transparence et un accompagnement tout au long de ce processus.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!---------------- END (Tablet screen)------------------>


        <!------------------------------------section5------------------------------------->
        <div class="row_1i">
            <div class="mainTitle">
                <svg xmlns="http://www.w3.org/2000/svg" id="Calque_1" data-name="Calque 1" version="1.1" viewBox="0 0 100 100" width='55' height='55' fill='#646b52'>
                    <path class="cls-2" d="M48.3,83.02c-1.45,2.69-3.21,5.28-4.87,7.35h-4.56c-1.66-2.07-3.42-4.66-4.87-7.35h-13.47c-4.45,0-7.36-2.9-7.36-7.35v-41.44c0-4.35,3.01-7.25,7.36-7.25h41.44c4.87,0,7.36,2.49,7.36,7.35v41.34c0,4.66-2.9,7.35-7.56,7.35h-13.47ZM41.16,86.75c1.66-2.39,2.9-4.97,4.25-7.88h15.85c2.49,0,3.83-1.35,3.83-3.63v-40.51c0-2.38-1.35-3.63-3.73-3.63H21.06c-2.18,0-3.62,1.35-3.62,3.52v40.61c0,2.17,1.45,3.63,3.62,3.63h15.85c1.35,2.9,2.59,5.49,4.25,7.88ZM74,70.07V26.14c0-2.38-1.35-3.63-3.73-3.63H26.14v-4.14h44.76c4.87,0,7.35,2.49,7.35,7.35v44.34h-4.25ZM82.9,61.37V17.44c0-2.39-1.35-3.63-3.73-3.63h-44.44v-4.15h45.06c4.87,0,7.36,2.49,7.36,7.35v44.34h-4.25Z"/>
                    <path class="cls-1" d="M42.56,43.25c-2.52-.01-5.02.44-7.39,1.32v-2.81c2.38-.82,4.87-1.27,7.39-1.33,4.97,0,7.95,2.73,7.95,7.12.13,2.48-.87,4.89-2.73,6.53l-1.33,1.48c-2.1,2.33-2.41,3-2.41,5.23v2.32h-2.96v-2.32c-.27-2.31.63-4.61,2.41-6.12l1.68-1.74c1.52-1.35,2.42-3.26,2.48-5.29,0-2.66-2.07-4.39-5.1-4.39Z"/>
                    <path class="cls-1" d="M44.79,68.24c0,1.57-.65,2.32-2.31,2.32-1.1.18-2.14-.57-2.32-1.68-.03-.21-.03-.43,0-.64,0-1.66.74-2.32,2.32-2.32s2.35.66,2.35,2.32h-.04Z"/>
                </svg>
                <p class="title exeption" style="margin-bottom: 20px;">Foire aux questions "online store"</p>
                <p class="semititle">Vos questions sur online store</p>
            </div>
        </div>
        <div class="row_1i">
            <div class="questions-section">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header bg-black" id="headingOne">
                            <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Est-ce que le stock véhicule est visible ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>

                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                Oui nous avons un stock de modèles une panoplie de versions et de couleurs. <br>
                                Vous pouvez aussi avoir une visibilité sur le stock disponible par rapport à chaque modèle.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Les photos des véhicules présentées sont-elles réelles ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                Toutes les photos prises et vidéos 360 degrés intérieur et extérieur sont réelles et sont prises par nos équipes avec du matériel haute définition.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Est-ce que mon paiement est sécurisé ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                L'unique paiement demandé au niveau de cette plateforme est un acompte afin de réserver votre véhicule. <br>
                                Ce paiement se fera en ligne par CMI ou par virement bancaire suivant les coordonnées bancaires communiquées sur notre plateforme.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingfore">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefore" aria-expanded="false" aria-controls="collapsefore">
                                Comment être sûr que mon véhicule sera en bon état à la livraison ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapsefore" class="collapse" aria-labelledby="collapsefore" data-parent="#accordion">
                            <div class="card-body">
                                Dès que vous intégrez vos coordonnées complètes sur la plateforme et que nous validons votre achat, la prise en charge de la livraison de votre véhicule se fait par nos professionnels expérimentés.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingfive">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                Comment faire pour réserver un véhicule et le commander ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                            <div class="card-body">
                                Afin de réserver votre véhicule, merci de suivre les quelques étapes indiquées sur notre plateforme. <br>
                                Toute précommande n'est valable qu'après validation de votre versement d'acompte d'une valeur de 1000 DH. <br>
                                Un bon de commande officiel vous sera envoyé sur votre compte, vous recevrez aussi une notification par e-mail. <br>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingsixe">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesixe" aria-expanded="false" aria-controls="collapsesixe">
                                Est-ce qu'il y'a des frais à prévoir pour la livraison ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapsesixe" class="collapse" aria-labelledby="headingsixe" data-parent="#accordion">
                            <div class="card-body">
                                Tous les frais à prévoir lors du paiement de votre véhicule figurent sur le récapitulatif de votre simulation ainsi que le BDC envoyé par le Conseiller Commercial digital sur la plateforme :
                                <li><strong>Le prix de véhicule</strong></li>
                                <li><strong>Les frais de service</strong></li>
                                <li><strong>Les frais d'immatriculationn</strong></li>
                                <li><strong>La peinture métallisée</strong></li>
                                <li><strong>Le prix des accessoires ajoutés</strong></li>

                                <strong>Important : La livraison de votre véhicule est gratuite dans un rayon de 100 kilomètres.
                                    Des frais de livraison supplémentaires sont à prévoir si la livraison du véhicule dépasse 100 kilomètres à partir de la ville de Casablanca.</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingseven">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                                Peut-on acheter à titre professionnel ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapseseven" class="collapse" aria-labelledby="headingseven" data-parent="#accordion">
                            <div class="card-body">
                                Pour le moment la plateforme est dédiée uniquement aux clients particuliers et aux auto-entrepreneurs.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingeight">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
                                Peut on faire une reprise de notre voiture avec une véhicule neuf ou occasion ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapseeight" class="collapse" aria-labelledby="headingeight" data-parent="#accordion">
                            <div class="card-body">
                                Il est possible de faire une demande de reprise lors de la création de votre compte. <br>
                                Après avoir rempli les données demandées sur notre module reprise, un de nos conseillers prendra contact avec vous par la suite afin de vous orienter et venir faire une expertise de votre véhicule dans l'un de nos ateliers.<br>
                                Si vous souhaitez voir nos véhicules d'occasion disponibles, vous pouvez les consulter sur le lien. <br>
                                <strong>https://www.renault.m-automotiv.ma/voiture-occasion-renault</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingnine">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">
                                Quelles sont les garanties proposées par M-AUTOMOTIV Renault Maroc ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordion">
                            <div class="card-body">
                                <strong>Acheter en ligne et limiter vos déplacements</strong> <br>
                                Pour garantir la sécurité de ses clients et futurs clients, M-AUTOMOTIV Renault assurent un processus d'achat de votre véhicule complètement digitalisé à travers la plateforme en ligne d'achat garantie par M-AUTOMOTIV Renault Maroc. <br>
                                Toutes les démarches d'achat d'un véhicule sont présentées sur cette plateforme. les documents nécessaires à la vente peuvent être directement scannés au niveau de notre site afin que vous puissiez éviter les déplacements. Encore plus, nous vous assurons un pick up des documents et une livraison jusqu'à votre domicile si vous le souhaitez. <br>
                                <strong>Vivez votre propre expérience</strong>   <br>
                                Pour vous assurer une expérience customisée, M-AUTOMOTIV Renault mettent à votre disposition tout au long de ce parcours la possibilité de discuter avec votre conseiller commercial afin de vous rassurez sur vos choix tout au long de votre parcours. <br>
                                <strong>Comme si vous étiez au Showroom</strong> <br>
                                Depuis le choix de votre véhicule jusqu'à sa livraison, nous vous assurons une expérience semblable à celle de nos showrooms comme si vous y étiez. Une vue intérieure et extérieure de nos véhicules vous est présentée ainsi qu'une large panoplie d'accessoires adaptés à votre offre. Vous pourrez aussi simuler votre financement à crédit sur notre simulateur RCI dédié. <br>
                                <strong>Sécurité et Transparence</strong>  <br>
                                Toutes les procédures mises en place sur cette plateforme respectent nos conditions de vente en vigueur et vous assurent une sécurité de vos données personnelles en suivant les règles adoptées par le CNDP. Vous serez en contact permanent avec nos équipes commerciales pour une transparence et un accompagnement tout au long de ce processus. <br>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingten">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseten" aria-expanded="false" aria-controls="collapseten">
                                Comment je peux savoir quand allez-vous me livrer ?
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapseten" class="collapse" aria-labelledby="headingten" data-parent="#accordion">
                            <div class="card-body">
                                La date de livraison finale vous sera confirmée par votre commercial dédié sur la plateforme une fois que vous précommandez le véhicule.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingeleven">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseeleven" aria-expanded="false" aria-controls="collapseeleven">
                                Annulation - Résiliation
                                <svg class="rotate-icon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 01.708 0L8 8.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            </h5>
                        </div>
                        <div id="collapseeleven" class="collapse" aria-labelledby="headingeleven" data-parent="#accordion">
                            <div class="card-body">
                                Le client pourra résilier le présent contrat et exiger le remboursement de son acompte augmente des intérêts au taux légal, par lettre recommandée avec accuse de réception : <br>
                                <li>En cas de dépassement de la date de livraison indiquée au recto du présent contrat excédant sept jours et non dû à un cas de force majeure, sous réserve que la livraison du véhicule n'intervienne pas entre l'envoi et la réception de la lettre précitée. Conformément à la législation en vigueur, le client exerce ce droit dans un délai de cinq jours francs après l'expiration du délai de sept jours précités.</li>
                                <li>Si, à la suite de la signature du présent contrat, la construction du modelé commande vient à être abandonnée et s'il n'y a pas de véhicule correspondant à la commande, lorsque le client ne demande pas le report du contrat sur un autre modèle de la marque.</li>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!----------------------------------END section5-------------------------------------->


        <!--<iframe src="homeContent.html" frameborder="0" width="100%" height="1000px"></iframe>-->



        <div class="row_1i">
            <div class="backToTop">
                    <hr>
                    <a href="#">retour en haut de page</a><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                    </svg></span>
            </div>
        </div>


</div>



    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src={{ asset('scripts/owl.carousel.min.js') }}></script>
    <script src={{ asset('scripts/homePage.js') }}></script>
    <script src={{ asset('scripts/headerFooter.js') }}></script>

@stop
