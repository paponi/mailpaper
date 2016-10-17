@extends('layouts.dashboard')
@section('page_heading','Notificações')
@section('section')

    <div class="row">

            <div class=" teste-tab-container">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 teste">
                    <div class="list-group">
                        @foreach($users as $user)
                            <a class="list-group-item" href="#">{{$user->name}}</a>
                        @endforeach
                        {{--@for($i=0;$i<3;$i++)
                            <a class="list-group-item" href="#">{{$i}}</a>
                        @endfor--}}
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 tab-content teste-tab">
                    <!-- flight section -->
                    @foreach($users as $user)
                    <div class="tab-pane">
                        <center>
                            <h4>ALERTAS</h4>
                            <h5>
                                @if($user->notificacoes)

                                    <input type="checkbox" name="my-checkbox" checked>
                                @else

                                    <input type="checkbox" name="my-checkbox" >
                                @endif
                            </h5>



                        </center>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>



    </div>
    <link href="/assets/stylesheets/bootstrap-switch.css" rel="stylesheet">

    <script src="/js/jquery-1.12.4.js"></script>
    <script src="js/bootstrap-switch.js"></script>
    <script>
        $(document).ready(function() {

            $("div.teste>div.list-group>a").click(function(e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.teste-tab>div.tab-pane").removeClass("active");
                $("div.teste-tab>div.tab-pane").eq(index).addClass("active");
            });
        });
        $(function(argument) {
            $.noConflict();
            $('[type="checkbox"]').bootstrapSwitch();
        })
    </script>

@stop