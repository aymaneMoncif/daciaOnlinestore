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


        .radio-inputs {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            border-radius: 0.5rem;
            background-color: #EEE;
            box-sizing: border-box;
            box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
            padding: 0.25rem;
            width: 300px;
            font-size: 14px;
        }

        .radio-inputs .radio {
            flex: 1 1 auto;
            text-align: center;
            margin: auto;
        }

        .radio-inputs .radio input {
            display: none;
        }

        .radio-inputs .radio .valider, .radio-inputs .radio .refuser  {
            display: flex;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            border: none;
            padding: .5rem 0;
            color: rgba(51, 65, 85, 1);
            transition: all .15s ease-in-out;
        }

        .radio-inputs .radio input:checked + .valider {
            background-color: #0da72480;
            font-weight: 600;
        }
        .radio-inputs .radio input:checked + .refuser {
            background-color: #d234349d;
            font-weight: 600;
        }
        strong{
            font-size: 20px
        }

    </style>
@stop


@section('page_header')
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

        <h1 class="page-title">
            <i class=""></i>
            Edit Paiement
        </h1>
    
        <div id="voyager-notifications"></div>
        <div class="page-content edit-add container-fluid">
            @if($commande)
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                    <!-- form start -->
                        <form role="form" class="form-edit-add" action="{{ route('voyager.paiements.update', $dataTypeContent->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="panel-body">
                                <!-- Adding / Editing -->
                                <!-- GET THE DISPLAY OPTIONS -->                
                                <div class="form-group  col-md-12 ">
                                    <label class="control-label" for="name">Modepaiement</label>
                                    <input required="" type="text" class="form-control" name="modepaiement" placeholder="Modepaiement" value={{$dataTypeContent->modepaiement}}>
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->
                                            
                                <div class="form-group  col-md-12 ">
                                    <label class="control-label" for="name">Methodepaiement</label>
                                    <input required="" type="text" class="form-control" name="methodepaiement" placeholder="Methodepaiement" value={{$dataTypeContent->methodepaiement}}>
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->
                                            
                                <div class="form-group  col-md-12 ">
                                    <label class="control-label" for="name">Nombanque</label>
                                    <input required="" type="text" class="form-control" name="nombanque" placeholder="Nombanque" value={{$dataTypeContent->nombanque}}>
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->
                    
                                <div class="form-group  col-md-12 ">
                                    <label class="control-label" for="name">Numtransaction</label>
                                    <input required="" type="text" class="form-control" name="numtransaction" placeholder="Numtransaction" value={{$dataTypeContent->numtransaction}}>
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->
                                            
                                <div class="form-group  col-md-12 ">
                                    <label class="control-label" for="name">Imagerecu</label>
                                    <div data-field-name="imagerecu">
                                        <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                        <img id="recu" src={{ asset('storage/' . $dataTypeContent->imagerecu) }} data-file-name={{$dataTypeContent->imagerecu}} data-id="7" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    </div>
                                    <input type="file" name="imagerecu" accept="image/*">
                                </div>
                                <!-- GET THE DISPLAY OPTIONS -->
                                            
                                <div class="form-group  col-md-12 " >
                                    <label class="control-label" for="client_id">Client</label>
                                    <select class="form-control" id="client_id" name="client_id" required>
                                        <option value="">none</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $dataTypeContent->client_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                                                
                                <div class="form-group  col-md-12 " > 
                                    <label class="control-label" for="commande_id">Commandes</label>
                                    <select class="form-control" id="commande_id" name="commande_id" required>
                                        <option value="">none</option>
                                        @foreach($commandes as $commande)
                                            <option value="{{ $commande->id }}" {{ $dataTypeContent->commande_id == $commande->id ? 'selected' : '' }}>
                                                {{ $commande->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group  col-md-12 ">
                                    <label class="control-label" for="name"><strong>Validation</strong></label>
                                    <div class="radio-inputs">
                                        <label class="radio">
                                            <input type="radio" name="validation" value="valider" hidden {{ $dataTypeContent->validation === 'valider' ? 'checked' : '' }}>
                                            <span class="valider">valider</span>
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="validation" value="refuser" hidden {{ $dataTypeContent->validation === 'refuser' ? 'checked' : '' }}>
                                            <span class="refuser">refuser</span>
                                        </label>
                                    </div>
                                </div>
                                
                            </div><!-- panel-body -->

                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary save">Save</button>
                            </div>
                        </form>

                        <div style="display:none">
                            <input type="hidden" id="upload_url" value="http://127.0.0.1:8000/page/upload">
                            <input type="hidden" id="upload_type_slug" value="paiements">
                        </div>
                    </div>
                    <!-- ### Apport ### -->
                    <div class="panel panel panel-bordered panel-dark">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i>Commande</h3> 
                                                                
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body" style="">
                            <label for="slug" style="font-size: 20px;
                            color: black;">Total prix</label>
                            <ul>
                                <li style="font-size: 20px;
                                font-weight: 600;
                                color: black;">{{$commande?->total}}</li>
                            </ul>
                        </div>
                    </div>
                    <!-- ### Apport ### -->
                </div>
                <div class="col-md-4">
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

                    @if($simulateur)
                        <!-- ### Apport ### -->
                        <div class="panel panel panel-bordered panel-dark">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="icon wb-clipboard"></i>Simulation</h3> 
                                                                    
                                <div class="panel-actions">
                                    <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                                </div>
                            </div>
                            <div class="panel-body" style="">
                                <label for="slug">Type de simulation</label>
                                <input type="text" class="form-control" name="type" placeholder="Type de simulation" readonly="" value={{$simulateur?->type}}><br>
                                <label for="slug">Apport</label>
                                <input type="text" class="form-control" name="Apport" placeholder="Apport" readonly="" value={{$simulateur?->apport}} ><br>
                                <label for="slug">Durée / Mois</label>
                                <input type="text" class="form-control" name="durree" placeholder="durree" readonly="" value={{$simulateur?->durree}} ><br>
                                <label for="slug">Taux</label>
                                <input type="text" class="form-control" name="taux" placeholder="taux" readonly="" value={{$simulateur?->taux}} ><br>
                                <label for="slug">Frais de dossier</label>
                                <input type="text" class="form-control" name="fraisdossier" placeholder="fraisdossier" readonly="" value={{$simulateur?->fraisdossier}} ><br>
                                <label for="slug">Mensualité</label>
                                <input type="text" class="form-control" name="mensualite" placeholder="mensualite" readonly="" value={{$simulateur?->mensualite}} ><br>
                            </div>
                        </div>
                        <!-- ### Apport ### -->
                    @endif
                </div>
            </div>

            @else
                <p>where is the commande, huh !!!</p>
            @endif
        </div>

        <div class="modal fade modal-danger" id="confirm_delete_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title"><i class="voyager-warning"></i> Are you sure</h4>
                    </div>

                    <div class="modal-body">
                        <h4>Are you sure you want to delete '<span class="confirm_delete_name"></span>'</h4>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirm_delete">Yes, Delete it!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const element = document.getElementById('recu');
        element.addEventListener('click', function() {
            if (element.style.width === '100%') {
                element.style.width = '200px';
            } else {
                element.style.width = '100%';
            }
        });
    });
    </script>
@stop