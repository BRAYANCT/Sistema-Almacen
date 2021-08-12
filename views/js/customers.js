/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditClient", function() {

    var idClient = $(this).attr("idClient");

    var datos = new FormData();
    datos.append("idClient", idClient);

    $.ajax({
        url: "ajax/customers.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            /* console.log(respuesta); */
            $("#idClient").val(respuesta["id"]);
            $("#editClient").val(respuesta["name"]);
            $("#editDocumentId").val(respuesta["document"]);
            $("#editEmail").val(respuesta["email"]);
            $("#editPhone").val(respuesta["phone"]);
            $("#editDirection").val(respuesta["direction"]);
            $("#editBirthDate").val(respuesta["birth_Date"]);
        }

    })

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnDeleteClient", function() {

    var idClient = $(this).attr("idClient");

    swal({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
    }).then(function(result) {
        if (result.value) {

            window.location = "index.php?ruta=customers&idClient=" + idClient;
        }

    })

})