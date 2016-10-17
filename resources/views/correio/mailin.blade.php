@extends('layouts.dashboard')
@section('page_heading','Registar Correio')
@section('section')
    <link rel="stylesheet" href="assets/stylesheets/bootstrap-select-1.css">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/registacorreio') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('assunto') ? ' has-error' : '' }}">
                        <label for="assunto" class="col-md-4 control-label">Assunto </label>

                        <div class="col-md-6">
                            <input id="assunto" type="text" class="form-control" name="assunto"
                                   value="{{ old('assunto') }}">

                            @if ($errors->has('assunto'))
                                {{-- <span class="help-block">
                                       <strong>{{ $errors->first('assunto') }}</strong>
                                 </span>--}}
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('observacoes') ? ' has-error' : '' }}">
                        <label for="observacoes" class="col-md-4 control-label">Observações </label>

                        <div class="col-md-6">
                            <textarea id="observacoes" type="text" rows="4" class="form-control" name="observacoes"
                            >{{ old('observacoes') }}</textarea>
                            @if ($errors->has('observacoes'))
                                {{--<span class="help-block">
                                         <strong>{{ $errors->first('observacoes') }}</strong>
                                 </span>--}}
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('tipomovimento') ? ' has-error' : '' }}">
                        <label for="tipomovimento" class="col-md-4 control-label">Tipo de Movimento </label>
                        <div class="col-md-3">
                            <select id="tipomovimento" onchange="verMovimento(this.value);" class="form-control"
                                    name="tipomovimento" value="{{ old('tipomovimento') }}">
                                <option value="">Escolha Tipo :</option>
                                @foreach($tipomovimento as $tipomovimentos)
                                    <option value="{{ $tipomovimentos->id }}">{{ $tipomovimentos->descricao }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tipomovimento'))
                                {{--<span class="help-block">
                                        <strong>{{ $errors->first('tipomovimento') }}</strong>
                                </span>--}}
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        {{-- <div id="origem" style="display:none;">--}}
                        <div id="origem" >

                            <div class="form-group{{ $errors->has('servico_origem') ? ' has-error' : '' }}">
                                <label for="servico_origem" class="col-md-4 control-label">Serviço Origem </label>
                                <div class="col-md-4">
                                    <select id="servico_origem" name="servico_origem" class="selectpicker"
                                            data-live-search="true" title="Escolha o Serviço de Origem:">
                                        <option></option>
                                        @foreach($servicos as $servico)
                                            <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('servico_origem'))
                                        {{--<span class="help-block">
                                            <strong>{{ $errors->first('servico_origem') }}</strong>
                                        </span>--}}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('colaborador_origem') ? ' has-error' : '' }}">
                                <label for="colaborador_origem" class="col-md-4 control-label">Colaborador Origem </label>
                                <div class="col-md-4">
                                    <select id="colaborador_origem" class="selectpicker" data-live-search="true"
                                            name="colaborador_origem" title="Escolha o Colaborador de Origem:"
                                            value="{{ old('colaborador_origem') }}">
                                        <option></option>
                                        @foreach($utilizadores as $utilizador)
                                            <option value="{{ $utilizador->id }}">{{ $utilizador->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('colaborador_origem'))
                                        {{--<span class="help-block">
                                            <strong>{{ $errors->first('colaborador_origem') }}</strong>
                                        </span>--}}
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div id="destino" style="display:none;">--}}
                        <div id="destino">

                            <div class="form-group{{ $errors->has('servico_destino') ? ' has-error' : '' }}">
                                <label for="servico_destino" class="col-md-4 control-label">Serviço Destino </label>
                                <div class="col-md-4">
                                    <select id="servico_destino" class="selectpicker" data-live-search="true"
                                            title="Escolha o Serviço de Destino:" name="servico_destino"
                                            value="{{ old('servico_destino') }}">
                                        <option></option>
                                        @foreach($servicos as $servico)
                                            <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('servico_destino'))
                                        {{--<span class="help-block">
                                            <strong>{{ $errors->first('servico_destino') }}</strong>
                                        </span>--}}
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('colaborador_destino') ? ' has-error' : '' }}">
                                <label for="colaborador_destino" class="col-md-4 control-label">Colaborador Destino </label>
                                <div class="col-md-4">
                                    <select id="colaborador_destino" class="selectpicker" data-live-search="true"
                                            title="Escolha o Colaborador de Destino:" name="colaborador_destino"
                                            value="{{ old('colaborador_destino') }}">
                                        <option></option>
                                        @foreach($utilizadores as $utilizador)
                                            <option value="{{ $utilizador->id }}">{{ $utilizador->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('colaborador_destino'))
                                        {{--<span class="help-block">
                                            <strong>{{ $errors->first('colaborador_destino') }}</strong>
                                        </span>--}}
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="fa fa-btn fa-envelope"></i> Registar Correio
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="js/bootstrap-select-1.js"></script>

    <script>
        function verMovimento(id_tipo_movimento) {

            /*if (id_tipo_movimento == '1') {
                //alert('entrada');
                document.getElementById('origem').style.display = 'block';
                document.getElementById('destino').style.display = 'none';
            }
            if (id_tipo_movimento == '2') {
                //alert('saida');
                document.getElementById('destino').style.display = 'block';
                document.getElementById('origem').style.display = 'none';
            }*/
        }

    </script>
@stop