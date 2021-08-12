<!-- categorias -->
<div class="content-wrapper coloraside1">

  <section class="content-header">

    <h1>

      Administrar Categoria

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

    <div class="box" style="color:#000;">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregateCategory">

          Agregar categoría

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" style="color:#000;text-align: center" width="100%">

          <thead>

            <tr>

              <th style="width:10px;color:#000;">#</th>
              <th>Categoria</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>
            <?php
            $item = null;
            $valor = null;
            $categories = controllerCategory::ctrShowCategories($item, $valor);
            foreach ($categories as $key => $value) {
              echo ' <tr>
                    <td>' . ($key + 1) . '</td>
                    <td class="text-uppercase">' . $value["category"] . '</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditCategory" idCategory="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditCategory"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnDeleteCategory" idCategory="' . $value["id"] . '"><i class="fa fa-times"></i></button>
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

<!-- modal usuarios -->
<div id="modalAgregateCategory" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="newCategory" placeholder="Ingresar categoría" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar categoría</button>

        </div>
        <?php
        $createCategory = new controllerCategory();
        $createCategory->ctrCreateCategory();
        ?>

      </form>

    </div>

  </div>

</div>

<!-- eliminar category -->
<div id="modalEditCategory" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editCategory" id="editCategory" required>

                <input type="hidden" name="idCategory" id="idCategory" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

        $editCategory = new controllerCategory();
        $editCategory->ctrEditCategory();

        ?>

      </form>

    </div>

  </div>

</div>
<?php
$deleteCategory = new controllerCategory();
$deleteCategory->ctrDeleteCategory();
?>