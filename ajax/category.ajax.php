<?php

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class AjaxCategories{
	/*	EDITAR CATEGORÍA*/	

	public $idCategory;
	public function ajaxEditCategory(){
		$item = "id";
		$valor = $this->idCategory;
		$respuesta = controllerCategory::ctrShowCategories($item, $valor);
		echo json_encode($respuesta);
	}
}
/*EDITAR CATEGORÍA*/	
if(isset($_POST["idCategory"])){

	$categoria = new AjaxCategories();
	$categoria -> idCategory = $_POST["idCategory"];
	$categoria -> ajaxEditCategory();
}
