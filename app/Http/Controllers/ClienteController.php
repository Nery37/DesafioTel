<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Flash;
use Response;

class ClienteController extends AppBaseController
{
    /** @var  ClienteRepository */
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }

    /**
     * Display a listing of the Cliente.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $clientes = $this->clienteRepository->all();

        return view('clientes.index')
            ->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new Cliente.
     *
     * @return Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created Cliente in storage.
     *
     * @param CreateClienteRequest $request
     *
     * @return Response
     */
    public function store(CreateClienteRequest $request)
    {
        $input = $request->all();
        $input = $this->formatarDados($input);
        $input['local_nascimento'] = $input['local_nascimento'][0];
        $input['created_by'] = Auth::User()->id;
        if($input['local_nascimento'][0] == 2){
            if(isset($input['data_nascimento']) && $input['data_nascimento'] != null){
                $time = strtotime($input['data_nascimento']);
                list($ano, $mes, $dia) = explode('-', $input['data_nascimento']);
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $diadonascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                $idade = floor((((($hoje - $diadonascimento) / 60) / 60) / 24) / 365.25);
                if(intval($idade) >= 18){
                    $cliente = $this->clienteRepository->create($input);
                    Flash::success('Cadastro criado com sucesso.');
                    return redirect(route('clientes.index'));
                }else{
                    Flash::info('Para está localidade o indivíduo deve ser maior de idade.');
                    return back(); 
                 }
            }else{
                Flash::info('Para esta localidade é necessario o preenchimento do campo "Data de Nascimento".');
                return back(); 
            }
        }
        $cliente = $this->clienteRepository->create($input);
        Flash::success('Cadastro criado com sucesso.');
        return redirect(route('clientes.index'));

    }

    /**
     * Display the specified Cliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error('Cliente não encontrado');

            return redirect(route('clientes.index'));
        }

        return view('clientes.show')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified Cliente.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error('Cliente não encontrado');

            return redirect(route('clientes.index'));
        }

        return view('clientes.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified Cliente in storage.
     *
     * @param int $id
     * @param UpdateClienteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClienteRequest $request)
    {
        $cliente = $this->clienteRepository->find($id);
        $input = $request->all();
        $input['local_nascimento'] = $input['local_nascimento'][0];
        $input['updated_by'] = Auth::User()->id;

        if (empty($cliente)) {
            Flash::error('Cliente não encontrado');

            return redirect(route('clientes.index'));
        }

        if($input['local_nascimento'][0] == 2){
            if(isset($input['data_nascimento']) && $input['data_nascimento'] != null){
                $time = strtotime($input['data_nascimento']);
                list($ano, $mes, $dia) = explode('-', $input['data_nascimento']);
                $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $diadonascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                $idade = floor((((($hoje - $diadonascimento) / 60) / 60) / 24) / 365.25);
                if(intval($idade) >= 18){
                    $cliente = $this->clienteRepository->update($input, $id);
                    Flash::success('Cadastro atualizado com sucesso.');
                    return redirect(route('clientes.index'));
                }else{
                    Flash::info('Para está localidade o indivíduo deve ser maior de idade.');
                    return back(); 
                 }
            }else{
                Flash::info('Para esta localidade é necessario o preenchimento do campo "Data de Nascimento".');
                return back(); 
            }
        }
        $cliente = $this->clienteRepository->update($input, $id);
        Flash::success('Cadastro atualizado com sucesso.');
        return redirect(route('clientes.index'));
    }

    /**
     * Remove the specified Cliente from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cliente = $this->clienteRepository->find($id);

        if (empty($cliente)) {
            Flash::error('Cliente não encontrado');

            return redirect(route('clientes.index'));
        }

        $this->clienteRepository->delete($id);

        Flash::success('Cadastro deletado com sucesso.');

        return redirect(route('clientes.index'));
    }

    public function formatarDados($input){
        if(isset($input['cpf'])){
            $input['cpf'] = str_replace('.','',$input['cpf']);
            $input['cpf'] = str_replace('-','',$input['cpf']);
        }
        if(isset($input['rg'])){
            $input['rg'] = str_replace('.','',$input['rg']);
            $input['rg'] = str_replace('-','',$input['rg']);
        }
        if(isset($input['telefone'])){
            $input['telefone'] = str_replace('(','',$input['telefone']);
            $input['telefone'] = str_replace(')','',$input['telefone']);
            $input['telefone'] = str_replace(' ','',$input['telefone']);
            $input['telefone'] = str_replace('-','',$input['telefone']);
        }
        return $input;
    }
}
