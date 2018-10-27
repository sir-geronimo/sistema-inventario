<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Plantilla::apply();
$CI =& get_instance();
exit(var_dump($_SESSION));
?>

<div class="container-fluid">
	<div class="col col-md-6 offset-3">
		<div class="box">
			<div class="text-center">
				<h1>Ferretería Peña</h1>
				<h2>Agregar suplidor</h2>
			</div>

			<form method="POST" action="<?= base_url('suplidores/save') ?>">
				<!-- Nombre -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="nombre" class="input-group-text">Nombre</label>
					</div>
					<input class="form-control" name="nombre" id="nombre" type="text" required autofocus autocomplete>
				</div>
				<!-- Apellido -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="apellido" class="input-group-text">Apellido</label>
					</div>
					<input class="form-control" name="apellido" id="apellido" type="text" required autocomplete>
				</div>
				<!-- Direccion -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="direccion" class="input-group-text">Dirección</label>
					</div>
					<input class="form-control" name="direccion" id="direccion" type="text" required autocomplete>
				</div>
				<!-- Buttons -->
				<div class="row">
					<div class="col-sm-6">
						<a href="<?= base_url('suplidores/view') ?>" class="btn btn-secondary">< Volver</a>
					</div>					
					<div class="col-sm-6 text-right">
						<button type="submit" class="btn btn-success">Agregar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>