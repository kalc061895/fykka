<?php 
if ($this->session->userdata("datos")==", ") {
 ?>
<link href="<?php echo site_url('bootstrap/fileupload/fileinput.css'); ?>" media="all" rel="stylesheet" type="text/css">
<script src="<?php echo site_url('bootstrap/fileupload/fileinput.min.js'); ?>" type="text/javascript"></script>
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Terminar Registro</div>
        <div class="card-body">
          <form method="post"  action="<?php echo site_url('sistema/actualizar_usuario'); ?>">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="firstName" class="form-control" placeholder="nombres completos" required="required" autofocus="autofocus" name="usu_nombre">
                    <label for="firstName">Nombres</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" class="form-control" placeholder="Last name" required="required" name="usu_apellidos">
                    <label for="lastName">Apellidos</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" id="tipo" name="usu_profesion">
                        <option >Tu actividad principal es...</option>
                        <option value="Analista">Analista</option>
                        <option value="Diseñador">Diseñador</option>
                        <option value="Tester">Tester</option>
                        <option value="Product Owner">Product Owner</option>
                        <option value="Base de Datos">Diseñadores de base de datos</option>
                        <option value="Scrum Master">Scrum Master</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" name="usu_nivel" placeholder="otra cosa">
                        <option>Tu nivel de Experiencia es...</option>
                        <option value="JUNIOR">JUNIOR</option>
                        <option value="MASTER">MASTER</option>
                        <option value="SENIOR">SENIOR</option>
                    </select>
                  </div>
                </div>
              </div>
               <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <select class="form-control" name="usu_tipo">
                        
                        <option selected="">Elije tu tipo de Usuario...</option>
                        <option value="SUPER USUARIO">SUPER USUARIO</option>
                        <option value="USUARIO SIMPLE" >USUARIO SIMPLE</option>
                    </select>
                  </div>
                </div>
                <!--div class="col-md-6">
                  <div class="form-group">
                      <input id="input-b3" name="input-b3[]" type="file" class="file" multiple 
                          data-show-upload="false" data-show-caption="true" placeholder="Selecciona tu foto..." data-msg-placeholder="Select {files} for upload...">
                  </div>
                </div-->

                
              </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block" id="btnIngresar" title="Ingresar">Continuar... <i class="fas fa-arrow-right fa-fw"></i></button>             
            
          </div>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo site_url(''); ?>">Iniciar Sesión</a>
            <a class="d-block small" href="#">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

 <?php 
} else {
  redirect(site_url(""));
}
?>