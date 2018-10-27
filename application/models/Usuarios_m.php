<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_m extends CI_Model {

	public function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if(empty($username) || empty($password)) {
			$this->session->set_flashdata('login_error', 'Usuario o contraseña incorrecta');
			$this->session->set_flashdata('username', $username);
			redirect(base_url('inicio/login'),'refresh');
			exit();
		}

		$this->db->where('username', $username);
		$sql = $this->db->get('usuarios');
		$user = $sql->row(0);

		if(is_null($user)) {
			$this->session->set_flashdata('login_error', 'Usuario o contraseña incorrecta');
			$this->session->set_flashdata('username', $username);
			redirect(base_url('inicio/login'),'refresh');
		} else {
			if(password_verify($password, $user->password)) {
				$session_data = [
					'logged' => TRUE,
					'user_id' => $user->id,
					'usuario' => $user->nombre. ' ' .$user->apellido
				];
				
				$this->session->set_userdata( $session_data );
				redirect(base_url('inicio/home'),'refresh');
			} else {
				$this->session->set_flashdata('login_error', 'Usuario o contraseña incorrecta');
				$this->session->set_flashdata('username', $username);
				redirect(base_url('inicio/login'),'refresh');
			}
		}
	}

	public function register() {
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$pass = password_hash($password, PASSWORD_BCRYPT);

		$this->db->where('username', $username);
		$this->db->select('id, username');
		$this->db->from('usuarios');
		$this->db->limit(1);
		$sql = $this->db->get();
		$user = $sql->row(0);

		if($user !== NULL) {
			$this->session->set_flashdata('register_error', 'Usuario existente');
			redirect(base_url('usuarios/register'),'refresh');
		} else {

			$data = [
				'username' => $this->input->post('username'),
				'password' => $pass,
				'nombre' => $this->input->post('name'),
				'apellido' => $this->input->post('lastname'),
			];

			$this->db->set($data);
			$this->db->insert('usuarios');
			$id = $this->db->insert_id();

			return $id;
		}
	}

	function logout() {
		$logout = $this->input->post('logout');
		if(!empty($logout)) {
			$this->session->logged = FALSE;
			$this->session->sess_destroy();
			redirect(base_url('inicio/login'),'refresh');
		} else {
			redirect(base_url('inicio/login'),'refresh');
		}
	}
}