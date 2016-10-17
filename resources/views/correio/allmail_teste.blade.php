@extends('layouts.dashboard')
@section('page_heading','Correio')
@section('section')
    <style>
        .obs {
            height: 50px;
            overflow: auto;
        }
    </style>
    <style>
        .autocomplete {
            max-height: 200px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
    </style>
    @if (session('novo'))
        @include('widgets.alert', array('class'=>'success', 'dismissable'=>true, 'message'=>  session('novo') , 'icon'=> 'check'))
    @endif
    @if (session('erros'))
        @include('widgets.alert', array('class'=>'danger', 'dismissable'=>true, 'message'=>  session('erros') , 'icon'=> 'check'))
    @endif

    <div class="row">
        <div class="col-md-4 pull-right">
            {!!  Form::open(array('url' => "/correio/procura", 'class' => 'navbar-form navbar-left', 'method' => 'POST')) !!}
            {!!  Form::text('auto',$value = null, array('placeholder' => 'Pesquisar', 'id' => 'auto', 'class' => 'form-control')) !!}
            {!!  Form::button('<i class="fa fa-search"></i>', array('class' => 'btn btn-default','type' => 'submit')) !!}
            {!!  Form::close() !!}
        </div>
    </div>

    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            @if (count($movimentos) === 0)
                <h3>De momento não existe Correio Registado! </h3>
            @else
                <table class="table table-bordered table-condensed table-inverse table-responsive" style="margin-top:10px;">
                    <thead class="thead-default">
                    <tr>
                        <th><input type="checkbox" class="lidos"> </th>
                        <th>ID</th>
                        <th>Assunto</th>
                        <th>Observações</th>
                        <th>Movimento</th>
                        {{--<th>Último Movimento</th>--}}
                        <th></th>
                    </tr>
                    </thead>

                    @foreach($movimentos as $movimento)
                        @if ($movimento->lido == 1)
                        <tr style="font-weight: 900;background-color:white;">
                        @else
                        <tr style="font-weight: normal;background-color:#f2f2f2;">
                        @endif
                            {{--<td>{{ $movimento->id }}</td>--}}
                            <td><input type="checkbox" class="lido" > </td>
                            <td>{{ $movimento->correio_id }}</td>
                            <td>{{ $movimento->correio->assunto }}</td>
                            <td>{{ $movimento->correio->observacoes }}</td>
                            <td>{{ $movimento->tipomovimento->descricao }}</td>
                            {{--<td>{{ $movimento->ultimo_movimento }}</td>--}}
                            <td>

                                <a href="{{ url('/mail/show/' . $movimento->tipomovimento_id ,$movimento->correio_id ) }}"
                                   class="btn btn-sm btn-success btn-outline pull-right">
                                    <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                                </a>

                                <a href="{{ url('/mail/showfull/' . 'full/'.$movimento->correio_id .'/'. $movimento->id) }}"
                                   style="margin-right:5px;" class="btn btn-sm btn-info btn-outline pull-right">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                </table>


                <div class="pull-right">
                    {{ $movimentos->links() }}
                </div>

            @endif
        </div>

    </div>
    </div>

    <div class="modal fade" id="Modaleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Alterar Correio</h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#dados" aria-controls="home" role="tab"
                                                                  data-toggle="tab">Dados</a></li>
                        <li role="presentation"><a href="#movimento" aria-controls="profile" role="tab"
                                                   data-toggle="tab">Movimento</a></li>
                        <li role="presentation"><a href="#historico" aria-controls="messages" role="tab"
                                                   data-toggle="tab">Histórico</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="dados"><h2>Dados</h2></div>
                        <div role="tabpanel" class="tab-pane" id="movimento"><h2>Movimento</h2></div>
                        <div role="tabpanel" class="tab-pane" id="historico"><h2>Histórico</h2></div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modalapagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Apagar Correio</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Eliminar Correio</button>
                </div>
            </div>
        </div>
    </div>


    {{--<script src="js/jquery.js"></script>--}}
    {{--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>--}}

    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

    <script>
        $(document).ready(function () {
            $.noConflict();
            $('input:text').bind({
            });
            $( "#auto" ).autocomplete({
                minLength:1,
                autoFocus: true,
                source: '{{URL('getdata')}}'
            });



            $(function () {
                $('.lidos').on('click', function () {
                    $('.lido').each(function(){
                        if (this.checked == true){
                            this.checked = false;
                        }else{
                            this.checked = true;
                        };
                    });
                });
            });




        });



    </script>
    <script>
        function verMovimento(id_tipo_movimento) {
            if (id_tipo_movimento == '1') {
                //alert('entrada');
                document.getElementById('origem').style.display = 'block';
                document.getElementById('destino').style.display = 'none';
            }
            if (id_tipo_movimento == '2') {
                //alert('saida');
                document.getElementById('destino').style.display = 'block';
                document.getElementById('origem').style.display = 'none';
            }
        }
    </script>
@stop