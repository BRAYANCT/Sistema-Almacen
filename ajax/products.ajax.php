<?php
require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";
class ajaxProducts
{
    /*  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA*/
    public $idCategory;

    public function ajaxCreateCodeProduct()
    {
        $item = "id_category";
        $valor = $this->idCategory;
        $respuesta = controllerProducts::ctrShowProducts($item, $valor);
        echo json_encode($respuesta);
    }
    /*  EDITAR PRODUCTO*/
    public $idProduct;
    public $bringProducts;
    public $nameProduct;
    public function ajaxEditProduct()
    {
        if ($this->bringProducts == "ok") {
            $item = null;
            $valor = null;
            $respuesta = controllerProducts::ctrShowProducts($item, $valor);
            echo json_encode($respuesta);
        } else if ($this->nameProduct != "") {
            $item = "description";
            $valor = $this->nameProduct;
            $respuesta = controllerProducts::ctrShowProducts($item, $valor);
            echo json_encode($respuesta);
        } else {
            $item = "id";
            $valor = $this->idProduct;
            $respuesta = controllerProducts::ctrShowProducts($item, $valor);
            echo json_encode($respuesta);
        }
    }
}
/*GENERAR CÓDIGO A PARTIR DE ID CATEGORIA*/
if (isset($_POST["idCategory"])) {
    $codeProduct = new ajaxProducts();
    $codeProduct->idCategory = $_POST["idCategory"];
    $codeProduct->ajaxCreateCodeProduct();
}
/*EDITAR PRODUCTO*/
if (isset($_POST["idProduct"])) {
    $editProduct = new ajaxProducts();
    $editProduct->idProduct = $_POST["idProduct"];
    $editProduct->ajaxEditProduct();
}
/*TRAER PRODUCTO*/
if (isset($_POST["bringProducts"])) {
    $bringProducts = new ajaxProducts();
    $bringProducts->bringProducts = $_POST["bringProducts"];
    $bringProducts->ajaxEditProduct();
}
/*  TRAER PRODUCTO*/
if (isset($_POST["nameProduct"])) {

    $bringProducts = new ajaxProducts();
    $bringProducts->nameProduct = $_POST["nameProduct"];
    $bringProducts->ajaxEditProduct();
}
