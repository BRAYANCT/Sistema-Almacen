<?php
/* crar modelos de ventas */
require_once "connection.php";

class modelSales{
    static public function mdlShowSales($tabla,$item,$valor){
        if($item != null){
			$stmt = connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = connection::connect()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
    }
    /* registro venta */
    static public function  mdlLoginSale($tabla, $datos){
		$stmt = connection::connect()->prepare("INSERT INTO $tabla(code, id_client, id_seller, products, tax, net, total, payment_method) VALUES (:code, :id_client, :id_seller, :products, :tax, :net, :total, :payment_method)");

		$stmt->bindParam(":code", $datos["code"], PDO::PARAM_INT);
		$stmt->bindParam(":id_client", $datos["id_client"], PDO::PARAM_INT);
		$stmt->bindParam(":id_seller", $datos["id_seller"], PDO::PARAM_INT);
		$stmt->bindParam(":products", $datos["products"], PDO::PARAM_STR);
		$stmt->bindParam(":tax", $datos["tax"], PDO::PARAM_STR);
		$stmt->bindParam(":net", $datos["net"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":payment_method", $datos["payment_method"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
    }
}