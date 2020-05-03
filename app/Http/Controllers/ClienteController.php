<?php

namespace salesSys\Http\Controllers;

use Illuminate\Http\Request;
use salesSys\Persona;
use Illuminate\Support\Facades\Redirect;
use salesSys\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if (isset($request)){ // si hay un request/peticion

            // para hacer busqueda filtrada de categorias:
            $query = trim($request -> get('searchText')); // texto a buscar
            $personas = DB::table('personas')
                -> where('nombre','LIKE', '%' . $query . '%') # busqueda por nombre
                -> where('tipo_persona', '=', 'Cliente') # a solo clientes
                -> orwhere('num_documento','LIKE', '%' . $query . '%') # o busqueda por num de doc
                -> where('tipo_persona', '=', 'Cliente') # pero solo cliente
                -> orderBy('idpersona', 'desc') // ordena por id descendentemente
                -> paginate(7); // paginar de 7 en 7

            return view('ventas.cliente.index', [
                "personas" => $personas, // se le manda las categorias
                "searchText" => $query // se le manda el texto de busqueda
            ]);
        }
    }

    public function create(){
        return view('ventas.cliente.create');
    }


    public function store(PersonaFormRequest $request){
        $persona = new Persona();
        $persona -> tipo_persona = 'Cliente';
        $persona -> nombre = $request -> get('nombre');
        $persona -> tipo_documento = $request -> get('tipo_documento');
        $persona -> num_documento = $request -> get('num_documento');
        $persona -> direccion = $request -> get('direccion');
        $persona -> telefono = $request -> get('telefono');
        $persona -> email = $request -> get('email');

        $persona -> save();
        return Redirect::to('ventas/cliente');
    }


    public function show($idcliente){
        return view('ventas.cliente.show', [
            "cliente" => Persona::findOrFail($idcliente)
        ]);
    }

    public function edit($idcliente){
        return view('ventas.cliente.edit', [
            "persona" => Persona::findOrFail($idcliente)
        ]);
    }


    public function update(PersonaFormRequest $request, $idpersona){
        $persona = Persona::findOrFail($idpersona);
        $persona -> nombre = $request -> get('nombre');
        $persona -> tipo_documento = $request -> get('tipo_documento');
        $persona -> num_documento = $request -> get('num_documento');
        $persona -> direccion = $request -> get('direccion');
        $persona -> telefono = $request -> get('telefono');
        $persona -> email = $request -> get('email');

        $persona -> update();
        return Redirect::to('ventas/cliente');
    }


    public function destroy($idpersona){
        $persona = Persona::findOrFail($idpersona);
        $persona -> tipo_persona = 'Inactivo'; // pasa a ser Inactivo
        $persona -> update(); // actualiza
        //$persona -> destroy($id); // en caso de querer eliminar
        return Redirect::to('ventas/cliente');
    }
}
