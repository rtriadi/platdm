<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spd_admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['spd_admin_m', 'model_setting']);
    }

	public function index()
	{
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort);
            $data['total'] = $this->spd_admin_m->total_submenu($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort);
            $data['total'] = $this->spd_admin_m->total_submenu($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort);
            $data['total'] = $this->spd_admin_m->total_submenu($sort);
        } else {
            $data['row'] = $this->spd_admin_m->get();
            $data['total'] = $this->spd_admin_m->total_submenu('0');
        }
        $data['page'] = "Semua SPD";
        $this->template->load('template', 'spd-admin', $data);
    }

    public function semua()
	{
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort);
            $data['total'] = $this->spd_admin_m->total_submenu($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort);
            $data['total'] = $this->spd_admin_m->total_submenu($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort);
            $data['total'] = $this->spd_admin_m->total_submenu($sort);
        } else {
            $data['row'] = $this->spd_admin_m->get();
            $data['total'] = $this->spd_admin_m->total_submenu('0');
        }
        $data['page'] = "Semua SPD";
        $this->template->load('template', 'spd-admin', $data);
    }

    public function belum_input()
	{
        $status = '0';
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } else {
            $data['row'] = $this->spd_admin_m->getByStatus($status);
            $data['total'] = $this->spd_admin_m->total_submenu('0', $status);
        }
        $data['page'] = "Belum Input Rincian";
        $this->template->load('template', 'spd-admin', $data);
    }

    public function berkas_diterima()
	{
        $status = '1';
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } else {
            $data['row'] = $this->spd_admin_m->getByStatus($status);
            $data['total'] = $this->spd_admin_m->total_submenu('0', $status);
        }
        $data['page'] = "Berkas Diterima";
        $this->template->load('template', 'spd-admin', $data);
    }

    public function ok()
	{
        $status = '2';
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } else {
            $data['row'] = $this->spd_admin_m->getByStatus($status);
            $data['total'] = $this->spd_admin_m->total_submenu('0', $status);
        }
        $data['page'] = "Status OK";
        $this->template->load('template', 'spd-admin', $data);
    }

    public function approved()
	{
        $status = '3';
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } else {
            $data['row'] = $this->spd_admin_m->getByStatus($status);
            $data['total'] = $this->spd_admin_m->total_submenu('0', $status);
        }
        $data['page'] = "Approved oleh PPK";
        $this->template->load('template', 'spd-admin', $data);
    }

    public function spd_batal()
	{
        $status = '5';
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } else {
            $data['row'] = $this->spd_admin_m->getByStatus($status);
            $data['total'] = $this->spd_admin_m->total_submenu('0', $status);
        }
        $data['page'] = "SPD Batal";
        $this->template->load('template', 'spd-admin', $data);
    }

    public function telah_bayar()
	{
        $status = '4';
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySort($sort, $status);
            $data['total'] = $this->spd_admin_m->total_submenu($sort, $status);
        } else {
            $data['row'] = $this->spd_admin_m->getByStatus($status);
            $data['total'] = $this->spd_admin_m->total_submenu('0', $status);
        }
        $data['page'] = "Telah Bayar";
        $this->template->load('template', 'spd-admin', $data);
    }
    
    public function export_excel()
	{
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $data['row'] = $this->spd_admin_m->getBySortExcel($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $data['row'] = $this->spd_admin_m->getBySortExcel($sort);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $data['row'] = $this->spd_admin_m->getBySortExcel($sort);
        } else {
            $sort = '0';
            $data['row'] = $this->spd_admin_m->getExcel();
        }
        
        $this->template->load('template', 'spd-admin-excel', $data);
	}
	
	public function add()
    {
        $spd_admin = new stdClass();
        $spd_admin->id             = null;
        $spd_admin->nip_ppk        = null;
        $spd_admin->nip_bendahara  = null;
        $spd_admin->nip_pegawai    = null;
        $spd_admin->no_spd         = null;
        $spd_admin->tgl_spd        = null;
        $spd_admin->maksud         = null;
        $spd_admin->kendaraan      = null;
        $spd_admin->lamanya        = null;
        $spd_admin->tgl_berangkat  = null;
        $spd_admin->tujuan1        = null;
        $spd_admin->tujuan2        = null;
        $spd_admin->tujuan3        = null;
        $spd_admin->tujuan4        = null;
        $spd_admin->tgl_selesai    = null;
        $spd_admin->no_st          = null;
        $spd_admin->tgl_st         = null;
        $spd_admin->uang_muka      = null;
        $spd_admin->status         = null;

            
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $query_peg = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
            $query_ben = $this->spd_admin_m->getPegawaiBendaByKantor($this->fungsi->user_login()->kantor);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $query_peg = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
            $query_ben = $this->spd_admin_m->getPegawaiBendaByKantor($this->fungsi->user_login()->kantor);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $query_peg = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
            $query_ben = $this->spd_admin_m->getPegawaiBendaByKantor($this->fungsi->user_login()->kantor);
        } else {
            $sort = '0';
            $query_peg = $this->spd_admin_m->getPegawai();
            $query_ben = $this->spd_admin_m->getPegawaiBendaByKantor($this->fungsi->user_login()->kantor);
        }
        
        $query_ppk = $this->spd_admin_m->getPegawaiPPKByKantor();
        $query_city = $this->spd_admin_m->getCity();

        $data = array(
            'page'   => 'Tambah',
            'row'    => $spd_admin,
            'peg'    => $query_peg,
            'ppk'    => $query_ppk,
            'ben'    => $query_ben,
            'city'   => $query_city,
            'sort'   => $sort,
            'kantor'  => $this->fungsi->user_login()->kantor
        );
        $this->template->load('template', 'spd-admin-form', $data);
    }

    public function edit($id)
    {
        $query = $this->spd_admin_m->get($id);

        if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
            $query_peg = $this->spd_admin_m->getPegawai();
            $query_ben = $this->spd_admin_m->getPegawaiBendaByKantor();
        } else {
            $query_peg = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
            $query_ben = $this->spd_admin_m->getPegawaiBendaByKantor($this->fungsi->user_login()->kantor);
        }

        $query_ppk = $this->spd_admin_m->getPegawaiPPKByKantor();
        $query_city = $this->spd_admin_m->getCity();

        if($query->num_rows() > 0) {
            $spd_admin = $query->row();
            $data = array(
                'page'   => 'Edit',
                'row'    => $spd_admin,
                'peg'    => $query_peg,
                'ppk'    => $query_ppk,
                'ben'    => $query_ben,
                'city'   => $query_city,
                'kantor' => $this->fungsi->user_login()->kantor,
                'level'  => $this->fungsi->user_login()->level
            );
            $this->template->load('template', 'spd-admin-form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "<script>window.location='".site_url('spd-admin/semua')."';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['Tambah'])) {
            $this->spd_admin_m->add($post);
        } else if(isset($_POST['Edit'])) {
            $this->spd_admin_m->edit($post);
        } else if(isset($_POST['Bayar'])) {
            $this->spd_admin_m->update_bayar($post);
        } 

        if($this->db->affected_rows() >0 ) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }

        if(isset($_POST['Bayar'])) {
            redirect('spd_admin/telah_bayar');
        } else {
            redirect('spd_admin/semua');
        }
    }

    public function delete($id)
    {
        $this->spd_admin_m->delete($id);
        if($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location='".site_url('spd_admin/semua')."';</script>";
    }

    public function batal($id)
    {
        $this->spd_admin_m->batal($id);
        if($this->db->affected_rows() > 0) {
            echo "<script>alert('SPD berhasil dibatalkan');</script>";
        }
        echo "<script>window.location='".site_url('spd_admin/semua')."';</script>";
    }

    public function ceklis_berkas_diterima()
	{
		$mode = $_POST['mode'];
		$id = $_POST['id'];
		if ($mode == 'true')
		{
			$str = $this->db->query("UPDATE spd SET status = '1' where id = $id");
			$message = 'Hey my button is enableed!!';
			$success = 'Enabled';
			echo json_encode(array('message' => $message, '$success' => $success));
		} else if ($mode == 'false') {
			$str = $this->db->query("UPDATE spd SET status = '0' where id = $id");
			$message = 'Hey my button is disable!!';
			$success = 'Disabled';
			echo json_encode(array('message' => $message, 'success' => $success));
		}
    }
    
    public function ceklis_ok()
	{
		$mode = $_POST['mode'];
		$id = $_POST['id'];
		if ($mode == 'true')
		{
			$str = $this->db->query("UPDATE spd SET status = '2' where id = $id");
			$message = 'Hey my button is enableed!!';
			$success = 'Enabled';
			echo json_encode(array('message' => $message, '$success' => $success));
		} else if ($mode == 'false') {
			$str = $this->db->query("UPDATE spd SET status = '1' where id = $id");
			$message = 'Hey my button is disable!!';
			$success = 'Disabled';
			echo json_encode(array('message' => $message, 'success' => $success));
		}
    }
    
    public function ceklis_approved()
	{
		$mode = $_POST['mode'];
		$id = $_POST['id'];
		if ($mode == 'true')
		{
			$str = $this->db->query("UPDATE spd SET status = '3' where id = $id");
			$message = 'Hey my button is enableed!!';
			$success = 'Enabled';
			echo json_encode(array('message' => $message, '$success' => $success));
		} else if ($mode == 'false') {
			$str = $this->db->query("UPDATE spd SET status = '2' where id = $id");
			$message = 'Hey my button is disable!!';
			$success = 'Disabled';
			echo json_encode(array('message' => $message, 'success' => $success));
		}
    }
    
    public function ceklis_reapproved()
	{
            $id = $_POST['id'];
		    $str = $this->db->query("UPDATE spd SET status = '3' where id = $id");
			$message = 'Hey my button is disable!!';
			$success = 'Disabled';
			echo json_encode(array('message' => $message, 'success' => $success));
	}

    public function status_ok($id)
    {
        $this->spd_admin_m->statusOK($id);
        // if($this->db->affected_rows() > 0) {
        //     echo "<script>alert('Data berhasil diubah');</script>";
        // }
        echo "<script>window.location='".site_url('spd_admin/ok')."';</script>";
    }

    public function status_approved($id)
    {
        $this->spd_admin_m->statusApproved($id);
        // if($this->db->affected_rows() > 0) {
        //     echo "<script>alert('Data berhasil diubah');</script>";
        // }
        echo "<script>window.location='".site_url('spd_admin/approved')."';</script>";
    }

    public function print_spd($id)
	{
        $data['row'] = $this->spd_admin_m->get($id);
        //$this->template->load('template', 'spd-admin-print', $data);
        $this->load->view('spd-admin-print', $data);
    }
    
    public function print_lampiran($id)
	{
        $data['row'] = $this->spd_admin_m->get($id);
        //$this->template->load('template', 'spd-admin-print', $data);
        $this->load->view('spd-admin-lampiran', $data);
    }
    
    public function print_rincian($id)
	{
        $data['row'] = $this->spd_admin_m->get($id);
        //$this->template->load('template', 'spd-admin-print', $data);
        $this->load->view('spd-admin-rincian', $data);
    }
    
    public function update_status()
	{
		$this->spd_admin_m->updateStatus();
		redirect('spd_admin/semua');
	}
}
