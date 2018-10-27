<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Plantilla::apply();
$CI =& get_instance(); 
?>

<div class="container-fluid">
	<div class="col col-md-6 offset-md-3">
		<div class="box">
			<div class="text-center">
				<h1>Ferretería Peña</h1>
				<h2>Editar artículo</h2>
			</div>

			<form method="POST" action="<?= base_url('inventario/save') ?>">
				<input type="hidden" name="id" value="<?= $articulo->id ?>">
				<!-- Nombre -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="nombre" class="input-group-text">Nombre</label>
					</div>
					<input value="<?= $articulo->nombre ?>" class="form-control" name="nombre" id="nombre" type="text" required autofocus autocomplete>
				</div>
				<!-- Cantidad -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="cantidad" class="input-group-text">Cantidad</label>
					</div>
					<input value="<?= $articulo->cantidad ?>" class="form-control" name="cantidad" id="cantidad" type="number" required autocomplete>
				</div>
				<!-- Numero de serie -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="num_serie" class="input-group-text">Num. Serie</label>
					</div>
					<input value="<?= $articulo->num_serie ?>" class="form-control" name="num_serie" id="num_serie" type="text" required autocomplete>
				</div>
				<!-- Precio de venta -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="precio_venta" class="input-group-text">Precio de venta</label>
					</div>
					<input value="<?= $articulo->precio_venta ?>" class="form-control" name="precio_venta" id="precio_venta" type="number" required autofocus autocomplete>
				</div>
				<!-- Estante -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="estante" class="input-group-text">Estante</label>
					</div>
					<input value="<?= $articulo->estante ?>" class="form-control" name="estante" id="estante" type="text" required autocomplete>
				</div>

				<!-- Suplidor -->
				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="suplidor" class="input-group-text">Suplidor</label>
					</div>

					<select name="suplidor" id="suplidor" class="custom-select">
						<option selected value="<?= $articulo->suplidor ?>">
							<?= $articulo->suplidor_nombre. ' ' .$articulo->suplidor_apellido ?>
						</option>
						<?php 
							if($suplidores):
								foreach ($suplidores as $suplidor):
									if($suplidor->id === $articulo->suplidor):
										continue;
									endif;
						?>
						<option value="<?= $suplidor->id ?>">
							<?= $suplidor->nombre. ' ' .$suplidor->apellido ?>
						</option>
						<?php endforeach; endif; ?>
					</select>
				</div>

				<div class="form-group input-group">
					<div class="input-group-prepend">
						<label for="fecha_compra" class="input-group-text">Fecha de compra</label>
					</div>
					<input value="<?= $articulo->fecha_compra ?>" class="form-control" name="fecha_compra" id="fecha_compra" type="date" required autocomplete>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<a href="<?= base_url('inventario/view') ?>" class="btn btn-secondary">< Volver</a>
					</div>					
					<div class="col-sm-6 text-right">
						<button type="submit" class="btn btn-success">Actualizar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>