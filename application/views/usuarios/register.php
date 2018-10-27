<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Plantilla::apply();
$CI =& get_instance();
?>

<div class="container-fluid">
	<div class="col col-md-4 mx-auto text-center">
		<div class="box">
			<div>
				<img width="40%" src="<?= base_url('assets/img/user.png') ?>" alt="user">
			</div>
			<h2 class="header">Regístrate</h2>
			<?php if($CI->session->flashdata('register_error') !== NULL): ?>
			<div class="label-error">
				<?= $CI->session->flashdata('register_error') !== NULL ? $CI->session->flashdata('register_error') : ''; ?>
			</div>
			<?php endif;?>
			<form method="POST" action="<?= base_url('usuarios/save') ?>">
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<label for="username" class="input-group-text" ><i class="fas fa-user"></i></label>
				</div>
				<input id="username" name="username" placeholder="Nombre de usuario" type="text" class="form-control" required autofocus>
			</div>
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<label for="password" class="input-group-text" ><i class="fas fa-lock"></i></label>
				</div>
				<input id="password" name="password" placeholder="Contraseña" type="password" class="form-control" required>
			</div>
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<label for="name" class="input-group-text" ><i class="fas fa-bars"></i></label>
				</div>
				<input id="name" name="name" placeholder="Nombre" type="text" class="form-control" required>
			</div>
			<div class="input-group form-group">
				<div class="input-group-prepend">
					<label for="lastname" class="input-group-text" ><i class="fas fa-bars"></i></label>
				</div>
				<input id="lastname" name="lastname" placeholder="Apellido" type="text" class="form-control" required>
			</div>			
			<div class="form-submit">
				<button class="btn btn-success" type="submit">Enviar</button>
			</div>
			<a class="text-muted" href="<?= base_url('inicio/login') ?>">Ya tienes cuenta</a>
			</form>			
		</div>
	</div>
</div>