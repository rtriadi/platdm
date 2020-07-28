<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_m extends CI_Model
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
        if($id != null) {
            $this->db->where('id_pegawai', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getByKantor($id = null)
    {
        $this->db->from('pegawai');
        if($id != null) {
            $this->db->where('kantor', $id);
        }
        $this->db->order_by('level', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function getNIP($id = null)
    {
        $this->db->from('pegawai');
        if($id != null) {
            $this->db->where('nip', $id);
        }
        $query = $this->db->get();
        return $query;
    }

	public function add($post)
	{
		$params['nip']         = $post['nip'];
		$params['nama']        = $post['nama'];
		$params['pangkat_gol'] = $post['pangkat_gol'];
		$params['jabatan']     = $post['jabatan'];
		$params['kantor']      = $post['kantor'];
		$params['password']    = sha1($post['password']);
		$params['level']       = $post['level'];
		$this->db->insert('pegawai', $params);

	}

	public function edit($post)
	{
		$params['nip']         = $post['nip'];
		$params['nama']        = $post['nama'];
		$params['pangkat_gol'] = $post['pangkat_gol'];
		$params['jabatan']     = $post['jabatan'];
		$params['kantor']      = $post['kantor'];
		if (!empty($post['password'])) {
			$params['password'] = sha1($post['password']);
		}
		$params['level']       = $post['level'];
		$this->db->where('id_pegawai', $post['id_pegawai']);
		$this->db->update('pegawai', $params);
	}

	public function delete($id)
	{
		$this->db->where('nip', $id);
		$this->db->delete('pegawai');
    }
	
	public function delete_nip_spd($id)
	{
		$this->db->where('nip_pegawai', $id);
		$this->db->delete('spd');
	}
	
	public function delete_nip_spd_pegawai($id)
	{
		$this->db->where('nip_pegawai', $id);
		$this->db->delete('spd_pegawai');
    }
    
    function cek_nip($nip = "")
	{
		$query = $this->db->get_where('pegawai', array('nip' => $nip));
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
