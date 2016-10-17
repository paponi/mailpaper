@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('section')

    <div class="col-sm-12">
        <div class="row">

            <div class="col-lg-3 col-md-6 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading" style="cursor: pointer;" onclick="window.location='allmail_teste';">
                        <div class="row" >
                            <div class="col-xs-3">
                                <i class="fa fa-envelope fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $nr_correios }}</div>
                                <div>CORREIO</div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <span class="pull-left"><a href="{{ url ('allmail_teste') }}">Ver Mais</a></span>
                        <span class="pull-right"><a href="{{ url ('allmail_teste') }}"><i class="fa fa-arrow-circle-right"></i></a></span>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="cursor: pointer;" onclick="window.location='allusers';">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"> {{ $nr_utilizadores }}</div>
                                <div>UTILIZADORES</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="{{ url ('allusers') }}">Ver Mais</a></span>
                            <span class="pull-right"><a href="{{ url ('allusers') }}"><i class="fa fa-arrow-circle-right"></i></a></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading" style="cursor: pointer;" onclick="window.location='allservicos';">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-server fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $nr_servicos }}</div>
                                <div>SERVIÇOS</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"><a href="{{ url ('allservicos') }}">Ver Mais</a></span>
                            <span class="pull-right"><a href="{{ url ('allservicos') }}"><i class="fa fa-arrow-circle-right"></i></a></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

        </div>

        <div class="row">


            <div class="col-lg-3 col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-cogs fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">&nbsp</div>
                                <div>DEFINIÇÕES</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Mais</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-area-chart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">&nbsp</div>
                                <div>ESTATÍSTICAS</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Mais</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
@stop

