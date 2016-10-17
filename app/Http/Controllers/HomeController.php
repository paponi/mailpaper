<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Correio;
use App\Servico;
use Illuminate\Support\Facades\View;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $nr_correios_nlidos = '5';
        View::share('nr_correios_nlidos',$nr_correios_nlidos);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nr_utilizadores = User::count();
        $nr_correios = Correio::count();
        $nr_servicos = Servico::count();

        return view('home')->with('nr_utilizadores',$nr_utilizadores)->with('nr_servicos',$nr_servicos)->with('nr_correios',$nr_correios);
    }


    public function allusers()
    {
        return view('allusers');
    }
}
