<?php
class Conexion {

	static private $instance;
	
	/**
	* @return PDO Return a PDO instance representing a connection to a database
	*/
	public static function getConexion() {
		try {
			if(self::$instance == NULL){           
				$PDOinstance = new PDO("mysql:host=serverdbmg.mysql.database.azure.com;dbname=tienda;charset=utf8", "mgrandapa", "Dominick1609$");
				$PDOinstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance = $PDOinstance;
			}
			return self::$instance;
		} catch (PDOException $e) {				
			$mensaje  = '<b>Error al conectarse a la base de datos. Verifique el host, nombre de la base de datos, usuario y/o clave de la base de datos. Detalle del error: </b> ' . $e->getMessage() . "<br/>";
			die($mensaje);
		}		
	}	
}
?>