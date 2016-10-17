<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as RequestServico;

use App\Http\Requests;
use App\Servico;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Request as Request1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index(Request $request){

         if (\Str::length($request->pesquisa) > 0 ){
            $servicos = DB::table('servicos')->select()
                ->where('id', '=', $request->pesquisa)
                ->get();

         }else{
             $servicos = Servico::paginate(5);
         }

        return view('servicos.index')->with('servicos',$servicos);
    }

    public function criar(Request $request){

        $this->validate($request, [
                'nome' => 'required|max:100',
        ]);
        Servico::insert(['inserido_por'=>Auth::user()->id,'nome'=>Request1::input('nome'),'created_at' => Carbon::now()]);
		return redirect('allservicos')->with('novo', 'Serviço Adicionado!');;
    }

    public function editar(Servico $servico){
        $servico->where('id',Request1::input('id'))->update(['nome'=> Request1::input('nome'),'alterado_por'=> Auth::user()->id,'updated_at'=>Carbon::now()]);
        return redirect('allservicos');
    }

    public function apagar(Servico $servico){
        $id = Request1::input('id');
        $servico->where('id',$id)->delete();
        return redirect('allservicos');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
    }

    public function adicionar(){
    	return view('servicos/adicionarservico');
    }
}
