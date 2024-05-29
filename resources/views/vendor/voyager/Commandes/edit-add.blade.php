@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
        strong{
            font-weight: 500;
            color: rgb(73, 73, 73)
        }
        .fs-3{
            font-size: 16px;
        }

        .validezone2, .attentezone2 {
            height: 46px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 500;
        }
        .validezone, .attentezone {
            height: 46px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            justify-content: space-between;
            font-size: 20px;
            font-weight: 500;
        }
        .valideAndIconTrue{
            color: #56b956e8;
        }
        .valideAndIconFalse{;
            color: #7d7d7de8;
        }
        .valideAndIconFalse, .valideAndIconTrue{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .validezone {
            border: 1px solid #5dc45de8;
            color: #56b956e8;
        }
        .attentezone {
            border: 1px solid #565656e8;
            color: #7d7d7de8;
        }
    </style>
@stop


@section('page_header')
    <h1 class="page-title">

    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="row">

        <form role="form" class="form-edit-add" action="{{ route('custom.commandes.update', $commande->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- ### status CMD ### -->
        @if ($commande->Status_commande)
            <input type="text" name="Status_commande" value={{$commande->Status_commande}} hidden>
        @endif
        <!-- ### status CMD ### -->

        <div class="col-md-8">
            <!-- ### TITLE ### -->
            <div class="panel panel-bordered panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Client</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table width="100%" cellspacing="0" cellpadding="0" style="padding:40px;">
                        <tbody>
                            <!-- ### n_chassis ### -->
                            @if ($commande->n_chassis)
                                <input type="text" name="n_chassis" value={{$commande->n_chassis}} hidden>
                            @endif
                            <!-- ### n_chassis ### -->

                            <!-- ### client_id ### -->
                            @if ($commande->Client)
                                <input type="text" name="client_id" value={{$commande->Client->id}} hidden>
                            @endif
                            <!-- ### client_id ### -->
                            <td class="fs-3" height="40">
                                <label for="identite">Identité</label> :
                                @if ($commande->Client)
                                    <strong>{{ $commande->Client->id }}</strong>
                                @else
                                    <strong>This user is deleted</strong>
                                @endif
                            </td>
                            <tr>
                                <td class="fs-3" height="40"><label>Nom </label>: <strong>{{$commande->Client?->name}}</strong></td>
                            </tr>
                            <tr>
                                <td class="fs-3" height="40"><label>Prénom </label>: <strong>{{$commande->Client?->prenom}}</strong></td>
                            </tr>
                            <tr>
                                <td class="fs-3" height="40"><label>Téléphone </label>: <strong>{{$commande->Client?->tele}}</strong></td>
                            </tr>
                            <tr>
                                <td class="fs-3" height="40"><label>Email </label> : <strong>{{$commande->Client?->email}}</strong></td>
                            </tr>
                            <tr>
                                <td class="fs-3" height="40"><label>Ville </label> : <strong>{{$commande->Client?->ville}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ### CONTENT ### -->
                <!-- ### modele_id ### -->
                <input type="text" name="modele_id" value={{$commande->modele_id}} hidden>
                <!-- ### modele_id ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Véhicules</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <label for="id_modele">Modèle</label>
                    <select class="form-control" id="id_modele" name="id_modele" disabled>
                        @foreach($modeles as $modele)
                            <option value="{{ $modele->id }}" {{ $commande->modele_id == $modele->id ? 'selected' : '' }}>
                                {{ $modele->nommodele }}
                            </option>
                        @endforeach
                    </select><br><br>

                    <!-- ### version_id ### -->
                    <input type="text" name="version_id" value={{$commande->version_id}} hidden>
                    <!-- ### version_id ### -->
                    <label for="id_version">Version</label>
                    <select class="form-control" id="id_version" name="id_version" disabled>
                        @foreach($versions as $version)
                            <option value="{{ $version->id }}" {{ $commande->version_id == $version->id ? 'selected' : '' }}>
                                {{ $version->nomversion }}
                            </option>
                        @endforeach
                    </select><br>


                    <!-- ### couleur_id ### -->
                    <input type="text" name="couleur_id" value={{$commande->couleur_id}} hidden>
                    <!-- ### couleur_id ### -->
                    <label for="slug">Couleur</label><small>(Veuillez choisir la version avant)</small>
                    <select class="form-control" id="id_version" name="id_version" disabled>
                        @foreach($couleurs as $couleur)
                            <option value="{{ $couleur->id }}" {{ $commande->couleur_id == $couleur->id ? 'selected' : '' }}>
                                {{ $couleur->nomcouleur }}
                            </option>
                        @endforeach
                    </select><br>

                    <label for="equipements">Equipements</label><br>
                    <select class="form-control select2" name="equipement_id" multiple disabled>
                        @foreach($equipementsSelected as $equipement)
                            <option value="{{ $equipement->id }}"
                                {{ $equipementsSelected->contains($equipement->id) ? 'selected' : '' }}>
                                {{ $equipement->nomequipement }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- ### Apport ### -->
            <div class="panel panel panel-bordered panel-dark">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-clipboard"></i>Apport</h3>

                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body" style="">
                    <label for="slug">Type de paiement</label>
                    <input type="text" class="form-control" name="type" placeholder="Type de paiement" readonly="" value="Virement"><br>
                    <label for="slug">Nom de la banque</label>
                    <input type="text" class="form-control" name="nombanque" placeholder="nom de la banque" readonly="" value={{$commande->Aport?->nombanque}} ><br>
                    <!--input type="text" class="form-control" name="numerotransaction" placeholder="Numero de transaction" readonly="" value={$commande->Aport->numerotransaction} ><br-->
                    <!--img style="width: 100%;" src= asset('storage/'. $commande->Aport->imagerecu) alt=""-->
                    @if($commande->Aport?->comptable_validation == 1)
                        <div class="validezone">
                            <span>Validé</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                            </svg>
                        </div>
                    @else
                        <div class="attentezone">
                            <span>En attente</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
            <!-- ### Apport ### -->

            <!-- ### Paiement ### -->
            <div class="panel panel panel-bordered panel-dark">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-clipboard"></i>Paiement</h3>

                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body" style="">
                    <label for="slug">Type de paiement</label>
                    <input type="text" class="form-control" name="type" placeholder="Type de paiement" readonly="" value="MOBILIZE"><br>
                    @if($commande->Paiement?->validation == 'valider')
                        <div class="validezone">
                            <span>Validé</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                            </svg>
                        </div>
                    @elseif($commande->Paiement?->validation == 'refuser')
                        <div class="attentezone">
                            <span style="color: red">Refuser</span>
                        </div>
                    @else
                        <div class="attentezone">
                            <span>En attente</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
            <!-- ### Paiement ### -->

            <!-- ### Dossier d'achat ### -->
            <div class="panel panel panel-bordered panel-dark">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-clipboard"></i>Dossier d'achat</h3>

                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body" style="">
                    <label for="slug">Mode de paiement</label>
                    <input type="text" class="form-control" name="type" placeholder="Type de paiement" readonly="" value="{{ $commande->DossierAchat->modepaiement ?? '' }}"><br>
                    <div class="validezone2">
                        <p>
                            Mode de paiement
                        </p>
                        @if($commande->DossierAchat?->modepaiement_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="validezone2">
                        <p>
                            CIN
                        </p>
                        @if($commande->DossierAchat?->cin_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="validezone2">
                        <p>
                            Attestation salaire
                        </p>
                        @if($commande->DossierAchat?->Attestationsalaire_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="validezone2">
                        <p>
                            Bulletin de paie
                        </p>
                        @if($commande->DossierAchat?->bulletinpaie_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="validezone2">
                        <p>
                            Relevé bancaire
                        </p>
                        @if($commande->DossierAchat?->relevebancaire_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="validezone2">
                        <p>
                            Justificatif de domiciliation
                        </p>
                        @if($commande->DossierAchat?->justificatifdomiciliation_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="validezone2">
                        <p>
                            RIB
                        </p>
                        @if($commande->DossierAchat?->rib_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="validezone2">
                        <p>
                            Relevé cnss
                        </p>
                        @if($commande->DossierAchat?->relevecnss_Validation == 'valider')
                            <div class="valideAndIconTrue">
                                <span>Validé</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </div>
                        @elseif($commande->DossierAchat?->relevecnss_Validation == 'refuser')
                            <div class="valideAndIconFalse">
                                <span style="color: red">Refuser</span>
                            </div>
                        @else
                            <div class="valideAndIconFalse">
                                <span>En attente</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ### Dossier d'achat ### -->

        </div>

        <div class="col-md-4">
            <!-- ### CC Status & Comment ### -->
            <div class="panel panel-bordered panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-image"></i>CC Status & Comment</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                @if(Auth::guard('admin')->user()->role->name == 'Centre conseiller' || Auth::guard('admin')->user()->role->name == 'admin')
                    <div class="panel-body">
                        <h3 class="panel-title" style="color: black;">Call center Status</h3>
                            <select class="form-control" name="CC_status" id="">
                                <option value="" {{ $commande->CC_status === "" ? 'selected' : '' }}>Vide</option>
                                <option value="Injoignable 1" {{ $commande->CC_status === "Injoignable 1" ? 'selected' : '' }}>Injoignable 1</option>
                                <option value="Injoignable 2" {{ $commande->CC_status === "Injoignable 2" ? 'selected' : '' }}>Injoignable 2</option>
                                <option value="Intéressé" {{ $commande->CC_status === "Intéressé" ? 'selected' : '' }}>Intéressé</option>
                                <option value="clos sans Suite" {{ $commande->CC_status === "clos sans Suite" ? 'selected' : '' }}>clos sans Suite</option>
                                <option value="A rappeler" {{ $commande->CC_status === "A rappeler" ? 'selected' : '' }}>A rappeler</option>
                            </select>
                            <h3 class="panel-title" style="color: black;">Call center Status</h3>
                            <textarea class="form-control" name="CC_Comment" id="" cols="30" rows="10">{{ $commande->CC_Comment }}</textarea>
                        <button class="btn btn-primary" type="submit">Ajouter</button>
                    </div>
                @else
                    <div class="panel-body">
                        <h3 class="panel-title" style="color: black;">Call center Status</h3>
                            <select class="form-control" name="CC_status" id="" disabled>
                                <option value={{$commande->CC_status}} selected>{{$commande->CC_status}}</option>
                            </select>
                            <h3 class="panel-title" style="color: black;">Call center Status</h3>
                            <textarea class="form-control" name="CC_Comment" id="" cols="30" rows="10" disabled>{{ $commande->CC_Comment }}</textarea>
                    </div>
                @endif
            </div>
            <!-- ### CC Status & Comment ### -->

            <!-- ### Commercial Status & Comment ### -->
            <div class="panel panel-bordered panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-image"></i>Commercial Status & Comment</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>

                @if(Auth::guard('admin')->user()->role->name == 'Commercial' || Auth::guard('admin')->user()->role->name == 'admin')
                    <div class="panel-body">
                        <h3 class="panel-title" style="color: black;">Commercial Status</h3>
                        <select class="form-control" name="Commercial_Status" id="">
                            <option value="" {{ $commande->Commercial_Status === "" ? 'selected' : '' }}>Vide</option>
                            <option value="Commande" {{ $commande->Commercial_Status === "Commande" ? 'selected' : '' }}>Commande</option>
                            <option value="Livraison" {{ $commande->Commercial_Status === "Livraison" ? 'selected' : '' }}>Livraison</option>
                            <option value="Clos sans suite" {{ $commande->Commercial_Status === "Clos sans suite" ? 'selected' : '' }}>Clos sans suite</option>
                            <option value="Opportunité" {{ $commande->Commercial_Status === "Opportunité" ? 'selected' : '' }}>Opportunité</option>
                        </select>

                        <h3 class="panel-title" style="color: black;">Commercial Comment</h3>
                        <textarea class="form-control" name="Commercial_Comment" id="" cols="30" rows="10">{{ $commande->Commercial_Comment }}</textarea>

                        <button class="btn btn-primary" type="submit">Ajouter</button>
                    </div>
                @else
                    <div class="panel-body">
                        <h3 class="panel-title" style="color: black;">Commercial Status</h3>
                        <select class="form-control" name="Commercial_Status" id="" disabled>
                            <option value={{$commande->Commercial_Status}} selected>{{$commande->Commercial_Status}}</option>
                        </select>
                        <h3 class="panel-title" style="color: black;">Commercial Comment</h3>
                        <textarea class="form-control" name="Commercial_Comment" id="" cols="30" rows="10" disabled>{{ $commande->Commercial_Comment }}</textarea>
                    </div>
                @endif
            </div>
            <!-- ### Commercial Status & Comment ### -->
        </div>

        </form>

    </div>
@stop

@section('javascript')

@stop
