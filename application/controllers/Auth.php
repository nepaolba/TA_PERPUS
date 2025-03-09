<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->run() == FALSE ? $this->load->view('auth/login') : $this->__loginPetugas();
	}

	private function __loginPetugas()
	{
		$cek_username = $this->__cekUsername('petugas', 'username');
		if ($cek_username) {
			$cekPass = $this->__cekPassword($cek_username['password']);
			if ($cekPass) {
				$setSession = ['nama' => $cek_username['nama_petugas'], 'id' => $cek_username['kd_petugas'], 'role' => 'admin', 'dateLog' => date('Y-m-d H:s:i')];
				$this->session->set_userdata($setSession);
				redirect('Admin');
			} else {
				$this->session->set_flashdata('msg', 'Password Salah.');
				redirect('Auth');
			}
		} else {
			$this->__loginAnggota();
		}
	}
	private function __loginAnggota()
	{
		$cek_username = $this->__cekUsername('anggota', 'kd_anggota');
		if ($cek_username) {
			$cekPass = $this->__cekPassword($cek_username['password']);
			if ($cekPass) {
				$setSession = ['nama' => $cek_username['nama_anggota'], 'id' => $cek_username['kd_anggota'], 'role' => 'user', 'dateLog' => date('Y-m-d H:s:i')];
				$this->session->set_userdata($setSession);
				redirect('Welcome');
			} else {
				$this->session->set_flashdata('msg', 'Password Salah.');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('msg', 'Username Salah.');
			redirect('Auth');
		}
	}



	private function __cekUsername($table, $where)
	{
		$username = $this->input->post('username');
		return $this->auth->getUsername($table, $username, $where);
	}

	private function __cekPassword($hashedPassword)
	{
		$password = $this->input->post('password');
		return password_verify($password, $hashedPassword);
	}

	public function logout()
	{
		!$this->session->userdata('nama') ? redirect('Auth') : '';
		$this->session->sess_destroy();
		redirect($this->config->item('logout_redirect'));
	}
}
