<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Plantilla::apply();
$CI =& get_instance();
?>

<script type="text/javascript">
	$(document).ready(function() {
	    $('#suplidores').DataTable({
	    	"language": {
	    		"search" : "Buscar:",
	    		"info" : "Mostrando _START_ a _END_ de _TOTAL_ suplidores",
	    		"infoEmpty": "Mostrando 0 a 0 de 0 suplidores",
	    		"zeroRecords":    "No se encontraron registros coincidentes",
	    		"lengthMenu":     "Mostrar _MENU_ suplidores",
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
		<div class="action-button">
			<a href="<?= base_url('inicio/home') ?>" class="btn btn-secondary">< Volver</a>
			<button type="button" data-toggle="modal" data-target="#addSupplier" class="btn btn-info"><i class="fas fa-plus"></i> Agregar suplidor...</button>
			<a href="<?= base_url('suplidores/view') ?>" class="btn btn-warning">Ver Activos ></a>
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
		<?php if($suplidores): ?>
			<table class="table" id="suplidores" style="border-collapse: collapse !important;">
				<thead>
					<tr>
						<th colspan="6" style="font-size: 24px; background-color: chartreuse;">Suplidores</th>
					</tr>
					<tr>
						<th class="suppliers">ID</th>
						<th class="suppliers">Nombre</th>
						<th class="suppliers">Apellido</th>
						<th class="suppliers">Dirección</th>
						<th class="suppliers">Estado</th>
						<th class="suppliers"><i class="fas fa-bars"></i></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($suplidores as $suplidor): ?>
						<tr>
							<td><?= $suplidor->id ?></td>
							<td><?= $suplidor->nombre ?></td>
							<td><?= $suplidor->apellido ?></td>
							<td><?= $suplidor->direccion ?></td>
							<td>
								<?php if($suplidor->active == 1) {
										echo "Activo";
									} else {
										echo "Inactivo";
									}
								?>							
							</td>
							<td>
								<a href="<?= base_url('suplidores/edit/').$suplidor->id ?>" class="edit-button"><i class="fas fa-edit"></i></a>
								<?php if($suplidor->active == 1): ?>
										<a onclick="return confirm('Estás seguro?')" href="<?= base_url('suplidores/delete/').$suplidor->id ?>" class="btn delete-button"><i class="far fa-trash-alt"></i> Desactivar</a>
								<?php else: ?>
										<a onclick="return confirm('Estás seguro?')" href="<?= base_url('suplidores/reactivate/').$suplidor->id ?>" class="btn btn-primary"><i class="fas fa-check"></i> Reactivar</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<th class="suppliers">ID</th>
						<th class="suppliers">Nombre</th>
						<th class="suppliers">Apellido</th>
						<th class="suppliers">Dirección</th>
						<th class="suppliers">Estado</th>
						<th class="suppliers"><i class="fas fa-bars"></i></th>
					</tr>
				</tfoot>
			</table>
			<div class="text-center"><b>Total suplidores: <?= count($suplidores) ?></b></div>
			<!-- Modal -->
			<div role="dialog" id="addSupplier"  tabindex="-1" role="dialog" class="modal fade">
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
						<form method="POST" action="<?= base_url('suplidores/save') ?>">
							<div class="modal-body">
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
							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
								<button type="submit" class="btn btn-primary">Agregar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>