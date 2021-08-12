<?php
/* crar modelos de clientes */
require_once "connection.php";

class modelCustomers
{
    public static function mdlLoginClient($tabla, $datos)
    {
        $stmt = connection::connect()->prepare("INSERT INTO $tabla(name, document, email, phone, direction, birth_Date) VALUES (:name, :document, :email, :phone, :direction, :birth_Date)");

        $stmt->bindParam(":name", $datos["name"], PDO::PARAM_STR);
        $stmt->bindParam(":document", $datos["document"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $datos["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":direction", $datos["direction"], PDO::PARAM_STR);
        $stmt->bindParam(":birth_Date", $datos["birth_Date"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
    static public function mdlShowCustomers($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = connection::connect()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlEditClient($tabla, $datos)
    {

        $stmt = connection::connect()->prepare("UPDATE $tabla SET name = :name, document = :document, email = :email, phone = :phone, direction = :direction, birth_Date = :birth_Date WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":name", $datos["name"], PDO::PARAM_STR);
        $stmt->bindParam(":document", $datos["document"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $datos["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":direction", $datos["direction"], PDO::PARAM_STR);
        $stmt->bindParam(":birth_Date", $datos["birth_Date"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlDeleteClient($tabla, $datos){

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
	static public function mdlUpdateClient($tabla, $item1, $valor1,$valor2){
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
