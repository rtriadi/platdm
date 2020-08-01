<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['model_pegawai', 'user_m', 'model_setting', 'spd_admin_m']);
		$this->load->library('form_validation');
	}

	public function spdku()
	{
		if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
			$sort = '1';
		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
			$sort = '2';
		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
			$sort = '3';
		} else {
			$sort = '0';
		}
		$data['format'] = $this->model_setting->getSetting($sort, '1')->row();
		$data['row'] = $this->model_pegawai->getSPDbyNip($this->fungsi->user_login()->nip);
		$this->template->load('template', 'pegawai/spdku/spdku_data', $data);
	}

	public function approve_spdku()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['approve'])) {
			$params = array(
				'status_ppk' => '1'
			);
			$this->db->where('id', $post['id']);
			$this->db->update('spd', $params);
			redirect('spdku/approve_spdku');
		} else {
			if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
				$sort = '1';
			} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
				$sort = '2';
			} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
				$sort = '3';
			} else {
				$sort = '0';
			}
			$data['format'] = $this->model_setting->getSetting($sort, '1')->row();
			$data['row'] = $this->model_pegawai->getApproveSPDbyNip($this->fungsi->user_login()->nip);
			$this->template->load('template', 'pegawai/spdku/approve_spdku', $data);
		}
	}

	public function laporan_pengeluaran_riil($id)
	{
		if ($this->fungsi->user_login()->level == 4) {
			$data['row'] = $this->model_pegawai->getSPDbyNip($this->fungsi->user_login()->nip, $id)->row();
		} else {
			$nip = '';
			$data['row'] = $this->model_pegawai->getSPDbyNip($nip, $id)->row();
		}
		$this->load->view('pegawai/spdku/laporan_penghasilan_riil', $data);
	}

	public function laporan_pelaksanaan_st($id)
	{
		if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
			$sort = '1';
		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
			$sort = '2';
		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
			$sort = '3';
		} else {
			$sort = '0';
		}

		if ($this->fungsi->user_login()->level == 4) {
			$data['row'] = $this->model_pegawai->getSPDbyNip($this->fungsi->user_login()->nip, $id)->row();
		} else {
			$nip = '';
			$data['row'] = $this->model_pegawai->getSPDbyNip($nip, $id)->row();
		}

		$data['format'] = $this->model_setting->getSetting($sort, '1')->row();
		$this->load->view('pegawai/spdku/laporan_pelaksanaan_st', $data);
	}

	public function spdku_rincian($id)
	{
		$this->form_validation->set_rules('tgl_berangkat', 'Tgl Berangkat', 'required');
		$this->form_validation->set_rules('tgl_selesai', 'Tgl Selesai', 'required');
		/*$this->form_validation->set_rules('by_transportasi_berangkat', 'Biaya Transportasi Berangkat', 'required');
		$this->form_validation->set_rules('by_transportasi_pulang', 'Biaya Transportasi Pulang', 'required');
		$this->form_validation->set_rules('total_by_transportasi', 'Total Biaya Transportasi', 'required');

		$this->form_validation->set_rules('durasi_menginap', 'Durasi Menginap', 'required');
		$this->form_validation->set_rules('menginap_dari', 'Menginap Dari', 'required');
		$this->form_validation->set_rules('menginap_sampai', 'Menginap Sampai', 'required');
		$this->form_validation->set_rules('tarif_penginapan', 'Tarif Penginapan', 'required');
		$this->form_validation->set_rules('total_by_penginapan', 'Total Biaya Penginapan', 'required');
		$this->form_validation->set_rules('pengeluaran1', 'Pengeluaran1', 'required');
		$this->form_validation->set_rules('pengeluaran2', 'Pengeluaran2', 'required');
		$this->form_validation->set_rules('pengeluaran3', 'Pengeluaran3', 'required');
		$this->form_validation->set_rules('pengeluaran4', 'Pengeluaran4', 'required');
		$this->form_validation->set_rules('pengeluaran_riil', 'Pengeluaran Riil', 'required');
		$this->form_validation->set_rules('grand_total', 'Grand Total', 'required');
		$this->form_validation->set_rules('nip_atasan', 'Atasan', 'required');
		$this->form_validation->set_rules('isi_laporan', 'Laporan Pelaksanaan ST', 'required');*/

		$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length', '%s minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '%s ini sudah dipakai, silahkan ganti');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger font-italic small">', '</span>');

		$config['upload_path']    = './uploads/kuitansi/';
		$config['allowed_types']  = 'pdf';
		$config['max_size']       = 10240;
		$config['file_name']      = 'kuitansi-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);

		$post = $this->input->post(null, TRUE);

		if ($this->form_validation->run() == FALSE) {
			if ($this->fungsi->user_login()->level == 4) {
				$query = $this->model_pegawai->getSPDbyNip($this->fungsi->user_login()->nip, $id);
			} else {
				$nip = '';
				$query = $this->model_pegawai->getSPDbyNip($nip, $id);
			}
			if ($query->num_rows() > 0) {
				if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
					$sort = '1';
				} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
					$sort = '2';
				} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
					$sort = '3';
				} else {
					$sort = '0';
				}
				$format = $this->model_setting->getSetting($sort, '1')->row();
				$spd = $query->row();
				$pangkat_gol = $spd->pangkat_gol;
				$provinsi = $spd->province_name;
				$query_cek_penginapan = $this->model_pegawai->cek_penginapan($provinsi, $pangkat_gol)->row();
				$query_cek_biaya_taxi = $this->model_pegawai->cek_biaya_taxi($provinsi)->row();
				$query_pegawai = $this->model_pegawai->getPegawai();

				$data = array(
					'row' => $spd,
					'format' => $format,
					'cek_penginapan' => $query_cek_penginapan,
					'cek_biaya_taxi' => $query_cek_biaya_taxi,
					'pegawai' => $query_pegawai
				);
				$this->template->load('template', 'pegawai/spdku/spdku_form', $data);
			} else {
				echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('spdku') . "';</script>";
			}
		} else {
			if (@$_FILES['kuitansi']['name'] != null) {
				if ($this->upload->do_upload('kuitansi')) {

					$sql = $this->model_pegawai->getSPDbyNip($this->fungsi->user_login()->nip, $post['id'])->row();
					if ($sql->kuitansi != null) {
						$target_file = './uploads/kuitansi/' . $sql->kuitansi;
						unlink($target_file);
					}

					$post['kuitansi'] = $this->upload->data('file_name');
					$this->model_pegawai->spdkuEdit($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					if ($this->fungsi->user_login()->level == 4) {
						redirect('spdku');
					} else {
						redirect('spd_admin');
					}
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					if ($this->fungsi->user_login()->level == 4) {
						redirect('spdku');
					} else {
						redirect('spd_admin');
					}
				}
			} else {
				$post['kuitansi'] = null;
				$this->model_pegawai->spdkuEdit($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				if ($this->fungsi->user_login()->level == 4) {
					redirect('spdku');
				} else {
					redirect('spd_admin');
				}
			}
		}
	}

	function nip_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM pegawai WHERE nip = '$post[nip]' AND id_pegawai != '$post[id_pegawai]'");
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('nip_check', '{field} ini sudah dipakai, silahkan ganti');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function akunku()
	{
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

		$this->form_validation->set_message('required', '%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length', '%s minimal 5 karakter');
		$this->form_validation->set_message('is_unique', '%s ini sudah dipakai, silahkan ganti');

		$this->form_validation->set_error_delimiters('<span class="help-block text-danger font-italic small">', '</span>');

		if ($this->form_validation->run() == FALSE) {
			$query = $this->user_m->get($this->fungsi->user_login()->id_pegawai);
			if ($query->num_rows() > 0) {
				$spd = $query->row();
				$data = array(
					'row' => $spd
				);
				$this->template->load('template', 'pegawai/akunku/akunku_form', $data);
			} else {
				echo "<script>alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('spdku') . "';</script>";
			}
		} else {
			$post = $this->input->post(null, TRUE);
			$this->user_m->edit($post);
			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			echo "<script>window.location='" . site_url('dashboard') . "';</script>";
		}
	}

	public function slipgajiku($nip)
	{
		$this->template->load('template', 'pegawai/slipgajiku/slipgajiku_data');
	}

	public function showGaji()
	{
		$bln = $this->input->get('bln');
		$thn = $this->input->get('thn');
		$nip = $this->input->get('nip');
		$bulan = substr($bln, 0, 3);
		$tahun = substr($thn, 2);
		$bln_thn = $bulan . '-' . $tahun;

		$gaji = $this->model_pegawai->gaji($bln_thn, $nip);
		if ($this->model_pegawai->gaji13($bln_thn, $nip)->num_rows() > 0) {
			$gaji13 = $this->model_pegawai->gaji13($bln_thn, $nip)->row()->gaji13;
		} else {
			$gaji13 = 0;
		}
		if ($this->model_pegawai->honor($bln_thn, $nip)->num_rows() > 0) {
			$honor = $this->model_pegawai->honor($bln_thn, $nip)->row()->honor;
			$honor_ket = $this->model_pegawai->honor($bln_thn, $nip)->row()->keterangan;
		} else {
			$honor = 0;
			$honor_ket = '-';
		}
		if ($this->model_pegawai->insentif($bln_thn, $nip)->num_rows() > 0) {
			$insentif = $this->model_pegawai->insentif($bln_thn, $nip)->row()->insentif;
		} else {
			$insentif = 0;
		}
		if ($this->model_pegawai->kekurangan_gaji($bln_thn, $nip)->num_rows() > 0) {
			$kekurangan_gaji = $this->model_pegawai->kekurangan_gaji($bln_thn, $nip)->row()->kekurangan_gaji;
			$kekurangan_gaji_ket = $this->model_pegawai->kekurangan_gaji($bln_thn, $nip)->row()->keterangan;
		} else {
			$kekurangan_gaji = 0;
			$kekurangan_gaji_ket = '-';
		}
		if ($this->model_pegawai->thr($bln_thn, $nip)->num_rows() > 0) {
			$thr = $this->model_pegawai->thr($bln_thn, $nip)->row()->thr;
		} else {
			$thr = 0;
		}
		if ($this->model_pegawai->tukin_13($bln_thn, $nip)->num_rows() > 0) {
			$tukin_13 = $this->model_pegawai->tukin_13($bln_thn, $nip)->row()->tukin_13;
		} else {
			$tukin_13 = 0;
		}
		if ($this->model_pegawai->tukin_thr($bln_thn, $nip)->num_rows() > 0) {
			$tukin_thr = $this->model_pegawai->tukin_thr($bln_thn, $nip)->row()->tukin_thr;
		} else {
			$tukin_thr = 0;
		}
		if ($this->model_pegawai->kekurangan_tukin($bln_thn, $nip)->num_rows() > 0) {
			$kekurangan_tukin = $this->model_pegawai->kekurangan_tukin($bln_thn, $nip)->row()->kekurangan_tukin;
			$kekurangan_tukin_ket = $this->model_pegawai->kekurangan_tukin($bln_thn, $nip)->row()->keterangan;
		} else {
			$kekurangan_tukin = 0;
			$kekurangan_tukin_ket = '-';
		}
		if ($this->model_pegawai->tukin_plt($bln_thn, $nip)->num_rows() > 0) {
			$tukin_plt = $this->model_pegawai->tukin_plt($bln_thn, $nip)->row()->tukin_plt;
			$tukin_plt_ket = $this->model_pegawai->tukin_plt($bln_thn, $nip)->row()->keterangan;
		} else {
			$tukin_plt = 0;
			$tukin_plt_ket = '-';
		}
		if ($this->model_pegawai->uang_lembur($bln_thn, $nip)->num_rows() > 0) {
			$uang_lembur = $this->model_pegawai->uang_lembur($bln_thn, $nip)->row()->uang_lembur;
		} else {
			$uang_lembur = 0;
		}
		if ($this->model_pegawai->uang_makan($bln_thn, $nip)->num_rows() > 0) {
			$uang_makan = $this->model_pegawai->uang_makan($bln_thn, $nip)->row()->uang_makan;
		} else {
			$uang_makan = 0;
		}
		if ($this->model_pegawai->potongan_tukin($bln_thn, $nip)->num_rows() > 0) {
			$potongan_tukin = $this->model_pegawai->potongan_tukin($bln_thn, $nip)->row();

			$jumlah_potongan = $potongan_tukin->absensi +
				$potongan_tukin->futsal +
				$potongan_tukin->prodip_manado +
				$potongan_tukin->tinelo +
				$potongan_tukin->asuransi_kolektif +
				$potongan_tukin->panti +
				$potongan_tukin->yayasan +
				$potongan_tukin->pinogu +
				$potongan_tukin->forum_ar +
				$potongan_tukin->uang_makan_forum_ar +
				$potongan_tukin->iuran_oikumene +
				$potongan_tukin->iuran_kasi +
				$potongan_tukin->mushola +
				$potongan_tukin->kurban +
				$potongan_tukin->rumah_dinas +
				$potongan_tukin->mess_inul_vista +
				$potongan_tukin->mess_cinta +
				$potongan_tukin->suki +
				$potongan_tukin->pdi +
				$potongan_tukin->iuran_seksi_waskon_1 +
				$potongan_tukin->iuran_seksi_waskon_2 +
				$potongan_tukin->iuran_seksi_waskon_3 +
				$potongan_tukin->iuran_seksi_waskon_4 +
				$potongan_tukin->iuran_seksi_penagihan +
				$potongan_tukin->iuran_seksi_pemeriksaan +
				$potongan_tukin->iuran_seksi_ekstensifikasi +
				$potongan_tukin->iuran_seksi_pelayanan +
				$potongan_tukin->lain_lain +
				$potongan_tukin->pas +
				$potongan_tukin->cbb;
			$tukin_bersih = ($potongan_tukin->tukin_kotor + $potongan_tukin->tambahan_lain) - $jumlah_potongan;
		} else {
			$potongan_tukin = null;
			$jumlah_potongan = 0;
			$tukin_bersih = 0;
		}

		$jumlah_penghasilan_lain = $gaji13 +
			$honor +
			$insentif +
			$kekurangan_gaji +
			$thr +
			$tukin_13 +
			$tukin_thr +
			$kekurangan_tukin +
			$tukin_plt +
			$uang_lembur +
			$uang_makan;

		if ($gaji->num_rows() > 0) {
			$jumlah = $gaji->row()->gaji + $tukin_bersih + $jumlah_penghasilan_lain;
		} else {
			$jumlah = 0;
		}

		$data['bln'] = $bln;
		$data['thn'] = $thn;
		$data['gaji'] = $gaji;
		$data['gaji13'] = $gaji13;
		$data['honor'] = $honor;
		$data['honor_ket'] = $honor_ket;
		$data['insentif'] = $insentif;
		$data['kekurangan_gaji'] = $kekurangan_gaji;
		$data['kekurangan_gaji_ket'] = $kekurangan_gaji_ket;
		$data['thr'] = $thr;
		$data['tukin_13'] = $tukin_13;
		$data['tukin_thr'] = $tukin_thr;
		$data['kekurangan_tukin'] = $kekurangan_tukin;
		$data['kekurangan_tukin_ket'] = $kekurangan_tukin_ket;
		$data['tukin_plt'] = $tukin_plt;
		$data['tukin_plt_ket'] = $tukin_plt_ket;
		$data['uang_lembur'] = $uang_lembur;
		$data['uang_makan'] = $uang_makan;
		$data['potongan_tukin'] = $potongan_tukin;
		$data['tukin_bersih'] = $tukin_bersih;
		$data['jumlah_penghasilan_lain'] = $jumlah_penghasilan_lain;
		$data['jumlah_potongan'] = $jumlah_potongan;
		$data['jumlah'] = $jumlah;
		$this->load->view('pegawai/slipgajiku/showGaji', $data);
	}

	public function gaji_pdf()
	{
		$bln = $this->input->get('bln');
		$thn = $this->input->get('thn');
		$nip = $this->input->get('nip');
		$bulan = substr($bln, 0, 3);
		$tahun = substr($thn, 2);
		$bln_thn = $bulan . '-' . $tahun;

		$gaji = $this->model_pegawai->gaji($bln_thn, $nip);
		if ($this->model_pegawai->gaji13($bln_thn, $nip)->num_rows() > 0) {
			$gaji13 = $this->model_pegawai->gaji13($bln_thn, $nip)->row()->gaji13;
		} else {
			$gaji13 = 0;
		}
		if ($this->model_pegawai->honor($bln_thn, $nip)->num_rows() > 0) {
			$honor = $this->model_pegawai->honor($bln_thn, $nip)->row()->honor;
			$honor_ket = $this->model_pegawai->honor($bln_thn, $nip)->row()->keterangan;
		} else {
			$honor = 0;
			$honor_ket = '-';
		}
		if ($this->model_pegawai->insentif($bln_thn, $nip)->num_rows() > 0) {
			$insentif = $this->model_pegawai->insentif($bln_thn, $nip)->row()->insentif;
		} else {
			$insentif = 0;
		}
		if ($this->model_pegawai->kekurangan_gaji($bln_thn, $nip)->num_rows() > 0) {
			$kekurangan_gaji = $this->model_pegawai->kekurangan_gaji($bln_thn, $nip)->row()->kekurangan_gaji;
			$kekurangan_gaji_ket = $this->model_pegawai->kekurangan_gaji($bln_thn, $nip)->row()->keterangan;
		} else {
			$kekurangan_gaji = 0;
			$kekurangan_gaji_ket = '-';
		}
		if ($this->model_pegawai->thr($bln_thn, $nip)->num_rows() > 0) {
			$thr = $this->model_pegawai->thr($bln_thn, $nip)->row()->thr;
		} else {
			$thr = 0;
		}
		if ($this->model_pegawai->tukin_13($bln_thn, $nip)->num_rows() > 0) {
			$tukin_13 = $this->model_pegawai->tukin_13($bln_thn, $nip)->row()->tukin_13;
		} else {
			$tukin_13 = 0;
		}
		if ($this->model_pegawai->tukin_thr($bln_thn, $nip)->num_rows() > 0) {
			$tukin_thr = $this->model_pegawai->tukin_thr($bln_thn, $nip)->row()->tukin_thr;
		} else {
			$tukin_thr = 0;
		}
		if ($this->model_pegawai->kekurangan_tukin($bln_thn, $nip)->num_rows() > 0) {
			$kekurangan_tukin = $this->model_pegawai->kekurangan_tukin($bln_thn, $nip)->row()->kekurangan_tukin;
			$kekurangan_tukin_ket = $this->model_pegawai->kekurangan_tukin($bln_thn, $nip)->row()->keterangan;
		} else {
			$kekurangan_tukin = 0;
			$kekurangan_tukin_ket = '-';
		}
		if ($this->model_pegawai->tukin_plt($bln_thn, $nip)->num_rows() > 0) {
			$tukin_plt = $this->model_pegawai->tukin_plt($bln_thn, $nip)->row()->tukin_plt;
			$tukin_plt_ket = $this->model_pegawai->tukin_plt($bln_thn, $nip)->row()->keterangan;
		} else {
			$tukin_plt = 0;
			$tukin_plt_ket = '-';
		}
		if ($this->model_pegawai->uang_lembur($bln_thn, $nip)->num_rows() > 0) {
			$uang_lembur = $this->model_pegawai->uang_lembur($bln_thn, $nip)->row()->uang_lembur;
		} else {
			$uang_lembur = 0;
		}
		if ($this->model_pegawai->uang_makan($bln_thn, $nip)->num_rows() > 0) {
			$uang_makan = $this->model_pegawai->uang_makan($bln_thn, $nip)->row()->uang_makan;
		} else {
			$uang_makan = 0;
		}
		if ($this->model_pegawai->potongan_tukin($bln_thn, $nip)->num_rows() > 0) {
			$potongan_tukin = $this->model_pegawai->potongan_tukin($bln_thn, $nip)->row();

			$jumlah_potongan = $potongan_tukin->absensi +
				$potongan_tukin->futsal +
				$potongan_tukin->prodip_manado +
				$potongan_tukin->tinelo +
				$potongan_tukin->asuransi_kolektif +
				$potongan_tukin->panti +
				$potongan_tukin->yayasan +
				$potongan_tukin->pinogu +
				$potongan_tukin->forum_ar +
				$potongan_tukin->uang_makan_forum_ar +
				$potongan_tukin->iuran_oikumene +
				$potongan_tukin->iuran_kasi +
				$potongan_tukin->mushola +
				$potongan_tukin->kurban +
				$potongan_tukin->rumah_dinas +
				$potongan_tukin->mess_inul_vista +
				$potongan_tukin->mess_cinta +
				$potongan_tukin->suki +
				$potongan_tukin->pdi +
				$potongan_tukin->iuran_seksi_waskon_1 +
				$potongan_tukin->iuran_seksi_waskon_2 +
				$potongan_tukin->iuran_seksi_waskon_3 +
				$potongan_tukin->iuran_seksi_waskon_4 +
				$potongan_tukin->iuran_seksi_penagihan +
				$potongan_tukin->iuran_seksi_pemeriksaan +
				$potongan_tukin->iuran_seksi_ekstensifikasi +
				$potongan_tukin->iuran_seksi_pelayanan +
				$potongan_tukin->lain_lain +
				$potongan_tukin->pas +
				$potongan_tukin->cbb;
			$tukin_bersih = ($potongan_tukin->tukin_kotor + $potongan_tukin->tambahan_lain) - $jumlah_potongan;
		} else {
			$potongan_tukin = null;
			$jumlah_potongan = 0;
			$tukin_bersih = 0;
		}

		$jumlah_penghasilan_lain = $gaji13 +
			$honor +
			$insentif +
			$kekurangan_gaji +
			$thr +
			$tukin_13 +
			$tukin_thr +
			$kekurangan_tukin +
			$tukin_plt +
			$uang_lembur +
			$uang_makan;

		if ($gaji->num_rows() > 0) {
			$jumlah = $gaji->row()->gaji + $tukin_bersih + $jumlah_penghasilan_lain;
		} else {
			$jumlah = 0;
		}

		$data['bln'] = $bln;
		$data['thn'] = $thn;
		$data['gaji'] = $gaji;
		$data['gaji13'] = $gaji13;
		$data['honor'] = $honor;
		$data['honor_ket'] = $honor_ket;
		$data['insentif'] = $insentif;
		$data['kekurangan_gaji'] = $kekurangan_gaji;
		$data['kekurangan_gaji_ket'] = $kekurangan_gaji_ket;
		$data['thr'] = $thr;
		$data['tukin_13'] = $tukin_13;
		$data['tukin_thr'] = $tukin_thr;
		$data['kekurangan_tukin'] = $kekurangan_tukin;
		$data['kekurangan_tukin_ket'] = $kekurangan_tukin_ket;
		$data['tukin_plt'] = $tukin_plt;
		$data['tukin_plt_ket'] = $tukin_plt_ket;
		$data['uang_lembur'] = $uang_lembur;
		$data['uang_makan'] = $uang_makan;
		$data['potongan_tukin'] = $potongan_tukin;
		$data['tukin_bersih'] = $tukin_bersih;
		$data['jumlah_penghasilan_lain'] = $jumlah_penghasilan_lain;
		$data['jumlah_potongan'] = $jumlah_potongan;
		$data['jumlah'] = $jumlah;

		/*$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "slipgaji.pdf";

		$this->pdf->load_view('pegawai/slipgajiku/laporan_pdf', $data);*/
		$this->load->view('pegawai/slipgajiku/laporan_pdf', $data);
	}

	public function import_spd()
	{
		$insert = 0;
		$update = 0;
		if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
			$sort = '1';
		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
			$sort = '2';
		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
			$sort = '3';
		} else {
			$sort = '0';
		}

		$path = 'uploads/import/';
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

					$pecahtglspd = explode(' ', $value['E']);
					$tglspd = tgl_sql($pecahtglspd[0], $pecahtglspd[1], $pecahtglspd[2]);

					$pecahtglberangkat = explode(' ', $value['H']);
					$tglberangkat = tgl_sql($pecahtglberangkat[0], $pecahtglberangkat[1], $pecahtglberangkat[2]);

					$pecahtglselesai = explode(' ', $value['J']);
					$tglselesai = tgl_sql($pecahtglselesai[0], $pecahtglselesai[1], $pecahtglselesai[2]);

					$pecahtglst = explode(' ', $value['M']);
					$tglst = tgl_sql($pecahtglst[0], $pecahtglst[1], $pecahtglst[2]);

					$pecahtujuan = explode(',', $value['I']);
					$hit = count($pecahtujuan);
					if ($hit == 1) {
						$pecahtujuan[1] = '';
						$pecahtujuan[2] = '';
						$pecahtujuan[3] = '';
					} elseif ($hit == 2) {
						$pecahtujuan[2] = '';
						$pecahtujuan[3] = '';
					} elseif ($hit == 3) {
						$pecahtujuan[3] = '';
					}

					$inserdata[$i]['nip_ppk']                   = $value['N'];
					$inserdata[$i]['nip_bendahara']             = $value['O'];
					$inserdata[$i]['nip_pegawai']               = substr(str_replace(' ', '', $value['C']), 3);
					$inserdata[$i]['no_spd']                    = $value['D'];
					$inserdata[$i]['tgl_spd']                   = $tglspd;
					$inserdata[$i]['maksud']                    = $value['F'];
					$inserdata[$i]['kendaraan']                 = $value['G'];
					$inserdata[$i]['lamanya']                   = $value['K'];
					$inserdata[$i]['tgl_berangkat']             = $tglberangkat;
					$inserdata[$i]['tujuan1']                   = $pecahtujuan[0];
					$inserdata[$i]['tujuan2']                   = $pecahtujuan[1];
					$inserdata[$i]['tujuan3']                   = $pecahtujuan[2];
					$inserdata[$i]['tujuan4']                   = $pecahtujuan[3];
					$inserdata[$i]['tgl_selesai']               = $tglselesai;
					$inserdata[$i]['no_st']                     = substr($value['L'], 3);
					$inserdata[$i]['tgl_st']                    = $tglst;
					$inserdata[$i]['status']              		= '0';
					$inserdata[$i]['sort']                      = $sort;
					$i++;
				}

				foreach ($inserdata as $dt) {
					/* $cek = $this->model_keuangan->cek_gaji($dt['nip_pegawai']);
					if (count($cek) == 1) {
						$datas = array(
							'nip_ppk' => $dt['nip_ppk'],
							'sort' => $dt['sort']
						);

						$apdet = $this->model_keuangan->update('spd', 'nip', $dt['nip'], $datas);
						if ($apdet) {
							$update++;
						}
					} else { */
					$datas = array(
						'nip_ppk'                   => $dt['nip_ppk'],
						'nip_bendahara'             => $dt['nip_bendahara'],
						'nip_pegawai'               => $dt['nip_pegawai'],
						'no_spd'                    => $dt['no_spd'],
						'tgl_spd'                   => $dt['tgl_spd'],
						'maksud'                    => $dt['maksud'],
						'kendaraan'                 => $dt['kendaraan'],
						'lamanya'                   => $dt['lamanya'],
						'tgl_berangkat'             => $dt['tgl_berangkat'],
						'tujuan1'                   => $dt['tujuan1'],
						'tujuan2'                   => $dt['tujuan2'],
						'tujuan3'                   => $dt['tujuan3'],
						'tujuan4'                   => $dt['tujuan4'],
						'tgl_selesai'               => $dt['tgl_selesai'],
						'no_st'                     => $dt['no_st'],
						'tgl_st'                    => $dt['tgl_st'],
						'status'              		=> $dt['status'],
						'sort'                      => $dt['sort']
					);
					//print_r($datas);
					$inser = $this->model_pegawai->create('spd', $datas);

					if ($inser) {
						$insert++;
					}
					/* } */
				}
				echo "<script>alert('Insert = " . $insert . "');</script>";
				echo "<script>window.location='" . base_url() . "spd_admin';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_rincian_spd()
	{
		$insert = 0;
		$update = 0;
		// 		if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
		// 			$sort = '1';
		// 		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
		// 			$sort = '2';
		// 		} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
		// 			$sort = '3';
		// 		} else {
		// 			$sort = '0';
		// 		}

		$path = 'uploads/import/';
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

					if ($value['C'] != '') {
						$pecahtglspd = explode(' ', $value['H']);
						$tglspd = tgl_sql($pecahtglspd[0], $pecahtglspd[1], $pecahtglspd[2]);

						$pecahtglberangkat = explode(' ', $value['L']);
						$tglberangkat = tgl_sql($pecahtglberangkat[0], $pecahtglberangkat[1], $pecahtglberangkat[2]);

						$pecahtglselesai = explode(' ', $value['N']);
						$tglselesai = tgl_sql($pecahtglselesai[0], $pecahtglselesai[1], $pecahtglselesai[2]);

						$pecahtglst = explode(' ', $value['R']);
						$tglst = tgl_sql($pecahtglst[0], $pecahtglst[1], $pecahtglst[2]);

						if ($value['AB'] != '') {
							$pecahtgl_menginap_dari = explode(' ', $value['AB']);
							$tgl_menginap_dari = tgl_sql($pecahtgl_menginap_dari[0], $pecahtgl_menginap_dari[1], $pecahtgl_menginap_dari[2]);
						} else {
							$tgl_menginap_dari = null;
						}

						if ($value['AC'] != '') {
							$pecahtgl_menginap_sampai = explode(' ', $value['AC']);
							$tgl_menginap_sampai = tgl_sql($pecahtgl_menginap_sampai[0], $pecahtgl_menginap_sampai[1], $pecahtgl_menginap_sampai[2]);
						} else {
							$tgl_menginap_sampai = null;
						}

						if ($value['AL'] == 'SPD DIBATALKAN') {
							$status = '5';
						} elseif ($value['AL'] == 'TELAH BAYAR') {
							$status = '4';
						} elseif ($value['AL'] == 'BERKAS DITERIMA' || $value['AL'] == 'Berkas Diterima') {
							$status = '1';
						} elseif ($value['AL'] == 'OK') {
							$status = '2';
						} else {
							$status = '0';
						}

						if ($value['AM'] != '') {
							$pecahtgl_bayar = explode(' ', $value['AM']);
							//$tgl_bayar = str_replace('/', '-', $pecahtgl_bayar[2]);
							$pecahtgl_ls = explode('/', $pecahtgl_bayar[2]);
							$tgl_bayar = tgl_excel($pecahtgl_ls[0], $pecahtgl_ls[1], $pecahtgl_ls[2]);
							$ls = $pecahtgl_bayar[0] . ' ' . $pecahtgl_bayar[1];
						} else {
							$tgl_bayar = '';
							$ls = '';
						}

						if ($value['V'] != '-') {
							$penye = $value['V'];
							$uh = $value['U'];
							$penyesuaian = ($penye / $uh) * 100;
						} else {
							$penyesuaian = '-';
						}

						if ($value['S'] != '-' or $value['S'] != '') {
							$jlh_hari = $value['O'];
						} else {
							$jlh_hari = '';
						}

						$pecahtujuan = explode(',', $value['M']);
						$hit = count($pecahtujuan);
						if ($hit == 0) {
							$pecahtujuan[0] = '';
							$pecahtujuan[1] = '';
							$pecahtujuan[2] = '';
							$pecahtujuan[3] = '';
						} elseif ($hit == 1) {
							$pecahtujuan[1] = '';
							$pecahtujuan[2] = '';
							$pecahtujuan[3] = '';
						} elseif ($hit == 2) {
							$pecahtujuan[2] = '';
							$pecahtujuan[3] = '';
						} elseif ($hit == 3) {
							$pecahtujuan[3] = '';
						}


						$inserdata[$i]['nip_ppk']                   = '197203061992031001';
						$inserdata[$i]['nip_bendahara']             = '199110222013101001';
						//$inserdata[$i]['nip_atasan']                = $value['C'];
						$inserdata[$i]['nip_pegawai']               = substr(str_replace(' ', '', $value['C']), 3);
						$inserdata[$i]['no_spd']                    = $value['G'];
						$inserdata[$i]['tgl_spd']                   = $tglspd;
						$inserdata[$i]['maksud']                    = $value['I'];
						$inserdata[$i]['kendaraan']                 = $value['J'];
						$inserdata[$i]['lamanya']                   = $value['O'];
						$inserdata[$i]['tgl_berangkat']             = $tglberangkat;
						$inserdata[$i]['tujuan1']                   = $pecahtujuan[0];
						$inserdata[$i]['tujuan2']                   = $pecahtujuan[1];
						$inserdata[$i]['tujuan3']                   = $pecahtujuan[2];
						$inserdata[$i]['tujuan4']                   = $pecahtujuan[3];
						$inserdata[$i]['tgl_selesai']               = $tglselesai;
						$inserdata[$i]['no_st']                     = substr($value['Q'], 3);
						$inserdata[$i]['tgl_st']                    = $tglst;
						$inserdata[$i]['uang_harian']               = $value['S'];
						$inserdata[$i]['jlh_hari']                  = $jlh_hari;
						$inserdata[$i]['total_uh']                  = $value['U'];
						$inserdata[$i]['penyesuaian_uh']            = $penyesuaian;
						$inserdata[$i]['uang_harian2']              = $value['T'];
						//$inserdata[$i]['jlh_hari2']                 = $value['O'];
						//$inserdata[$i]['total_uh2']                 = $value['O'];
						//$inserdata[$i]['penyesuaian_uh2']           = $value['O'];
						$inserdata[$i]['grand_total_uh']            = $value['W'];
						$inserdata[$i]['by_transportasi_berangkat'] = $value['X'] / 2;
						$inserdata[$i]['by_transportasi_pulang']    = $value['X'] / 2;
						$inserdata[$i]['total_by_transportasi']     = $value['X'];
						$inserdata[$i]['durasi_menginap']           = $value['Z'];
						$inserdata[$i]['menginap_dari']             = $tgl_menginap_dari;
						$inserdata[$i]['menginap_sampai']           = $tgl_menginap_sampai;
						$inserdata[$i]['tarif_penginapan']          = $value['Y'];
						// $inserdata[$i]['durasi_menginap2']          = $value['O'];
						// $inserdata[$i]['menginap_dari2']            = $value['O'];
						// $inserdata[$i]['menginap_sampai2']          = $value['O'];
						$inserdata[$i]['tarif_penginapan2']         = $value['AD'];
						// $inserdata[$i]['durasi_menginap3']          = $value['O'];
						// $inserdata[$i]['menginap_dari3']            = $value['O'];
						// $inserdata[$i]['menginap_sampai3']          = $value['O'];
						// $inserdata[$i]['tarif_penginapan3']         = $value['O'];
						$inserdata[$i]['total_by_penginapan']       = $value['AE'];
						// $inserdata[$i]['pengeluaran1']              = $value['O'];
						// $inserdata[$i]['pengeluaran2']              = $value['O'];
						// $inserdata[$i]['pengeluaran3']              = $value['O'];
						// $inserdata[$i]['pengeluaran4']              = $value['O'];
						$inserdata[$i]['pengeluaran_riil']          = $value['AF'];
						// $inserdata[$i]['total_biaya_spd']           = $value['O'];
						$inserdata[$i]['grand_total']               = $value['AG'];
						$inserdata[$i]['uang_muka']                 = $value['AH'];
						$inserdata[$i]['kredit']                    = $value['AI'];
						$inserdata[$i]['total_bayar']               = $value['AJ'];
						$inserdata[$i]['kurang_lebih_bayar']        = $value['AK'];
						$inserdata[$i]['status']                    = $status;
						$inserdata[$i]['tgl_bayar']                 = $tgl_bayar;
						// $inserdata[$i]['ket']                       = $value['O'];
						$inserdata[$i]['ls']                        = $ls;
						$inserdata[$i]['dipa']                      = $value['AN'];
						// $inserdata[$i]['isi_laporan']               = $value['O'];
						// $inserdata[$i]['kuitansi']                  = $value['O'];
						$inserdata[$i]['sort']                      = $value['AQ'];
						$i++;
					}
				}

				foreach ($inserdata as $dt) {
					$cek = $this->spd_admin_m->cek_nospd($dt['no_spd']);
					if (count($cek) == 1) {
						$datas = array(
							'nip_ppk'                   => $dt['nip_ppk'],
							'nip_bendahara'             => $dt['nip_bendahara'],
							// 'nip_atasan'                => $dt['nip_atasan'],
							'nip_pegawai'               => $dt['nip_pegawai'],
							'no_spd'                    => $dt['no_spd'],
							'tgl_spd'                   => $dt['tgl_spd'],
							'maksud'                    => $dt['maksud'],
							'kendaraan'                 => $dt['kendaraan'],
							'lamanya'                   => $dt['lamanya'],
							'tgl_berangkat'             => $dt['tgl_berangkat'],
							'tujuan1'                   => $dt['tujuan1'],
							'tujuan2'                   => $dt['tujuan2'],
							'tujuan3'                   => $dt['tujuan3'],
							'tujuan4'                   => $dt['tujuan4'],
							'tgl_selesai'               => $dt['tgl_selesai'],
							'no_st'                     => $dt['no_st'],
							'tgl_st'                    => $dt['tgl_st'],
							'uang_harian'               => $dt['uang_harian'],
							'jlh_hari'                  => $dt['jlh_hari'],
							'total_uh'                  => $dt['total_uh'],
							'penyesuaian_uh'            => $dt['penyesuaian_uh'],
							'uang_harian2'              => $dt['uang_harian2'],
							// 'jlh_hari2'                 => $dt['jlh_hari2'],
							// 'total_uh2'                 => $dt['total_uh2'],
							// 'penyesuaian_uh2'           => $dt['penyesuaian_uh2'],
							'grand_total_uh'            => $dt['grand_total_uh'],
							'by_transportasi_berangkat' => $dt['by_transportasi_berangkat'],
							'by_transportasi_pulang'    => $dt['by_transportasi_pulang'],
							'total_by_transportasi'     => $dt['total_by_transportasi'],
							'durasi_menginap'           => $dt['durasi_menginap'],
							'menginap_dari'             => $dt['menginap_dari'],
							'menginap_sampai'           => $dt['menginap_sampai'],
							'tarif_penginapan'          => $dt['tarif_penginapan'],
							// 'durasi_menginap2'          => $dt['durasi_menginap2'],
							// 'menginap_dari2'            => $dt['menginap_dari2'],
							// 'menginap_sampai2'          => $dt['menginap_sampai2'],
							'tarif_penginapan2'         => $dt['tarif_penginapan2'],
							// 'durasi_menginap3'          => $dt['durasi_menginap3'],
							// 'menginap_dari3'            => $dt['menginap_dari3'],
							// 'menginap_sampai3'          => $dt['menginap_sampai3'],
							// 'tarif_penginapan3'         => $dt['tarif_penginapan3'],
							'total_by_penginapan'       => $dt['total_by_penginapan'],
							// 'pengeluaran1'              => $dt['pengeluaran1'],
							// 'pengeluaran2'              => $dt['pengeluaran2'],
							// 'pengeluaran3'              => $dt['pengeluaran3'],
							// 'pengeluaran4'              => $dt['pengeluaran4'],
							'pengeluaran_riil'          => $dt['pengeluaran_riil'],
							// 'total_biaya_spd'           => $dt['total_biaya_spd'],
							'grand_total'               => $dt['grand_total'],
							'uang_muka'                 => $dt['uang_muka'],
							'kredit'                    => $dt['kredit'],
							'total_bayar'               => $dt['total_bayar'],
							'kurang_lebih_bayar'        => $dt['kurang_lebih_bayar'],
							'status'                    => $dt['status'],
							'tgl_bayar'                 => $dt['tgl_bayar'],
							// 'ket'                       => $dt['ket'],
							'ls'                        => $dt['ls'],
							'dipa'                      => $dt['dipa'],
							// 'isi_laporan'               => $dt['isi_laporan'],
							// 'kuitansi'                  => $dt['kuitansi'],
							'sort'                      => $dt['sort']
						);
						//  print_r($datas);
						$apdet = $this->spd_admin_m->update('spd', 'no_spd', $dt['no_spd'], $datas);
						//$apdets = $this->spd_admin_m->update('spd_pegawai', 'no_spd', $dt['no_spd'], $datas);

						if ($apdet) {
							$update++;
						}
					} else {
						if ($dt['nip_pegawai'] != '') {
							$datas = array(
								'nip_ppk'                   => $dt['nip_ppk'],
								'nip_bendahara'             => $dt['nip_bendahara'],
								// 'nip_atasan'                => $dt['nip_atasan'],
								'nip_pegawai'               => $dt['nip_pegawai'],
								'no_spd'                    => $dt['no_spd'],
								'tgl_spd'                   => $dt['tgl_spd'],
								'maksud'                    => $dt['maksud'],
								'kendaraan'                 => $dt['kendaraan'],
								'lamanya'                   => $dt['lamanya'],
								'tgl_berangkat'             => $dt['tgl_berangkat'],
								'tujuan1'                   => $dt['tujuan1'],
								'tujuan2'                   => $dt['tujuan2'],
								'tujuan3'                   => $dt['tujuan3'],
								'tujuan4'                   => $dt['tujuan4'],
								'tgl_selesai'               => $dt['tgl_selesai'],
								'no_st'                     => $dt['no_st'],
								'tgl_st'                    => $dt['tgl_st'],
								'uang_harian'               => $dt['uang_harian'],
								'jlh_hari'                  => $dt['jlh_hari'],
								'total_uh'                  => $dt['total_uh'],
								'penyesuaian_uh'            => $dt['penyesuaian_uh'],
								'uang_harian2'              => $dt['uang_harian2'],
								// 'jlh_hari2'                 => $dt['jlh_hari2'],
								// 'total_uh2'                 => $dt['total_uh2'],
								// 'penyesuaian_uh2'           => $dt['penyesuaian_uh2'],
								'grand_total_uh'            => $dt['grand_total_uh'],
								'by_transportasi_berangkat' => $dt['by_transportasi_berangkat'],
								'by_transportasi_pulang'    => $dt['by_transportasi_pulang'],
								'total_by_transportasi'     => $dt['total_by_transportasi'],
								'durasi_menginap'           => $dt['durasi_menginap'],
								'menginap_dari'             => $dt['menginap_dari'],
								'menginap_sampai'           => $dt['menginap_sampai'],
								'tarif_penginapan'          => $dt['tarif_penginapan'],
								// 'durasi_menginap2'          => $dt['durasi_menginap2'],
								// 'menginap_dari2'            => $dt['menginap_dari2'],
								// 'menginap_sampai2'          => $dt['menginap_sampai2'],
								'tarif_penginapan2'         => $dt['tarif_penginapan2'],
								// 'durasi_menginap3'          => $dt['durasi_menginap3'],
								// 'menginap_dari3'            => $dt['menginap_dari3'],
								// 'menginap_sampai3'          => $dt['menginap_sampai3'],
								// 'tarif_penginapan3'         => $dt['tarif_penginapan3'],
								'total_by_penginapan'       => $dt['total_by_penginapan'],
								// 'pengeluaran1'              => $dt['pengeluaran1'],
								// 'pengeluaran2'              => $dt['pengeluaran2'],
								// 'pengeluaran3'              => $dt['pengeluaran3'],
								// 'pengeluaran4'              => $dt['pengeluaran4'],
								'pengeluaran_riil'          => $dt['pengeluaran_riil'],
								// 'total_biaya_spd'           => $dt['total_biaya_spd'],
								'grand_total'               => $dt['grand_total'],
								'uang_muka'                 => $dt['uang_muka'],
								'kredit'                    => $dt['kredit'],
								'total_bayar'               => $dt['total_bayar'],
								'kurang_lebih_bayar'        => $dt['kurang_lebih_bayar'],
								'status'                    => $dt['status'],
								'tgl_bayar'                 => $dt['tgl_bayar'],
								// 'ket'                       => $dt['ket'],
								'ls'                        => $dt['ls'],
								'dipa'                      => $dt['dipa'],
								// 'isi_laporan'               => $dt['isi_laporan'],
								// 'kuitansi'                  => $dt['kuitansi'],
								'sort'                      => $dt['sort']
							);
							// print_r($datas);
							$inser = $this->model_pegawai->create('spd', $datas);
							$insers = $this->model_pegawai->create('spd_pegawai', $datas);

							if ($inser) {
								$insert++;
							}
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "spd_admin';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}
}
