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
        Edit Dossier Achat
    </h1>
    <div id="voyager-notifications"></div>
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="{{ route('update.dossier_achats', $dataTypeContent->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="panel-body">
                            <!-- Adding / Editing -->
                                                       
                            <div class="form-group  col-md-12 " >  
                                <label class="control-label" for="name">Mode de paiement</label>
                                <input  required  type="text" class="form-control" name="modepaiement" placeholder="Modepaiement" value={{$dataTypeContent->modepaiement}}>                               
                            </div>
                                                                
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Modepaiement Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="modepaiement_Validation" value="valider" hidden {{ $dataTypeContent->modepaiement_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="modepaiement_Validation" value="refuser" hidden {{ $dataTypeContent->modepaiement_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                                                        
                            <div class="form-group  col-md-12 " > 
                                <label class="control-label" for="name">Cin</label>
                                <div data-field-name="cin">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="cinImage" src="{{ asset('storage/' . $dataTypeContent->cin) }}" data-file-name="{{ $dataTypeContent->cin }}" data-id="8" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input  type="file" name="cin" accept="image/*">
                            </div>
                                                            
                            <div class="form-group  col-md-12 " >        
                                <label class="control-label" for="name">Cin Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="cin_Validation" value="valider" hidden {{ $dataTypeContent->cin_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="cin_Validation" value="refuser" hidden {{ $dataTypeContent->cin_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->   

                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Attestationsalaire</label>
                                <div data-field-name="Attestationsalaire">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="Attestationsalaire" src={{ asset('storage/' . $dataTypeContent->Attestationsalaire) }} data-file-name={{$dataTypeContent->Attestationsalaire}} data-id="8" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input  type="file" name="Attestationsalaire" accept="image/*">
                            </div>
                                                           
                            <div class="form-group  col-md-12 " >        
                                <label class="control-label" for="name">Attestationsalaire Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="Attestationsalaire_Validation" value="valider" hidden {{ $dataTypeContent->Attestationsalaire_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="Attestationsalaire_Validation" value="refuser" hidden {{ $dataTypeContent->Attestationsalaire_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS --> 
                                                          
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Bulletinpaie</label>
                                <div data-field-name="bulletinpaie">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="Bulletinpaie" src={{ asset('storage/' . $dataTypeContent->bulletinpaie) }} data-file-name={{$dataTypeContent->bulletinpaie}} data-id="8" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input  type="file" name="bulletinpaie" accept="image/*">
                            </div>
                                                            
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Bulletinpaie Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="bulletinpaie_Validation" value="valider" hidden {{ $dataTypeContent->bulletinpaie_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="bulletinpaie_Validation" value="refuser" hidden {{ $dataTypeContent->bulletinpaie_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS --> 
                                                          
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Relevebancaire</label>
                                <div data-field-name="relevebancaire">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="relevebancaire" src={{ asset('storage/' . $dataTypeContent->relevebancaire) }} data-file-name={{$dataTypeContent->relevebancaire}} data-id="8" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input  type="file" name="relevebancaire" accept="image/*">
                            </div>
                                                          
                            <div class="form-group  col-md-12 " > 
                                <label class="control-label" for="name">Relevebancaire Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="relevebancaire_Validation" value="valider" hidden {{ $dataTypeContent->relevebancaire_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="relevebancaire_Validation" value="refuser" hidden {{ $dataTypeContent->relevebancaire_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                                                                
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Justificatifdomiciliation</label>
                                <div data-field-name="justificatifdomiciliation">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="justificatifdomiciliation" src={{ asset('storage/' . $dataTypeContent->justificatifdomiciliation) }} data-file-name={{$dataTypeContent->justificatifdomiciliation}} data-id="8" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input  type="file" name="justificatifdomiciliation" accept="image/*">
                            </div>
                                                                
                            <div class="form-group  col-md-12 " > 
                                <label class="control-label" for="name">Justificatifdomiciliation Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="justificatifdomiciliation_Validation" value="valider" hidden {{ $dataTypeContent->justificatifdomiciliation_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="justificatifdomiciliation_Validation" value="refuser" hidden {{ $dataTypeContent->justificatifdomiciliation_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->

                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Rib</label>
                                <div data-field-name="rib">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="rib" src={{ asset('storage/' . $dataTypeContent->rib) }} data-file-name={{$dataTypeContent->rib}} data-id="8" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input  type="file" name="rib" accept="image/*">
                            </div>
                                                                
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Rib Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="rib_Validation" value="valider" hidden {{ $dataTypeContent->rib_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="rib_Validation" value="refuser" hidden {{ $dataTypeContent->rib_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                                                                
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">Relevecnss</label>
                                <div data-field-name="relevecnss">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="relevecnss" src={{ asset('storage/' . $dataTypeContent->relevecnss) }} data-file-name={{$dataTypeContent->relevecnss}} data-id="8" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input  type="file" name="relevecnss" accept="image/*">
                            </div>

                            <div class="form-group  col-md-12">
                                <label class="control-label" for="name">Relevecnss Validation</label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="relevecnss_Validation" value="valider" hidden {{ $dataTypeContent->relevecnss_Validation === 'valider' ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="relevecnss_Validation" value="refuser" hidden {{ $dataTypeContent->relevecnss_Validation === 'refuser' ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                                                                
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="client_id">Client</label>
                                <select class="form-control" id="client_id" name="client_id">
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
                                <select class="form-control" id="commande_id" name="commande_id">
                                    <option value="">none</option>
                                    @foreach($commandes as $commande)
                                        <option value="{{ $commande->id }}" {{ $dataTypeContent->commande_id == $commande->id ? 'selected' : '' }}>
                                            {{ $commande->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                           
                                                            
                            <div class="form-group  col-md-12 " >
                                <label class="control-label" for="name">RCIcomment</label>
                                    <textarea  class="form-control" name="RCIcomment" rows="5">{{ $dataTypeContent->RCIcomment }}</textarea>
                            </div>
                        
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>

                    <div style="display:none">
                        <input type="hidden" id="upload_url" value="http://127.0.0.1:8000/admin/upload">
                        <input type="hidden" id="upload_type_slug" value="dossier-achats">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
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
        var elements = [
            'cinImage', 
            'Attestationsalaire', 
            'Bulletinpaie', 
            'relevecnss', 
            'rib', 
            'justificatifdomiciliation', 
            'relevebancaire'
        ];

        elements.forEach(function(id) {
            var element = document.getElementById(id);
            element.addEventListener('click', function() {
                if (element.style.width === '100%') {
                    element.style.width = '200px';
                } else {
                    element.style.width = '100%';
                }
            });
        });
    });
</script>

@stop