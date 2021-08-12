<div class="content-wrapper coloraside1">

  <section class="content-header">

    <h1>

      Administrar Usuarios

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>
  <br>
  <!-- Main content -->
  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar usuario

        </button>

      </div>

      <div class="box-body" style="color:#000">

        <table class="table table-bordered table-striped dt-responsive tablas" style="color:#000;text-align: center" width="100%">

          <thead>

            <tr>

              <th style="width:10px;color:#000;text-align: center">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Último login</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>
            <?php
            $item = null;
            $valor = null;

            $users = controllerUsers::ctrShowUsers($item, $valor);

            foreach ($users as $key => $value) {
              echo ' <tr>
                  <td>'.($key + 1).'</td>
                  <td>' . $value["name"] . '</td>
                  <td>' . $value["user"] . '</td>';
              if ($value["picture"] != "") {
                echo '<td><img src="' . $value["picture"] . '" class="img-thumbnail" width="40px"></td>';
              } else {
                echo '<td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
              }
              echo '<td>' . $value["profile"] . '</td>';
              if ($value["state"] != 0) {

                echo '<td><button class="btn btn-success btn-xs btnActivate" idUser="' . $value["id"] . '" stateUser="0">Activado</button></td>';
              } else {

                echo '<td><button class="btn btn-danger btn-xs btnActivate" idUser="' . $value["id"] . '" stateUser="1">Desactivado</button></td>';
              }
              /* ultimo login */
              echo '<td>' . $value["last_login"] . '</td>

                  <td>

                    <div class="btn-group containerDanger">
                        
                      <button class="btn btn-warning btnEditUser" idUser="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditUser"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnDeleteUser" idUser="' . $value["id"] . '" pictureUser="' . $value["picture"] . '" user="' . $value["user"] . '"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
            }
            ?>




          </tbody>

        </table>

      </div>

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog" style="color: #000;">

  <div class="modal-dialog ">

    <div class="modal-content ">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="newName" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="newUser" placeholder="Ingresar usuario" id="newUser" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="newPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="newProfile">

                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="newPicture" name="newPicture">

              <p class="help-block" style="color: #000;">Peso máximo de la foto 200 MB</p>

              <img src="views/img/users/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>
        <?php
        $createUser = new ControllerUsers();
        $createUser->ctrCreateUser();
        ?>
      </form>

    </div>

  </div>

</div>
<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditUser" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editName" name="editName" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" id="editUser" name="editUser" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="editPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordCurrent" name="passwordCurrent">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editProfile">

                  <option value="" id="editProfile"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group" style="color:#000">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="newPicture" name="editPicture">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="views/img/users/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="pictureCurrent" id="pictureCurrent">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

        <?php


        $editUser = new ControllerUsers();
        $editUser->ctrEditUser();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$deleteUser = new ControllerUsers();
$deleteUser->ctrDeleteUser();

?>