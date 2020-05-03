<?php

namespace salesSys\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Input;
use salesSys\Http\Requests\ArticuloFormRequest;
use salesSys\Articulo;
use Illuminate\Support\Facades\DB;


class ArticuloController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        if (isset($request)){ # si hay un request/peticion post

            # para hacer busqueda filtrada
            $query = trim($request -> get('searchText')); // texto a buscar

            $articulos = DB::table('articulo as a')
                -> join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria') # funcion join sql
                -> select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'c.nombre as categoria',
                    'a.descripcion', 'a.imagen', 'a.estado')
                -> where('a.nombre','LIKE', '%' . $query . '%') # filtrando nombre articulo
                -> orwhere('a.codigo','LIKE', '%' . $query . '%') # filtrado por codigo
                -> orderBy('a.idarticulo', 'desc') # ordena por id descendentemente
                -> paginate(7); # paginar de 7 en 7

            return view('almacen.articulo.index', [
                "articulos" => $articulos, // se le manda las categorias
                "searchText" => $query // se le manda el texto de busqueda
            ]);
        }
    }

    public function create(){
        $categorias = DB::table('categoria')
            -> where('condicion', '=', '1') # categorias activas
            -> get();
        return view('almacen.articulo.create', ['categorias' => $categorias]);
    }


    public function store(ArticuloFormRequest $request){
        $articulo = new Articulo();
        $articulo -> idcategoria = $request -> get('idcategoria');
        $articulo -> codigo = $request ->get('codigo');
        $articulo -> nombre = $request -> get('nombre');
        $articulo -> stock = $request -> get('stock');
        $articulo -> descripcion = $request -> get('descripcion');
        $articulo -> estado = 'Activo'; # cuando se crea el articulo, por defecto esta activo

        if($request -> hasFile('imagen')){
            $file = $request -> file('imagen');
            $filename = time().'.'.$request -> imagen ->extension();
            $file -> move(public_path().'/imagenes/articulos/', $filename);
            $articulo -> imagen = $filename;
        }
        /*
        # Clase INPUT fue ELIMINADA de a partir de LARAVEL 5
        # validar la subida de img
        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file -> move(public_path() . '/imagenes/articulos/', $file -> getClientOriginalName());
            $articulo -> imagen = $file -> getClientOriginalName();
        }
        */
        $articulo -> save();
        return Redirect::to('almacen/articulo');
    }

    public function show($idarticulo){
        return view('almacen.articulo.show', [
            "articulo" => Articulo::findOrFail($idarticulo)
        ]);
    }

    public function edit($idCategoria){
        $articulo = Articulo::findOrFail($idCategoria);
        $categorias = DB::table('categoria')
            -> where('condicion', '=', '1') -> get();
        return view('almacen.articulo.edit', [
            "articulo" => $articulo,
            "categorias" => $categorias
        ]);
    }

    public function update(ArticuloFormRequest $request, $idarticulo){
        $articulo = Articulo::findOrFail($idarticulo);

        $articulo -> idcategoria = $request -> get('idcategoria');
        $articulo -> codigo = $request ->get('codigo');
        $articulo -> nombre = $request -> get('nombre');
        $articulo -> stock = $request -> get('stock');
        $articulo -> descripcion = $request -> get('descripcion');

        # validar la subida de img
        if($request -> hasFile('imagen')){
            $file = $request -> file('imagen');
            $filename = time().'.'.$request -> imagen ->extension();
            $file -> move(public_path().'/imagenes/articulos/', $filename);
            $articulo -> imagen = $filename;
        }

        $articulo -> update();
        return Redirect::to('almacen/articulo');
    }

    public function destroy($idarticulo){
        $articulo = Articulo::findOrFail($idarticulo);
        $articulo -> estado = 'Inactivo'; // cambia a no disponible, NO elimina
        $articulo -> update(); // actualiza
        return Redirect::to('almacen/articulo');
    }
}
