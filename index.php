<?php
require_once './Slim/Slim.php';
require_once 'Conexion.class.php';
require_once 'Producto.class.php';
require_once 'Mascota.class.php';
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

// Mascotas: Servicio 1
$app->get('/mascotas', function(){  
	$dao = new ProductoDAO();
    $lista = $dao->listarMascota();    
    echo json_encode($lista);    
});

// Productos: Servicio 2
$app->get('/productos/:nombre', function($nombre){   
	$dao = new ProductoDAO();
    $lista = $dao->buscarPorNombre($nombre); 	
    echo json_encode($lista);    
});

// Mascotas: Servicio 2
$app->get('/mascotas/:nombre', function($nombre){   
	$dao = new ProductoDAO();
    $lista = $dao->buscarPorNombreMascota($nombre); 	
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

// Mascota: Servicio 3
$app->post('/imascotas', function () use ($app) {    
   $nombre = $app->request()->post('nombre');
   $tipo = $app->request()->post('tipo'); 
   $edad = $app->request()->post('edad'); 
   $peso = $app->request()->post('peso'); 
   $fecha_nacimiento = $app->request()->post('fecha_nacimiento'); 
   $objeto = new Mascota(); 
   $objeto->nombre = $nombre;
   $objeto->tipo = $tipo;
   $objeto->edad = $edad;
   $objeto->peso = $peso;
   $objeto->fecha_nacimiento = $fecha_nacimiento;
   
   $dao = new ProductoDAO();
   $dao->insertarMascota($objeto);   
   echo json_encode(array('mensaje' => "Mascota registrada satisfactoriamente"));    
});

// Mascota: Servicio 4
$app->post('/umascotas', function () use ($app) {    
   $nombre = $app->request()->post('nombre');
   $tipo = $app->request()->post('tipo');
   $edad = $app->request()->post('edad');
   $peso = $app->request()->post('peso');
   $fecha_nacimiento = $app->request()->post('fecha_nacimiento');
   $id = $app->request()->post('id');
   $objeto = new Mascota(); 
   $objeto->nombre = $nombre;
   $objeto->tipo = $tipo;
   $objeto->edad = $edad;
   $objeto->peso = $peso;
   $objeto->fecha_nacimiento = $fecha_nacimiento;
   $objeto->id = $id;
   
   $dao = new ProductoDAO();
   $dao->actualizarMascota($objeto);   
   echo json_encode(array('mensaje' => "Mascota actualizada satisfactoriamente"));    
});

// Mascota: Servicio 5
$app->post('/dmascotas', function () use ($app) {
   $id = $app->request()->post('id');
   
   $dao = new ProductoDAO();
   $dao->eliminarMascota($id);   
   echo json_encode(array('mensaje' => "Mascota eliminada satisfactoriamente"));    
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