<div id="back"></div>

<div class="login-box">
  
  <div class="login-logo">

    <img src="views/img/template/logo-blanco-bloque.png" class="img-responsive" style="padding:30px 100px 0px 100px">

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUser" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      
      </div>

      <div class="row btn-login">
       
        <div class="col-xs-12">

          <button type="submit" class="btn btn-primary btn-block btn-flat ">Ingresar</button>
        
        </div>

      </div>

      <?php

        $login = new controllerUsers();
        $login -> ctrStartUser();
        
      ?>

    </form>

  </div>

</div>
