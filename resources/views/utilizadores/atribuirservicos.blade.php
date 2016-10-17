@extends('layouts.dashboard')
@section('page_heading','Atríbuir Serviços')
@section('section')




  <div class="row">
    <label id="nrutilizador22" style="display:none;">{{ $idutilizador }}</label>
    <div class="col-md-2 col-md-offset-3">
      <label class="control-label">Utilizador</label>
    </div>
    <div class="col-md-3">
      <select id="utilizador" class="form-control" onchange="idutilizador()">
        <option value="0">Escolha o Utilizador:</option>
        @foreach($utilizadores as $utilizador)
          <option value="{{ $utilizador->id }}">{{ $utilizador->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row col-md-6 col-md-offset-3" id="divtabelaservicos" style="margin-top:20px;display:none;">

    @if(count($servicosutilizador) === 0)
      <div class="row">
        <h3>Ainda não tem serviços atribuidos!</h3>
        <a href="#" data-toggle="modal" data-target="#adicionaservico" type="button" class="btn btn-default btn-sm pull-right"   >
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </a>
      </div>
    @else
      <table class="table table-striped table-condensed">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>
            <a href="#" data-toggle="modal" data-target="#adicionaservico" type="button" class="btn btn-default btn-sm pull-right"   >
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </a>
          </th>
        </tr>
        @foreach($servicosutilizador as $servicoutilizador)
          <tr>
            <td>{{ $servicoutilizador->id }}</td>
              <td colspan="2">{{ $servicoutilizador->nome_servico }}</td>
          </tr>
          @endforeach
          </tr>
      </table>
    @endif

  </div>



  <!-- Modal -->
  <div class="modal fade" id="adicionaservico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ url('/atribuirservico/') }}" method="post" >
          {{ csrf_field() }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Atribuir Serviço a Utilizador</h4>
          </div>
          <div class="modal-body">
              <input name="nrutilizador" id="nrutilizador" style="display:none;" value="{{ $idutilizador }}">
            <div class="row">
              <div class="col-md-2 col-md-offset-3">
                <label class="control-label">Serviço</label>
              </div>
              <div class="col-md-4">
                <select name="idservico" id="idservico" class="form-control">
                  @foreach($servicos as $servico)
                    <option name="idservico2" id="idservico2" value="{{ $servico->id }}">{{ $servico->nome }}</option>
                  @endforeach
                </select>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" >Atribuir</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="/js/jquery-1.12.4.js"></script>
  <script src="/js/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script>

    $(document).ready(function() {
      $.noConflict();
      var nr = $('#nrutilizador');
        //if (nr.text() > 0){
        if (nr.val() > 0){
        $('#divtabelaservicos').css("display", "block");
        $('#utilizador').val(nr.val());
      }
      else {
        $('#utilizador').val(0);
      }
    });

    function idutilizador()
    {
      var i = document.getElementById('utilizador');
      var p = i.options[i.selectedIndex].value;
      document.getElementById("nrutilizador").val = p;
      //alert(p);
      window.location.href = "/atribuirservicos/"+p;
    }

  </script>



  <script>
    $(document).ready(function () {
      $.noConflict();
      $('input:text').bind({
      });
      $( "#utilizador" ).autocomplete({
        minLength:1,
        autoFocus: true,
        source: '{{URL('getdata_utilizadores')}}'
      });


    });
  </script>
@stop
