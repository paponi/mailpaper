<?php


namespace App\Http\Controllers\Correio;

use App\Correio;
use Validator;
use App\Http\Controllers\Controller;

class CorreioController extends Controller
{


    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'assunto' => 'required|max:155',
            'observacoes' => 'required|max:255',

        ]);
    }

    /**
     * Create a new correio instance after a valid registration.
     *
     * @param  array  $data
     * @return Correio
     */
    protected function create(array $data)
    {
        return Correio::create([
            'assunto' => $data['assunto'],
            'observacoes' => $data['observacoes'],


        ]);
    }
}


?>