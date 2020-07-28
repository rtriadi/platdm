<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_keuangan extends CI_Model
{

	public function getPegawai($id = null)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('level', '4');
		if ($id != null) {
			$this->db->where('spd.id', $id);
		}
		$this->db->order_by('nama', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function cek_gaji($bln = "", $nip = "")
	{
		$query = $this->db->get_where('gaji', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_uang_makan($bln = "", $nip = "")
	{
		$query = $this->db->get_where('uang_makan', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_gaji13($bln = "", $nip = "")
	{
		$query = $this->db->get_where('gaji13', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_thr($bln = "", $nip = "")
	{
		$query = $this->db->get_where('thr', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_kekurangan_gaji($bln = "", $nip = "")
	{
		$query = $this->db->get_where('kekurangan_gaji', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_uang_lembur($bln = "", $nip = "")
	{
		$query = $this->db->get_where('uang_lembur', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_insentif($bln = "", $nip = "")
	{
		$query = $this->db->get_where('insentif', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_honor($bln = "", $nip = "")
	{
		$query = $this->db->get_where('honor', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_tukin_13($bln = "", $nip = "")
	{
		$query = $this->db->get_where('tukin_13', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_tukin_thr($bln = "", $nip = "")
	{
		$query = $this->db->get_where('tukin_thr', array('bulan_tahun' => $bln, 'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_potongan_tukin($bln = "", $nip = "")
	{
		$query = $this->db->get_where('potongan_tukin', array('bulan_tahun' => $bln,'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_kekurangan_tukin($bln = "", $nip = "")
	{
		$query = $this->db->get_where('kekurangan_tukin', array('bulan_tahun' => $bln,'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	function cek_tukin_plt($bln = "", $nip = "")
	{
		$query = $this->db->get_where('tukin_plt', array('bulan_tahun' => $bln,'nip' => $nip));
		$query = $query->result_array();
		return $query;
	}

	public function create($table, $data)
	{
	    
		return $this->db->insert($table, $data);
	}

	public function update($table, $kolom, $id,  $data)
	{
		return $this->db->where($kolom, $id)
			->update($table, $data);
	}
}
