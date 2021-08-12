<?php
/* crar controladores de productos */
class controllerProducts
{
    /* show prodcuts-mostrar productos */
    static public function ctrShowProducts($item, $valor)
    {
        $tabla = "products";

        $respuesta = modelProducts::mdlShowProducts($tabla, $item, $valor);

        return $respuesta;
    }
    /* crear productos */
    static public function ctrCreateProduct()
    {
        if (isset($_POST["newDescription"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newDescription"]) &&
                preg_match('/^[0-9]+$/', $_POST["newStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["newPricePurchase"]) &&
                preg_match('/^[0-9.]+$/', $_POST["newPriceSale"])
            ) {

                /* valdiate picture */
                $ruta = "views/img/products/default/anonymous.png";

                if (isset($_FILES["newPicture"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["newPicture"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    /* creamos el directorio */
                    $directorio = "views/img/products/" . $_POST["newCode"];

                    mkdir($directorio, 0755);
                    if ($_FILES["newPicture"]["type"] == "image/jpeg") {
                        /* guardarimg directori */

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/products/" . $_POST["newCode"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["newPicture"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES["newPicture"]["type"] == "image/png") {

                        /*GUARDAMOS LA IMAGEN EN EL DIRECTORIO*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/products/" . $_POST["newCode"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["newPicture"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                /* fin imagen */
                $tabla = "products";

                $datos = array(
                    "id_category" => $_POST["newCategory"],
                    "code" => $_POST["newCode"],
                    "description" => $_POST["newDescription"],
                    "stock" => $_POST["newStock"],
                    "price_Purchase" => $_POST["newPricePurchase"],
                    "price_Sale" => $_POST["newPriceSale"],
                    "picture" => $ruta
                );


                $respuesta = modelProducts::mdlLoginProduct($tabla, $datos);


                if ($respuesta == "ok") {

                    echo '<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "products";

										}
									})

						</script>';
                } else {
                    echo '<script>

                    swal({
                          type: "error",
                          title: "¡El producto no se puede guardar!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {
                            window.location = "products";
                            }
                        })
                  </script>';
                }
            } else {


                echo '<script>

                swal({
                      type: "error",
                      title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {
                        window.location = "products";
                        }
                    })
              </script>';
            }
        }
    }
    /* edit product */
    static public function ctrEditProduct()
    {
        if (isset($_POST["editDescription"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editDescription"]) &&
                preg_match('/^[0-9]+$/', $_POST["editStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editPricePurchase"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editPriceSale"])
            ) {

                /* valdiate picture */
                $ruta = $_POST["pictureCurrent"];

                if (isset($_FILES["editPicture"]["tmp_name"]) && !empty($_FILES["editPicture"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["editPicture"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    /* creamos el directorio */
                    $directorio = "views/img/products/" . $_POST["editCode"];
                    if (!empty($_POST["pictureCurrent"]) && $_POST["pictureCurrent"] != "views/img/products/default/anonymous.png") {
                        unlink($_POST["pictureCurrent"]);
                    } else {
                        mkdir($directorio, 0755);
                    }

                    if ($_FILES["editPicture"]["type"] == "image/jpeg") {
                        /* guardarimg directori */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "views/img/products/" . $_POST["editCode"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["editPicture"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }
                    if ($_FILES["editPicture"]["type"] == "image/png") {
                        /*GUARDAMOS LA IMAGEN EN EL DIRECTORIO*/
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "views/img/products/" . $_POST["editCode"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editPicture"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                /* fin imagen */
                $tabla = "products";

                $datos = array(
                    "id_category" => $_POST["editCategory"],
                    "code" => $_POST["editCode"],
                    "description" => $_POST["editDescription"],
                    "stock" => $_POST["editStock"],
                    "price_Purchase" => $_POST["editPricePurchase"],
                    "price_Sale" => $_POST["editPriceSale"],
                    "picture" => $ruta
                );

               
                $respuesta = modelProducts::mdlEditProduct($tabla, $datos);

               
                if ($respuesta == "ok") {

                    echo '<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "products";

										}
									})

						</script>';
                } else {
                  

                    echo '<script>

                    swal({
                          type: "error",
                          title: "¡El producto no se puede guardar!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {
                            window.location = "products";
                            }
                        })
                  </script>';
                }
            }
        }
    }

	static public function ctrDeleteProduct(){

		if(isset($_GET["idProduct"])){
			$tabla ="products";
			$datos = $_GET["idProduct"];
			if($_GET["picture"] != "" && $_GET["picture"] != "views/img/products/default/anonymous.png"){
				unlink($_GET["picture"]);
				rmdir('views/img/products/'.$_GET["code"]);
			}
			$respuesta = modelProducts::mdlDeleteProduct($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								window.location = "products";
								}
							})
				</script>';
			}		else{
                echo'<script>
				swal({
					  type: "error",
					  title: "El producto no se pudo borrado ",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								window.location = "products";
								}
							})
				</script>';
            }
		}
	}

}
