@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 clearfix">
            <img src=" {{ asset("img/logo_ipo_cortado.png")  }}" style="position: absolute;top: -170px;left: -55px;" width="850" height="650">
        </div>
        <div class="col-md-4">
            {{--<img src=" {{ asset("img/logo_horizontal_ipo.png")  }}" width="230px" height="70px" >--}}
            <div class="panel panel-default" style="border: rgba(196, 196, 196,0.37) solid 1px;border-radius: 10px; -webkit-box-shadow: 0px 0 50px #ccc;">
               {{-- <div class="panel-heading" style="font-size: 20px;font-weight: bold;">Entrar

                </div>--}}
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Utilizador</label>

                            <div class="col-md-6 input-group">

                                 <span class="input-group-addon" id="basic-addon1">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </span>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    {{--<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>--}}
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6 input-group">
                                 <span class="input-group-addon" id="basic-addon1">
                                <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                </span>
                                <input id="password" type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    {{--<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>--}}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Autenticação</label>
                            <div class="col-md-6">
                                <select id="ligacao" class="form-control">
                                    <option>Normal</option>
                                    <option>Active Directory</option>
                                    <option>SSO</option>
                                </select>
                                
                            </div>
                        </div>

                        {{--<div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Guardar Dados
                                    </label>
                                </div>
                            </div>
                        </div>--}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                            <a class="btn btn-link" href="{{ url('/password/email') }}">Esqueceu a Password?</a>
                           </div>
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Entrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
