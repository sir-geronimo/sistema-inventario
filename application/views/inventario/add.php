<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Plantilla::apply();
$CI =& get_instance(); ?>

<div class="container-fluid">
	<div class="col col-sm-6 col-xs-3 offset-sm-3 offset-xs-3">
		<div class="box">
			<div class="text-center">
				<h1>Ferretería Peña</h1>
				<h2>Agregar artículo</h2>
			</div>
			<?php if($CI->session->flashdata('item_error') !== NULL ): ?>
				<div class="label-error text-center">
					<?= $CI->session->flashdata('item_error') !== NULL ? $CI->session->flashdata('item_error') : '' ?>
				</div>
			<?php endif;?>

			<form method="POST" action="<?= base_url('inventario/save') ?>">
				<?php if($this->session->flashdata('add_error') !== NULL): ?>
				<div class="label-error">
				<?= $this->session->flashdata('add_error') !== NULL ? $this->session->flashdata('add_error') : ''; ?>
				</div>
				<?php endif; ?>
				<!-- Nombre -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="nombre" class="input-group-text">Nombre</label>
					</div>
					<input value="<?= $CI->session->flashdata('item_name') ?>" class="form-control" name="nombre" id="nombre" type="text" required autofocus autocomplete="name">
				</div>
				<!-- Cantidad -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="cantidad" class="input-group-text">Cantidad</label>
					</div>
					<input class="form-control" name="cantidad" id="cantidad" type="number" required autocomplete>
				</div>
				<!-- Numero de serie -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="num_serie" class="input-group-text">Num. Serie</label>
					</div>
					<input class="form-control" name="num_serie" id="num_serie" type="text" required autocomplete>
				</div>
				<!-- Precio de venta -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="precio_venta" class="input-group-text">Precio de venta</label>
					</div>
					<input class="form-control" name="precio_venta" id="precio_venta" type="number" required autofocus autocomplete>
				</div>
				<!-- Estante -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="estante" class="input-group-text">Estante</label>
					</div>
					<input class="form-control" name="estante" id="estante" type="text" required autocomplete>
				</div>

				<!-- Suplidor -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="suplidor" class="input-group-text">Suplidor</label>
					</div>

					<select name="suplidor" id="suplidor" class="custom-select">
						<option selected>Seleccione un suplidor</option>
						<?php 
							if($suplidores):
								foreach ($suplidores as $suplidor):
						?>
						<option value="<?= $suplidor->id ?>">
							<?= $suplidor->nombre. ' ' .$suplidor->apellido ?>
						</option>
						<?php endforeach; endif; ?>
					</select>
					<div class="input-group-prepend">
						<button type="button" data-toggle="modal" data-target="#addSupplier" class="btn btn-secondary"><i class="fas fa-plus"></i></button>
					</div>
				</div>

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="fecha_compra" class="input-group-text">Fecha de compra</label>
					</div>
					<input value="<?= date('Y-m-d') ?>" class="form-control" name="fecha_compra" id="fecha_compra" type="date" required autocomplete>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-3">
						<a href="<?= base_url('inicio/home') ?>" class="btn btn-secondary">< Volver</a>
					</div>					
					<div class="col-sm-6 col-xs-3 text-right">
						<button type="submit" class="btn btn-success">Agregar</button>
					</div>
				</div>
			</form>

			<!-- Modal -->
			<div role="dialog" id="addSupplier" tabindex="-1" role="dialog" class="modal fade">
				<div class="modal-dialog" role="document">
					<!-- Modal content -->
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title">Agregar suplidor</h2>
							<button data-dismiss="modal" type="button" class="close" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<!-- Form -->
						<form id="supplier" method="POST" action="<?= base_url('suplidores/save') ?>">
							<div class="modal-body">
								<!-- Nombre -->
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<label for="nombre_suplidor" class="input-group-text">Nombre</label>
									</div>
									<input class="form-control" name="nombre" id="nombre_suplidor" type="text" required autofocus autocomplete>
								</div>
								<!-- Apellido -->
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<label for="apellido_suplidor" class="input-group-text">Apellido</label>
									</div>
									<input class="form-control" name="apellido" id="apellido_suplidor" type="text" required autocomplete>
								</div>
								<!-- Direccion -->
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<label for="direccion_suplidor" class="input-group-text">Dirección</label>
									</div>
									<input class="form-control" name="direccion" id="direccion_suplidor" type="text" required autocomplete>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
								<button type="submit" class="btn btn-primary">Agregar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	$('#addSupplier').on('shown.bs.modal', function() {
		$('#nombre_suplidor').focus();
	});

	$("#supplier").on("submit", function( event ) {
	  event.preventDefault();

	  var form = $( this );
	  var formData = form.serialize();
	  $.post(form.attr('action'), formData)
	  	.done(function (res) {
			try {
	  			var data = JSON.parse(res);
	  			var option = $('<option></option>');
	  			option.attr('value', data.id);
	  			option.attr('selected', 'selected');
	  			option.text(data.nombre + ' ' + data.apellido);
	  			$("option:selected").removeAttr('selected');
	  			$('#suplidor').append(option);

				$('#nombre_suplidor').val('');
				$('#apellido_suplidor').val('');
				$('#direccion_suplidor').val('');
	  		} catch (e) {
	  			console.log(e);
	  		}
	  	})
	  	.fail(function (err) {
	  		console.error(err);
	  	});

	  $('#addSupplier').modal('toggle');
	});
</script>