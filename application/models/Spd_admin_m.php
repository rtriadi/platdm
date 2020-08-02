<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spd_admin_m extends CI_Model
{
    public function total_submenu($sort = null, $status = null)
    {
        $this->db->select_sum('total_bayar');
        $this->db->from('spd');
        $this->db->where('total_bayar >=', '0');
        if ($sort != null) {
            $this->db->where('sort', $sort);
        }
        if ($status != null) {
            $this->db->where('status', $status);
        }
        $query = $this->db->get();
        return $query;
    }
    
    public function get($id = null)
    {
        $this->db->select('spd.*, pegawai.*');
        $this->db->from('spd');
        $this->db->join('pegawai', 'pegawai.nip = spd.nip_pegawai');
        $this->db->order_by('sort', 'ASC');
        $this->db->order_by('id', 'DESC');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getByStatus($status = null)
    {
        $this->db->select('spd.*, pegawai.*');
        $this->db->from('spd');
        $this->db->join('pegawai', 'pegawai.nip = spd.nip_pegawai');
        $this->db->order_by('sort', 'ASC');
        $this->db->order_by('id', 'DESC');
        if ($status != null) {
            $this->db->where('status', $status);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getBySort($id = null, $status = null)
    {
        $this->db->select('spd.*, pegawai.*');
        $this->db->from('spd');
        $this->db->join('pegawai', 'pegawai.nip = spd.nip_pegawai');
        $this->db->order_by('id', 'DESC');
        if ($id != null) {
            $this->db->where('sort', $id);
        }
        if ($status != null) {
            $this->db->where('status', $status);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getExcel($id = null)
    {
        $this->db->select('spd.*, pegawai.*');
        $this->db->from('spd');
        $this->db->join('pegawai', 'pegawai.nip = spd.nip_pegawai');
        $this->db->order_by('sort', 'ASC');
        $this->db->order_by('id', 'ASC');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getBySortExcel($id = null)
    {
        $this->db->select('spd.*, pegawai.*');
        $this->db->from('spd');
        $this->db->join('pegawai', 'pegawai.nip = spd.nip_pegawai');
        $this->db->order_by('id', 'ASC');
        if ($id != null) {
            $this->db->where('sort', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getLastSPD($id = null)
    {
        $this->db->select('spd.no_spd');
        $this->db->from('spd');
        $this->db->where('sort', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        // $tanggal=getdate();
        // if ($this->fungsi->user_login()->level == 2) {
        //     $kantor = '-'.substr($this->fungsi->user_login()->kantor, 6);
        // } else {
        //     $kantor = "";
        // }
        $params = array(
            'nip_ppk'       => $post['nip_ppk'],
            'nip_bendahara' => $post['nip_bendahara'],
            'nip_pegawai'   => $post['nip_pegawai'],
            //'no_spd'        => 'SPD-'.$post['no_spd'].'/WPJ.16/KP.02'.$kantor.'/'.$tanggal['year'],
            'no_spd'        => $post['no_spd'],
            'tgl_spd'       => $post['tgl_spd'],
            'maksud'        => $post['maksud'],
            'kendaraan'     => $post['kendaraan'],
            'lamanya'       => $post['lamanya'],
            'tgl_berangkat' => $post['tgl_berangkat'],
            'tujuan1'       => $post['tujuan1'],
            'tujuan2'       => $post['tujuan2'],
            'tujuan3'       => $post['tujuan3'],
            'tujuan4'       => $post['tujuan4'],
            'tgl_selesai'   => $post['tgl_selesai'],
            'no_st'         => $post['no_st'],
            'tgl_st'        => $post['tgl_st'],
            'uang_muka'     => $post['uang_muka'],
            'dipa'          => $post['dipa'],
            'status'        => $post['status'],
            'sort'          => $post['sort']
        );
        $this->db->insert('spd', $params);
    }

    public function edit($post)
    {
        $params = array(
            'nip_ppk'       => $post['nip_ppk'],
            'nip_bendahara' => $post['nip_bendahara'],
            'nip_pegawai'   => $post['nip_pegawai'],
            'no_spd'        => $post['no_spd'],
            'tgl_spd'       => $post['tgl_spd'],
            'maksud'        => $post['maksud'],
            'kendaraan'     => $post['kendaraan'],
            'lamanya'       => $post['lamanya'],
            'tgl_berangkat' => $post['tgl_berangkat'],
            'tujuan1'       => $post['tujuan1'],
            'tujuan2'       => $post['tujuan2'],
            'tujuan3'       => $post['tujuan3'],
            'tujuan4'       => $post['tujuan4'],
            'tgl_selesai'   => $post['tgl_selesai'],
            'no_st'         => $post['no_st'],
            'tgl_st'        => $post['tgl_st'],
            'uang_muka'     => $post['uang_muka'],
            'dipa'          => $post['dipa'],
            'status'        => $post['status'],
            'sort'          => $post['sort']
        );
        $this->db->where('id', $post['id']);
        $this->db->update('spd', $params);
    }

    public function statusOK($id)
	{
		$params = array(
			'status' => '2'        
		);
		$this->db->where('id', $id);
		$this->db->update('spd', $params);
    }
    
    public function statusApproved($id)
	{
		$params = array(
			'status' => '3'        
		);
		$this->db->where('id', $id);
		$this->db->update('spd', $params);
	}

    public function update_bayar($post)
    {
        $params = array(
            'status'    => $post['status'],
            'tgl_bayar' => $post['tgl_bayar'],
            'dipa'      => $post['dipa'],
            'ls'        => $post['ls']
        );
        $this->db->where('id', $post['id']);
        $this->db->update('spd', $params);
    }

    public function batal($id)
    {
        $params = array(
            'grand_total' => 0,
            'uang_muka'   => 0,
            'kredit'      => 0,
            'total_bayar' => 0,
            'status'      => '5'
        );
        $this->db->where('id', $id);
        $this->db->update('spd', $params);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('spd');
    }

    public function getPegawai($id = null)
    {
        $this->db->from('pegawai');
        if ($id != null) {
            $this->db->where('nip', $id);
        }
        $this->db->where('level', '4');
        $query = $this->db->get();
        return $query;
    }

    public function getPegawaiByKantor($id = null)
    {
        $this->db->from('pegawai');
        if ($id != null) {
            $this->db->where('kantor', $id);
        }
        $this->db->where('level', '4');
        $query = $this->db->get();
        return $query;
    }

    public function getPegawaiPPKByKantor($id = null)
    {
        $this->db->from('pegawai');
        if ($id != null) {
            $this->db->where('kantor', $id);
        }
        $this->db->where('level', '4');
        $this->db->where('ppk', '1');
        $query = $this->db->get();
        return $query;
    }

    public function getPegawaiBendaByKantor($id = null)
    {
        $this->db->from('pegawai');
        if ($id != null) {
            $this->db->where('kantor', $id);
        }
        $this->db->where('level', '4');
        $this->db->where('bendahara', '1');
        $query = $this->db->get();
        return $query;
    }

    public function getCity($id = null)
    {
        $this->db->from('city');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function rekapPerOrang($nip)
    {
        $query = $this->db->query("SELECT pegawai.nama as nama, month(spd.tgl_spd) as bulan, SUM(spd.grand_total_uh) as total_uh, SUM(spd.total_by_penginapan) as total_penginapan, SUM(spd.pengeluaran_riil) as pengeluaran_riil, SUM(spd.total_bayar) as total_bayar FROM spd, pegawai WHERE spd.nip_pegawai=pegawai.nip AND spd.nip_pegawai=$nip GROUP BY month(spd.tgl_spd)");
        return $query;
    }

    public function rekapPembuatanSPD($bulan, $tahun, $sort)
    {
        if ($bulan == 13) {
            $query = $this->db->query("SELECT month(tgl_spd) as bulan, SUM(total_bayar) as total_bayar FROM spd WHERE year(tgl_spd)=$tahun AND sort=$sort GROUP BY month(tgl_spd)");
        } else {
            $query = $this->db->query("SELECT month(tgl_spd) as bulan, SUM(total_bayar) as total_bayar FROM spd WHERE month(tgl_spd) = $bulan AND year(tgl_spd) = $tahun AND sort=$sort");
        }
        return $query;
    }

    public function rekapPembayaranSPD($bulan, $tahun, $sort)
    {
        if ($bulan == 13) {
            $query = $this->db->query("SELECT month(tgl_bayar) as bulan, SUM(total_bayar) as total_bayar FROM spd WHERE status_bayar='2' AND year(tgl_bayar)=$tahun AND sort=$sort GROUP BY month(tgl_bayar)");
        } else {
            $query = $this->db->query("SELECT month(tgl_bayar) as bulan, SUM(total_bayar) as total_bayar FROM spd WHERE status_bayar='2' AND month(tgl_bayar)=$bulan AND year(tgl_bayar)=$tahun AND sort=$sort");
        }
        return $query;
    }

    public function rekapPerDIPA($dipa, $tahun, $sort)
    {
        $query = $this->db->query("SELECT dipa, month(tgl_bayar) as bulan, SUM(total_bayar) as total_bayar FROM spd WHERE dipa=$dipa AND status_bayar='2' AND year(tgl_bayar)=$tahun AND sort=$sort GROUP BY month(tgl_bayar)");
        return $query;
    }

    function cek_nospd($no_spd = "")
	{
		$query = $this->db->get_where('spd', array('no_spd' => $no_spd));
		$query = $query->result_array();
		return $query;
    }
    
    public function update($table, $kolom, $id,  $data)
	{
		return $this->db->where($kolom, $id)
			->update($table, $data);
	}
	
	public function updateStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('pilih_status');
		$params = array(
			'status' => $status
		);
		/* print_r($id);
		print_r($status); */
		$this->db->where_in('id', $id);
		$this->db->update('spd', $params);
	}
	
}
