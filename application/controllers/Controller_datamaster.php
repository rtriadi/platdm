<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_datamaster extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['model_datamaster']);
		$this->load->library('form_validation');
	}

	public function kategori_pangkat_gol()
	{
		$data['row'] = $this->model_datamaster->getKategoriPangkatGol();
		$this->template->load('template', 'data_master/kategori_pangkat_gol', $data);
	}

	public function add_kategori_pangkat_gol()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->addKategoriPangkatGol($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/kategori_pangkat_gol');
	}

	public function update_kategori_pangkat_gol()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->updateKategoriPangkatGol($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/kategori_pangkat_gol');
	}

	public function delete_kategori_pangkat_gol()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->deleteKategoriPangkatGol($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/kategori_pangkat_gol');
	}

	public function pangkat_gol()
	{
		$data['row'] = $this->model_datamaster->getPangkatGol();
		$data['kategori'] = $this->model_datamaster->getKategoriPangkatGol();
		$this->template->load('template', 'data_master/pangkat_gol', $data);
	}

	public function add_pangkat_gol()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->addPangkatGol($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/pangkat_gol');
	}

	public function update_pangkat_gol()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->updatePangkatGol($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/pangkat_gol');
	}

	public function delete_pangkat_gol()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->deletePangkatGol($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/pangkat_gol');
	}

	public function ref_penginapan()
	{
		$data['row'] = $this->model_datamaster->getRefPenginapan();
		$data['kategori'] = $this->model_datamaster->getKategoriPangkatGol();
		$this->template->load('template', 'data_master/ref_penginapan', $data);
	}

	public function add_ref_penginapan()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->addRefPenginapan($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/ref_penginapan');
	}

	public function update_ref_penginapan()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->updateRefPenginapan($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/ref_penginapan');
	}

	public function delete_ref_penginapan()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->deleteRefPenginapan($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/ref_penginapan');
	}

	public function ref_biaya_taxi()
	{
		$data['row'] = $this->model_datamaster->getRefBiayaTaxi();
		$this->template->load('template', 'data_master/ref_biaya_taxi', $data);
	}

	public function add_ref_biaya_taxi()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->addRefBiayaTaxi($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/ref_biaya_taxi');
	}

	public function update_ref_biaya_taxi()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->updateRefBiayaTaxi($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/ref_biaya_taxi');
	}

	public function delete_ref_biaya_taxi()
	{
		$post = $this->input->post(null, true);
		$this->model_datamaster->deleteRefBiayaTaxi($post);
		if ($this->db->affected_rows() > 0) {
		}
		redirect('controller_datamaster/ref_biaya_taxi');
	}

	public function import_pangkat_gol()
	{
		$insert = 0;
		$update = 0;

		$path = 'uploads/import/data_master/';
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

					$inserdata[$i]['nama'] = $value['A'];
					$inserdata[$i]['id_kategori_pangkat_gol'] = $value['B'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_datamaster->cek_pangkat_gol($dt['nama']);
					if (count($cek) == 1) {
						$datas = array(
							'nama' => $dt['nama'],
							'id_kategori_pangkat_gol' => $dt['id_kategori_pangkat_gol']
						);

						$apdet = $this->model_datamaster->update('pangkat_gol', 'nama', $dt['nama'], $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'nama' => $dt['nama'],
							'id_kategori_pangkat_gol' => $dt['id_kategori_pangkat_gol']
						);

						$inser = $this->model_datamaster->create('pangkat_gol', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_datamaster/pangkat_gol';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_ref_penginapan()
	{
		$insert = 0;
		$update = 0;

		$path = 'uploads/import/data_master/';
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

					$inserdata[$i]['provinsi'] = $value['A'];
					$inserdata[$i]['id_kategori_pangkat_gol'] = $value['B'];
					$inserdata[$i]['nominal'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_datamaster->cek_ref_penginapan($dt['provinsi'], $dt['id_kategori_pangkat_gol']);
					if (count($cek) == 1) {
						$datas = array(
							'provinsi' => $dt['provinsi'],
							'id_kategori_pangkat_gol' => $dt['id_kategori_pangkat_gol'],
							'nominal' => $dt['nominal']
						);

						$this->db->where('provinsi', $dt['provinsi']);
						$this->db->where('id_kategori_pangkat_gol', $dt['id_kategori_pangkat_gol']);
						$apdet = $this->db->update('ref_penginapan', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'provinsi' => $dt['provinsi'],
							'id_kategori_pangkat_gol' => $dt['id_kategori_pangkat_gol'],
							'nominal' => $dt['nominal']
						);

						$inser = $this->model_datamaster->create('ref_penginapan', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_datamaster/ref_penginapan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_ref_biaya_taxi()
	{
		$insert = 0;
		$update = 0;

		$path = 'uploads/import/data_master/';
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

					$inserdata[$i]['provinsi'] = $value['A'];
					$inserdata[$i]['besaran'] = $value['B'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_datamaster->cek_ref_biaya_taxi($dt['provinsi']);
					if (count($cek) == 1) {
						$datas = array(
							'provinsi' => $dt['provinsi'],
							'besaran' => $dt['besaran']
						);

						$apdet = $this->model_datamaster->update('ref_biaya_taxi', 'provinsi', $dt['provinsi'], $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'provinsi' => $dt['provinsi'],
							'besaran' => $dt['besaran']
						);

						$inser = $this->model_datamaster->create('ref_biaya_taxi', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_datamaster/ref_biaya_taxi';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}
}
