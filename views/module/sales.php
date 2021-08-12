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

    <div class="box">

      <div class="box-header with-border">

        <a href="create-sales">

          <button class="btn btn-primary">

            Agregar venta

          </button>

        </a>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%" style="color:#000">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Código factura</th>
              <th>Cliente</th>
              <th>Vendedor</th>
              <th>Forma de pago</th>
              <th>Neto</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $respuesta = controllerSales::ctrShowSales($item, $valor);

            foreach ($respuesta as $key => $value) {


              echo '<tr>

              <td>' . ($key + 1) . '</td>

              <td>' . $value["code"] . '</td>';

              $itemClient = "id";
              $valorClient = $value["id_client"];

              $respuestaCliente = controllerCustomers::ctrShowCustomers($itemClient, $valorClient);

              echo '<td>' . $respuestaCliente["name"] . '</td>';

              $itemUser = "id";
              $valorUser = $value["id_seller"];

              $respUser = controllerUsers::ctrShowUsers($itemUser, $valorUser);

              echo '<td>' . $respUser["name"] . '</td>

              <td>' . $value["payment_method"] . '</td>

              <td>S/. ' . number_format($value["net"], 2) . '</td>

              <td>S/. ' . number_format($value["total"], 2) . '</td>

              <td>' . $value["date"] . '</td>

              <td>

                <div class="btn-group">
                    
                  <button class="btn btn-info"><i class="fa fa-print"></i></button>

                  <button class="btn btn-warning btnEditSale" idSale="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btnDeleteSale" idSale="' . $value["id"] . '"><i class="fa fa-times"></i></button>

                </div>  

              </td>

            </tr>';
            }

            ?>

          </tbody>

        </table>

        <?php

   /*      $eliminarVenta = new ControladorVentas();
        $eliminarVenta->ctrEliminarVenta(); */

        ?>


      </div>

    </div>

  </section>

</div>