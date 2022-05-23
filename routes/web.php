<?php

use Illuminate\Support\Facades\Route;
//dependencia al controlador
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//primera ruta en laravel 
Route::get('Hola', function(){
    echo "Holabb<3";
} );

Route::get('arreglos', function(){
    $estudiantes =["AN" =>"Ana", 
    "JU" =>"Juana",
    "DI" =>"Diana"]; echo"<pre>";
    var_dump($estudiantes);
    echo"</pre>";
    echo"<hr />";
    //agregar posicion
    $estudiantes["CR"]="Cristian";
    echo"<pre>";
    var_dump($estudiantes);
    echo"</pre>";

    //retirar elementos de un arreglo
    echo"<hr/>";
    unset($estudiantes["JU"]);
    echo"<pre>";
    var_dump($estudiantes);
    echo"</pre>";
});

Route::get("paises", function(){
    $paises =["Colombia" => [
        "capital" => "Bogota", 
        "moneda" => "Peso", 
        "poblacion" => 51.6, 
        "ciudades" =>[
            "Bogotá", 
            "Medellín", 
            "Cali"
        ]
    ],
    "Peru" => [
        "capital" => "Lima", 
        "moneda" => "Sol", 
        "poblacion" => 32.97,
        "ciudades" =>[
            "Cuzco", 
            "Piura"
        ]
    ],
    "Paraguay" => [
        "capital" => "Asuncion", 
        "moneda" => "Guaraní paraguayo", 
        "poblacion" => 7.133, 
        "ciudades" =>[
            "Villarica", 
            "Luque"
        ]

    ]];
    //mostrar la vista de paises 
    return view ('paises')
    -> with("paises", $paises);
/*foreach($paises as $pais => $infopais){
    echo "<h1>$pais</h1>";
    foreach($infopais as $clave => $valor ){
        echo"$clave : $valor <br/>";
    }*/

    /*echo "capital:".$infopais["capital"];
    echo "<br>";
    echo "moneda:".$infopais["moneda"];
    echo "<br>";
    echo "poblacion:".$infopais["poblacion"];
    echo "<hr/>";*/

});

Route::get('prueba', function(){
    return view('productos.new');

});

//Rutas REST 
Route::resource('productos', ProductoController::class);
