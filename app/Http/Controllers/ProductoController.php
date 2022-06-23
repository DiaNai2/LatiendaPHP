<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;

//dependencia para el validador 
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "aqui va la lista de productos";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //seleccionar marcas
        $marcas=Marca::all();
        //seleccionar categoria
        $Categoria = Categoria::all();
        //mostrar las vistas con las marcas y categorias
       return view ('productos.new')
       ->with('categorias', $Categoria)
       ->with('marcas', $marcas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validacion de datos de formulario
        //1. establecer las reglas de valiodacion a aplicar
        //para la 'input data' 
        $reglas=[
            "nombre" => 'required|alpha|unique:productos,nombre',
            "desc"  =>  'required|min:10|max:20',
            "precio"=> 'required|numeric',
            "imagen" => 'required|image',
            "categoria"=> 'required'
        ];
        $mensajes=[
            "required"=>"compo obligatorio",
            "alpha"=>"solo letras",
            "numeric"=>"solo numeros",
            "image"=> "debe ser un archivo imagen",
            "min"=> "minimo : value",
            
        ];
        //2. ctrear el objeto validador
        $v = Validator::make($request->all(), $reglas, $mensajes);

        //3. validar
        //fails() retorna
        //true: si la validacion falla
        //false: si los datos son validos
        if($v->fails()){
            //validacion incorrecta
            //mostrar la vista new
            //llevando los errores
            return redirect('productos/create')
            ->withErrors($v);
        }else{
            //validacion correcta 
             //crear el objeto uplodedfile 
        $archivo=$request->imagen;
        //campturar nombre ""original del archivo
        $nombre_archivo= $archivo->getClientOriginalName();
        var_dump($nombre_archivo);
        //mover el archivo a la carpeta "public/img"
        $ruta=public_path();
        $archivo->move("$ruta/img",  $nombre_archivo);
        //registrar producto en la base de datos 
        $producto=new Producto;
        $producto->nombre= $request->nombre;
        $producto->precio= $request->precio;
        $producto->desc= $request->desc;
        $producto->imagen= $nombre_archivo;
        $producto->marca_id= $request->marca;
        $producto->categoria_id= $request->categoria;
        $producto->save();
        echo "producto registrado";
        //redirreccion al formulario 
        //llevando un mensaje de exito 
        return redirect('productos/create')
            ->with("mensajito", "produto registrado");
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($producto)
    {
        echo "aqui va el detalle del producto con  id: $producto";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($producto)
    {
        echo "aqui va el form para editar el producto con id: $producto";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
