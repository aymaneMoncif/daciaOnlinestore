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


    <h1 class="page-title">
        <i class="voyager-person"></i>
            Edit User
    </h1>
    <div id="voyager-notifications"></div>
    <div class="page-content container-fluid">
        <form role="form" class="form-edit-add" action="{{ route('voyager.users.update', $dataTypeContent->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">                  
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value={{$dataTypeContent->name}}>
                            </div>

                            <div class="form-group">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" value={{$dataTypeContent->prenom}}>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value={{$dataTypeContent->email}}>
                            </div>

                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value={{$dataTypeContent->ville}}>
                            </div>

                            <div class="form-group">
                                <label for="tele">Téléphone</label>
                                <input type="text" class="form-control" id="tele" name="tele" placeholder="Téléphone" value={{$dataTypeContent->tele}}>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label><br>
                                <small>Leave empty to keep the same</small>
                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                            </div>

                            <div class="form-group" style="display: none">
                                <label for="testDrive">Test drive</label><br>
                                <input type="password" class="form-control" id="testDrive" name="testDrive" value={{$dataTypeContent->testDrive}} autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="default_role">Default Role</label>
                                <select class="form-control select2-ajax select2-hidden-accessible" name="role_id" data-get-items-route="http://127.0.0.1:8000/admin/users/relation" data-get-items-field="user_belongsto_role_relationship" data-id="48" data-method="edit" data-select2-id="3" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="5">None</option>
                                    <option value="2" selected="selected" data-select2-id="6">Client</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="additional_roles">Additional Roles</label>
                                <select class="form-control select2-ajax select2-hidden-accessible" name="user_belongstomany_role_relationship[]" multiple="" data-get-items-route="http://127.0.0.1:8000/admin/users/relation" data-get-items-field="user_belongstomany_role_relationship" data-id="48" data-method="edit" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="9">None</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="passwordChanged">password Changed</label><br>
                                <input type="text" class="form-control" id="passwordChanged" name="passwordChanged" value="" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="locale">Locale</label>
                                <select class="form-control select2 select2-hidden-accessible" id="locale" name="locale" data-select2-id="locale" tabindex="-1" aria-hidden="true">
                                    <option value="al">al</option>
                                    <option value="am">am</option>
                                    <option value="ar">ar</option>
                                    <option value="az">az</option>
                                    <option value="bg">bg</option>
                                    <option value="ca">ca</option>
                                    <option value="cs">cs</option>
                                    <option value="de">de</option>
                                    <option value="el">el</option>
                                    <option value="en" selected="" data-select2-id="2">en</option>
                                    <option value="es">es</option>
                                    <option value="fa">fa</option>
                                    <option value="fi">fi</option>
                                    <option value="fr">fr</option>
                                    <option value="gl">gl</option>
                                    <option value="id">id</option>
                                    <option value="it">it</option>
                                    <option value="ja">ja</option>
                                    <option value="km">km</option>
                                    <option value="ku">ku</option>
                                    <option value="mm">mm</option>
                                    <option value="my">my</option>
                                    <option value="nl">nl</option>
                                    <option value="pl">pl</option>
                                    <option value="pt">pt</option>
                                    <option value="pt_br">pt_br</option>
                                    <option value="ro">ro</option>
                                    <option value="ru">ru</option>
                                    <option value="sv">sv</option>
                                    <option value="tr">tr</option>
                                    <option value="uk">uk</option>
                                    <option value="vi">vi</option>
                                    <option value="zh_CN">zh_CN</option>
                                    <option value="zh_TW">zh_TW</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                <img src="{{ asset('storage/' . $dataTypeContent->avatar) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                Save
            </button>
        </form>
        <div style="display:none">
            <input type="hidden" id="upload_url" value="http://127.0.0.1:8000/admin/upload">
            <input type="hidden" id="upload_type_slug" value="users">
        </div>
    </div>


@stop

@section('javascript')
    
@stop