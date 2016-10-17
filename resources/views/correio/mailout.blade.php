@extends('layouts.dashboard')
@section('page_heading','Registar Saída de Correio')
@section('section')

    <div class="col-sm-12">
        <div class="row">

            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/registacorreiosaida') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('assunto') ? ' has-error' : '' }}">
                        <label for="assunto" class="col-md-4 control-label">Assunto </label>

                        <div class="col-md-6">
                            <input id="assunto" type="text" class="form-control" name="assunto" value="{{ old('assunto') }}">

                            @if ($errors->has('assunto'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('assunto') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('observacoes') ? ' has-error' : '' }}">
                        <label for="observacoes" class="col-md-4 control-label">Observações </label>

                        <div class="col-md-6">
                            <textarea id="observacoes" type="text" rows="4" class="form-control" name="observacoes" value="{{ old('observacoes') }}"></textarea>
                        </div>
                    </div>







                    <div class="form-group{{ $errors->has('colaborador_destino') ? ' has-error' : '' }}">
                        <label for="colaborador_destino" class="col-md-4 control-label">Colaborador Destino </label>
                        <div class="col-md-4">
                            <select id="colaborador_destino" class="form-control" name="colaborador_destino" value="{{ old('colaborador_destino') }}">
                                @foreach($utilizadores as $utilizador)
                                    <option>{{ $utilizador->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('colaborador_destino'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('colaborador_destino') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('servico_destino') ? ' has-error' : '' }}">
                        <label for="servico_destino" class="col-md-4 control-label">Serviço Destino </label>
                        <div class="col-md-4">
                            <select id="servico_destino" class="form-control" name="servico_destino" value="{{ old('servico_destino') }}">
                                <@foreach($servicos as $servico)
                                    <option>{{ $servico->nome }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('servico_destino'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('servico_destino') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="fa fa-btn fa-envelope"></i> Registar Saída de Correio
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


@stop