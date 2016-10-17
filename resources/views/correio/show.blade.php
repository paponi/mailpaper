@extends('layouts.dashboard')
@section('page_heading','Novo Movimento do Correio Número ' . $idc)
@section('section')



    <div class="col-md-10">
        <div class="row">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#dados" aria-controls="dados" role="tab" data-toggle="tab">Dados</a></li>
                <li role="presentation">
                    <a href="#movimentos" aria-controls="movimentos" role="tab" data-toggle="tab">Movimentos</a>
                </li>
            </ul>

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="dados">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url('/mail/novomovimento',$idc) }}">
                        {{ csrf_field() }}
                        @foreach($detalhescorreio as $detalhecorreio)

                            <div class="row form-group" style="margin-top:20px;">
                                <label for="id" class="col-md-3 col-md-offset-1 control-label">Número </label>
                                <div class="col-md-2">
                                    <input id="id" type="text" class="form-control" readonly name="id"
                                           value="{{ $detalhecorreio->id }}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="assunto" class="col-md-3  col-md-offset-1 control-label">Assunto </label>
                                <div class="col-md-6">
                                    <input id="assunto" type="text" class="form-control" readonly name="assunto"
                                           value="{{ $detalhecorreio->assunto }}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="observacoes" class="col-md-3  col-md-offset-1 control-label">Observações do
                                    Correio</label>
                                <div class="col-md-6">
                                <textarea id="observacoes" type="text" style="resize: none;" class="form-control"
                                          readonly name="observacoes">{{ $detalhecorreio->observacoes }}</textarea>
                                </div>
                            </div>
                        @endforeach


                        @if ( $tipo == '2')

                            <div class="row  form-group">
                                <label for="tipomovimento" class="col-md-3 col-md-offset-1 control-label">Tipo de
                                    Movimento </label>

                                <div class="col-md-3">
                                    <input readonly id="tipomovimento" name="tipomovimento" class="form-control"
                                           value="Entrada">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('colaborador_origem') ? ' has-error' : '' }}">
                                <label for="colaborador_origem" class="col-md-3 col-md-offset-1 control-label">Colaborador
                                    Origem </label>
                                <div class="col-md-4">
                                    <select id="colaborador_origem" class="form-control" name="colaborador_origem" value="{{ old('colaborador_origem') }}">
                                        <option value="">Escolha o Colaborador:</option>
                                        @foreach($utilizadores as $utilizador)
                                            <option value="{{ $utilizador->id }}">{{ $utilizador->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('colaborador_origem'))
                                       {{-- <span class="help-block">
                                            <strong>{{ $errors->first('colaborador_origem') }}</strong>
                                        </span>--}}
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('servico_origem') ? ' has-error' : '' }}">
                                <label for="servico_origem" class="col-md-3 col-md-offset-1 control-label">Serviço
                                    Origem </label>
                                <div class="col-md-4">
                                    <select id="servico_origem" class="form-control" name="servico_origem" value="{{ old('servico_origem') }}">
                                        <option value="">Escolha o Serviço:</option>
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

                        @endif

                        @if ( $tipo == '1')

                            <div class="row form-group">
                                <label for="tipomovimento" class="col-md-3 col-md-offset-1 control-label">Tipo de
                                    Movimento </label>
                                <div class="col-md-3">
                                    <input readonly id="tipomovimento" name="tipomovimento" class="form-control"
                                           value="Saída">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('colaborador_destino') ? ' has-error' : '' }}">
                                <label for="colaborador_destino" class="col-md-3 col-md-offset-1 control-label">Colaborador
                                    Destino </label>
                                <div class="col-md-4">
                                    <select id="colaborador_destino" class="form-control"
                                            name="colaborador_destino" value="{{ old('colaborador_destino') }}">
                                        <option value="">Escolha o Colaborador:</option>
                                        @foreach($utilizadores as $utilizador)
                                            <option value="{{ $utilizador->id }}">{{ $utilizador->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('colaborador_destino'))
                                       {{-- <span class="help-block">
                                            <strong>{{ $errors->first('colaborador_destino') }}</strong>
                                        </span>--}}
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('servico_destino') ? ' has-error' : '' }}">
                                <label for="servico_destino" class="col-md-3 col-md-offset-1 control-label">Serviço
                                    Destino </label>
                                <div class="col-md-4">
                                    <select id="servico_destino" class="form-control" name="servico_destino" value="{{ old('servico_destino') }}">
                                        <option value="">Escolha o Serviço:</option>
                                        @foreach($servicos as $servico)
                                            <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('servico_destino'))
                                       {{-- <span class="help-block">
                                            <strong>{{ $errors->first('servico_destino') }}</strong>
                                        </span>--}}
                                    @endif
                                </div>
                            </div>

                        @endif

                        <div class="row form-group">
                            <label for="observacoes" class="col-md-3  col-md-offset-1 control-label">Observações do
                                Movimento</label>
                            <div class="col-md-6">
                                <textarea id="observacoes" type="text" style="resize: none;" class="form-control"
                                          name="observacoes"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-success pull-right">Gravar</button>
                        </div>
                    </form>
                </div>

                <div role="tabpanel" class="tab-pane" id="movimentos">

                    <div class="row col-md-10 col-md-offset-1 ">
                        <table class="table table-responsive table-condensed table-bordered table-hover"
                               style="margin-top:10px;">
                            <tr>
                                <td colspan="2" style="text-align: center;font-weight: bold;">ORIGEM</td>
                                <td colspan="2" style="text-align: center;font-weight: bold;">DESTINO</td>
                            </tr>
                            <tr style="text-align: center;">
                                <th style="text-align: center;">Colaborador</th>
                                <th style="text-align: center;">Serviço</th>
                                <th style="text-align: center;">Colaborador</th>
                                <th style="text-align: center;">Serviço</th>
                            </tr>
                            @foreach($movimentos as $movimento)
                                <tr>
                                    <td>{{ $movimento-> nomec_origem }}</td>
                                    <td>{{ $movimento-> nomes_origem }}</td>
                                    <td>{{ $movimento-> nomec_destino }}</td>
                                    <td>{{ $movimento-> nomes_destino }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
@stop