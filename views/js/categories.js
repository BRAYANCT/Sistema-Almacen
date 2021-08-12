/* editar categoria */
$(".tablas").on("click", ".btnEditCategory", function() {
    var idCategory = $(this).attr("idCategory");
    var datos = new FormData();
    datos.append("idCategory", idCategory);

    $.ajax({
        url: "ajax/category.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#editCategory").val(respuesta["category"]);
            $("#idCategory").val(respuesta["id"]);
        }
    })
})

/* eliminar */
$(".tablas").on("click", ".btnDeleteCategory", function() {
    var idCategory = $(this).attr("idCategory");
    swal({
        title: '¿Está seguro de borrar la categoría?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar categoría!'
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=categories&idCategory=" + idCategory;
        }
    })
})