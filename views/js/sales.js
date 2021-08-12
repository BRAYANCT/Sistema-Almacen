/*  $.ajax({

     url: "ajax/datatable-sales.ajax.php",
     success: function(respuesta) {

         console.log("respuesta", respuesta);

     }

 }) */

$('.tableSales').DataTable({
    "ajax": "ajax/datatable-sales.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});
/* agregar productos desde la tabla*/
$(".tableSales tbody").on("click", "button.addProduct", function() {

    var idProduct = $(this).attr("idProduct");
    $(this).removeClass("btn-primary addProduct");
    $(this).addClass("btn-default");
    var datos = new FormData();
    datos.append("idProduct", idProduct);
    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            var description = respuesta["description"];
            var stock = respuesta["stock"];
            var price = respuesta["price_Sale"];

            if (stock == 0) {
                swal({
                    title: "No hay stock disponible",
                    type: "error",
                    confirmButtonText: "¡Cerrar!"
                });
                $("button[idProduct='" + idProduct + "']").addClass("btn-primary addProduct");
                return;
            }

            $(".newProduct").append(
                '<div class="row" style="padding:5px 15px">' +
                '<!-- Descripción del producto -->' +
                '<div class="col-xs-6" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="' + idProduct + '"><i class="fa fa-times"></i></button></span>' +
                '<input type="text" class="form-control newProductDescription addProduct" idProduct="' + idProduct + '" name="addProduct" value="' + description + '" readonly required>' +
                '</div>' +
                '</div>' +
                '<!-- Cantidad del producto -->' +
                '<div class="col-xs-3" >' +
                '<input type="number" class="form-control newQuantityProduct" name="newQuantityProduct" max="' + stock + '" min="1" value="1" stock="' + stock + '" newStock="' + Number(stock - 1) + '" required>' +
                '</div>' +
                '<!-- Precio del producto -->' +
                '<div class="col-xs-3 incomeAmount" style="padding-left:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                '<input type="text" class="form-control newPriceProduct" realPrice="' + price + '" name="newPriceProduct" value="' + price + '"  readonly required>' +
                '</div>' +
                '</div>' +
                '</div>');
            // SUMAR TOTAL DE PRECIOS
            sumaTotalPrices();
            // AGREGAR IMPUESTO
            addTax();
            // AGRUPAR PRODUCTOS EN FORMATO JSON
            listarProductos()
                // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

            $(".newPriceProduct").number(true, 2);

        }

    })
});
/*cuando cargue la tabla se actualiza */
$(".tableSales").on("draw.dt", function() {

    if (localStorage.getItem("removeProduct") != null) {

        var listIdProduct = JSON.parse(localStorage.getItem("removeProduct"));
        for (var i = 0; i < listIdProduct.length; i++) {
            $("button.recuperarBoton[idProduct='" + listIdProduct[i]["idProduct"] + "']").removeClass('btn-default');
            $("button.recuperarBoton[idProduct='" + listIdProduct[i]["idProduct"] + "']").addClass('btn-primary agregarProducto');
        }
    }
})

/*QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN*/

var idRemoveProduct = [];

localStorage.removeItem("removeProduct");
$(".formSale").on("click", "button.removeProduct", function() {
    $(this).parent().parent().parent().parent().remove();
    var idProduct = $(this).attr("idProduct");
    /* local storage */
    if (localStorage.getItem("removeProduct") == null) {
        idRemoveProduct = [];
    } else {
        idRemoveProduct.concat(localStorage.getItem("removeProduct"))
    }
    idRemoveProduct.push({ "idProduct": idProduct });
    localStorage.setItem("removeProduct", JSON.stringify(idRemoveProduct));

    $("button.recuperarBoton[idProduct='" + idProduct + "']").removeClass('btn-default');
    $("button.recuperarBoton[idProduct='" + idProduct + "']").addClass('btn-primary addProduct');
    if ($(".newProduct").children().length == 0) {
        $("#newSalesTax").val(0);
        $("#newTotalSales").val(0);
        $("#totalSale").val(0);
        $("#newTotalSales").attr("total", 0);
    } else {

        // SUMAR TOTAL DE PRECIOS
        sumaTotalPrices();
        // AGREGAR IMPUESTO
        addTax();
        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProductos()
    }
})

/* agregando desed  dispositivos*/
var numProduct = 0;

$(".btnAgregateProduct").click(function() {
    numProduct++;

    var datos = new FormData();
    datos.append("bringProducts", "ok");

    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $(".newProduct").append(
                '<div class="row" style="padding:5px 15px">' +

                '<!-- Descripción del producto -->' +
                '<div class="col-xs-6" style="padding-right:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct><i class="fa fa-times"></i></button></span>' +
                '<select class="form-control newProductDescription addProduct" id="product' + numProduct + '"  idProduct name="newProductDescription" required>' +
                '<option>Seleccione el producto</option>' +
                '</select>' +
                '</div>' +
                '</div>' +

                '<!-- Cantidad del producto -->' +

                '<div class="col-xs-3 incomePrice">' +
                '<input type="number" class="form-control newQuantityProduct" name="newQuantityProduct" min="1" value="1" stock newStock required>' +
                '</div>' +

                '<!-- Precio del producto -->' +

                '<div class="col-xs-3 incomeAmount" style="padding-left:0px">' +
                '<div class="input-group">' +
                '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                '<input type="text" class="form-control newPriceProduct" realPrice="" name="newPriceProduct" readonly required>' +
                '</div>' +
                '</div>' +
                '</div>');

            // AGREGAR LOS PRODUCTOS AL SELECT 
            respuesta.forEach(funcionForEach);

            function funcionForEach(item, index) {
                if (item.stock != 0) {
                    $("#product" + numProduct).append(
                        '<option idProduct="' + item.id + '" value="' + item.description + '">' + item.description + '</option>'
                    )

                }

            }
            // SUMAR TOTAL DE PRECIOS
            sumaTotalPrices();
            // AGREGAR IMPUESTO
            addTax();

            /* formato */
            $(".newPriceProduct").number(true, 2);


        }

    })
})

/* seleccionar producto */
$(".formSale").on("change", "select.newProductDescription", function() {

    var nameProduct = $(this).val();

    var newPriceProduct = $(this).parent().parent().parent().children(".incomeAmount").children().children(".newPriceProduct"); /* precio */
    var newQuantityProduct = $(this).parent().parent().parent().children(".incomePrice").children(".newQuantityProduct"); /* cantidad -stock*/
    var newProductDescription = $(this).parent().parent().parent().children().children().children(".newProductDescription"); /* descripcion */


    var datos = new FormData();
    datos.append("nameProduct", nameProduct);

    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            /* $(newProductDescription).attr("idProduct", respuesta["id"]); */
            $(newQuantityProduct).attr("stock", respuesta["stock"]);
            $(newQuantityProduct).attr("newStock", Number(respuesta["stock"]) - 1);
            $(newPriceProduct).val(respuesta["price_Sale"]);
            $(newPriceProduct).attr("realPrice", respuesta["price_Sale"]);

            // AGRUPAR PRODUCTOS EN FORMATO JSON
            listarProductos()

        }
    })

})

/* modificar la cantidad */
$(".formSale").on("change", "input.newQuantityProduct", function() {

    var price = $(this).parent().parent().children(".incomeAmount").children().children(".newPriceProduct");
    var finalPrice = $(this).val() * price.attr("realPrice");
    price.val(finalPrice);
    var newStock = Number($(this).attr("stock")) - $(this).val();
    $(this).attr("newStock", newStock);
    if (Number($(this).val()) > Number($(this).attr("stock"))) {
        /*SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES*/
        $(this).val(1);
        var finalPrice = $(this).val() * price.attr("realPrice");
        price.val(finalPrice);
        // SUMAR TOTAL DE PRECIOS
        sumaTotalPrices();
        // AGREGAR IMPUESTO
        addTax();
        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProductos()
            /* sumarTotalPrecios(); */
        swal({
            title: "La cantidad supera el Stock",
            text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

        return;

    }
    // SUMAR TOTAL DE PRECIOS
    sumaTotalPrices();
    // AGREGAR IMPUESTO
    addTax();
    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos()
})

/* sumar precios */
function sumaTotalPrices() {

    var priceItem = $(".newPriceProduct");
    var arraySumPrice = [];
    for (var i = 0; i < priceItem.length; i++) {
        arraySumPrice.push(Number($(priceItem[i]).val()));
    }

    function SumArrayPrices(total, numero) {
        return total + numero;
    }
    var sumTotalPrice = arraySumPrice.reduce(SumArrayPrices);
    $("#newTotalSales").val(sumTotalPrice);
    $("#totalSale").val(sumTotalPrice);
    $("#newTotalSales").attr("total", sumTotalPrice);


}
/* agregar impuesto */
function addTax() {

    var tax = $("#newSalesTax").val();
    var totalPrice = $("#newTotalSales").attr("total");
    var totalTax = Number(totalPrice * tax / 100);
    var totalWithtax = Number(totalTax) + Number(totalPrice);
    $("#newTotalSales").val(totalWithtax);
    $("#totalSale").val(totalWithtax);
    $("#newPriceTax").val(totalTax);
    $("#newNetPrice").val(totalPrice);

}
/* impuesto */
$("#newSalesTax").change(function() {

    addTax();

});
/* formato al precio final  */
$("#newTotalSales").number(true, 2);

/*SELECINAR METODO DE PAGO  */
$("#newPaymentMethod").change(function() {
    var metodo = $(this).val();
    if (metodo == "Efectivo") {

        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");
        $(this).parent().parent().parent().children(".boxesMethodPayment").html(
                '<div class="col-xs-4" style="padding-left:0px">' +
                '<div class="input-group">' +
                '   <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
                '   <input type="text" class="form-control" id="newCashValue" placeholder="000000" required>' +
                '</div>' +
                '</div>' +
                '<div class="col-xs-4" id="captureCashChange" style="padding-left:0px">' +

                '   <div class="input-group">' +

                '       <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +

                '       <input type="text" class="form-control" id="newChangeCash" placeholder="000000" readonly required>' +

                '   </div>' +

                '</div>'
            )
            // Agregar formato al precio

        $('#newCashValue').number(true, 2);
        $('#newChangeCash').number(true, 2);
        /* lista metodo entradas */
        listMethods();

    } else {
        $(this).parent().parent().removeClass('col-xs-4');

        $(this).parent().parent().addClass('col-xs-6');

        $(this).parent().parent().parent().children('.boxesMethodPayment').html(

            '<div class="col-xs-6" style="padding-left:0px">' +

            '<div class="input-group">' +

            '<input type="number" min="0" class="form-control" id="newCodeTransaction" placeholder="Código transacción"  required>' +

            '<span class="input-group-addon"><i class="fa fa-lock"></i></span>' +

            '</div>' +

            '</div>')

    }
})

/* cambio efectivo */
$(".formSale").on("change", "input#newCashValue", function() {
    var cash = $(this).val();

    var change = Number(cash) - Number($('#newTotalSales').val());
    var newChangeCash = $(this).parent().parent().parent().children('#captureCashChange').children().children('#newChangeCash');

    newChangeCash.val(change);

})

/* cambio transaccion */
$(".formSale").on("change", "input#newCodeTransaction", function() {
    listMethods()
})

/* listar produtos */
function listarProductos() {

    var productList = [];

    var desciption = $(".newProductDescription");

    var amount = $(".newQuantityProduct");

    var price = $(".newPriceProduct");

    for (var i = 0; i < desciption.length; i++) {

        productList.push({
            "id": $(desciption[i]).attr("idProduct"),
            "desciption": $(desciption[i]).val(),
            "amount": $(amount[i]).val(),
            "stock": $(amount[i]).attr("newStock"),
            "price": $(price[i]).attr("realPrice"),
            "total": $(price[i]).val()
        })
    }
    $("#productList").val(JSON.stringify(productList));
}

/* list metod */
function listMethods() {
    var methodsList = "";
    if ($("#newPaymentMethod").val() == "Efectivo") {
        $("#listMethodPayment").val("Efectivo");
    } else {
        $("#listMethodPayment").val($("#newPaymentMethod").val() + "-" + $("#newCodeTransaction").val());
    }
}

/* boton editar venta */
$(".btnEditSale").click(function() {
    var idSale = $(this).attr("idSale");
    window.location = "index.php?ruta=edit-sales&idSale=" + idSale;

})