<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
Plantilla::apply();
?>

<div class="container-fluid">
	<div class="box">
		<!-- Dropdown menu with user -->
		<div class="clearfix">
			<div class="float-right">
				<div class="dropdown">
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
		</div>
		<div class="row">
			<h1 class="mx-auto">Ferretería Peña</h1>
		</div>
		<div class="row">
			<h2 class="mx-auto">Acciones</h2>
		</div>
		<div class="inline-actions">
			<a class="action" href="<?= base_url('inventario/add') ?>">
				<span>Agregar al inventario</span>
			</a>
			<a class="action" href="<?= base_url('inventario/view') ?>">
				<span>Facturacion</span>
			</a>
			<a class="action" href="<?= base_url('suplidores/view') ?>">
				<span>Suplidores</span>
			</a>
		</div>
		<br><br>
				<table id="facturas" class="table" style="border-collapse: collapse !important;">
			<thead>
				<tr>
					<th colspan="8" style="background-color: #30BF24; font-size: 24px;">Historial de facturas</th>
				</tr>
				<tr style="background-color: #DDD;">
					<th>ID de Factura</th>
					<th>Codigo de cliente</th>
					<th>Fecha</th>
					<th>Total de factura</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($facturas as $items): ?>
					<tr>
						<td><?= $items->id ?></td>
						<td><?= $items->codigo_cliente ?></td>
						<td><?= $items->fecha_facturacion ?></td>
						<td><?= $items->total ?></td>
						<td>
							<a href="<?= base_url('facturacion/verF/'. $items->id) ?>" class="btn btn-outline-primary"><i class="fas fa-eye"></i></a>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr style="background-color: #DDD;">
					<th>ID de Factura</th>
					<th>Codigo de cliente</th>
					<th>Fecha</th>
					<th>Total de factura</th>
					<th>Acciones</th>
				</tr>				
			</tfoot>
		</table>
		<br>
		<form method="POST" action="<?= base_url('usuarios/logout') ?>">
			<input type="hidden" name="logout" value="logout">
			<button onclick="return confirm('Desea cerrar sesión?')" class="btn btn-danger">Salir</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	    $('#facturas').DataTable({
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