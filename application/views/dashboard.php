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
				<span>Inventario</span>
			</a>
			<a class="action" href="<?= base_url('suplidores/view') ?>">
				<span>Suplidores</span>
			</a>
		</div>
		<form method="POST" action="<?= base_url('usuarios/logout') ?>">
			<input type="hidden" name="logout" value="logout">
			<button onclick="return confirm('Desea cerrar sesión?')" class="btn btn-danger">Salir</button>
		</form>
	</div>
</div>