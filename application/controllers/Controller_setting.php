<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_setting extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['model_setting', 'spd_admin_m']);
	}

	public function index()
	{
		if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
            $data['row'] = $this->spd_admin_m->getPegawai();
        } else {
            $data['row'] = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
        } 
		//$data['row'] = $this->model_setting->getPegawaiHasRole();
		//$data['pegawai'] = $this->model_setting->getPegawai();
		$this->template->load('template', 'setting/pegawai_has_role', $data);
	}

	public function switch_ppk()
	{
		$mode = $_POST['mode'];
		$id = $_POST['id'];
		if ($mode == 'true')
		{
			$str = $this->db->query("UPDATE pegawai SET ppk = '1' where id_pegawai = $id");
			$message = 'Hey my button is enableed!!';
			$success = 'Enabled';
			echo json_encode(array('message' => $message, '$success' => $success));
		} else if ($mode == 'false') {
			$str = $this->db->query("UPDATE pegawai SET ppk = '0' where id_pegawai = $id");
			$message = 'Hey my button is disable!!';
			$success = 'Disabled';
			echo json_encode(array('message' => $message, 'success' => $success));
		}
	}

	public function switch_bendahara()
	{
		$mode = $_POST['mode'];
		$id = $_POST['id'];
		if ($mode == 'true')
		{
			$str = $this->db->query("UPDATE pegawai SET bendahara = '1' where id_pegawai = $id");
			$message = 'Hey my button is enableed!!';
			$success = 'Enabled';
			echo json_encode(array('message' => $message, '$success' => $success));
		} else if ($mode == 'false') {
			$str = $this->db->query("UPDATE pegawai SET bendahara = '0' where id_pegawai = $id");
			$message = 'Hey my button is disable!!';
			$success = 'Disabled';
			echo json_encode(array('message' => $message, 'success' => $success));
		}
	}

	public function switch_kepala_kantor()
	{
		$mode = $_POST['mode'];
		$id = $_POST['id'];
		if ($mode == 'true')
		{
			$str = $this->db->query("UPDATE pegawai SET kepala_kantor = '1' where id_pegawai = $id");
			$message = 'Hey my button is enableed!!';
			$success = 'Enabled';
			echo json_encode(array('message' => $message, '$success' => $success));
		} else if ($mode == 'false') {
			$str = $this->db->query("UPDATE pegawai SET kepala_kantor = '0' where id_pegawai = $id");
			$message = 'Hey my button is disable!!';
			$success = 'Disabled';
			echo json_encode(array('message' => $message, 'success' => $success));
		}
	}

	public function setting_nomor()
	{
		if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->model_setting->getSetting($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->model_setting->getSetting($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->model_setting->getSetting($sort);
        } else {
			$sort = '0';
            $data['row'] = $this->model_setting->getSetting();
		}
		
		$data['page'] = "Setting Nomor";
		$data['sort'] = $sort;
		$this->template->load('template', 'setting/setting-no', $data);
	}

	public function process()
    {
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['Edit'])) {
            $this->model_setting->edit($post);
        }

        if($this->db->affected_rows() >0 ) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect('controller_setting/setting_nomor');
        }

	}
	
	public function user()
	{
		$data['row'] = $this->model_setting->getUser();
		$this->template->load('template', 'setting/user', $data);
	}

	public function add_user()
	{
		$post = $this->input->post(null, true);
		$this->model_setting->addUser($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_setting/user');
	}

	public function update_user()
	{
		$post = $this->input->post(null, true);
		$this->model_setting->updateUser($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_setting/user');
	}

	public function delete_user()
	{
		$post = $this->input->post(null, true);
		$this->model_setting->deleteUser($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_setting/user');
	}
}
