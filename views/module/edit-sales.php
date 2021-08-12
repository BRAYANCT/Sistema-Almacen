<div class="content-wrapper coloraside1">

  <section class="content-header">

    <h1>

      Ventas

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>
  <br>
  <section class="content">

    <div class="row">

      <!--=====================================
  EL FORMULARIO
  ======================================-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formSale">

            <div class="box-body" style="color:#000">

              <div class="box">
                <?php

                $item = "id";
                $valor = $_GET["idSale"];
                $sale = controllerSales::ctrShowSales($item, $valor);
             
                $itemUser = "id";
                $valueUser = $sale["id_seller"];
                $seller = controllerUsers::ctrShowUsers($itemUser, $valueUser);

                $itemClient = "id";
                $valueClient = $sale["id_client"];

                $client = controllerCustomers::ctrShowCustomers($itemClient, $valueClient);

                $taxPercentage = $sale["tax"] * 100 / $sale["net"];


                ?>
                <!--=====================================
                    ENTRADA DEL VENDEDOR
                  ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="newSeller" name="newSeller" value="<?php echo $seller['name'] ?>" readonly>
                    <input type="hidden" name="idSeller" value="<?php echo $seller['id'] ?>">
                  </div>

                </div>

                <!--=====================================
                    ENTRADA DEL VENDEDOR
                  ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <input type="text" class="form-control" id="newSale" name="editSale" value="<?php echo $sale['code'] ?>" readonly>

                  </div>

                </div>

                <!--=====================================
                  ENTRADA DEL CLIENTE
                  ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control" id="selectClient" name="selectClient" required>

                      <option value="<?php echo $client['id'] ?>"><?php echo $client['name'] ?></option>
                      <?php
                      $item = null;
                      $valor = null;
                      $customers = controllerCustomers::ctrShowCustomers($item, $valor);
                      foreach ($customers as $key => $value) {
                        echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                      }
                      ?>
                    </select>
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddClient" data-dismiss="modal">Agregar cliente</button></span>
                  </div>
                </div>
                <!--=====================================
                  ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->
                <!-- Descripción del producto -->
                <div class="col-xs-6">
                  <span style="text-align: center;">Descripcion</span>
                </div>
                <div class="col-xs-3">
                  <span style="text-align: center;">Stock</span>
                </div>
                <div class="col-xs-3">
                  <span style="text-align: center;">Precio</span>
                </div>
                <hr>
                <!-- nuevo producto -->
                <div class="form-group row newProduct">
                      <?php
                        $listProduct=json_decode($sale["products"], true);
                     
                        foreach ($listProduct as $key => $value) {

                          $item = "id";
                          $valor = $value["id"];
        
                          $respuesta = controllerProducts::ctrShowProducts($item, $valor);
 
                          $stockAntiguo = $respuesta["stock"] + $value["amount"];

                          echo'
                          <div class="row" style="padding:5px 15px">
                         
                          <div class="col-xs-6" style="padding-right:0px">
                          <div class="input-group">
                          <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="' .$value["id"]. '"><i class="fa fa-times"></i></button></span>
                          <input type="text" class="form-control newProductDescription addProduct" idProduct="' .$value["id"]. '" name="addProduct" value="' .$value["desciption"]. ' " readonly required>
                          </div>
                          </div>
                         
                          <div class="col-xs-3" >
                          <input type="number" class="form-control newQuantityProduct" name="newQuantityProduct" max="' .$value["stock"]. '" min="1" value="'.$value["amount"].'" stock="' .$stockAntiguo.'" newStock="'  .$value["stock"]. '" required>
                          </div>
                        
                          <div class="col-xs-3 incomeAmount" style="padding-left:0px">
                          <div class="input-group">
                          <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                          <input type="text" class="form-control newPriceProduct" realPrice=" '.$respuesta["price_Sale"].'" name="newPriceProduct" value="'.$value["price"].'"  readonly required>
                          </div>
                          </div>
                          </div>'
                          
                          ;
                        }
                      ?>
                </div>
                <!-- lista producto -->
                <input type="hidden" id="productList" name="productList">

                <!--=====================================
            BOTÓN PARA AGREGAR PRODUCTO
            ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregateProduct">Agregar producto</button>

                <hr>
                <div class="row">

                  <!--=====================================
              ENTRADA IMPUESTOS Y TOTAL
              ======================================-->

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td style="width: 50%">

                            <div class="input-group">

                              <input type="number" class="form-control input-lg" min="0" id="newSalesTax" name="newSalesTax" value="<?php echo $taxPercentage?>" required readonly>

                              <input type="hidden" name="newPriceTax" id="newPriceTax" value="<?php echo $sale["net"]?>"required>

                              <input type="hidden" name="newNetPrice" id="newNetPrice" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="newTotalSales" name="newTotalSales" total="" value="<?php echo $sale["net"]?>" readonly required>

                              <input type="hidden" name="totalSale" value="<?php echo $sale["total"]?>" id="totalSale">

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                  ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">

                  <div class="col-xs-6" style="padding-right:0px">

                    <div class="input-group">

                      <select class="form-control" id="newPaymentMethod" name="newPaymentMethod" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>
                      </select>

                    </div>

                  </div>
                  <div class="boxesMethodPayment"></div>
                  <input type="hidden" id="listMethodPayment" name="listMethodPayment">

                </div>

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

            </div>

          </form>
          <?php
          $editSales = new controllerSales();
          $editSales->ctrCreateSales();
          ?>

        </div>

      </div>

      <!--=====================================
  LA TABLA DE PRODUCTOS
  ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning" style="color:#000">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive  tableSales">

              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAddClient" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

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

                <input type="text" class="form-control input-lg" name="newClient" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="newDocumentId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="newEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="newPhone" placeholder="Ingresar teléfono" data-inputmask="'mask':'(51) 999-999-999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="newDirection" placeholder="Ingresar dirección" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="newBirthDate" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>
      <?php
      $createCliente = new controllerCustomers();
      $createCliente->ctrCreateClient();
      ?>

    </div>

  </div>

</div>