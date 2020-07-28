<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_setting extends CI_Model
{
	public function getPegawai($id = null)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		if ($id != null) {
			$this->db->where('id_pegawai', $id);
		}
		$this->db->order_by('nama', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getPegawaiHasRole($id = null)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		if ($id != null) {
			$this->db->where('id_pegawai', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function changePegawaiHasRole($post)
	{
		$params = array(
			'ppk' => $post['ppk'],
			'bendahara' => $post['bendahara'],
			'kepala_kantor' => $post['kepala_kantor']
		);

		$this->db->where('id_pegawai', $post['id']);
		$query = $this->db->update('pegawai', $params);
		return $query;
	}

	public function getSetting($id = null, $tipe = null)
	{
		$this->db->select('*');
		$this->db->from('setting_no');
		if ($id != null) {
			$this->db->where('kantor', $id);
		}
		if ($tipe != null) {
			$this->db->where('tipe', $tipe);
		}
		$query = $this->db->get();
		return $query;
	}

	public function edit($post)
    {
        $params = array(
            'format_awal'       => $post['format_awal'],
            'format_akhir' => $post['format_akhir']
        );
        $this->db->where('id_setting', $post['id_setting']);
        $this->db->update('setting_no', $params);
	}
	
	public function getUser($id = null)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('level <', '4');
		if ($id != null) {
			$this->db->where('id_pegawai', $id);
		}
		$this->db->order_by('id_pegawai', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function addUser($post)
	{
		$params['nip']         = $post['username'];
		$params['nama']        = $post['nama'];
		$params['kantor']      = $post['kantor'];
		$params['password']    = sha1($post['password']);
		$params['level']       = $post['level'];

		$query = $this->db->insert('pegawai', $params);
		return $query;
	}

	public function updateUser($post)
	{
		$params['nip']         = $post['username'];
		$params['nama']        = $post['nama'];
		$params['kantor']      = $post['kantor'];
		if (!empty($post['password'])) {
			$params['password'] = sha1($post['password']);
		}
		$params['level']       = $post['level'];

		$this->db->where('id_pegawai', $post['id']);
		$query = $this->db->update('pegawai', $params);
		return $query;
	}

	public function deleteUser($post)
	{
		$this->db->where('id_pegawai', $post['id']);
		$query = $this->db->delete('pegawai');
		return $query;
	}
}
