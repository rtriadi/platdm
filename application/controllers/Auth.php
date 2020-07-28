<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['login'])) {
			$this->load->model('user_m');
			$query = $this->user_m->login($post);
			if($query->num_rows() > 0) {
				$row = $query->row();
				$params = array(
					'id' => $row->id_pegawai,
					'level' => $row->level,
				);
				$this->session->set_userdata($params);
				if($this->input->post('nip') == $this->input->post('password')) {
				    $this->session->set_flashdata('message', 'chgpassword');    
				} else {
				    
				}
				redirect(site_url('/dashboard'), $data);
			} else {
				echo "<script>
					alert('Login gagal, username / password salah');
					window.location='".site_url('auth/login')."'
					</script>";
			}
		}
	}

	public function logout()
	{
		$params = array('id', 'level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}
}
