<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\UsuarioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

class UsuarioController extends AppBaseController
{
    /** @var  UsuarioRepository */
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepo)
    {
        $this->usuarioRepository = $usuarioRepo;
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
        $usuarios = $this->usuarioRepository->all();

        return view('usuarios.index')
            ->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new Cliente.
     *
     * @return Response
     */
    public function create()
    {
        return back();
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
        return back();
        $input = $request->all();

        $cliente = $this->clienteRepository->create($input);

        Flash::success('Cliente saved successfully.');

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
        return back();   
        $usuario = $this->usuarioRepository->find($id);

        if (empty($usuario)) {
            Flash::error('O usuário não foi encotrado.');

            return redirect(route('usuarios.index'));
        }

        return view('usuarios.show')->with('usuario', $usuario);
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
        $usuario = $this->usuarioRepository->find($id);

        if (empty($usuario)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('usuarios.index'));
        }

        return view('usuarios.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified Cliente in storage.
     *
     * @param int $id
     * @param UpdateClienteRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
       // dd($request->all());
        $input = $request->all();
        $usuario = $this->usuarioRepository->find($id);
        if($input['password'] == null){
            unset($input['password']);
        }else{
            $input['password'] = bcrypt($input['password']);
        }
        if (empty($usuario)) {
            Flash::error('Usuario não encontrado');

            return redirect(route('usuarios.index'));
        }

        if($usuario->email != $input['email']){
            $user = \App\User::where('email', $input['email'])->first();
            if($user != null){
                Flash::info('Email já cadastrado.');
                return redirect(route('usuarios.edit', $id));
            }
        }

        $usuario = $this->usuarioRepository->update($input, $id);

        Flash::success('Usuário editado com sucesso.');

        return redirect(route('usuarios.index'));
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
        $usuario = $this->usuarioRepository->find($id);
        $auth = Auth::user()->id;
        if (empty($usuario)) {
            Flash::error('Cliente not found');

            return redirect(route('usuarios.index'));
        }
        $this->usuarioRepository->delete($id);
        if($auth == $id){
            Auth::logout();
            return redirect('/login');
        }
        Flash::success('Usuário deletado com sucesso.');

        return redirect(route('usuarios.index'));
    }
}
