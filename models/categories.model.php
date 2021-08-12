<?php
 /* crar modelos de categorias  */
 require_once "connection.php";

class modelCategories{
    /* create category */
    static public function mdlLoginCategory($tabla, $datos){
        $stmt = connection::connect()->prepare("INSERT INTO $tabla(category) VALUES (:category)");
		$stmt->bindParam(":category", $datos, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
    }
    static public function mdlShowCategories($tabla, $item, $valor){
        if($item != null){
			$stmt = connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = connection::connect()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
    }
    static public function mdlEditCategory($tabla, $datos){
		$stmt = connection::connect()->prepare("UPDATE $tabla SET category = :category WHERE id = :id");
		$stmt -> bindParam(":category", $datos["category"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
	}
    static public function mdlDeleteCategory($tabla, $datos){
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