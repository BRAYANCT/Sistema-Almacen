<?php

require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";

class AjaxUsers
{
	/* editar usuario */
	public $idUser;
	 public function ajaxEditUser()
	{
		$item = "id";
		$valor = $this->idUser;
		$respuesta = ControllerUsers::ctrShowUsers($item, $valor);
		echo json_encode($respuesta);
	}

	/* activar usuario y desactivar */
	public $activateUser;
	public $activateId;

	 public function ajaxActivateUser()
	{
		$tabla = "users";
		$item1 = "state";
		$valor1 = $this->activateUser;
		$item2 = "id";
		$valor2 = $this->activateId;
		$respuesta = ModelUsers::mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2);
		var_dump($respuesta);
	}
	/*	VALIDAR NO REPETIR USUARIO*/
	public $validateUser;
	public function ajaxValidateUser()
	{
		$item = "user";
		$valor = $this->validateUser;
		$respuesta = ControllerUsers::ctrShowUsers($item, $valor);
		echo json_encode($respuesta);
	}
}
/* editar usuario */
if (isset($_POST["idUser"])) {
	$edit = new AjaxUsers();
	$edit->idUser = $_POST["idUser"];
	$edit->ajaxEditUser();
}
/*ACTIVAR USUARIO*/

if (isset($_POST["activateUser"])) {

	$activateUser = new AjaxUsers();
	$activateUser->activateUser = $_POST["activateUser"];
	$activateUser->activateId = $_POST["activateId"];
	$activateUser->ajaxActivateUser();
}
/*VALIDAR NO REPETIR USUARIO*/

if (isset($_POST["validateUser"])) {

	$valUsuario = new AjaxUsers();
	$valUsuario->validateUser = $_POST["validateUser"];
	$valUsuario->ajaxValidateUser();
}
