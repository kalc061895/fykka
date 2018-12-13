<script type="text/javascript">
    function envi_mant(id){
        if (confirm('¿Esta Seguro de Enviar a Mantenimiento esta Maquina?','Si','No')) {
            $.post("<?php echo site_url("sistema/new_mant"); ?>/"+id,function(){
            $("#maq"+id).remove();
            //$("tr#"+id+" button").attr('disabled','disabled');
            //$("tr#"+id+" button").text('Enviado');
            });        
        }
    }
</script>

<div class="row"></div>
                <!-- VISION -->
                <div class="row">
                <?php 
                    $clase = array('warning','success','danger');
                    if ($maqu_man!=null): ?>
                    <div class="col-lg-8">
                    <h2 class="page-header">Maquinas para Mantenimiento</h2>
                           <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-warning"></i> Estas Maquinas Necesitan Cambio de Aceite</h3>
                            </div>
                            <div class="panel-body" id="maqu_man">
                                
                                     <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="warning">
                                        <th>Maquina:<br><small><i> Descripcion, Código Minag, Ubicación</i></small></th>
                                        <th>Hrm. Actual</th>
                                        <th>Faltan</th>
                                        <th>Enviar a<br>Taller</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($maqu_man as $row): ?>    
                                    <tr id="maq<?php echo $row->maqu_ide; ?>">
                                        <td><?php echo $row->nom_maqu; ?></td>
                                        <td><?php echo $row->horo_act; ?></td>
                                        <td><?php echo $row->horo_falta; ?> Hrs</td>
                                        <td><button class="btn btn-danger btn-sm" onclick="envi_mant('<?php echo $row->maqu_ide; ?>')">Enviar <i class="fa fa-arrow-right"></i></button></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                            <div class="text-right">
                                <a class="opcion" href="<?php echo site_url('sistema/oper_camb_acei'); ?>">Ver Todas las Maquinas <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                            </div>
                        </div>             
                    </div>
         <?php endif ?> 

                    <div class="col-lg-4">
                        <h2 class="page-header text-center">Insumos en Escaces</h2>
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-dropper"></i> Insumos y repuestos por agotarse</h3>
                            </div>
                            <div class="panel-body" id="insu_man">
                                <?php 
                                $clase = array('warning','success','danger');

                                if ($insumos!=null): ?>
                                     <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr class="active">
                                        <th>Insumo</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($insumos as $row): ?>    
                                    <tr >
                                        <td><?php echo $row->nombre; ?></td>
                                        <td><?php echo $row->stock; ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                                 <?php endif ?> 
                            <div class="text-right">
                                <a class="opcion" href="<?php echo site_url('sistema/gest_insu'); ?>">Ver Detalles <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <!-- /.row -->

            
                
                    