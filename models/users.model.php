<?php
// crar modelos de usuarios 
require_once "connection.php";
class ModelUsers
{
	/*	MOSTRAR USUARIOS*/
	static public function mdlShowUsers($tabla, $item, $valor)
	{
		if ($item != null) {
			$stmt = connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		}else{

			$stmt = connection::connect()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		$stmt -> close();

		$stmt = null;
	}
	static public function mdlLoginUser($tabla, $datos)
	{
		$stmt = connection::connect()->prepare("INSERT INTO $tabla(name, user, password,passwordNormal, profile,picture) VALUES (:name, :user, :password, :passwordNormal, :profile,:picture)");
		$stmt->bindParam(":name", $datos["name"], PDO::PARAM_STR);
		$stmt->bindParam(":user", $datos["user"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":passwordNormal", $datos["passwordNormal"], PDO::PARAM_STR);
		$stmt->bindParam(":profile", $datos["profile"], PDO::PARAM_STR);
		$stmt->bindParam(":picture", $datos["picture"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
	/* editar usuario */

	static public function ctreditUser($tabla, $datos)
	{
		$stmt = connection::connect()->prepare("UPDATE $tabla SET name = :name, password = :password,passwordNormal=:passwordNormal, profile = :profile, picture = :picture WHERE user = :user");

		$stmt -> bindParam(":name", $datos["name"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":passwordNormal", $datos["passwordNormal"], PDO::PARAM_STR);
		$stmt -> bindParam(":profile", $datos["profile"], PDO::PARAM_STR);
		$stmt -> bindParam(":picture", $datos["picture"], PDO::PARAM_STR);
		$stmt -> bindParam(":user", $datos["user"], PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}
	static public function mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2){
		$stmt = connection::connect()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null; 
	}
	static public function mdlDeleteUser($tabla, $datos){
		$stmt = connection::connect()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}
