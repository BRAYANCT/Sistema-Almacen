<?php
/* crar controladores de categorias */
class controllerCategory
{
    /* create categories */
    static public function ctrCreateCategory()
    {
        if (isset($_POST["newCategory"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])) {

                $tabla = "categories";
                $datos = $_POST["newCategory"];
                $respuesta = modelCategories::mdlLoginCategory($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "categories";
									}
								})
					</script>';
                }
            } else {
                echo '<script>
                swal({
                      type: "error",
                      title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {
                        window.location = "categories";
                        }
                    })
              </script>';
            }
        }
    }
    static public function ctrShowCategories($item, $valor)
    {
        $tabla = "categories";

		$respuesta = modelCategories::mdlShowCategories($tabla, $item, $valor);

		return $respuesta;
    }
    static public function ctrEditCategory(){
        if(isset($_POST["editCategory"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCategory"])){

				$tabla = "categories";

				$datos = array("category"=>$_POST["editCategory"],
							   "id"=>$_POST["idCategory"]);

				$respuesta = modelCategories::mdlEditCategory($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categories";

							}
						})

			  	</script>';

			}

		}
    }
    /* eliminar categoria */
	static public function ctrDeleteCategory(){

		if(isset($_GET["idCategory"])){
			$tabla ="categories";
			$datos = $_GET["idCategory"];
			$respuesta = modelCategories::mdlDeleteCategory($tabla, $datos);
			if($respuesta == "ok"){
				echo'<script>
					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "categories";
									}
								})
					</script>';
			}
		}
		
	}

}
