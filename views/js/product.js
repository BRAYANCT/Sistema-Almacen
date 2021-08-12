$('.tableProducts').DataTable({
    "ajax": "ajax/datatable-products.ajax.php",
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

/*capture category and code asignate  */
$("#newCategory").change(function() {
    var idCategory = $(this).val();
    var datos = new FormData();
    datos.append("idCategory", idCategory);
    $.ajax({
        url: "ajax/products.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (!respuesta) {
                var newCode = idCategory + "01";
                $("#newCode").val(newCode);
            } else {
                var newCode = Number(respuesta["code"]) + 1;
                $("#newCode").val(newCode);
            }
        }
    })
})

/* agregate price Purchase  newPercentage  newPricePurchase*/
$("#newPricePurchase, #editPricePurchase").change(function() {
    if ($(".percentage").prop("checked")) {
        var valPercentage = $(".newPercentage").val();
        var percentage = Number(($("#newPricePurchase").val() * valPercentage / 100)) + Number($("#newPricePurchase").val());
        var editPercentage = Number(($("#editPricePurchase").val() * valPercentage / 100)) + Number($("#editPricePurchase").val());
        $("#newPriceSale").val(percentage);
        $("#newPriceSale").prop("readonly", true);
        $("#editPriceSale").val(editPercentage);
        $("#editPriceSale").prop("readonly", true);
    }
})

/* cambio de porcentaje */
$(".newPercentage").change(function() {
    if ($(".percentage").prop("checked")) {
        var valPercentage = $(this).val();
        var percentage = Number(($("#newPricePurchase").val() * valPercentage / 100)) + Number($("#newPricePurchase").val());
        var editPercentage = Number(($("#editPricePurchase").val() * valPercentage / 100)) + Number($("#editPricePurchase").val());
        $("#newPriceSale").val(percentage);
        $("#newPriceSale").prop("readonly", true);
        $("#editPriceSale").val(editPercentage);
        $("#editPriceSale").prop("readonly", true);
    }
})
$(".percentage").on("ifUnchecked", function() {
    $("#newPriceSale").prop("readonly", false);
    $("#editPriceSale").prop("readonly", false);
})
$(".percentage").on("ifChecked", function() {
    $("#newPriceSale").prop("readonly", true);
    $("#editPriceSale").prop("readonly", true);
})

/* subir img en prodcuts */
$('.newPicture').change(function() {
    var picture = this.files[0];
    /* format de img */
    if (picture["type"] != "image/jpeg" && picture["type"] != "image/png") {
        $(".newPicture").val("");
        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else if (picture["size"] > 2000000) {

        $(".newPicture").val("");

        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosPicture = new FileReader;
        datosPicture.readAsDataURL(picture);

        $(datosPicture).on("load", function(event) {

            var rutaPicture = event.target.result;

            $(".previsualizar").attr("src", rutaPicture);

        })

    }
})

/* edit products */

$('.tableProducts tbody').on("click", "button.btnEditProducts", function() {
        var idProducts = $(this).attr("idProducts");
        var datos = new FormData();
        datos.append("idProducts", idProducts);

        $.ajax({

            url: "ajax/products.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                var datosCategy = new FormData();
                datosCategy.append("idCategory", respuesta["id_category"]);
                $.ajax({

                    url: "ajax/category.ajax.php",
                    method: "POST",
                    data: datosCategy,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(respuesta) {

                        $("#editCategory").val(respuesta["id"]);
                        $("#editCategory").html(respuesta["category"]);
                    }
                })
                $("#editCode").val(respuesta["code"]);
                $("#editDescription").val(respuesta["description"]);
                $("#editStock").val(respuesta["stock"]);
                $("#editPricePurchase").val(respuesta["price_Purchase"]);
                $("#editPriceSale").val(respuesta["price_Sale"]);
                if (respuesta["picture"] != "") {
                    $("#pictureCurrent").val(respuesta["picture"]);
                    $(".previsualizar").attr("src", respuesta["picture"]);
                }
            }
        })
    })
    /* delete prodcuts */
$('.tableProducts tbody').on("click", "button.btnDeleteProduct", function() {

    var idProduct = $(this).attr("idProduct");
    var code = $(this).attr("code");
    var picture = $(this).attr("picture");

    swal({

        title: '¿Está seguro de borrar el producto?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
    }).then(function(result) {
        if (result.value) {

            window.location = "index.php?ruta=products&idProduct=" + idProduct + "&picture=" + picture + "&code=" + code;

        }
    })
})