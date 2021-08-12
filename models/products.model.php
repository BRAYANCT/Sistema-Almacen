<?php
/* crar modelos de productos */
require_once "connection.php";

class modelProducts{
    static public function mdlShowProducts($tabla, $item, $valor){
		if($item != null){

			$stmt = connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

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
    static public function mdlLoginProduct($tabla, $datos){
        $stmt = connection::connect()->prepare("INSERT INTO $tabla(id_category, code, description, picture, stock, price_Purchase, price_Sale) VALUES (:id_category, :code, :description, :picture, :stock, :price_Purchase, :price_Sale)");
		$stmt->bindParam(":id_category", $datos["id_category"], PDO::PARAM_INT);
		$stmt->bindParam(":code", $datos["code"], PDO::PARAM_STR);
		$stmt->bindParam(":description", $datos["description"], PDO::PARAM_STR);
		$stmt->bindParam(":picture", $datos["picture"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":price_Purchase", $datos["price_Purchase"], PDO::PARAM_STR);
		$stmt->bindParam(":price_Sale", $datos["price_Sale"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
    }
    
    static public function mdlEditProduct($tabla, $datos){
        $stmt = connection::connect()->prepare("UPDATE $tabla SET id_category=:id_category, code=:code, description=:description, picture=:picture, stock=:stock, price_Purchase=:price_Purchase, price_Sale=:price_Sale WHERE code=:code");
		$stmt->bindParam(":id_category", $datos["id_category"], PDO::PARAM_INT);
		$stmt->bindParam(":code", $datos["code"], PDO::PARAM_STR);
		$stmt->bindParam(":description", $datos["description"], PDO::PARAM_STR);
		$stmt->bindParam(":picture", $datos["picture"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":price_Purchase", $datos["price_Purchase"], PDO::PARAM_STR);
		$stmt->bindParam(":price_Sale", $datos["price_Sale"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
    }
    static public function  mdlDeleteProduct($tabla, $datos){
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
	static public function mdlUpdateProduct($tabla, $item1, $valor1,$valor2){
		$stmt = connection::connect()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id",$valor2, PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null; 
	}
}