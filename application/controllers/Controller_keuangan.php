<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controller_keuangan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['model_keuangan', 'model_pegawai', 'user_m']);
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['row'] = $this->model_keuangan->getPegawai();
		$this->template->load('template', 'keuangan/keuangan_data', $data);
	}

	public function import_gaji()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['gaji'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_gaji($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'gaji' => $dt['gaji']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('gaji', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'gaji' => $dt['gaji']
						);

						$inser = $this->model_keuangan->create('gaji', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_uang_makan()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['uang_makan'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_uang_makan($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'uang_makan' => $dt['uang_makan']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('uang_makan', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'uang_makan' => $dt['uang_makan']
						);

						$inser = $this->model_keuangan->create('uang_makan', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_gaji13()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['gaji13'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_gaji13($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'gaji13' => $dt['gaji13']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('gaji13', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'gaji13' => $dt['gaji13']
						);

						$inser = $this->model_keuangan->create('gaji13', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_thr()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['thr'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_thr($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'thr' => $dt['thr']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('thr', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'thr' => $dt['thr']
						);

						$inser = $this->model_keuangan->create('thr', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_kekurangan_gaji()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['kekurangan_gaji'] = $value['C'];
					$inserdata[$i]['keterangan'] = $value['D'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_kekurangan_gaji($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'kekurangan_gaji' => $dt['kekurangan_gaji'],
							'keterangan' => $dt['keterangan']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('kekurangan_gaji', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'kekurangan_gaji' => $dt['kekurangan_gaji'],
							'keterangan' => $dt['keterangan']
						);

						$inser = $this->model_keuangan->create('kekurangan_gaji', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_uang_lembur()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['uang_lembur'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_uang_lembur($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'uang_lembur' => $dt['uang_lembur']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('uang_lembur', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'uang_lembur' => $dt['uang_lembur']
						);

						$inser = $this->model_keuangan->create('uang_lembur', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_insentif()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['insentif'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_insentif($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'insentif' => $dt['insentif']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('insentif', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'insentif' => $dt['insentif']
						);

						$inser = $this->model_keuangan->create('insentif', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_honor()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['honor'] = $value['C'];
					$inserdata[$i]['keterangan'] = $value['D'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_honor($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'honor' => $dt['honor'],
							'keterangan' => $dt['keterangan']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('honor', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'honor' => $dt['honor'],
							'keterangan' => $dt['keterangan']
						);

						$inser = $this->model_keuangan->create('honor', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_tukin_13()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['tukin_13'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_tukin_13($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'tukin_13' => $dt['tukin_13']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('tukin_13', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'tukin_13' => $dt['tukin_13']
						);

						$inser = $this->model_keuangan->create('tukin_13', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_tukin_thr()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['tukin_thr'] = $value['C'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_tukin_thr($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'tukin_thr' => $dt['tukin_thr']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('tukin_thr', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'tukin_thr' => $dt['tukin_thr']
						);

						$inser = $this->model_keuangan->create('tukin_thr', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_potongan_tukin()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['grade'] = $value['C'];
					$inserdata[$i]['persentase_pemberian_tukin'] = $value['D'];
					$inserdata[$i]['tukin_kotor'] = $value['E'];
					$inserdata[$i]['absensi'] = $value['F'];
					$inserdata[$i]['tambahan_lain'] = $value['G'];
					$inserdata[$i]['ket'] = $value['H'];
					$inserdata[$i]['tinelo'] = $value['I'];
					$inserdata[$i]['asuransi_kolektif'] = $value['J'];
					$inserdata[$i]['futsal'] = $value['K'];
					$inserdata[$i]['prodip_manado'] = $value['L'];
					$inserdata[$i]['panti'] = $value['M'];
					$inserdata[$i]['yayasan'] = $value['N'];
					$inserdata[$i]['pinogu'] = $value['O'];
					$inserdata[$i]['forum_ar'] = $value['P'];
					$inserdata[$i]['uang_makan_forum_ar'] = $value['Q'];
					$inserdata[$i]['iuran_oikumene'] = $value['R'];
					$inserdata[$i]['iuran_kasi'] = $value['S'];
					$inserdata[$i]['mushola'] = $value['T'];
					$inserdata[$i]['kurban'] = $value['U'];
					$inserdata[$i]['rumah_dinas'] = $value['V'];
					$inserdata[$i]['mess_inul_vista'] = $value['W'];
					$inserdata[$i]['mess_cinta'] = $value['X'];
					$inserdata[$i]['suki'] = $value['Y'];
					$inserdata[$i]['pdi'] = $value['Z'];
					$inserdata[$i]['iuran_seksi_waskon_1'] = $value['AA'];
					$inserdata[$i]['iuran_seksi_waskon_2'] = $value['AB'];
					$inserdata[$i]['iuran_seksi_waskon_3'] = $value['AC'];
					$inserdata[$i]['iuran_seksi_waskon_4'] = $value['AD'];
					$inserdata[$i]['iuran_seksi_penagihan'] = $value['AE'];
					$inserdata[$i]['iuran_seksi_pemeriksaan'] = $value['AF'];
					$inserdata[$i]['iuran_seksi_ekstensifikasi'] = $value['AG'];
					$inserdata[$i]['iuran_seksi_pelayanan'] = $value['AH'];
					$inserdata[$i]['lain_lain'] = $value['AI'];
					$inserdata[$i]['keterangan'] = $value['AJ'];
					$inserdata[$i]['pas'] = $value['AK'];
					$inserdata[$i]['cbb'] = $value['AL'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_potongan_tukin($dt['bulan_tahun'], $dt['nip']);
					$countcek = count($cek);
					if ($countcek > '0' || $countcek > NULL || $countcek != '') {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'grade' => $dt['grade'],
							'persentase_pemberian_tukin' => $dt['persentase_pemberian_tukin'],
							'tukin_kotor' => $dt['tukin_kotor'],
							'absensi' => $dt['absensi'],
							'tambahan_lain' => $dt['tambahan_lain'],
							'ket' => $dt['ket'],
							'tinelo' => $dt['tinelo'],
							'asuransi_kolektif' => $dt['asuransi_kolektif'],
							'futsal' => $dt['futsal'],
							'prodip_manado' => $dt['prodip_manado'],
							'panti' => $dt['panti'],
							'yayasan' => $dt['yayasan'],
							'pinogu' => $dt['pinogu'],
							'forum_ar' => $dt['forum_ar'],
							'uang_makan_forum_ar' => $dt['uang_makan_forum_ar'],
							'iuran_oikumene' => $dt['iuran_oikumene'],
							'iuran_kasi' => $dt['iuran_kasi'],
							'mushola' => $dt['mushola'],
							'kurban' => $dt['kurban'],
							'rumah_dinas' => $dt['rumah_dinas'],
							'mess_inul_vista' => $dt['mess_inul_vista'],
							'mess_cinta' => $dt['mess_cinta'],
							'suki' => $dt['suki'],
							'pdi' => $dt['pdi'],
							'iuran_seksi_waskon_1' => $dt['iuran_seksi_waskon_1'],
							'iuran_seksi_waskon_2' => $dt['iuran_seksi_waskon_2'],
							'iuran_seksi_waskon_3' => $dt['iuran_seksi_waskon_3'],
							'iuran_seksi_waskon_4' => $dt['iuran_seksi_waskon_4'],
							'iuran_seksi_penagihan' => $dt['iuran_seksi_penagihan'],
							'iuran_seksi_pemeriksaan' => $dt['iuran_seksi_pemeriksaan'],
							'iuran_seksi_ekstensifikasi' => $dt['iuran_seksi_ekstensifikasi'],
							'iuran_seksi_pelayanan' => $dt['iuran_seksi_pelayanan'],
							'lain_lain' => $dt['lain_lain'],
							'keterangan' => $dt['keterangan'],
							'pas' => $dt['pas'],
							'cbb' => $dt['cbb'],
						);
						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('potongan_tukin', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'grade' => $dt['grade'],
							'persentase_pemberian_tukin' => $dt['persentase_pemberian_tukin'],
							'tukin_kotor' => $dt['tukin_kotor'],
							'absensi' => $dt['absensi'],
							'tambahan_lain' => $dt['tambahan_lain'],
							'ket' => $dt['ket'],
							'tinelo' => $dt['tinelo'],
							'asuransi_kolektif' => $dt['asuransi_kolektif'],
							'futsal' => $dt['futsal'],
							'prodip_manado' => $dt['prodip_manado'],
							'panti' => $dt['panti'],
							'yayasan' => $dt['yayasan'],
							'pinogu' => $dt['pinogu'],
							'forum_ar' => $dt['forum_ar'],
							'uang_makan_forum_ar' => $dt['uang_makan_forum_ar'],
							'iuran_oikumene' => $dt['iuran_oikumene'],
							'iuran_kasi' => $dt['iuran_kasi'],
							'mushola' => $dt['mushola'],
							'kurban' => $dt['kurban'],
							'rumah_dinas' => $dt['rumah_dinas'],
							'mess_inul_vista' => $dt['mess_inul_vista'],
							'mess_cinta' => $dt['mess_cinta'],
							'suki' => $dt['suki'],
							'pdi' => $dt['pdi'],
							'iuran_seksi_waskon_1' => $dt['iuran_seksi_waskon_1'],
							'iuran_seksi_waskon_2' => $dt['iuran_seksi_waskon_2'],
							'iuran_seksi_waskon_3' => $dt['iuran_seksi_waskon_3'],
							'iuran_seksi_waskon_4' => $dt['iuran_seksi_waskon_4'],
							'iuran_seksi_penagihan' => $dt['iuran_seksi_penagihan'],
							'iuran_seksi_pemeriksaan' => $dt['iuran_seksi_pemeriksaan'],
							'iuran_seksi_ekstensifikasi' => $dt['iuran_seksi_ekstensifikasi'],
							'iuran_seksi_pelayanan' => $dt['iuran_seksi_pelayanan'],
							'lain_lain' => $dt['lain_lain'],
							'keterangan' => $dt['keterangan'],
							'pas' => $dt['pas'],
							'cbb' => $dt['cbb'],
						);
						//$inser = INSERT INTO 'potongan_tukin' VALUES $datas; 
						$inser = $this->model_keuangan->create('potongan_tukin', $datas);
						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_kekurangan_tukin()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['kekurangan_tukin'] = $value['C'];
					$inserdata[$i]['keterangan'] = $value['D'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_kekurangan_tukin($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'kekurangan_tukin' => $dt['kekurangan_tukin'],
							'keterangan' => $dt['keterangan']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('kekurangan_tukin', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'kekurangan_tukin' => $dt['kekurangan_tukin'],
							'keterangan' => $dt['keterangan']
						);

						$inser = $this->model_keuangan->create('kekurangan_tukin', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
		}
	}

	public function import_tukin_plt()
	{
		$insert = 0;
		$update = 0;

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

					$inserdata[$i]['bulan_tahun'] = $value['A'];
					$inserdata[$i]['nip'] = $value['B'];
					$inserdata[$i]['tukin_plt'] = $value['C'];
					$inserdata[$i]['keterangan'] = $value['D'];
					$i++;
				}

				foreach ($inserdata as $dt) {
					$cek = $this->model_keuangan->cek_tukin_plt($dt['bulan_tahun'], $dt['nip']);
					if (count($cek) > 0 || count($cek) != '' || count($cek) != NULL) {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'tukin_plt' => $dt['tukin_plt'],
							'keterangan' => $dt['keterangan']
						);

						$this->db->where( 'bulan_tahun', $dt['bulan_tahun']);
						$this->db->where( 'nip', $dt['nip']);
						$apdet = $this->db->update('tukin_plt', $datas);
						if ($apdet) {
							$update++;
						}
					} else {
						$datas = array(
							'bulan_tahun' => $dt['bulan_tahun'],
							'nip' => $dt['nip'],
							'tukin_plt' => $dt['tukin_plt'],
							'keterangan' => $dt['keterangan']
						);

						$inser = $this->model_keuangan->create('tukin_plt', $datas);

						if ($inser) {
							$insert++;
						}
					}
				}
				echo "<script>alert('Insert = " . $insert . " dan Update = " . $update . "');</script>";
				echo "<script>window.location='" . base_url() . "controller_keuangan';</script>";
			} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
					. '": ' . $e->getMessage());
			}
		} else {
			echo $error['error'];
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

			$jumlah_potongan = $potongan_tukin->futsal +
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
			$potongan_tukin = '-';
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

			$jumlah_potongan = $potongan_tukin->futsal +
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
			$potongan_tukin = '-';
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

		$this->load->library('pdf');

		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "slipgaji.pdf";

		$this->pdf->load_view('pegawai/slipgajiku/laporan_pdf', $data);
	}
}
