<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        /* check_admin(); */
        $this->load->model(['pegawai_m', 'spd_admin_m']);
        $this->load->library('form_validation');
    }

	public function index()
	{
        if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
            $data['row'] = $this->spd_admin_m->getPegawai();
        } else {
            $data['row'] = $this->spd_admin_m->getPegawaiByKantor($this->fungsi->user_login()->kantor);
        } 
        // $data['row'] = $this->pegawai_m->getByLevel();
		$this->template->load('template', 'pegawai-data', $data);
	}
	
	public function add()
    {
        $pegawai              = new stdClass();
        $pegawai->id_pegawai  = null;
        $pegawai->nip         = null;
        $pegawai->nama        = null;
        $pegawai->pangkat_gol = null;
        $pegawai->jabatan     = null;
        $pegawai->kantor      = null;
        $pegawai->password    = null;
        $pegawai->level       = null;
        
        $data = array(
            'page' => 'Tambah',
			'row' => $pegawai
        );
        $this->template->load('template', 'pegawai-form', $data);
    }

    public function edit($id)
    {
        $query = $this->pegawai_m->get($id);
        if($query->num_rows() > 0) {
			$pegawai = $query->row();
			
            $data = array(
                'page' => 'Edit',
				'row' => $pegawai
            );
            $this->template->load('template', 'pegawai-form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "<script>window.location='".site_url('pegawai')."';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['Tambah'])) {
            $this->pegawai_m->add($post);
        } else if(isset($_POST['Edit'])) {
            $this->pegawai_m->edit($post);
        } 

        if($this->db->affected_rows() >0 ) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('pegawai');
    }

    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM pegawai WHERE username = '$post[username]' AND id != '$post[id]'");
        if($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silahkan ganti');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function delete($id)
    {
        $this->pegawai_m->delete($id);
        $this->pegawai_m->delete_nip_spd($id);
        $this->pegawai_m->delete_nip_spd_pegawai($id);
        if($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location='".site_url('pegawai')."';</script>";
    }
    
    public function import_pegawai()
	{
		$insert = 0;
		$update = 0;

		$path = 'assets/uploads/import_pegawai/';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls';
		$config['remove_spaces'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('insertFile')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
		}
		if (empty($error)) {
			if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
			} else {
				$import_xls_file = 0;
			}
			$inputFileName = $path . $import_xls_file;

			try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$flag = true;
				$i = 0;
				foreach ($allDataInSheet as $value) {
					if ($flag) {
						$flag = false;
						continue;
					}

					$inserdata[$i]['nip']         = substr(str_replace(' ', '', $value['B']), 3);
					$inserdata[$i]['nama']        = $value['A'];
					$inserdata[$i]['pangkat_gol'] = $value['D'];
					$inserdata[$i]['jabatan']     = $value['C'];
					$inserdata[$i]['kantor']      = $value['E'];
					$inserdata[$i]['password']    = substr(str_replace(' ', '', $value['B']), 3);
					$inserdata[$i]['level']       = '4';
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->pegawai_m->cek_nip($dt['nip']);
					if (count($cek) == 1) {
						$datas = array(
							'nip'         => $dt['nip'],
							'nama'        => $dt['nama'],
							'pangkat_gol' => $dt['pangkat_gol'],
							'jabatan'     => $dt['jabatan'],
							'kantor'      => $dt['kantor'],
							'password'    => sha1($dt['password']),
							'level'       => $dt['level']
						);

						$apdet = $this->pegawai_m->update('pegawai', 'nip', $dt['nip'], $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'nip'         => $dt['nip'],
							'nama'        => $dt['nama'],
							'pangkat_gol' => $dt['pangkat_gol'],
							'jabatan'     => $dt['jabatan'],
							'kantor'      => $dt['kantor'],
							'password'    => sha1($dt['password']),
							'level'       => $dt['level']
						);

						$inser = $this->pegawai_m->create('pegawai', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "pegawai';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}
	
	public function account()
	{
        $data['row'] = $this->pegawai_m->get($this->fungsi->user_login()->id);
		$this->template->load('template', 'pegawai/account_data', $data);
	}

	public function account_edit_ts($id)
    {
        $query = $this->pegawai_m->get($id);
        if($query->num_rows() > 0) {
			$pegawai = $query->row();
			$query_city = $this->city_m->get();
			$query_pegawai_type = $this->pegawai_type_m->get();
			
            $data = array(
                'page' => 'edit',
				'row' => $pegawai,
				'city' => $query_city,
				'pegawai_type' => $query_pegawai_type
            );
            $this->template->load('frontend/template', 'frontend/user-profile', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "<script>window.location='".site_url('home')."';</script>";
        }
    }
    
    public function account_edit($id)
    {
        $query = $this->pegawai_m->get($id);
        if($query->num_rows() > 0) {
			$pegawai = $query->row();
			$query_city = $this->city_m->get();
			$query_pegawai_type = $this->pegawai_type_m->get();
			
            $data = array(
                'page' => 'edit',
				'row' => $pegawai,
				'city' => $query_city,
				'pegawai_type' => $query_pegawai_type
            );
            $this->template->load('template', 'pegawai/account_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "<script>window.location='".site_url('akun')."';</script>";
        }
	}
	
    public function account_process_ts()
    {
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['edit'])) {
            $this->pegawai_m->edit($post);
            $id = $this->input->post('id', TRUE);
            //print_r($post);
        } 

        if($this->db->affected_rows() >0 ) {
            //$this->session->set_flashdata('success', 'Data berhasil disimpan');
            echo "<script>
				alert('Data berhasil disimpan');
				window.location='".site_url('akun/editts/'.$id.'')."'
				</script>";
        }
        //redirect('akun');
    }

    public function account_process()
    {
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['edit'])) {
            $this->pegawai_m->edit($post);
        } 

        if($this->db->affected_rows() >0 ) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        }
        redirect('akun');
    }

    public function approveppk()
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
        $data['page'] = "Menunggu di Approve oleh PPK";
        $this->template->load('template', 'spd-admin', $data);
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

    public function print_rincian($id)
	{
        $data['row'] = $this->spd_admin_m->get($id);
        //$this->template->load('template', 'spd-admin-print', $data);
        $this->load->view('spd-admin-rincian', $data);
    }

}
