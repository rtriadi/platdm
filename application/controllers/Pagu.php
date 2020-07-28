<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		//check_admin();
	}

	public function index()
	{
		$this->db->from('pagu');
		$get = $this->db->get();
		$data['row'] = $get;
		$this->template->load('template', 'pagu', $data);
	}

	public function add()
	{
		$post = $this->input->post(null, true);
		$params = array(
			'dipa_pagu' => $post['dipa_pagu'],
			'pagu' => $post['pagu'],
			'kodekantor' => $post['kodekantor']
		);

		$this->db->insert('pagu', $params);
		if ($this->db->affected_rows() > 0) {
			redirect('pagu');
		}
	}

	public function update()
	{
		$post = $this->input->post(null, true);
		$params = array(
			'dipa_pagu' => $post['dipa_pagu'],
			'pagu' => $post['pagu'],
			'kodekantor' => $post['kodekantor']
		);

		$this->db->where('id_pagu', $post['id_pagu']);
		$this->db->update('pagu', $params);
		if ($this->db->affected_rows() > 0) {
			redirect('pagu');
		}
	}

	public function delete($post)
	{
		$this->db->where('id_pagu', $post);
		$this->db->delete('pagu');
		if ($this->db->affected_rows() > 0) {
			redirect('pagu');
		}
	}

	public function rekap_pagu()
	{
		$this->db->from('pagu');
		$get_outstanding = $this->db->get();
		$data['outstanding'] = $get_outstanding;
		$this->db->from('pagu');
		$get_telahdibayar = $this->db->get();
		$data['telah_dibayar'] = $get_telahdibayar;
		$this->template->load('template', 'rekap_pagu', $data);
	}
}
