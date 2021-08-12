<?php

require_once "../controllers/customers.controller.php";
require_once "../models/customers.model.php";


class AjaxCustomers{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idClient;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idClient;
		$respuesta = controllerCustomers::ctrShowCustomers($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idClient"])){

	$client = new AjaxCustomers();
	$client -> idClient = $_POST["idClient"];
	$client -> ajaxEditarCliente();

}
