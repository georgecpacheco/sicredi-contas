<?php

namespace App\Http\Controllers\Associados;

use App\Http\Controllers\Controller;
use App\Http\Requests\Associados\CreateRequest;
use App\Http\Requests\Associados\UpdateRequest;
use App\Repositories\Associados\AssociadosRepository as Repository;

class AssociadosController extends Controller
{
    private $repository;

    public function __construct(Repository $repository) {

        $this->repository = $repository;

    }

    public function index()
    {
        $data['associados'] = $this->repository->getAll();
        return view('associados.index')->with($data);
    }

    public function create()
    {
        return view('associados.create');
    }

    public function store(CreateRequest $request)
    {
        $this->repository->createObj($request->only($request->fields));
        return redirect()->route('associados.associados.index')->with(['success' => 'Conta adicionada com sucesso!']);
    }


    public function edit($id) {
        $associado =  $this->repository->getById($id);
        return view('associados.edit',compact('associado'));
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
      $dados =  $data['associados'] = $this->repository->getAll();
    //  dd($data['associados']);
        foreach ($dados as $dado){
            dd($dado);
            dd($dado->contas);
        }
        return view('associados.agencia')->with($data);
    }
}
