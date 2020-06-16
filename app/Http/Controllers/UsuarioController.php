<?php

namespace salesSys\Http\Controllers;

use Illuminate\Http\Request;

use salesSys\Http\Requests;
use salesSys\User;
use Illuminate\Support\Facades\Redirect;
use salesSys\Http\Requests\UsuarioFormRequest;
use Illuminate\Support\Facades\DB;

/**
 * Controlador de usuarios, gestion de usuarios.
 */
class UsuarioController extends Controller{

    public function __construct(){
        # validar que el usario se haya logeado
        $this -> middleware('auth');
    }

    public function index(Request $request){

        if($request){
            $query = trim($request -> get('searchText'));
            $usuarios = DB::table('users') 
                -> where ('name', 'LIKE', '%'.$query.'%')
                -> orderBy('id', 'desc')
                -> paginate(10);
            return view('security.usuario.index', [
                "usuarios" => $usuarios,
                "searchText" => $query
            ]);  

        }
    }

    public function create(){
        return view('security.usuario.create');
    }

    public function store(UsuarioFormRequest $request){
        # creando un nuevo usuario
        $usuario = new User;
        $usuario -> name = $request -> get('name');
        $usuario -> email = $request -> get('email');
        $usuario -> password = bcrypt($request -> get('name')); # se encripta la contraseña con bcrypt (hash)

        $usuario -> save(); # guarda el usuario en la BD.
        return redirect('security/usuario');
    }

    public function edit($id){

        $usuario = User::findOrFail($id); # busca el usuario a editar

        return view('security.usuario.edit', [
            "usuario" => $usuario
        ]);
    }

    public function update(UsuarioFormRequest $request, $id){
        $usuario = User::findOrFail($id);
        $usuario -> name = $request -> get('name');
        $usuario -> email = $request -> get('email');
        $usuario -> password = bcrypt($request -> get('password'));
        $usuario -> update();
        return redirect('security/usuario');
    }

    public function destroy($id){
        $usuario = DB::table('users')
            -> where('id' , '=', $id);
        $usuario -> delete();
        return redirect('security/usuario');    
    }
}
