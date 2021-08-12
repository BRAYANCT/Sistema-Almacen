<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class tableProductsSales{
	/*
	 MOSTRAR LA TABLA DE PRODUCTOS
	 */ 
   public function showTableProductsSales(){
	   $item = null;
	   $valor = null;
		 $product = controllerProducts::ctrShowProducts($item, $valor);		
	  
		 if(count($product) == 0){
			 echo '{"data": []}';
			 return;
		 }	   
		 $datosJson = '{
		 "data": [';
		 for($i = 0; $i < count($product); $i++){
			 /*
			 TRAEMOS LA IMAGEN*/ 
			 $picture = "<img src='".$product[$i]["picture"]."' width='40px'>";
			 /*
			 STOCK*/ 
			 if($product[$i]["stock"] <= 10){
				 $stock = "<button class='btn btn-danger'>".$product[$i]["stock"]."</button>";
			 }else if($product[$i]["stock"] > 11 && $product[$i]["stock"] <= 15){
				 $stock = "<button class='btn btn-warning'>".$product[$i]["stock"]."</button>";
			 }else{
				 $stock = "<button class='btn btn-success'>".$product[$i]["stock"]."</button>";
			 }
			 /*
			 TRAEMOS LAS ACCIONES*/ 

			 $botones =  "<div class='btn-group'><button class='btn btn-primary addProduct recuperarBoton' idProduct='".$product[$i]["id"]."'>Agregar</button></div>"; 

			 $datosJson .='[
				 "'.($i+1).'",
				 "'.$picture.'",
				 "'.$product[$i]["code"].'",
				 "'.$product[$i]["description"].'",
				 "'.$stock.'",
				 "'.$botones.'"
			   ],';

		 }

		 $datosJson = substr($datosJson, 0, -1);

		$datosJson .=   '] 

		}';
	   
	   echo $datosJson;


   }


}

/*
ACTIVAR TABLA DE PRODUCTOs*/ 
$activateProductsSales = new tableProductsSales();
$activateProductsSales -> showTableProductsSales();

