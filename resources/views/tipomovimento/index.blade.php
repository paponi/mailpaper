@extends('layouts.dashboard')
@section('page_heading','Ver Tipos de Movimento')
@section('section')


    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <table class="table table-responsive table-striped ">
                <tr>
                    <th>ID</th>
                    <th>
                        Descrição
                    </th>
                    <th>Tipo</th>
                    <th>
                        <a href="#Modalinserir" type="button" data-toggle="modal" class="btn btn-default btn-sm pull-right"   >
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </a>
                    </th>
                </tr>

                @foreach($tipomovimentos as $tipomovimento)

                    <tr>
                        <td>{{ $tipomovimento->id }}</td>
                        <td>{{ $tipomovimento->descricao }}</td>
                        <td>{{ $tipomovimento->tipo }}</td>
                        <td>
                            <button  type="button" class="btn btn-primary btn-outline btn-sm pull-right" style="margin-left:5px;" data-toggle="modal"
                                     data-target="#Modalapagar" data-id="{{ $tipomovimento->id }}" data-descricao="{{$tipomovimento->descricao}}"  data-tipo="{{ $tipomovimento->tipo }}"  >
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-success btn-outline btn-sm pull-right" data-toggle="modal"
                                    data-target="#Modaleditar" data-id="{{$tipomovimento->id}}" data-descricao="{{$tipomovimento->descricao}}" data-tipo="{{ $tipomovimento->tipo }}" >
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </button>

                        </td>
                    </tr>
                @endforeach
            </table>


            <div class="modal fade" id="Modaleditar" tabindex="-1" role="dialog" aria-labelledby="ModaleditarLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/tipomovimento/editar/" method="post">
                            {{ csrf_field() }}

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="ModaleditarLabel">EDITAR TIPO DE MOVIMENTO</h4>
                            </div>
                            <div class="modal-body">
                                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="id" class="control-label">ID </label>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="id" class="form-control" type="text"  readonly="true" name="id" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="descricao" class="control-label">Descrição</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="descricao" class="form-control" type="text" name="descricao"  >
                                    </div>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Alterar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="Modalapagar" tabindex="-1" role="dialog" aria-labelledby="ModalapagarLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/tipomovimento/apagar/" method="post">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="ModalapagarLabel">APAGAR TIPO DE MOVIMENTO</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="id" class="control-label">ID </label>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="id"  class="form-control" type="text" readonly="true" name="id" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="descricao" class="control-label">Descrição</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="descricao" readonly="true" class="form-control" type="text" name="descricao" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="tipo" class="control-label">Tipo</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="tipo" disabled="true" class="form-control">
                                            <option value="entrada">Entrada</option>
                                            <option value="saida">Saída</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Apagar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="Modalinserir" tabindex="-1" role="dialog" aria-labelledby="ModalinserirLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" role="form" action="/tipomovimento/inserir/" method="POST"  >
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="ModalapagarLabel">INSERIR TIPO DE MOVIMENTO</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="descricao" class="control-label">Descrição</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="descricao" class="form-control" type="text" name="descricao" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="tipo" class="control-label">Tipo</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="tipo" class="form-control">
                                            <option value="entrada">Entrada</option>
                                            <option value="saida">Saída</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Inserir</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





        </div>
    </div>
    <script src="/js/jquery-1.12.4.js"></script>
    <script>
        $(document).ready(function() {
            $('#Modaleditar').on('show.bs.modal', function (e) {
                console.log( "ready!modaleditar" );
                var id = $(e.relatedTarget).data('id'); // Button that triggered the modal
                var descricao = $(e.relatedTarget).data('descricao');
                var tipo = $(e.relatedTarget).data('tipo');
                var modal = $(this)
                //modal.find('.modal-title').text('EDITAR' + ' - ' + id)
                modal.find('.modal-body input[name=id]').val(id)
                modal.find('.modal-body input[name=descricao]').val(descricao);
                modal.find('.modal-body select[name=tipo]').val(tipo);
            });


            $('#Modalapagar').on('show.bs.modal', function (e) {
                console.log( "ready!modalapagar" );
                var id = $(e.relatedTarget).data('id'); // Button that triggered the modal
                var descricao = $(e.relatedTarget).data('descricao');
                var tipo = $(e.relatedTarget).data('tipo');
                var modal = $(this)
                //modal.find('.modal-title').text('EDITAR' + ' - ' + id)
                modal.find('.modal-body input[name=id]').val(id)
                modal.find('.modal-body input[name=descricao]').val(descricao);
                modal.find('.modal-body select[name=tipo]').val(tipo);
            });
        });
    </script>
@stop