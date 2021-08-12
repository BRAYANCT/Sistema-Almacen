<div class="content-wrapper coloraside1">

  <section class="content-header">

    <h1>

      Administrar Productos

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>
  <br>
  <section class="content">

    <div class="box" style="color:#000">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregateProduct">

          Agregar producto

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tableProducts" style="color:#000;text-align: center" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Agregado</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <!--  <tbody> -->
          <?php
          /*  $item=null;
      $valor=null;
      $products=controllerProducts::ctrShowProducts($item,$valor);
      foreach($products as $key=>$value){
        echo'
        <tr>
        <td>'.($key+1).'</td>
        <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px"></td>
        <td>'.$value['code'].'</td>
        <td>'.$value['description'].'</td>';
        $item="id";
        $valor=$value["id_category"];
        $category=controllerCategory::ctrShowCategories($item,$valor);

        echo'<td>'.$category['category'].'</td>
        <td>'.$value['stock'].'</td>
        <td>'.$value['price_Purchase'].'</td>
        <td>'.$value['price_Sale'].'</td>
        <td>'.$value['date'].'</td>
        <td>

          <div class="btn-group">
              
            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

            <button class="btn btn-danger"><i class="fa fa-times"></i></button>

          </div>  

        </td>

      </tr>
        ';
      } */
          ?>


          <!--    </tbody> -->

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregateProduct" class="modal fade" role="dialog" style="color:#000">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
    CABEZA DEL MODAL
    ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
    CUERPO DEL MODAL
    ======================================-->

        <div class="modal-body">

          <div class="box-body">
            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="newCategory" name="newCategory" style="color:#000;" required>

                  <option value="">Selecionar categoría</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $categories = controllerCategory::ctrShowCategories($item, $valor);
                  foreach ($categories as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["category"] . '</option>';
                  }
                  ?>

                </select>

              </div>

            </div>
            <!-- ENTRADA PARA EL CÓDIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" name="newCode" id="newCode" placeholder="Ingresar código" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="newDescription" name="newDescription" placeholder="Ingresar descripción" required>

              </div>

            </div>



            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" id="newStock" name="newStock" min="0" placeholder="Stock" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" min="0" step="any" id="newPricePurchase" name="newPricePurchase" min="0" placeholder="Precio de compra" required>

                </div>

              </div>

              <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" min="0" step="any" id="newPriceSale" name="newPriceSale" min="0" placeholder="Precio de venta" required>

                </div>

                <br>

                <!-- CHECKBOX PARA PORCENTAJE -->

                <div class="col-xs-6">

                  <div class="form-group">

                    <label>

                      <input type="checkbox" class="minimal percentage" checked>
                      Utilizar procentaje
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">

                  <div class="input-group">

                    <input type="number" class="form-control input-lg newPercentage " min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" id="newPicture" class="newPicture" name="newPicture">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="views/img/products/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
        </div>
        <?php
        $createProduct = new controllerProducts();
        $createProduct->ctrCreateProduct();
        ?>
      </form>

    </div>

  </div>

</div>

<div id="modalEditProduct" class="modal fade" role="dialog">

  <div class="modal-dialog" style="color:#000">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="editCategory" readonly required>

                  <option id="editCategory"></option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editCode" name="editCode" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="editDescription" name="editDescription" required>

              </div>

            </div>

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" id="editStock" name="editStock" min="0" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group row">

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="editPricePurchase" name="editPricePurchase" step="any" min="0" required>

                </div>

              </div>

              <!-- ENTRADA PARA PRECIO VENTA -->

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="editPriceSale" name="editPriceSale" step="any" min="0" readonly required>

                </div>

                <br>

                <!-- CHECKBOX PARA PORCENTAJE -->

                <div class="col-xs-6">

                  <div class="form-group">

                    <label>

                      <input type="checkbox" class="minimal percentage" checked>
                      Utilizar procentaje
                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA PORCENTAJE -->

                <div class="col-xs-6" style="padding:0">

                  <div class="input-group">

                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="newPicture" name="editPicture">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="views/img/products/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="pictureCurrent" id="pictureCurrent">

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

      </form>

      <?php

      $editProduct = new controllerProducts();
      $editProduct->ctrEditProduct();

      ?>

    </div>

  </div>

</div>
<?php

$deleteProduct = new controllerProducts();
$deleteProduct->ctrDeleteProduct();

?>