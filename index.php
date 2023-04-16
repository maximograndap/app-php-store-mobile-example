<?php
require_once './Slim/Slim.php';
require_once 'Conexion.class.php';
require_once 'Producto.class.php';
require_once 'ProductoDAO.class.php';


// Autocarga de la librería
\Slim\Slim::registerAutoloader();

// Creando una instancia del Slim
$app = new \Slim\Slim();
$app->response->header('Content-Type', 'application/json');

// Productos: Servicio 1
$app->get('/productos', function(){  
	$dao = new ProductoDAO();
    $lista = $dao->listar();    
    echo json_encode($lista);    
});

// Productos: Servicio 2
$app->get('/productos/:nombre', function($nombre){   
	$dao = new ProductoDAO();
    $lista = $dao->buscarPorNombre($nombre); 	
    echo json_encode($lista);    
});

// Productos: Servicio 3
$app->post('/productos', function () use ($app) {    
   $nombre = $app->request()->post('nombre');
   $precio = $app->request()->post('precio'); 
   $objeto = new Producto();
   $objeto->id_categoria = 1;   
   $objeto->nombre = $nombre;
   $objeto->precio = $precio;
   
   $dao = new ProductoDAO();
   $dao->insertar($objeto);   
   echo json_encode(array('mensaje' => "Producto registrado satisfactoriamente"));    
});

// Avisos: Servicio 1
$app->get('/avisos', function(){ 
	$dao = new AvisoDAO();
    $lista = $dao->listar();    
    echo json_encode($lista);    
});

// Avisos: Servicio 2
$app->get('/avisos/:fecha', function($fecha){  
	$dao = new AvisoDAO();
    $lista = buscar($fecha);    
    echo json_encode($lista);    
});

// Avisos: Servicio 3
$app->post('/avisos', function() use ($app){     
   /*
   $request = $app->request();
   $body = $request->getBody();
   $data = json_decode($body);  
   $titulo = $data->titulo;
   $fecha_inicio = $data->fecha_inicio;
   $fecha_fin = $data->fecha_fin;
   */
   $titulo = $app->request()->post('titulo');
   $fecha_inicio = $app->request()->post('fecha_inicio');
   $fecha_fin = $app->request()->post('fecha_fin');
   
   $objeto = new Aviso();
   $objeto->titulo = $titulo;
   $objeto->fecha_inicio = $fecha_inicio;
   $objeto->fecha_fin = $fecha_fin;
   
   $dao = new AvisoDAO();
   $dao->insertar($objeto);
   echo json_encode(array('mensaje' => "Aviso registrado!"));    
});

$app->run();
?>