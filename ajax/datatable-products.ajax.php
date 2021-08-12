<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";
require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";
class tableProducts
{
	/* 	 MOSTRAR LA TABLA DE PRODUCT*/
	public function showTableProducts()
	{
		$item = null;
		$valor = null;
		$products = controllerProducts::ctrShowProducts($item, $valor);
		$datosJson = '{
		  "data": [';
		for ($i = 0; $i < count($products); $i++) {
			/* 	 TRAEMOS LA IMAGEN*/
			$picture = "<img src='".$products[$i]["picture"]."' width='40px'>";
			/* 	 		TRAEMOS LA CATEGORÍA*/
			$item = "id";
			$valor = $products[$i]["id_category"];
			$categories = controllerCategory::ctrShowCategories($item, $valor);
			/* 	 STOCK*/
			if ($products[$i]["stock"] <= 10) {
				$stock = "<button class='btn btn-danger'>" . $products[$i]["stock"] . "</button>";
			} else if ($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15) {
				$stock = "<button class='btn btn-warning'>" . $products[$i]["stock"] . "</button>";
			} else {
				$stock = "<button class='btn btn-success'>" . $products[$i]["stock"] . "</button>";
			}
			/*TRAEMOS LAS ACCIONES*/
			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditProducts' idProducts='" . $products[$i]["id"] . "' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeleteProduct' idProduct='" . $products[$i]["id"] . "' code='" . $products[$i]["code"] . "' picture='" . $products[$i]["picture"] . "' style='display:none'><i class='fa fa-times'></i></button></div>";
			$datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $picture . '",
			      "' . $products[$i]["code"] . '",
			      "' . $products[$i]["description"] . '",
			      "' . $categories["category"] . '",
			      "' . $stock . '",
			      "' . $products[$i]["price_Purchase"] . '",
			      "' . $products[$i]["price_Sale"] . '",
			      "' . $products[$i]["date"] . '",
			      "' . $botones . '"
			    ],';
		}
		$datosJson = substr($datosJson, 0, -1);
		$datosJson .=   '] 
		 }';
		echo $datosJson;
	}
}
/*ACTIVAR TABLA DE produ*/
$activateProducts = new tableProducts();
$activateProducts->showTableProducts();
