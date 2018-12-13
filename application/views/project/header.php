<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fykka - SCRUM tracking</title>
    <link rel="shortcut icon" href="<?php echo site_url('img/code.png');?>">

    <link href="<?php echo site_url('bootstrap/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('bootstrap/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('bootstrap/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('bootstrap/css/sb-admin.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('js/jtable/themes/metro/green/jtable.css');?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo site_url('bootstrap/vendor/jquery/jquery.js');?>"></script>
    
	
	<script type="text/javascript" src="<?php echo site_url("js/general.js"); ?>"></script>
    <script type="text/javascript">

		$(document).ready(function(){
			$(".opcion").click(function(e){
				e.preventDefault();
				loading('open');
				url=$(this).attr("href");
				$.post(url,function(data){
					$("#kev").html(data);
					loading('close');
				});
				
			});
					
		});			
	</script>
  </head>
  <body class="page-top	">
  	<div class="modal fade out" id="modalLoad" data-backdrop="static"   data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="false" style="padding-top:10%;display:none;">
            <div class="modal-dialog modal-sm  text-center">
    		                <i class="fas fa-spinner fa-inverse fa-2x fa-spin"></i><br>
	        		<h4 style="color: white;">Cargando...</h4>
                </div>
        </div>
    
  	<div id="kev"></div>



	
