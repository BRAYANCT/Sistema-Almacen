/* subir img */
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

/* editar usuario */
$(document).on("click", ".btnEditUser", function() {
    var idUser = $(this).attr("idUser");
    var datos = new FormData();
    datos.append("idUser", idUser);
    $.ajax({
        url: "ajax/users.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#editName").val(respuesta["name"]);
            $("#editUser").val(respuesta["user"]);
            $("#editProfile").html(respuesta["profile"]);
            $("#editProfile").val(respuesta["profile"]);
            $("#pictureCurrent").val(respuesta["picture"]);
            $("#passwordCurrent").val(respuesta["password"]);
            if (respuesta["picture"] != "") {
                $(".previsualizar").attr("src", respuesta["picture"]);
            }
        }
    });
})

/*ACTIVAR USUARIO*/
$(document).on("click", ".btnActivate", function() {
    var idUser = $(this).attr("idUser");
    var stateUser = $(this).attr("stateUser");
    var datos = new FormData();
    datos.append("activateId", idUser);
    datos.append("activateUser", stateUser);
    $.ajax({
        url: "ajax/users.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            if (window.matchMedia("(max-width:767px)").matches) {
                swal({
                    title: "El usuario ha sido actualizado",
                    type: "success",
                    confirmButtonText: "¡Cerrar!"
                }).then(function(result) {
                    if (result.value) {
                        window.location = "users";
                    }
                });
            }
        }
    })
    if (stateUser == 0) {

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('stateUser', 1);

    } else {

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('stateUser', 0);

    }

})

/* user repet register */
$("#newUser").change(function() {
    $(".alert").remove();
    var user = $(this).val();
    var datos = new FormData();
    datos.append("validateUser", user);

    $.ajax({
        url: "ajax/users.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta);
            if (respuesta) {

                $("#newUser").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

                $("#newUser").val("");

            }

        }

    })
})

/* delete users */
$(document).on("click", ".btnDeleteUser", function() {

    var idUser = $(this).attr("idUser");
    var pictureUser = $(this).attr("pictureUser");
    var user = $(this).attr("user");

    swal({
        title: '¿Está seguro de borrar el usuario?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    }).then(function(result) {
        if (result.value) {
            window.location = "index.php?ruta=users&idUser=" + idUser + "&user=" + user + "&pictureUser=" + pictureUser;
        }
    })
})