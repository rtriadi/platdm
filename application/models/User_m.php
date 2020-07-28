<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{

	public function login($post)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('nip', $post['nip']);
		$this->db->where('password', sha1($post['password']));
		$query = $this->db->get();
		return $query;
	}

	public function get($id = null)
	{
		$this->db->from('pegawai');
		if ($id != null) {
			$this->db->where('id_pegawai', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function edit($post)
	{
		$params['nip'] = $post['nip'];
		if (!empty($post['password'])) {
			$params['password'] = sha1($post['password']);
		}
		$params['nama'] = $post['nama'];
		$this->db->where('id_pegawai', $post['id_pegawai']);
		$this->db->update('pegawai', $params);
	}

	public function delete($id)
	{
		$this->db->where('id_pegawai', $id);
		$this->db->delete('pegawai');
	}
}
