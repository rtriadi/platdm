<?php

function check_already_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('id');
	if ($user_session) {
		redirect('dashboard');
	}
}

function check_not_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('id');
	if (!$user_session) {
		redirect('auth/login');
	}
}

function check_admin()
{
	$ci = &get_instance();
	$ci->load->library('fungsi');
	if (($ci->fungsi->user_login()->level != 1) and ($ci->fungsi->user_login()->level != 2)) {
		redirect('dashboard');
	}
}

function indo_currency($nominal)
{
	$result = "Rp " . number_format($nominal, 2, ',', '.');
	return $result;
}

function indo_date($date)
{
	$d = substr($date, 8, 2);
	$m = substr($date, 5, 2);
	$y = substr($date, 0, 4);
	return $d . '/' . $m . '/' . $y;
}

function penyebut($nilai)
{
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " " . $huruf[$nilai];
	} else if ($nilai < 20) {
		$temp = penyebut($nilai - 10) . " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
	}
	return $temp;
}

function terbilang($nilai)
{
	if ($nilai < 0) {
		$hasil = "minus " . trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}
	return $hasil;
}

function getNamaByNip($nip)
{
	$ci = &get_instance();
	$ci->db->select('nama');
	$ci->db->from('pegawai');
	$ci->db->where('nip', $nip);

	$nama = $ci->db->get()->row();
	if($nama) {
	    return $nama->nama;
	} else {
        return "  ";	    
	}
}

function getCityById($id)
{
	$ci = &get_instance();
	$ci->db->select('name, city_type');
	$ci->db->from('city');
	$ci->db->where('id', $id);

	$query = $ci->db->get()->row();
	$kab_kota = $query->city_type . ' ' . $query->name;
	return $kab_kota;
}

function getSPDpegawaiById($id)
{
	$ci = &get_instance();
	$ci->db->select('spd_pegawai.*, pegawai.*, city.name as city_name, province.name as province_name');
	$ci->db->from('spd_pegawai');
	$ci->db->join('pegawai', 'pegawai.nip = spd_pegawai.nip_pegawai');
	$ci->db->join('city', 'city.id = spd_pegawai.tujuan1');
	$ci->db->join('province', 'province.id = city.province_id');
	$ci->db->where('spd_pegawai.id', $id);
	$ci->db->order_by('spd_pegawai.tgl_spd', 'desc');
	$query = $ci->db->get()->row();
	return $query;
}

function tgl_ind($date)
{

	// array hari dan bulan
	$Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
	$Bulan = array(
		"Januari", "Februari", "Maret", "April", "Mei", "Juni",
		"Juli", "Agustus", "September", "Oktober", "November", "Desember"
	);

	// pemisahan tahun, bulan, hari, dan waktu
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl = substr($date, 8, 2);
	$waktu = substr($date, 11, 5);
	$hari = date("w", strtotime($date));
// 	if($date = "0000-00-00") {
// 	    $result = " ";
// 	    return $result;
// 	} else {
	    $result = $tgl . " " . $Bulan[(int) $bulan - 1] . " " . $tahun . "";
	    return $result;    
// 	}
}

function bulan_ind($date)
{

	// array hari dan bulan
	$Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
	$Bulan = array(
		"Januari", "Februari", "Maret", "April", "Mei", "Juni",
		"Juli", "Agustus", "September", "Oktober", "November", "Desember"
	);

	// pemisahan tahun, bulan, hari, dan waktu
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl = substr($date, 8, 2);
	$waktu = substr($date, 11, 5);
	$hari = date("w", strtotime($date));
	$result = $Bulan[(int) $bulan - 1];
	return $result;
}

function tgl_sql($tgl, $bln, $thn)
{
	$tgls = $tgl;
	$blns = '';
	if ($bln == 'Januari') {
		$blns = '01';
	} elseif ($bln == 'Februari') {
		$blns = '02';
	} elseif ($bln == 'Maret') {
		$blns = '03';
	} elseif ($bln == 'April') {
		$blns = '04';
	} elseif ($bln == 'Mei') {
		$blns = '05';
	} elseif ($bln == 'Juni') {
		$blns = '06';
	} elseif ($bln == 'Juli') {
		$blns = '07';
	} elseif ($bln == 'Agustus') {
		$blns = '08';
	} elseif ($bln == 'September') {
		$blns = '09';
	} elseif ($bln == 'Oktober') {
		$blns = '10';
	} elseif ($bln == 'November') {
		$blns = '11';
	} elseif ($bln == 'Desember') {
		$blns = '12';
	}
	$thns = $thn;
	$result = $thns . "-" . $blns . "-" . $tgls . "";
	return $result;
}

function tgl_excel($tgl, $bln, $thn)
{
	$tgls = $tgl;
	$blns = $bln;
	$thns = $thn;
	$result = $thns . "-" . $blns . "-" . $tgls . "";
	return $result;
}
