<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;

use App\Http\Requests;
use App\TipoMovimento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Request as Request1;



class TipoMovimentoController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tipomovimentos = TipoMovimento::all();
        return view('tipomovimento.index')->with('tipomovimentos',$tipomovimentos);
    }

    public function criar(Request $request)
    {
       $this->validate($request, [
            'descricao' => 'required|max:100',
        ]);

        TipoMovimento::insert(['inserido_por'=>Auth::user()->id,'descricao'=> Request1::input('descricao'),'created_at' => Carbon::now()]);
        return redirect('alltipomovimento');
    }

    public function editar(TipoMovimento $tipomovimento){
        $tipomovimento->where('id',Request1::input('id'))->update(['descricao'=> Request1::input('descricao'),'alterado_por'=> Auth::user()->id,'updated_at'=>Carbon::now()]);
        return redirect('alltipomovimento');
    }

    public function apagar(TipoMovimento $tipomovimento){
        $id = Request1::input('id');
        $tipomovimento->where('id',$id)->delete();
        return redirect('alltipomovimento');
    }

}
