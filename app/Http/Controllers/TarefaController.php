<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Mail\NovaTarefaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TarefasExport;
use PDF;
use App\Http\Middleware\LogAtividadesMiddleware;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware(LogAtividadesMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Auth::user()->tarefas()->paginate(10);
        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->regrasAndFeedback($regras, $feedback);
        $request->validate($regras, $feedback);

        $tarefa = Tarefa::create([
            'user_id' => Auth::user()->id,
            'tarefa' => $request->tarefa,
            'data_limite_conclusao' => $request->data_limite_conclusao,
        ]);

        $destinatario = Auth::user()->email;

        Mail::to($destinatario)->send(new NovaTarefaEmail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa])
            ->with(['store' => 'Tarefa cadastrada com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        if ($tarefa->user_id != Auth::user()->id) {
            return view('acesso-negado');
        }

        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        if ($tarefa->user_id != Auth::user()->id) {
            return view('acesso-negado');
        }

        return view('tarefa.create', ['tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        if ($tarefa->user_id != Auth::user()->id) {
            return view('acesso-negado');
        }

        $this->regrasAndFeedback($regras, $feedback);
        $request->validate($regras, $feedback);

        $tarefa->update([
            'tarefa' => $request->tarefa,
            'data_limite_conclusao' => $request->data_limite_conclusao,
        ]);

        return redirect()->route('tarefa.edit', ['tarefa' => $tarefa])
            ->with(['update' => 'Tarefa atualizada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tarefa $tarefa)
    {
        if ($tarefa->user_id != Auth::user()->id) {
            return view('acesso-negado');
        }

        $tarefa->forceDelete();
        return redirect()->route('tarefa.index')
            ->with(['destroy' => 'Tarefa excluída com sucesso!']);
    }

    public function regrasAndFeedback(&$regras, &$feedback)
    {
        $regras = [
            'tarefa' => 'required|min:3|max:200',
            'data_limite_conclusao' => 'required|date',
        ];

        $feedback = [
            'tarefa.required' => 'A tarefa é obrigatória',
            'tarefa.min' => 'A tarefa deve ter no mínimo 3 caracteres',
            'tarefa.max' => 'A tarefa deve ter no máximo 200 caracteres',
            'data_limite_conclusao.required' => 'A data limite de conclusão é obrigatória',
            'data_limite_conclusao.date' => 'A data limite de conclusão deve ser uma data válida',
        ];
    }

    public function exportacao($extensao)
    {
        return Excel::download(new TarefasExport, "tarefas.$extensao");
    }

    public function exportacao2()
    {
        $pdf = PDF::loadView('tarefa.pdf', ['tarefas' => Auth::user()->tarefas()->get()]);
//        return $pdf->download('lista_de_tarefas.pdf');
        return $pdf->stream('lista_de_tarefas.pdf');
    }
}
