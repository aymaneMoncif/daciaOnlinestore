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
        <i class="voyager-sort"></i>
        Edit Apport
    </h1>
    <div id="voyager-notifications"></div>
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="{{ route('voyager.aports.update', $dataTypeContent->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="panel-body">                  
                            <div class="form-group  col-md-12 ">                            
                                <label class="control-label" for="name">Nombanque</label>
                                <input required="" type="text" class="form-control" name="nombanque" placeholder="Nombanque" value={{$dataTypeContent->nombanque}}>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                                                
                            <div class="form-group  col-md-12 ">                             
                                <label class="control-label" for="name">Numerotransaction</label>
                                <input required="" type="text" class="form-control" name="numerotransaction" placeholder="Numerotransaction" value={{$dataTypeContent->numerotransaction}}>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                                                
                            <div class="form-group  col-md-12 ">                      
                                <label class="control-label" for="name">Imagerecu</label>
                                <div data-field-name="imagerecu">
                                    <a href="#" class="voyager-x remove-single-image" style="position:absolute;"></a>
                                    <img id="recu" src={{ asset('storage/' . $dataTypeContent->imagerecu) }} data-file-name={{ $dataTypeContent->imagerecu }} data-id="33" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                </div>
                                <input type="file" name="imagerecu" accept="image/*">
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                               
                            <div class="form-group  col-md-12 ">                        
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
                            <!-- GET THE DISPLAY OPTIONS -->
                                                
                            <div class="form-group  col-md-12 ">                             
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
                            <!-- GET THE DISPLAY OPTIONS -->
                                    
                            <div class="form-group  col-md-12 ">                         
                                <label class="control-label" for="name">Type Paiement</label>
                                <input type="text" class="form-control" name="type_paiement" placeholder="Type Paiement" value="">
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                                                
                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Signature</label>
                                <input type="text" class="form-control" name="signature" placeholder="Signature" value={{ $dataTypeContent->signature }}>
                            </div>

                            <div class="form-group  col-md-12 ">                                   
                                <label class="control-label" for="name"><strong>Comptable Validation</strong></label><br>
                                <div class="radio-inputs">
                                    <label class="radio">
                                        <input type="radio" name="comptable_validation" value='on'  {{ $dataTypeContent->comptable_validation == 1 ? 'checked' : '' }}>
                                        <span class="valider">valider</span>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="comptable_validation" value=off  {{ $dataTypeContent->comptable_validation == 0 ? 'checked' : '' }}>
                                        <span class="refuser">refuser</span>
                                    </label>
                                </div>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>

                    <div style="display:none">
                        <input type="hidden" id="upload_url" value="http://localhost:8000/admin/upload">
                        <input type="hidden" id="upload_type_slug" value="aports">
                    </div>
                </div>
            </div>
        </div>
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