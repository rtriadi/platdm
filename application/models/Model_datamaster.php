<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_datamaster extends CI_Model
{
	public function create($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	public function update($table, $kolom, $id,  $data)
	{
		return $this->db->where($kolom, $id)
			->update($table, $data);
	}

	public function getKategoriPangkatGol($id = null)
	{
		$this->db->select('*');
		$this->db->from('kategori_pangkat_gol');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function addKategoriPangkatGol($post)
	{
		$params = array(
			'nama' => $post['nama']
		);

		$query = $this->db->insert('kategori_pangkat_gol', $params);
		return $query;
	}

	public function updateKategoriPangkatGol($post)
	{
		$params = array(
			'nama' => $post['nama']
		);

		$this->db->where('id', $post['id']);
		$query = $this->db->update('kategori_pangkat_gol', $params);
		return $query;
	}

	public function deleteKategoriPangkatGol($post)
	{
		$this->db->where('id', $post['id']);
		$query = $this->db->delete('kategori_pangkat_gol');
		return $query;
	}

	public function getPangkatGol($id = null)
	{
		$this->db->select('pangkat_gol.*, kategori_pangkat_gol.nama as kategori_pangkat_gol_nama');
		$this->db->from('pangkat_gol');
		$this->db->join('kategori_pangkat_gol', 'kategori_pangkat_gol.id = pangkat_gol.id_kategori_pangkat_gol');
		if ($id != null) {
			$this->db->where('pangkat_gol.id', $id);
		}
		$this->db->order_by('pangkat_gol.id', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function addPangkatGol($post)
	{
		$params = array(
			'nama' => $post['nama'],
			'id_kategori_pangkat_gol' => $post['id_kategori_pangkat_gol']
		);

		$query = $this->db->insert('pangkat_gol', $params);
		return $query;
	}

	public function updatePangkatGol($post)
	{
		$params = array(
			'nama' => $post['nama'],
			'id_kategori_pangkat_gol' => $post['id_kategori_pangkat_gol']
		);

		$this->db->where('id', $post['id']);
		$query = $this->db->update('pangkat_gol', $params);
		return $query;
	}

	public function deletePangkatGol($post)
	{
		$this->db->where('id', $post['id']);
		$query = $this->db->delete('pangkat_gol');
		return $query;
	}

	public function getRefPenginapan($id = null)
	{
		$this->db->select('ref_penginapan.*, kategori_pangkat_gol.nama as kategori_pangkat_gol_nama');
		$this->db->from('ref_penginapan');
		$this->db->join('kategori_pangkat_gol', 'kategori_pangkat_gol.id = ref_penginapan.id_kategori_pangkat_gol');
		if ($id != null) {
			$this->db->where('ref_penginapan.id', $id);
		}
		$this->db->order_by('ref_penginapan.provinsi', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function addRefPenginapan($post)
	{
		$params = array(
			'provinsi' => $post['provinsi'],
			'id_kategori_pangkat_gol' => $post['id_kategori_pangkat_gol'],
			'nominal' => $post['nominal']
		);

		$query = $this->db->insert('ref_penginapan', $params);
		return $query;
	}

	public function updateRefPenginapan($post)
	{
		$params = array(
			'provinsi' => $post['provinsi'],
			'id_kategori_pangkat_gol' => $post['id_kategori_pangkat_gol'],
			'nominal' => $post['nominal']
		);

		$this->db->where('id', $post['id']);
		$query = $this->db->update('ref_penginapan', $params);
		return $query;
	}

	public function deleteRefPenginapan($post)
	{
		$this->db->where('id', $post['id']);
		$query = $this->db->delete('ref_penginapan');
		return $query;
	}

	public function getRefBiayaTaxi($id = null)
	{
		$this->db->select('*');
		$this->db->from('ref_biaya_taxi');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$this->db->order_by('provinsi', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function addRefBiayaTaxi($post)
	{
		$params = array(
			'provinsi' => $post['provinsi'],
			'besaran' => $post['besaran']
		);

		$query = $this->db->insert('ref_biaya_taxi', $params);
		return $query;
	}

	public function updateRefBiayaTaxi($post)
	{
		$params = array(
			'provinsi' => $post['provinsi'],
			'besaran' => $post['besaran']
		);

		$this->db->where('id', $post['id']);
		$query = $this->db->update('ref_biaya_taxi', $params);
		return $query;
	}

	public function deleteRefBiayaTaxi($post)
	{
		$this->db->where('id', $post['id']);
		$query = $this->db->delete('ref_biaya_taxi');
		return $query;
	}

	function cek_pangkat_gol($nama = "")
	{
		$query = $this->db->get_where('pangkat_gol', array('nama' => $nama));
		$query = $query->result_array();
		return $query;
	}

	function cek_ref_penginapan($provinsi = "", $id_kategori_pangkat_gol = "")
	{
		$query = $this->db->get_where('ref_penginapan', array('provinsi' => $provinsi, 'id_kategori_pangkat_gol' => $id_kategori_pangkat_gol));
		$query = $query->result_array();
		return $query;
	}

	function cek_ref_biaya_taxi($provinsi = "")
	{
		$query = $this->db->get_where('ref_biaya_taxi', array('provinsi' => $provinsi));
		$query = $query->result_array();
		return $query;
	}
}
