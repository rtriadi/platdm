<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        //check_admin();
        $this->load->model('spd_admin_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
            $sort = '1';
            $query_peg = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
            $sort = '2';
            $query_peg = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
        } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
            $sort = '3';
            $query_peg = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
        } else {
            $sort = '0';
            $query_peg = $this->spd_admin_m->getPegawai();
        }

        $data = array(
            'page'   => 'Tambah',
            'peg'    => $query_peg,
            'sort'   => $sort,
            'kantor'  => $this->fungsi->user_login()->kantor
        );
        $this->template->load('template', 'rekap', $data);
        // $this->template->load('template', 'rekap');
    }

    public function rekapSPD()
    {
        $tahun = $this->input->post('tahun', TRUE);
        $bulan = $this->input->post('bulan', TRUE);
        $nip_pegawai = $this->input->post('nip_pegawai', TRUE);
        $jenis = $this->input->post('jenis', TRUE);
        $dipa = $this->input->post('dipa', TRUE);
        $sort = $this->input->post('sort', TRUE);

        $data = array(
            'tahun'          => $tahun,
            'bulan'          => $bulan,
            'nip_pegawai'    => $nip_pegawai,
            'dipa'           => $dipa,
            'jenis'          => $jenis,
            'sort'          => $sort
        );
        $this->template->load('template', 'rekap-hasil', $data);
    }

    public function rekapPembuatanSPD()
    {
        $bulan = $this->input->post('bulan', TRUE);
        $tahun = $this->input->post('tahun', TRUE);
        $sort = $this->input->post('sort', TRUE);
        $query_bulan = $this->spd_admin_m->rekapPembuatanSPD($bulan, $tahun, $sort);
        $data = array(
            'page'   => 'Rekap Per Bulan Pembuatan SPD',
            'bulan'    => $query_bulan,
        );
        $this->template->load('template', 'rekap-bulan', $data);
    }

    public function rekapPembayaranSPD()
    {
        $bulan = $this->input->post('bulan', TRUE);
        $tahun = $this->input->post('tahun', TRUE);
        $sort = $this->input->post('sort', TRUE);
        $query_bulan = $this->spd_admin_m->rekapPembayaranSPD($bulan, $tahun, $sort);
        $data = array(
            'page'   => 'Rekap Per Bulan Pembayaran SPD',
            'bulan'    => $query_bulan,
        );
        $this->template->load('template', 'rekap-bulan', $data);
    }

    public function rekapPerDIPA()
    {
        $dipa = $this->input->post('dipa', TRUE);
        $tahun = $this->input->post('tahun', TRUE);
        $sort = $this->input->post('sort', TRUE);
        $query_dipa = $this->spd_admin_m->rekapPerDIPA($dipa, $tahun, $sort);
        $data = array(
            'page'   => 'Rekap Per DIPA',
            'dipa'    => $query_dipa,
        );
        $this->template->load('template', 'rekap-dipa', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('fullname', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[tbl_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules(
            'passconf',
            'Konfirmasi Password',
            'required|matches[password]',
            array('matches' => '%s tidak sesuai dengan password')
        );
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '%s ini sudah dipakai, silahkan ganti');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/rekap_form_add');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->rekap_m->add($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data berhasil disimpan');</script>";
            }
            echo "<script>window.location='" . site_url('user') . "';</script>";
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('fullname', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_username_check');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules(
                'passconf',
                'Konfirmasi Password',
                'matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }
        if ($this->input->post('passconf')) {
            $this->form_validation->set_rules(
                'passconf',
                'Konfirmasi Password',
                'matches[password]',
                array('matches' => '%s tidak sesuai dengan password')
            );
        }

        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
        $this->form_validation->set_message('min_length', '%s minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '%s ini sudah dipakai, silahkan ganti');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->rekap_m->get($id);
            if ($query->num_rows() > 0) {
                $data['row'] = $query->row();
                $this->template->load('template', 'user/rekap_form_edit', $data);
            } else {
                echo "<script>alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('user') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);
            $this->rekap_m->edit($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data berhasil disimpan');</script>";
            }
            echo "<script>window.location='" . site_url('user') . "';</script>";
        }
    }

    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM tbl_user WHERE username = '$post[username]' AND rekap_id != '$post[rekap_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete()
    {
        $id = $this->input->post('rekap_id');
        $this->rekap_m->delete($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location='" . site_url('user') . "';</script>";
    }
}
