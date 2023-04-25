<?php

class ProductoDAO {
    
	public function listar(){	
		try { 	
			$db = Conexion::getConexion();
			$stmt = $db->prepare("select * from producto");
			$stmt->execute();
			$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			$arreglo = array();
			foreach($filas as $fila) {			
				$elemento = array();
				$elemento['id_producto'] = $fila['id_producto'];
				$elemento['nombre'] = $fila['nombre'];
				$elemento['descripcion'] = $fila['descripcion'];
				$elemento['precio'] = $fila['precio'];
				$elemento['stock'] = $fila['stock'];
				$elemento['importancia'] = $fila['importancia'];
				$elemento['imagen'] = $fila['imagen'];
				$elemento['id_categoria'] = $fila['id_categoria'];
				$arreglo[] = $elemento;
			}
			return $arreglo;		
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}				
    }
	
	public function listarMascota(){	
		try { 	
			$db = Conexion::getConexion();
			$stmt = $db->prepare("select * from mascota");
			$stmt->execute();
			$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);			
			$arreglo = array();
			foreach($filas as $fila) {			
				$elemento = array();
				$elemento['id'] = $fila['id'];
				$elemento['nombre'] = $fila['nombre'];
				$elemento['tipo'] = $fila['tipo'];
				$elemento['edad'] = $fila['edad'];
				$elemento['peso'] = $fila['peso'];
				$elemento['fecha_nacimiento'] = $fila['fecha_nacimiento'];
				$arreglo[] = $elemento;
			}
			return $arreglo;		
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}				
    }
	
	public function buscarPorNombre($nombre){
		try { 	
			$db = Conexion::getConexion();
			$stmt = $db->prepare("select * from producto where nombre like ?");
			$stmt->bindValue(1, "%$nombre%", PDO::PARAM_STR);
			$stmt->execute();
			$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			$arreglo = array();
			foreach($filas as $fila) {			
				$elemento = array();
				$elemento['id_producto'] = $fila['id_producto'];
				$elemento['nombre'] = $fila['nombre'];
				$elemento['descripcion'] = $fila['descripcion'];
				$elemento['precio'] = $fila['precio'];
				$elemento['stock'] = $fila['stock'];
				$elemento['importancia'] = $fila['importancia'];
				$elemento['imagen'] = $fila['imagen'];
				$elemento['id_categoria'] = $fila['id_categoria'];
				$arreglo[] = $elemento;
			}
			return $arreglo;		
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}	
   	}
	
	public function buscarPorNombreMascota($nombre){
		try { 	
			$db = Conexion::getConexion();
			$stmt = $db->prepare("select * from mascota where nombre like ?");
			$stmt->bindValue(1, "%$nombre%", PDO::PARAM_STR);
			$stmt->execute();
			$filas = $stmt->fetchAll(PDO::FETCH_ASSOC);		
			$arreglo = array();
			foreach($filas as $fila) {			
				$elemento = array();
				$elemento['id'] = $fila['id'];
				$elemento['nombre'] = $fila['nombre'];
				$elemento['tipo'] = $fila['tipo'];
				$elemento['edad'] = $fila['edad'];
				$elemento['peso'] = $fila['peso'];
				$elemento['fecha_nacimiento'] = $fila['fecha_nacimiento'];
				$arreglo[] = $elemento;
			}
			return $arreglo;		
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}	
   	}
	
	public function insertar($objeto){
		try { 
			$db = Conexion::getConexion();			
			$stmt = $db->prepare("insert into producto (nombre, precio, id_categoria) values (?,?,?)");
			$datos = array($objeto->nombre, $objeto->precio, $objeto->id_categoria);
			$db->beginTransaction();
			$stmt->execute($datos);
			$db->commit();
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}		
	}
	
	public function insertarMascota($objeto){
		try { 
			$db = Conexion::getConexion();			
			$stmt = $db->prepare("insert into mascota (nombre, tipo, edad, peso, fecha_nacimiento) values (?,?,?,?,?)");
			$datos = array($objeto->nombre, $objeto->tipo, $objeto->edad, $objeto->peso, $objeto->fecha_nacimiento);
			$db->beginTransaction();
			$stmt->execute($datos);
			$db->commit();
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}		
	}
	
	public function actualizar($objeto){
		try { 
			$db = Conexion::getConexion();		
			$stmt = $db->prepare("update producto set nombre=?, precio=? where id_producto=?");
			$datos = array($objeto->nombre, $objeto->precio, $objeto->id_producto);
			$db->beginTransaction();						
			$stmt->execute($datos);			
			$db->commit();
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}	
	}
	
	public function actualizarMascota($objeto){
		try { 
			$db = Conexion::getConexion();		
			$stmt = $db->prepare("update mascota set nombre=?, tipo=?, edad=?, peso=?, fecha_nacimiento=? where id=?");
			$datos = array($objeto->nombre, $objeto->tipo, $objeto->edad, $objeto->peso, $objeto->fecha_nacimiento, $objeto->id);
			$db->beginTransaction();						
			$stmt->execute($datos);			
			$db->commit();
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}	
	}

	public function eliminar($id){
		try { 
			$db = Conexion::getConexion();  
			$stmt = $db->prepare("delete from producto where id_producto=?");
			$datos = array($id);
			$db->beginTransaction();			
			$stmt->execute($datos);			
			$db->commit();
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}
	}
	
	public function eliminarMascota($id){
		try { 
			$db = Conexion::getConexion();  
			$stmt = $db->prepare("delete from mascota where id=?");
			$datos = array($id);
			$db->beginTransaction();			
			$stmt->execute($datos);			
			$db->commit();
		} catch (PDOException $e) {
			$db->rollback();
			$mensaje  = '<b>Consulta inválida:</b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}
	}
}

?>