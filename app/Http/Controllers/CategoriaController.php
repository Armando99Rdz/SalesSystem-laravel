<?php

namespace salesSys\Http\Controllers;

use Illuminate\Http\Request;
use salesSys\Categoria; // el modelo de este controller
use Illuminate\Support\Facades\Redirect; // para hacer redirecciones
use salesSys\http\Requests\CategoriaFormRequest; // el request para validar el formulario
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException; // para las excepciones

class CategoriaController extends Controller {

    public function __construct(){

    }

    public function index(Request $request){
        if (isset($request)){ // si hay un request/peticion

            // para hacer busqueda filtrada de categorias:
            $query = trim($request -> get('searchText')); // texto a buscar
            // de la tabla categoria en el campo nombre busca por la cadena $query.
            $categorias = DB::table('categoria') -> where('nombre','LIKE', '%' . $query . '%')
            -> where('condicion', '=', '1') // solo las categorias activas
            -> orderBy('idcategoria', 'desc') // ordena por id descendentemente
            -> paginate(7); // paginar de 7 en 7 las categorias

            return view('almacen.categoria.index', [
                "categorias" => $categorias, // se le manda las categorias
                "searchText" => $query // se le manda el texto de busqueda
            ]);
        }
    }

    public function create(){
        return view('almacen.categoria.create');
    }

    /**
     * Para crear una categoria
     * @param CategoriaFormRequest $request
     */
    public function store(CategoriaFormRequest $request){
        $categoria = new Categoria();
        $categoria -> nombre = $request -> get('nombre');
        $categoria -> descripcion = $request ->get('descripcion');
        $categoria -> condicion = 1; // por defecto, al crear categoria pasa a ser activa
        $categoria -> save();

        return Redirect::to('almacen/categoria');
    }

    /**
     * Mostrar categoria
     * @param $idCategoria
     */
    public function show($idCategoria){
        try {
            $categoria = Categoria::findOrFail($idCategoria); // busca la categoria, de lo contrario devuelve un error
        }catch (ModelNotFoundException $exception){
            echo 'No se pudo ejecutar findOrFail() con esta categoria' . $exception;
            die();
        }

        return view('almacen.categoria.show', [
           "categoria" => $categoria
        ]);
    }

    public function edit($idCategoria){
        try {
            $categoria = Categoria::findOrFail($idCategoria); // busca la categoria, de lo contrario devuelve un error
        }catch (ModelNotFoundException $exception){
            echo 'No se pudo ejecutar findOrFail() con esta categoria' . $exception;
            die();
        }

        return view('almacen.categoria.edit', [
            "categoria" => $categoria
        ]);
    }

    /**
     * Actualizar categoria
     * @param CategoriaFormRequest $request
     * @param $idCategoria: para acutalizar
     */
    public function update(CategoriaFormRequest $request, $idCategoria){
        try {
            $categoria = Categoria::findOrFail($idCategoria);
        }catch (ModelNotFoundException $ex){
            echo 'No se pudo ejecutar findOrFail() ' . $ex;
            die();
        }

        $categoria -> nombre = $request -> get('nombre');
        $categoria -> descripcion = $request -> get('descripcion');
        $categoria -> update();
        return Redirect::to('almacen/categoria');
    }

    public function destroy($idCategoria){
        try {
            $categoria = Categoria::findOrFail($idCategoria);
        }catch (ModelNotFoundException $ex){
            echo 'No se pudo ejecutar findOrFail() ' . $ex;
            die();
        }

        $categoria -> condicion = '0';
        $categoria -> update();
        return Redirect::to('almacen/categoria');
    }
}
