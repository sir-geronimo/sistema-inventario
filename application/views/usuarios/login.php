<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
Plantilla::apply();
?>

<div class="container-fluid">
	<div class="col col-md-4 mx-auto">
		<div class="box text-center">
			<div>
				<img width="40%" src="<?= base_url('assets/img/user.png') ?>" alt="user">
			</div>
			<h2 style="header">Inicia sesión</h2>
			<?php if($CI->session->flashdata('login_error') !== NULL): ?>
				<div class="label-error">
					<?= $CI->session->flashdata('login_error') !== NULL ? $CI->session->flashdata('login_error') : ''; ?>
				</div>
			<?php endif;?>
			<form method="POST" action="<?= base_url('usuarios/login') ?>">
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<label for="username" class="input-group-text" ><i class="fas fa-user"></i></label>
					</div>
					<input <?php if($CI->session->flashdata('username') !== NULL):?>
						value="<?= $CI->session->flashdata('username') !== NULL ? $CI->session->flashdata('username') : ''; ?>"
						<?php endif;?>
						id="username" name="username" 
						placeholder="Nombre de usuario" type="text" 
						class="form-control" required autofocus>
				</div>
				<div class="input-group form-group">
					<div class="input-group-prepend">
						<label for="password" class="input-group-text" ><i class="fas fa-lock"></i></label>
					</div>
					<input id="password" name="password" placeholder="Contraseña" type="password" class="form-control">
				</div>
				<div class="form-submit">
					<button class="btn btn-success" type="submit">Enviar</button>
				</div>
				<div class="text-center">
					<a href="<?= base_url('usuarios/register') ?>" class="text-muted">Registrar</a>
				</div>
			</form>
		</div>
	</div>
</div>