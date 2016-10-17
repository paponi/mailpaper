<?php

namespace App\Http\Controllers;


use App\Servico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\UtilizadorServicos;
use Illuminate\Support\Facades\DB;
use Request as RequestUser;
use View;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $utilizadores = User::all();

        return view('utilizadores.index')->with('utilizadores',$utilizadores);
    }

    public function criar(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'unique:users|required|email',
            'password' => 'required|min:6|confirmed',
            'nrmecanografico' => 'required|unique:users'

        ]);

        $this->create($request->all());
        return redirect('allusers')->with('novo', 'Utilizador Adicionado!');
    }

    public function adicionar()
    {
        return view('/utilizadores/registautilizador');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'nrmecanografico' => 'required|max:10',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nrmecanografico' => $data['nrmecanografico'],
            'admin' => $data['administrador']
        ]);
    }

    protected function atribuirservicos(Request $request){
        $utilizadores = User::all();
        $servicos = Servico::all();
        //$servicoutilizador = UtilizadorServicos::all()->where('id_utilizador','=',$request->id);
        $idutilizador = $request->id;
        $idservico = $request->servico;
        $servicosutilizador = DB::table('utilizadorservicos')
            ->select('id_utilizador')
            ->where('id_utilizador','=',$request->id)
            ->get();


        return view('/utilizadores/atribuirservicos')->with('idservico',$idservico)->with('idutilizador',$idutilizador)->with('servicos',$servicos)->with('utilizadores',$utilizadores)->with('servicosutilizador',$servicosutilizador);
    }

    protected function atribuirservicosid(Request $request){
        $utilizadores = User::all();
        $servicos = Servico::all();
        //$servicoutilizador = UtilizadorServicos::all()->where('id_utilizador','=',$request->id);
        $idutilizador = $request->id;
        //$idservico = $request->servico;
        $servicosutilizador = DB::table('utilizadorservicos')
            ->select('*')
            ->selectRaw('utilizadorservicos.*,(SELECT nome from servicos where id = utilizadorservicos.id_servico)as nome_servico')
            ->where('id_utilizador','=',$idutilizador)
            ->get();


        return view('/utilizadores/atribuirservicos')->with('idutilizador',$idutilizador)->with('servicos',$servicos)->with('utilizadores',$utilizadores)->with('servicosutilizador',$servicosutilizador);
    }

    protected function atribuirservico(Request $request){
        $servicosutilizador = DB::table('utilizadorservicos')
            ->select('*')
            ->selectRaw('utilizadorservicos.*,(SELECT nome from servicos where id = utilizadorservicos.id_servico)as nome_servico')
            ->where('id_utilizador','=',$request->nrutilizador)
            ->get();
        $utilizadores = User::all()->where('admin','=',0);
        $servicos = Servico::all();
        $idutilizador = $request->nrutilizador;
        $idservico = $request->idservico;
        DB::table('utilizadorservicos')
        ->insert([
            'id_utilizador' => $idutilizador,
            'id_servico' => $idservico,

        ]);

        return view('/utilizadores/atribuirservicos')->with('idservico',$idservico)->with('idutilizador',$idutilizador)->with('servicos',$servicos)->with('utilizadores',$utilizadores)->with('servicosutilizador',$servicosutilizador);
    }
}
