@extends('layouts.dashboard')
@section('page_heading','Adicionar Serviço')
@section('section')

    <div class="col-sm-12">
        <div class="row">

           <div class="col-md-12">
               <form class="form-horizontal" role="form" method="POST" action="{{ url('/registaservico') }}">
                   {{ csrf_field() }}

                   <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                       <label for="nome" class="col-md-4 control-label">Nome </label>

                       <div class="col-md-6">
                           <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}">

                           @if ($errors->has('nome'))
                               <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                           @endif
                       </div>
                   </div>


                   <div class="form-group">
                       <div class="col-md-6 col-md-offset-4">
                           <button type="submit" class="btn btn-primary pull-right">
                               <i class="fa fa-btn fa-envelope"></i> Adicionar Serviço
                           </button>
                       </div>
                   </div>



                   </form>
           </div>


        </div>

        <div class="row">




        </div>

    </div>
@stop