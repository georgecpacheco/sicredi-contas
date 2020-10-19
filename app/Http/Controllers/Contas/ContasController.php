<?php

namespace App\Http\Controllers\Contas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contas\CreateRequest;
use App\Http\Requests\Contas\ImportRequest;
use App\Http\Requests\Contas\UpdateRequest;
use App\Models\Associados\Associados;
use Illuminate\Http\Request;
use App\Imports\ContasImport;
use App\Models\Contas\Contas;
use App\Repositories\Contas\ContasRepository as Repository;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

class ContasController extends Controller
{
    private $file;
    private $repository;

    public function __construct(Repository $repository) {

        $this->repository = $repository;
        $this->file = storage_path("logs/importacao.log");

    }

    public function index()
    {
        $data['contas'] = $this->repository->getAll();
        return view('contas.index')->with($data);
    }

    public function importacao(ImportRequest $request)
    {

        $dados = Excel::toArray(new ContasImport(), $request->file('importacsv'), \Maatwebsite\Excel\Excel::CSV);
        $total = count($dados[0]);

        $this->log("Iniciando importação...");
        $this->log("Contas encontradas: " . $total);

        foreach ($dados[0] as $index => $dado) {
           // dd($dado);
            $this->log("Importando conta " . ($index + 1) . "/" . $total);
            $conta = Contas::firstOrNew(['conta_numero' => $dado[1]]);

            $conta->conta_cpf = $dado[0];
            $conta->conta_numero = $dado[1];
            $conta->conta_tipo = $dado[2];
            $conta->conta_agencia = $dado[3];
            $conta->save();
            //dd($conta);

            $this->log("Concluída a importação");
            Artisan::call('cache:clear');
            $this->log("FIM!");

        }

        $data['contas'] = $this->repository->getAll();
        return view('contas.index')->with($data);

    }

    private function log($value){
        $time = now()->format("d/m/Y H:i:s");
        $log = "[$time] - $value" . PHP_EOL;
        file_put_contents($this->file, $log, FILE_APPEND);
    }

    public function create($associado_id)
    {
        $associado = Associados::find($associado_id);
        return view('contas.create', compact('associado'));
    }

    public function store(CreateRequest $request)
    {
        $this->repository->createObj($request->only($request->fields));
        return redirect()->route('contas.contas.index')->with(['success' => 'Conta adicionada com sucesso!']);
    }


    public function edit($id) {
        $conta =  $this->repository->getById($id);
        return view('contas.edit',compact('conta'));
    }

    public function update(UpdateRequest $request, $id) {
        $this->repository->updateObj($id, $request->only($request->fields));

        return redirect()->back()->with(['success' => 'Conta editada com sucesso!']);
    }

    public function show($id)
    {

    }

    public function destroy($id) {
        $this->repository->deleteObj($id);
        return redirect()->back()->with(['success' => 'Conta excluída com sucesso!']);
    }

    public function getAssociadosAgencia()
    {
        $data['contas'] = $this->repository->getAgencia();
        return view('contas.agencia')->with($data);
    }

    public function buscaAssociadosAgencia(Request $request)
    {
        $agencia = $request->get('agencia');
        $data['contas'] = $this->repository->getAgencia($agencia);
        return view('contas.agencia')->with($data);
    }

    public function getAssociadosContas($associado)
    {
        $data['associado'] = Associados::find($associado);
        $data['contas'] = $this->repository->getcontas($associado);
        return view('contas.associado')->with($data);
    }
}
