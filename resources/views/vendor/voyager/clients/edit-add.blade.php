@extends('voyager::master')

@section('css')

@stop


@section('page_header')
    <h1 class="page-title">

    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <h1 class="page-title">
        <i class=""></i>
            Edit Client
    </h1>

    <div id="voyager-notifications"></div>
        <div class="page-content edit-add container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="{{route('update.user.allinfo',$dataTypeContent->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="panel-body">
                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Nom</label>
                                <input required="" type="text" class="form-control" name="name" placeholder="Nom" value={{$dataTypeContent->name}}>
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Prenom</label>
                                <input required="" type="text" class="form-control" name="prenom" placeholder="Prenom" value={{$dataTypeContent->prenom}}>
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Email</label>
                                <input required="" type="text" class="form-control" name="email" placeholder="Email" value={{$dataTypeContent->email}}>
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Password</label>
                                <input required="" type="text" class="form-control" name="password" placeholder="Password" value={{$dataTypeContent->password}}>
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Tele</label>
                                <input required="" type="text" class="form-control" name="tele" placeholder="Tele" value={{$dataTypeContent->tele}}>
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Ville</label>
                                <input required="" type="text" class="form-control" name="ville" placeholder="Ville" value={{$dataTypeContent->ville}}>
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">TestDrive</label>
                                <input required="" type="text" class="form-control" name="testDrive" placeholder="TestDrive" value={{$dataTypeContent->testDrive}}>
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">PasswordChanged</label>
                                <input type="text" class="form-control" name="passwordChanged" placeholder="PasswordChanged" value={{$dataTypeContent->passwordChanged}}>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>
                <div style="display:none">
                    <input type="hidden" id="upload_url" value="http://localhost:8000/admin/upload">
                    <input type="hidden" id="upload_type_slug" value="clients">
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

@stop

@section('javascript')

@stop
