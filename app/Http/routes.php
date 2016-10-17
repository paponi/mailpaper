<?php

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//UTILIZADORES
Route::get('/allusers', 'UsersController@index');
Route::get('/adicionarutilizador', 'UsersController@adicionar');
Route::post('/registautilizador', 'UsersController@criar');
Route::get('/atribuirservicos', 'UsersController@atribuirservicos');
Route::get('/atribuirservicos/{id}', 'UsersController@atribuirservicosid');
Route::post('/atribuirservico', 'UsersController@atribuirservico');

//SERVICOS
Route::get('/allservicos', 'ServicoController@index');
Route::get('/adicionarservico', 'ServicoController@adicionar');
Route::post('/registaservico','ServicoController@criar');
Route::patch('/servicos/editar','ServicoController@editar');
Route::patch('/servicos/apagar','ServicoController@apagar');
Route::post('/servicos/procura', 'ServicoController@index');
Route::get('/servicos/index', 'ServicoController@index');

//CORREIO
Route::get('/allmail', 'CorreioController@index_teste');
Route::get('/allmail_teste', 'CorreioController@index_teste');
Route::get('/mymail/{id}', 'CorreioController@mymail');
Route::post('/registacorreio','CorreioController@criarmovimento');
Route::get('/mailin', 'CorreioController@mailin');
Route::get('/mailout', 'CorreioController@mailout');
Route::get('/mail/show/{tipo}/{id}', 'CorreioController@vermailid');
Route::get('/mail/showfull/{tipo}/{id}/{idm}', 'CorreioController@verfullmail');
Route::post('/mail/novomovimento/{idmcorreio}', 'CorreioController@criarnovomovimento');
Route::post('/correio/procura', 'CorreioController@pesquisa');

Route::get('search/autocomplete', 'ProcuraController@autocomplete');
Route::any('getdata' ,function(){
    $return_array[] = array();
    $term = Input::get('term');
    $data = DB::table("correios")
        ->select('id','assunto')
        ->where('id','=',$term)
        ->take(10)
        ->get();
    foreach ($data as $v){
        $return_array[] = array('value' => $v->id. ' - '.$v->assunto);
    }
    return Response::json($return_array);
});

Route::any('getdata_servicos' ,function(){
    $return_array[] = array();
    $term = Input::get('term');
    $data = DB::table("servicos")
        ->select('id','nome')
        ->where('id','=',$term)
        ->orWhere('nome','LIKE','%'. $term .'%')
        ->take(10)
        ->get();
    foreach ($data as $v){
        $return_array[] = array('value' => $v->id. ' - '.$v->nome);
    }
    return Response::json($return_array);
});

Route::any('getdata_servicos_utilizador' ,function(){
    $return_array[] = array();
    $term = Input::get('term');
    $data = DB::table("utilizadorservicos")
        ->select('id','id_utilizador','id_servico')
        ->where('id_utilizador','=',$term)
        ->take(10)
        ->get();
    foreach ($data as $v){
        $return_array[] = array('value' => $v->id_servico);
    }
    return Response::json($return_array);
});

//TIPO DE MOVIMENTO
Route::get('/alltipomovimento', 'TipoMovimentoController@index');
Route::post('/tipomovimento/inserir', 'TipoMovimentoController@criar');
Route::post('/tipomovimento/editar','TipoMovimentoController@editar');
Route::post('/tipomovimento/apagar','TipoMovimentoController@apagar');

//NOFITICAÇÕES
Route::get('/notificacoes', function(){
    $users = User::all();
    return view('notificacoes')->with('users',$users);
});

//DEFINIÇÔES
Route::get('/definicoes', function(){
    return view('definicoes');
});

//ADMINISTRADORES
Route::get('/administradores', function(){
    $users = User::all();
    return view('administradores')->with('users',$users);
});

Route::get('/help',function(){
    return view('help/index');
}
);