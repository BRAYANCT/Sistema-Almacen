    <?php

    session_start();

    ?>

    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema | Inventario</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" href="views/img/template/icono-negro.png">
        <!--=====================================
        PLUGINS DE CSS
        ======================================-->
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="views/css/style.css">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- DataTables -->
        <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="views/plugins/iCheck/all.css">
        <!--=====================================
        PLUGINS DE JAVASCRIPT
        ======================================-->
        <!-- jQuery 3 -->
        <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="views/dist/js/adminlte.min.js"></script>

        <!-- DataTables -->
        <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
        <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

        <!-- SweetAlert 2 -->
        <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
        <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="views/plugins/iCheck/icheck.min.js"></script>
        <!-- InputMask -->
        <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- jQuery Number -->
        <script src="views/plugins/jqueryNumber/jquerynumber.min.js"></script>

    </head>

    <body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page cabecero">
        <!--=====================================
        CUERPO DOCUMENTO
        ======================================-->
        <?php
        if (isset($_SESSION["startLogin"]) && $_SESSION["startLogin"] == "ok") {
            echo '<div class="wrapper">';
            /*=============================================
            CABEZOTE
            =============================================*/
            include "module/stubborn.php";
            /*=============================================
            MENU
            =============================================*/
            include "module/menu.php";
            /*=============================================
            CONTENIDO
            =============================================*/
            if (isset($_GET["ruta"])) {
                if (
                    $_GET["ruta"] == "home" ||
                    $_GET["ruta"] == "users" ||
                    $_GET["ruta"] == "categories" ||
                    $_GET["ruta"] == "products" ||
                    $_GET["ruta"] == "customers" ||
                    $_GET["ruta"] == "sales" ||
                    $_GET["ruta"] == "create-sales" ||
                    $_GET["ruta"] == "edit-sales" ||
                    $_GET["ruta"] == "reports" ||
                    $_GET["ruta"] == "exit"
                ) {
                    include "module/" . $_GET["ruta"] . ".php";
                } else {
                    include "module/404.php";
                }
            } else {
                include "module/home.php";
            }
            /*=============================================
            FOOTER
            =============================================*/
            include "module/footer.php";
            echo '</div>';
        } else {
            include "module/login.php";
        }
        ?>
        <script src="views/js/template.js"></script>
        <script src="views/js/users.js"></script>
        <script src="views/js/categories.js"></script>
        <script src="views/js/product.js"></script>
        <script src="views/js/customers.js"></script>
        <script src="views/js/sales.js"></script>

    </body>

    </html>