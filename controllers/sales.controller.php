<?php
/*crar controladores de ventas*/
class controllerSales
{
    static public function ctrShowSales($item, $valor)
    {
        $tabla = "sales";
        $respuesta = modelSales::mdlShowSales($tabla, $item, $valor);

        return $respuesta;
    }
    /* crear ventas */
    static public function ctrCreateSales()
    {
        if (isset($_POST["newSale"])) {
            /*ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS*/
            $productList = json_decode($_POST["productList"], true);
            $totalProductsBought = array();
            foreach ($productList as $key => $value) {
                array_push($totalProductsBought, $value["amount"]);
                $tableProducts = "products";

                $item = "id";
                $valor = $value["id"];

                $bringProduct = modelProducts::mdlShowProducts($tableProducts, $item, $valor);

                $item1a = "Sales";
                $valor1a = $value["amount"] + $bringProduct["Sales"];

                $newSales = modelProducts::mdlUpdateProduct($tableProducts, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["stock"];

                $newStock = modelProducts::mdlUpdateProduct($tableProducts, $item1b, $valor1b, $valor);
            }
            $tablaClientes = "customers";
            $item = "id";
            $valor = $_POST["selectClient"];

            $traerCliente = modelCustomers::mdlShowCustomers($tablaClientes, $item, $valor);

            $item1a = "shopping";
            $valor1a = array_sum($totalProductsBought) + $traerCliente["shopping"];
            $comprasCliente = modelCustomers::mdlUpdateClient($tablaClientes, $item1a, $valor1a, $valor);
           
                $item1b = "birth_Date";
    
                date_default_timezone_set('America/Lima');
    
                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $valor1b = $fecha.' '.$hora;
    
                $fechaCliente = modelCustomers::mdlUpdateClient($tablaClientes, $item1b, $valor1b, $valor);
               
            /* GUARDAR LA COMPRA*/

                 $tabla = "sales";
    
                $datos = array("id_seller"=>$_POST["idSeller"],
                               "id_client"=>$_POST["selectClient"],
                               "code"=>$_POST["newSale"],
                               "products"=>$_POST["productList"],
                               "tax"=>$_POST["newPriceTax"],
                               "net"=>$_POST["newNetPrice"],
                               "total"=>$_POST["totalSale"],
                               "payment_method"=>$_POST["newPaymentMethod"]);
    
                $respuesta = modelSales::mdlLoginSale($tabla, $datos);
    
                if($respuesta == "ok"){
    
                    echo'<script>
    
                    localStorage.removeItem("rango");
    
                    swal({
                          type: "success",
                          title: "La venta ha sido guardada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then((result) => {
                                    if (result.value) {
    
                                    window.location = "create-sales";
    
                                    }
                                })
    
                    </script>';
    
                }
        } 
    }
}
