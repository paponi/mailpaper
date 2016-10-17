<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use Response;


class ProcuraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function autocomplete(){
        $term = Input::get('term');

        $results = array();

        // this will query the users table matching the first name or last name.
        // modify this accordingly as per your requirements

        $queries = DB::table('correios')
            ->where('id', '=', $term)
            ->orWhere('assunto', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->assunto ];
        }
        return Response::json($results);
    }
}
