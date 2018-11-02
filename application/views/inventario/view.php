<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
Plantilla::apply();
?>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#articulos').DataTable({
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
			<a href="<?= base_url('inventario/purchased') ?>" class="btn btn-success">Articulos comprados ></a>
			<a href="<?= base_url('inventario/sold') ?>" class="btn btn-warning">Caja ></a>
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
		<?php if($articulos): ?>
		<table id="articulos" class="table" style="border-collapse: collapse !important;">
			<thead>
				<tr>
					<th colspan="8" style="background-color: #30BF24; font-size: 24px;">Articulos</th>
				</tr>
				<tr>
					<th class="stock">ID</th>
					<th class="stock">Nombre</th>
					<th class="stock">Cantidad</th>
					<th class="stock">No. Serie</th>
					<th class="stock">Precio de venta</th>
					<th class="stock">Estante</th>
					<th class="stock">Suplidor</th>
					<th class="stock"><i class="fas fa-bars"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($articulos as $articulo): ?>
					<tr>
						<td><?= $articulo->id ?></td>
						<td><?= $articulo->nombre ?></td>
						<td class="cantidad"><?= $articulo->cantidad ?></td>
						<td><?= $articulo->num_serie ?></td>
						<td><?= $articulo->precio_venta ?>$RD c/u</td>
						<td><?= $articulo->estante ?></td>
						<td><?= $articulo->suplidor_nombre. ' ' . $articulo->suplidor_apellido ?></td>
						<td>
							<a href="<?= base_url('inventario/edit/'. $articulo->id) ?>" class="btn edit-button"><i class="fas fa-edit"></i></a>
							<!-- add modal to remove a quantity from database -->
							<button data-id="<?= $articulo->id ?>" data-toggle="modal" data-target="#sell" class="sellButton btn delete-button ">
								<i class="fas fa-dollar-sign"></i>
							</button>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<th class="stock">ID</th>
					<th class="stock">Nombre</th>
					<th class="stock">Cantidad</th>
					<th class="stock">No. Serie</th>
					<th class="stock">Precio de venta</th>
					<th class="stock">Estante</th>
					<th class="stock">Suplidor</th>
					<th class="stock"><i class="fas fa-bars"></i></th>
				</tr>				
			</tfoot>
		</table>
		<div class="text-center"><b>Total articulos: <?= count($articulos) ?></b></div>
		<!-- Modal -->
			<div role="dialog" id="sell"  tabindex="-1" role="dialog" class="modal fade">
				<div class="modal-dialog" role="document">
					<!-- Modal content -->
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Vender artículo</h2>
							<button data-dismiss="modal" type="button" class="close" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<!-- Form -->
						<form id="sellForm" method="POST" action="<?= base_url('inventario/sell') ?>">
							<div class="modal-body">
								<input type="hidden" name="sell_id" id="sell_id">
								<!-- Nombre -->
								<div class="form-group input-group">
									
									<div class="input-group-prepend">
										<label for="nombre" class="input-group-text">Nombre</label>
									</div>
									<input class="form-control" readonly name="nombre" id="nombre" type="text" required>								
								</div>
								<input style="display: none;" class="form-control" readonly name="precio" id="precio" type="text" required>
								<!-- Cantidad -->
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<label for="cantidad" class="input-group-text">Cantidad</label>
									</div>
									<input class="form-control" name="cantidad_nueva" id="cantidad_nueva" type="number" required autofocus>
								</div>
								<!-- fecha -->
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<label for="fecha_venta" class="input-group-text">Fecha de venta</label>
									</div>
									<input class="form-control" name="fecha_venta" id="fecha_venta" type="date" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
								<button type="submit" class="btn btn-danger">Enviar a caja</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	var items = <?= json_encode($articulos) ?>;
	var button = $('.sellButton');
	var now = new Date();
	var d = now.getDate();
	var m = now.getMonth()+1;
	var y = now.getFullYear();

	if(d < 10) {
		d = '0' + d;
	}
	if (m < 10) {
		m = '0' + m;
	}

	today = y + '-' + m + '-' + d;

	$('#sell').on('shown.bs.modal', function() {
		 $('#cantidad_nueva').focus();
	});	
	$('#sell').on('hidden.bs.modal', function() {
		 $('#cantidad_nueva').val('');
	});

	button.on('click', function( event ) {
		try {
			var item = items.find(function (element) {
				$('#sell_id').val(element.id);
				$('#nombre').val(element.nombre);
				$('#precio').val(element.precio_venta);
				$('#fecha_venta').val(today);
				return element.id == $(event.currentTarget).data('id')
			});

			if (item) { 
				console.log('Encontrado', item);
			} else {
				console.log('No encontrado');
			}
		} catch (e) {
			console.error(e);
		}

		$('#sellForm').on('submit', function( event ) {
			event.preventDefault();
			var cantidadNueva = item.cantidad - $('#cantidad_nueva').val();
			var form = $( this );
			var formData = form.serialize();

			if($('#cantidad_nueva').val() < 1) {
				return alert('Cantidad debe ser mayor que 0');
			}

			if(cantidadNueva < 0 ) {
				return alert ('Cantidad mayor a la existente');
			} else {
				$.post(form.attr('action'), formData)
				.done(function(res) {
					try {
						location.reload();				
					} catch(e) {
						// statements
						console.log(e);
					}
				})
				.fail(function (err) {
					console.error(err);
				});	
			}

			$('#sell').modal('toggle');
		});
	});

</script>