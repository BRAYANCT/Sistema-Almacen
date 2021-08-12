<?php
/* crar controladores de usuarios 
 */
class controllerUsers
{
    static public function ctrStartUser()
    {
        if (isset($_POST["ingUser"])) {
            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUser"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "users";

                $item = "user";
                $valor = $_POST["ingUser"];

                $respuesta = ModelUsers::mdlShowUsers($tabla, $item, $valor);
                /*  var_dump($respuesta); */
                if (is_array($respuesta)) {

                    if ($respuesta["user"] == $_POST["ingUser"] && $respuesta["password"] == $encriptar) {
                        if ($respuesta["state"] == 1) {

                            $_SESSION["startLogin"] = "ok";
                            $_SESSION["id"] = $respuesta["id"];
                            $_SESSION["name"] = $respuesta["name"];
                            $_SESSION["user"] = $respuesta["user"];
                            $_SESSION["picture"] = $respuesta["picture"];
                            $_SESSION["profile"] = $respuesta["profile"];
                            /* registrar la fecha y hora de inicio de secion */
                            date_default_timezone_set('America/Lima');
                            $fecha = date('Y-m-d');
                            $hora = date('H:i:s');
                            $fechaActual = $fecha . ' ' . $hora;
                            $item1 = "last_login";
                            $valor1 = $fechaActual;
                            $item2 = "id";
                            $valor2 = $respuesta["id"];
                            $ultimoLogin = ModelUsers::mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2);
                            if ($ultimoLogin == "ok") {
                                echo '<script>                            
                                        window.location = "home";                                      
                                      </script>';
                            }
                            echo '<br><div class="alert alert-success">Ingreso exitoso</div>';
                        } else {
                            echo '<br><div class="alert alert-danger">El usuario aun no esta activado</div>';
                        }
                    } else {

                        echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                    }
                } else {
                    echo '<br><div class="alert alert-danger">el usuario no existe</div>';
                }
            }
        }
    }
    /* register user */
    static public function ctrCreateUser()
    {
        if (isset($_POST["newUser"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])
            ) {
                /* validar imagen */
                $ruta = "";
                if (isset($_FILES["newPicture"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["newPicture"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    /* creamos el directorio */
                    $directorio = "views/img/users/" . $_POST["newUser"];

                    mkdir($directorio, 0755);
                    if ($_FILES["newPicture"]["type"] == "image/jpeg") {
                        /* guardarimg directori */

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/users/" . $_POST["newUser"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["newPicture"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES["newPicture"]["type"] == "image/png") {

                        /*GUARDAMOS LA IMAGEN EN EL DIRECTORIO*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/users/" . $_POST["newUser"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["newPicture"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "users";
                $encriptar = crypt($_POST["newPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $passwordNormal = $_POST["newPassword"];

                $datos = array(
                    "name" => $_POST["newName"],
                    "user" => $_POST["newUser"],
                    "password" => $encriptar,
                    "passwordNormal" => $passwordNormal,
                    "profile" => $_POST["newProfile"],
                    "picture" => $ruta
                );

                $respuesta = modelUsers::mdlLoginUser($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "users";

						}

					});
				

					</script>';
                } else {
                    echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no se pudo guardar en la base de datos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "users";

						}

					});
				

					</script>';
                }
            } else {
                echo '<script>
                swal({
                    type: "error",
                    title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then((result)=>{
                    if(result.value){                    
                        window.location = "users";
                    }
                });
            </script>';
            }
        }
    }
    /* show users-mostrar usuario */
    static public function ctrShowUsers($item, $valor)
    {
        $tabla = "users";
        $respuesta = modelUsers::MdlShowUsers($tabla, $item, $valor);
        return $respuesta;
    }
    /* edit users -editar usuarios*/
    static public function ctrEditUser()
    {

        if (isset($_POST["editUser"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editName"])) {
                /* validar imagen */
                $ruta = $_POST["pictureCurrent"];
                if (isset($_FILES["editPicture"]["tmp_name"]) && !empty($_FILES["editPicture"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["editPicture"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    /* creamos el directorio */
                    $directorio = "views/img/users/" . $_POST["editUser"];
                    /* verificamos si existe img en db */
                    if (!empty($_POST["pictureCurrent"])) {
                        unlink($_POST["pictureCurrent"]);
                    } else {
                        mkdir($directorio, 0755);
                    }
                    if ($_FILES["editPicture"]["type"] == "image/jpeg") {
                        /* guardarimg directori */

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/users/" . $_POST["editUser"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editPicture"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES["editPicture"]["type"] == "image/png") {
                        /*GUARDAMOS LA IMAGEN EN EL DIRECTORIO*/
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/users/" . $_POST["editUser"] . "/" . $aleatorio . ".png";
                        $origen = imagecreatefrompng($_FILES["editPicture"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                }
                $tabla = "users";
                if ($_POST["editPassword" != ""]) {
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editPassword"])) {
                        $encriptar = crypt($_POST["editPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
                        echo '<script>
                     swal({
                         type: "error",
                         title: "¡La contraseña no puede ir vacio o llevar caracteres especiales!",
                         showConfirmButton: true,
                         confirmButtonText: "Cerrar"
                     }).then((result)=>{
                         if(result.value){                    
                             window.location = "users";
                         }
                     });
                 </script>';
                    }
                } else {
                    $encriptar = $_POST["passwordCurrent"];
                }
                $datos = array(
                    "name" => $_POST["editName"],
                    "user" => $_POST["editUser"],
                    "password" => $encriptar,
                    "passwordNormal" => $_POST["editPassword"],
                    "profile" => $_POST["editProfile"],
                    "picture" => $ruta
                );

                $respuesta = modelUsers::ctreditUser($tabla, $datos);
                /*  return $respuesta; */
                if ($respuesta == "ok") {
                    echo '<script>
					swal({
						type: "success",
						title: "¡El usuario ha sido guardado actualizado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){						
							window.location = "users";
						}
					});
					</script>';
                }
            } else {
                echo '<script>
                swal({
                      type: "error",
                      title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {
                        window.location = "usuarios";
                        }
                    })
                 </script>';
            }
        }
    }
    /* eliminar */
    static function ctrDeleteUser(){
        if(isset($_GET["idUser"])){
			$tabla ="users";
			$datos = $_GET["idUser"];
			if($_GET["pictureUser"] != ""){
				unlink($_GET["pictureUser"]);
				rmdir('views/img/users/'.$_GET["users"]);
			}
			$respuesta = modelUsers::mdlDeleteUser($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								window.location = "users";
								}
							})
				</script>';

			}		
		}
    }
}
