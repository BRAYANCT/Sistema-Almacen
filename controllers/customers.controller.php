<?php
/* crar controladores de clientes*/
class controllerCustomers
{
    public static function ctrCreateClient()
    {
        if(isset($_POST["newClient"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newClient"]) &&
			   preg_match('/^[0-9]+$/', $_POST["newDocumentId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["newEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["newPhone"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["newDirection"])){

			   	$tabla = "customers";

			   	$datos = array("name"=>$_POST["newClient"],
					           "document"=>$_POST["newDocumentId"],
					           "email"=>$_POST["newEmail"],
					           "phone"=>$_POST["newPhone"],
					           "direction"=>$_POST["newDirection"],
					           "birth_Date"=>$_POST["newBirthDate"]);
                          
			   	$respuesta = modelCustomers::mdlLoginClient($tabla, $datos);
            
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "customers";

									}
								})

					</script>';

				}else{
                    echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no se pudo guardar!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "customers";

							}
						})

			  	</script>';
                }

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "customers";

							}
						})

			  	</script>';



			}

		}
        
    }
    static public function ctrShowCustomers($item, $valor){

        $tabla = "customers";

        $respuesta = modelCustomers::mdlShowCustomers($tabla, $item, $valor);

        return $respuesta;

    }
    static public function ctrEditClient(){

		if(isset($_POST["editClient"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editClient"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editDocumentId"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editPhone"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editDirection"])){
			   	$tabla = "customers";
			   	$datos = array("id"=>$_POST["idClient"],
			   				   "name"=>$_POST["editClient"],
					           "document"=>$_POST["editDocumentId"],
					           "email"=>$_POST["editEmail"],
					           "phone"=>$_POST["editPhone"],
					           "direction"=>$_POST["editDirection"],
					           "birth_Date"=>$_POST["editBirthDate"]);                               
                
                $respuesta = modelCustomers::mdlEditClient($tabla, $datos);
              
			   	if($respuesta == "ok"){
					echo'<script>
					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "customers";
									}
								})
					</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "customers";
							}
						})
			  	</script>';
			}
		}
	}
    static public function ctrDeleteClient(){
        if(isset($_GET["idClient"])){

			$tabla ="customers";
			$datos = $_GET["idClient"];

			$respuesta = modelCustomers::mdlDeleteClient($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "customers";

								}
							})

				</script>';

			}		

		}

    }
}
        
    