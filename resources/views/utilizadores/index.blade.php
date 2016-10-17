@extends('layouts.dashboard')
@section('page_heading','Ver Utilizadores')
@section('section')


    @if (session('novo'))
        {{--<div class="alert alert-success">--}}
            {{--{{ session('novo') }}--}}
            @include('widgets.alert', array('class'=>'success', 'dismissable'=>true, 'message'=>  session('novo') , 'icon'=> 'check'))
       {{-- </div>--}}
    @endif


<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-responsive table-striped ">
            <tr>
                <th>ID</th>
            <th>
                Nome
            </th>
            <th>
                Email
            </th>
            <th>
                Nr. Mecanográfico
            </th>
            <th></th>
        </tr>

        @foreach($utilizadores as $utilizador)
        <tr>
            <td>{{ $utilizador->id }}</td>
            <td>
                {{ $utilizador->name }}
            </td>
            <td>
                {{ $utilizador->email }}
            </td>
            <td>
                {{ $utilizador->nrmecanografico }}
            </td>
            <td>
                <a class="btn btn-info btn-sm btn-outline" data-toggle="modal" data-target="#verUtilizador" data-servicos="" href="#" role="button" style="margin-top:-5px;">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
                <a class="btn btn-primary btn-sm btn-outline" href="#" role="button" data-toggle="modal" data-target="#editarUtilizador" style="margin-top:-5px;">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a class="btn btn-success btn-sm btn-outline" data-toggle="modal" data-target="#apagarUtilizador" href="#" role="button"  style="margin-top:-5px;">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
            </td>
        </tr>




        @endforeach
    </table>

</div>




</div>

    <div class="modal fade" id="verUtilizador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ver Utilizador</h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#Dados" aria-controls="home" role="tab" data-toggle="tab">Dados</a>
                        </li>
                        <li role="presentation">
                            <a href="#Servicos" aria-controls="servicos" role="tab" data-toggle="tab">Serviços</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Dados">
                            <h1>Dados</h1>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Servicos">
                            <table class="table table-striped" style="margin-top:5px;">
                                <tr>
                                    <th>Nome do Serviço</th>
                                </tr>
                                <tr>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-outline" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarUtilizador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Utilizador</h4>
                </div>
                <div class="modal-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#Dados" aria-controls="home" role="tab" data-toggle="tab">Dados</a>
                            </li>
                            <li role="presentation">
                                <a href="#Servicos" aria-controls="servicos" role="tab" data-toggle="tab">Serviços</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="Dados">
                                <h1>Dados</h1>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="Servicos">
                                <h1>Serviços</h1>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-outline" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="apagarUtilizador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Apagar Utilizador</h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#Dados" aria-controls="home" role="tab" data-toggle="tab">Dados</a>
                        </li>
                        <li role="presentation">
                            <a href="#Servicos" aria-controls="servicos" role="tab" data-toggle="tab">Serviços</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Dados">
                            <h1>Dados</h1>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Servicos">
                            <h1>Serviços</h1>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-outline" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <script>

    </script>
@stop