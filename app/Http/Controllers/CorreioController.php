<?php

namespace App\Http\Controllers;

use App\Servico;
use App\Correio;
use App\TipoMovimento;
use App\Movimento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail2;
use Request as RequestCorreio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use Carbon\Carbon;

class CorreioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function criarmovimento(Request $request)
    {
        $user = Auth::user();
        $tipomovimento = $request->get('tipomovimento');

        $this->validate($request, [
            'assunto' => 'required',
            'observacoes' => 'required',
            'tipomovimento' => 'required|not_in:Escolha Tipo : ',

        ]);
        if ($tipomovimento == '1') {
            $m = 'ENTRADA';
            $this->validate($request, [
                'assunto' => 'required|max:255',
                'observacoes' => 'required',
                'tipomovimento' => 'required|not_in:Escolha Tipo : ',
                'servico_origem' => 'required|not_in:Escolha o Serviço:',
                'colaborador_origem' => 'required|not_in:Escolha o Colaborador:',
                'servico_destino' => 'required|not_in:Escolha o Serviço:',
                'colaborador_destino' => 'required|not_in:Escolha o Colaborador:'
            ]);

            $colaborador_origem = $request->get('colaborador_origem');
            $servico_origem = $request->get('servico_origem');
            $colaborador_destino = $request->get('colaborador_destino');
            $servico_destino = $request->get('servico_destino');
            $id_tipo_movimento = 1;

            $texto1 = 'Caro ' . $user->name . ',<br><br> Deu entrada no Serviço de Informática o correio com os seguintes dados : <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Nr.º</b> ';

            $texto2 = '<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Assunto</b> :' . $request->get('assunto') . ' .<br><br> 
            O documento é proveniente :<br><br> <b>Serviço </b> :  ' . Servico::find($servico_origem)->nome . ' enviado pelo <b>Colaborador </b> : ' . User::find($colaborador_origem)->name . ' 
            <br><br>Vem endereçado para o <b>Colaborador</b> ' . User::find($colaborador_destino)->name . '
            <br><br>Esta entrada foi registada em ' . Carbon::now() . '<br><br><br><h2 class="pull-right"> <b>APP GESTÃO DE CORREIO INTERNO IPO</b> </h2>';
        }

        if ($tipomovimento == '2') {
            $m = 'SAÍDA';
            $this->validate($request, [
                'assunto' => 'required|max:255',
                'observacoes' => 'required',
                'tipomovimento' => 'required|not_in:Escolha Tipo : ',
                'servico_destino' => 'required|not_in:Escolha o Serviço:',
                'colaborador_destino' => 'required|not_in:Escolha o Colaborador:'
            ]);
            $colaborador_origem = $request->get('colaborador_origem');
            $servico_origem = $request->get('servico_origem');
            $colaborador_destino = $request->get('colaborador_destino');
            $servico_destino = $request->get('servico_destino');
            $id_tipo_movimento = 2;
            $texto1 = 'Caro ' . $user->name . ', <br><br>Foi registada uma saída no Serviço de Informática o correio com os seguintes dados 
            :<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Nr.º</b>';
            $texto2 = '<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Assunto</b> :' . $request->get('assunto') . '.<br><br>
            O documento tem como destino o Serviço ' . Servico::find($servico_destino)->nome .
            ' e como destinatário o colaborador  ' . User::find($colaborador_destino)->name . ' e foi enviado pelo colaborador '
            . User::find($colaborador_origem)->name . '
            <br><br>Esta saída foi registada em ' . Carbon::now() . '<br><br><br><h2><b>APP GESTÃO DE CORREIO INTERNO IPO</b></h2>';
        }

        $idnovo = Correio::create([
            'assunto' => $request->get('assunto'),
            'observacoes' => $request->get('observacoes'),
            'inserido_por' => $user->id
        ])->id;

        Movimento::create([
            'correio_id' => $idnovo,
            'tipomovimento_id' => $id_tipo_movimento,
            'colaborador_origem' => $colaborador_origem,
            'servico_origem' => $servico_origem,
            'colaborador_destino' => $colaborador_destino,
            'servico_destino' => $servico_destino,
            'inserido_por' => Auth::user()->id,
            'recebido_por' => Auth::user()->id,
            'recebido_em' => Carbon::now()
        ]);

        $title = 'NOTIFICAÇÃO DE EMAIL - NOVA ' . $m . ' DE CORREIO REGISTADO COM O ID -> ' .$idnovo;
        $emails = '';
        $usersemail = DB::table('users')
            ->select('email')
            ->where('notificacoes', '=', 1)
            ->get();

        if (count($usersemail > 0)) {
            foreach ($usersemail as $useremail) {
                $emails = $emails . $useremail->email;
            }
        }

        $content = $texto1 . $idnovo . $texto2;
        $emails_to = ['8030083@gmail.com', 'vascoaandressousa@gmail.com'];
        //$attach = $request->file('file');
        Mail::send(array('html' => 'emails.send'), ['title' => $title, 'content' => $content], function ($message) use ($user, $emails_to, $title) {
            $message->from('app@mail.pt', 'Gestão Correio Interno IPO');
            $message->to($emails_to);
            //$message->attach($attach);
            $message->subject($title);
        });

        //return response()->json(['message' => 'Email enviado!']);
        return redirect('allmail')->with('novo', $m .' de Correio Registada com o Número -> ' . $idnovo );
    }

    protected function criarnovomovimento(Request $request, $idmcorreio)
    {
        $tipomovimento = $request->get('tipomovimento');

        if ($tipomovimento == 'Entrada') {
            $this->validate($request, [
                'servico_origem' => 'required|not_in:Escolha o Serviço:',
                'colaborador_origem' => 'required|not_in:Escolha o Colaborador:',
            ]);
            $colaborador_origem = $request->get('colaborador_origem');
            $servico_origem = $request->get('servico_origem');
            $colaborador_destino = Auth::user()->id;
            $servico_destino = 1;//SERVICO INFORMATICA
            $id_tipo_movimento = 1;
        }

        if ($tipomovimento == 'Saída') {
            $this->validate($request, [
                'servico_destino' => 'required|not_in:Escolha o Serviço:',
                'colaborador_destino' => 'required|not_in:Escolha o Colaborador:'
            ]);
            $colaborador_origem = Auth::user()->id;
            $servico_origem = 1;//SERVICO INFORMATICA
            $colaborador_destino = $request->get('colaborador_destino');
            $servico_destino = $request->get('servico_destino');
            $id_tipo_movimento = 2;
        }


        $idnovo = Movimento::create([
            'correio_id' => $idmcorreio,
            'tipomovimento_id' => $id_tipo_movimento,
            'colaborador_origem' => $colaborador_origem,
            'servico_origem' => $servico_origem,
            'colaborador_destino' => $colaborador_destino,
            'servico_destino' => $servico_destino,
            'observacoes' => $request->get('observacoes')
        ]);

        $user = Auth::user();

        /* Mail::send('',['user' => $user],function ($m) use ($user) {
             $m->from('hello@app.com', 'Your Application');
             $m->to($user->email, $user->name)->subject('NOVO CORREIO');
         });*/


        return redirect('allmail')->with('novo', 'Novo Movimento de Correio Registado TIPO MOVIMENTO -> ' . $tipomovimento);

    }

    public function mailin()
    {
        $utilizadores = User::all();
        $servicos = Servico::all();
        $tipomovimento = TipoMovimento::all();
        return view('correio/mailin')->with('utilizadores', $utilizadores)->with('servicos', $servicos)->with('tipomovimento', $tipomovimento);
    }

    public function mailout()
    {
        $utilizadores = User::all();
        $servicos = Servico::all();
        $tipomovimento = TipoMovimento::all();
        return view('correio/mailout')->with('utilizadores', $utilizadores)->with('servicos', $servicos)->with('tipomovimento', $tipomovimento);
    }

    public function index()
    {
        $correiosin = DB::table('movimento')
            ->join('correios', 'correios.id', '=', 'movimento.correio_id')
            /*->join('tipomovimento', 'tipomovimento.id', '=', 'movimento.tipomovimento_id')
            ->join('users','users.id','=','movimento.colaborador_origem')*/
            ->select('correios.id', 'correios.assunto', 'correios.observacoes')//,'tipomovimento.descricao','movimento.*','users.name')
            ->where('movimento.tipomovimento_id', '=', '1')
            ->get();

        $correiosout = DB::table('movimento')
            ->join('correios', 'correios.id', '=', 'movimento.correio_id')
            /*->join('tipomovimento', 'tipomovimento.id', '=', 'movimento.tipomovimento_id')
            ->join('users','users.id','=','movimento.colaborador_destino')*/
            ->select('correios.id', 'correios.assunto', 'correios.observacoes')//,'tipomovimento.descricao','users.name')
            ->where('movimento.tipomovimento_id', '=', '2')
            ->get();

        $correiosall = DB::select(DB::raw('(SELECT * FROM (SELECT tipomovimento_id,correio_id,created_at as ultimo_movimento FROM movimento ORDER BY created_at desc) resultado inner join correios on resultado.correio_id = correios.id inner join tipomovimento on resultado.tipomovimento_id = tipomovimento.id GROUP BY resultado.correio_id  )'));

        //$nrcorreiosin = count($correiosin);
        $utilizadores = User::all();
        $servicos = Servico::all();
        $tipomovimento = TipoMovimento::all();
        $movimento = Movimento::all();

        return view('correio.allmail')->with('correiosall', $correiosall)->with('correiosin', $correiosin)->with('correiosout', $correiosout)->with('tipomovimento', $tipomovimento)->with('servicos', $servicos)->with('utilizadores', $utilizadores)->with('movimento', $movimento);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255'
        ]);
    }

    protected function vermailid(Request $request)
    {

        $detalhescorreio = DB::table('correios')
            ->select('*')
            ->where('id', '=', $request->id)
            ->get();

        $movimentos = DB::table('movimento')
            ->select('id')
            ->selectRaw('movimento.*,(SELECT name from users where id = movimento.colaborador_origem)as nomec_origem')
            ->selectRaw('movimento.*,(select nome from servicos where id = movimento.servico_origem) as nomes_origem')
            ->selectRaw('movimento.*,(SELECT name from users where id = movimento.colaborador_destino)as nomec_destino')
            ->selectRaw('movimento.*,(select nome from servicos where id = movimento.servico_destino) as nomes_destino')
            ->where('correio_id', '=', $request->id)
            ->get();

        $idc = $request->id;
        $tipom = $request->tipo;

        $utilizadores = User::all();
        $servicos = Servico::all();
        $tipomovimento = TipoMovimento::all();
        $movimento = Movimento::all();


        //alterar o correio para lido


        return view('correio.show')->with('tipo', $tipom)->with('idc', $idc)->with('detalhescorreio', $detalhescorreio)->with('movimentos', $movimentos)->with('tipomovimento', $tipomovimento)->with('servicos', $servicos)->with('utilizadores', $utilizadores)->with('movimento', $movimento);

    }

    protected function verfullmail(Request $request)
    {

        $detalhescorreio = DB::table('correios')
            ->select('*')
            ->where('id', '=', $request->id)
            ->get();

        $movimentos = DB::table('movimento')
            ->select('*')
            ->selectRaw('movimento.*,(SELECT name from users where id = movimento.colaborador_origem)as nomec_origem')
            ->selectRaw('movimento.*,(select nome from servicos where id = movimento.servico_origem) as nomes_origem')
            ->selectRaw('movimento.*,(SELECT name from users where id = movimento.colaborador_destino)as nomec_destino')
            ->selectRaw('movimento.*,(select nome from servicos where id = movimento.servico_destino) as nomes_destino')
            ->where('correio_id', '=', $request->id)
            ->get();

        $idc = $request->id;
        $tipom = $request->tipo;

        $utilizadores = User::all();
        $servicos = Servico::all();
        $tipomovimento = TipoMovimento::all();
        $movimento = Movimento::all();

        if ( Movimento::where('correio_id',$idc)->where('colaborador_destino',Auth::user()->id)->count() >0) {
            $mov = Movimento::findOrFail($request->idm);
            $mov->lido = 0;
            $mov->save();
            //echo 'Salvo';
        }else{
            //echo 'Não é dono do correio!!';
        }


        return view('correio.showfull')->with('tipo', $tipom)->with('idc', $idc)->with('detalhescorreio', $detalhescorreio)->with('movimentos', $movimentos)->with('tipomovimento', $tipomovimento)->with('servicos', $servicos)->with('utilizadores', $utilizadores)->with('movimento', $movimento);

    }

    protected function pesquisa(Request $request)
    {
        if ($request->auto > 0) {
            $detalhescorreio = DB::table('correios')
                ->select('*')
                ->where('id', '=', $request->auto)
                ->get();

            if (count($detalhescorreio) > 0) {
                return redirect('mail/showfull/full/' . $request->auto);
            } else {
                return redirect('allmail')->with('erros', 'Correio não encontrado!');
            }

        } else {
            return redirect('allmail')->with('erros', 'Correio não encontrado!');
        }
    }

    public function mymail(Request $request)
    {
        $correiosin = DB::table('movimento')
            ->join('correios', 'correios.id', '=', 'movimento.correio_id')
            /*->join('tipomovimento', 'tipomovimento.id', '=', 'movimento.id_tipo_movimento')
            ->join('users','users.id','=','movimento.colaborador_origem')*/
            ->select('correios.id', 'correios.assunto', 'correios.observacoes')//,'tipomovimento.descricao','movimento.*','users.name')
            ->where('movimento.tipomovimento_id', '=', '1')
            ->get();

        $correiosout = DB::table('movimento')
            ->join('correios', 'correios.id', '=', 'movimento.correio_id')
            /*->join('tipomovimento', 'tipomovimento.id', '=', 'movimento.id_tipo_movimento')
            ->join('users','users.id','=','movimento.colaborador_destino')*/
            ->select('correios.id', 'correios.assunto', 'correios.observacoes')//,'tipomovimento.descricao','users.name')
            ->where('movimento.tipomovimento_id', '=', '2')
            ->get();

        $correiosall = DB::select(DB::raw('(SELECT * FROM (SELECT tipomovimento_id,correio_id,lido,created_at as ultimo_movimento FROM movimento WHERE colaborador_destino = ' . $request->id . '  ORDER BY created_at desc) resultado inner join correios on resultado.correio_id = correios.id  inner join tipomovimento on resultado.tipomovimento_id = tipomovimento.id GROUP BY resultado.correio_id  )'));

        //$correiosall = DB::table('correios')
        //->select('*')
        //->get();
        //$nrcorreiosin = count($correiosin);

        $utilizadores = User::all();
        $servicos = Servico::all();
        $tipomovimento = TipoMovimento::all();
        $movimento = Movimento::all();
        $movimentos = Movimento::where('colaborador_destino', Auth::user()->id )->paginate(5);
        return view('correio.allmail_teste')->with('movimentos',$movimentos);
        //return view('correio.allmail')->with('correiosall', $correiosall)->with('correiosin', $correiosin)->with('correiosout', $correiosout)->with('tipomovimento', $tipomovimento)->with('servicos', $servicos)->with('utilizadores', $utilizadores)->with('movimento', $movimento);
    }

    public function index_teste()
    {
        $movimentos = Movimento::paginate(5);
        return view('correio.allmail_teste')->with('movimentos',$movimentos);

    }

}