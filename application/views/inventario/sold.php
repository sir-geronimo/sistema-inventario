<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Plantilla::apply();
$CI =& get_instance();
?>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#articulos_vendidos').DataTable({
	    	"language": {
	    		"search" : "Buscar:",
	    		"info" : "Mostrando _START_ a _END_ de _TOTAL_ articulos",
	    		"infoEmpty": "Mostrando 0 a 0 de 0 articulos",
	    		"zeroRecords":    "No se encontraron registros coincidentes",
	    		"lengthMenu":     "Mostrar _MENU_ articulos",
	    		"paginate": {
			        "first":      "Primero",
			        "last":       "Ultimo",
			        "next":       "Siguiente",
			        "previous":   "Anterior"
			    },
	    	}
	    });
	} );
</script>

<div class="container-fluid">
	<div class="box">
		<div class="action-button clearfix">
			<a href="<?= base_url('inicio/home') ?>" class="btn btn-secondary">< Volver</a>
			<a href="<?= base_url('inventario/view') ?>" class="btn btn-success">< Articulos</a>
			<a href="<?= base_url('inventario/purchased') ?>" class="btn btn-warning">Articulos comprados ></a>
			<!-- Dropdown menu with user -->
			<div class="btn-group float-right">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <?= $CI->session->usuario ?>
				</button>
				<div class="dropdown-menu">
					<form method="POST" action="<?= base_url('usuarios/logout') ?>">
						<input type="hidden" name="logout" value="logout">
						<button class="dropdown-item" onclick="return confirm('Desea cerrar sesión?')">Salir</button>
					</form>
				</div>
			</div>
		</div>
		<h1 class="text-center">Ferretería Peña</h1>
		<?php if($articulos_vendidos): ?>
		<table id="articulos_vendidos" class="table" style="border-collapse: collapse !important;">
			<thead>
				<tr>
					<th colspan="8" style="background-color: #30BF24; font-size: 24px;">Articulos Vendidos</th>
				</tr>
				<tr>
					<th class="stock">ID del Articulo</th>
					<th class="stock">Nombre</th>
					<th class="stock">Fecha de venta</th>
					<th class="stock">Cantidad vendida</th>
					<th class="stock">Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($articulos_vendidos as $articulo): ?>
					<tr>
						<td><?= $articulo->id_articulo ?></td>
						<td><?= $articulo->nombre ?></td>
						<td><?= $articulo->fecha_venta ?></td>
						<td><?= $articulo->cantidad ?></td>
						<td><?= $retVal = ($articulo->pagado > 0) ? "Pagado" : "<a href='pagar/".$articulo->id."' class='btn btn-success'>Pagar</a>" ;?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<th class="stock">ID del Articulo</th>
					<th class="stock">Nombre</th>
					<th class="stock">Fecha de venta</th>
					<th class="stock">Cantidad vendida</th>
				    <th class="stock">Estado</th>
				</tr>				
			</tfoot>
		</table>
		<div class="text-center"><b>Total articulos: <?= count($articulos_vendidos) ?></b></div>
		<?php endif;?>
	</div>
</div>