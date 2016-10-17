@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" >
                    <div class="panel-body">
                        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
                        <body>
                        <div class="content">
                            <div class="title" style="font-size: 40px;font-weight: 300;">
                                <a href="{{ url('/help') }}">Manual da Aplicação<br> de Gestão de Correio Interno</a>
                            </div>
                            <a href="{{ url('/help') }}"><img width="250" height="250" src="{{asset("/img/envelope_ipo.png")  }}"></a>
                        </div>
                        </body>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection