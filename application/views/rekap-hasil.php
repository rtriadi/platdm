<?php
$db_host = 'localhost';
$db_port = '3306';
$db_name = 'u5652458_platdm';
$db_user = 'u5652458_root';
$db_pass = 'u5652458_root123';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
	die ('Gagal terhubung MySQL: ' . mysqli_connect_error());	
}

if ($bulan == 13) {
	if ($nip_pegawai == 13) {
		if ($jenis == 1) {
			$sql = "
			SELECT  
				IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
				
				SUM( IF( MONTH(tgl_spd) = 1 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_januari,
				COUNT( IF( MONTH(tgl_spd) = 1 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_1,
				SUM( IF( MONTH(tgl_spd) = 2 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_februari,
				COUNT( IF( MONTH(tgl_spd) = 2 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_2,
				SUM( IF( MONTH(tgl_spd) = 3 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_maret,
				COUNT( IF( MONTH(tgl_spd) = 3 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_3,
				SUM( IF( MONTH(tgl_spd) = 4 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_april,
				COUNT( IF( MONTH(tgl_spd) = 4 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_4,
				SUM( IF( MONTH(tgl_spd) = 5 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_mei,
				COUNT( IF( MONTH(tgl_spd) = 5 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_5,
				SUM( IF( MONTH(tgl_spd) = 6 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_juni,
				COUNT( IF( MONTH(tgl_spd) = 6 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_6,
				SUM( IF( MONTH(tgl_spd) = 7 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_juli,
				COUNT( IF( MONTH(tgl_spd) = 7 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_7,
				SUM( IF( MONTH(tgl_spd) = 8 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_agustus,
				COUNT( IF( MONTH(tgl_spd) = 8 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_8,
				SUM( IF( MONTH(tgl_spd) = 9 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_september,
				COUNT( IF( MONTH(tgl_spd) = 9 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_9,
				SUM( IF( MONTH(tgl_spd) = 10 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_oktober,
				COUNT( IF( MONTH(tgl_spd) = 10 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_10,
				SUM( IF( MONTH(tgl_spd) = 11 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_november,
				COUNT( IF( MONTH(tgl_spd) = 11 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_11,
				SUM( IF( MONTH(tgl_spd) = 12 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_desember,
				COUNT( IF( MONTH(tgl_spd) = 12 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_12,
				
				COUNT(id) AS jml_trx,
				SUM( total_bayar ) AS total_trx
			FROM spd
			WHERE sort = $sort
			GROUP BY nip_pegawai
			WITH ROLLUP";
		} elseif ($jenis == 2) {
			if ($dipa == 13) {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_januari,
					COUNT( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1,
					SUM( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_februari,
					COUNT( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_2,
					SUM( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_maret,
					COUNT( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_3,
					SUM( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_april,
					COUNT( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_4,
					SUM( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_mei,
					COUNT( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_5,
					SUM( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juni,
					COUNT( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_6,
					SUM( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juli,
					COUNT( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_7,
					SUM( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_agustus,
					COUNT( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_8,
					SUM( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_september,
					COUNT( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_9,
					SUM( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_oktober,
					COUNT( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_10,
					SUM( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_november,
					COUNT( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_11,
					SUM( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_desember,
					COUNT( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_12,
					
					COUNT(id) AS jml_trx,
					SUM( total_bayar ) AS total_trx
				FROM spd
				WHERE status = 4 AND sort = $sort
				GROUP BY nip_pegawai
				WITH ROLLUP";
			} else {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_januari,
					COUNT( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1,
					SUM( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_februari,
					COUNT( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_2,
					SUM( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_maret,
					COUNT( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_3,
					SUM( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_april,
					COUNT( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_4,
					SUM( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_mei,
					COUNT( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_5,
					SUM( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juni,
					COUNT( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_6,
					SUM( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juli,
					COUNT( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_7,
					SUM( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_agustus,
					COUNT( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_8,
					SUM( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_september,
					COUNT( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_9,
					SUM( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_oktober,
					COUNT( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_10,
					SUM( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_november,
					COUNT( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_11,
					SUM( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_desember,
					COUNT( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_12,
					
					COUNT(id) AS jml_trx,
					SUM( total_bayar ) AS total_trx
				FROM spd
				WHERE status = 4 AND dipa = $dipa AND sort = $sort
				GROUP BY nip_pegawai
				WITH ROLLUP";
			}
		}

	} else {
		if ($jenis == 1) {
			$sql = "
			SELECT  
				IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
				
				SUM( IF( MONTH(tgl_spd) = 1 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_januari,
				COUNT( IF( MONTH(tgl_spd) = 1 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_1,
				SUM( IF( MONTH(tgl_spd) = 2 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_februari,
				COUNT( IF( MONTH(tgl_spd) = 2 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_2,
				SUM( IF( MONTH(tgl_spd) = 3 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_maret,
				COUNT( IF( MONTH(tgl_spd) = 3 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_3,
				SUM( IF( MONTH(tgl_spd) = 4 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_april,
				COUNT( IF( MONTH(tgl_spd) = 4 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_4,
				SUM( IF( MONTH(tgl_spd) = 5 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_mei,
				COUNT( IF( MONTH(tgl_spd) = 5 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_5,
				SUM( IF( MONTH(tgl_spd) = 6 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_juni,
				COUNT( IF( MONTH(tgl_spd) = 6 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_6,
				SUM( IF( MONTH(tgl_spd) = 7 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_juli,
				COUNT( IF( MONTH(tgl_spd) = 7 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_7,
				SUM( IF( MONTH(tgl_spd) = 8 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_agustus,
				COUNT( IF( MONTH(tgl_spd) = 8 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_8,
				SUM( IF( MONTH(tgl_spd) = 9 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_september,
				COUNT( IF( MONTH(tgl_spd) = 9 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_9,
				SUM( IF( MONTH(tgl_spd) = 10 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_oktober,
				COUNT( IF( MONTH(tgl_spd) = 10 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_10,
				SUM( IF( MONTH(tgl_spd) = 11 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_november,
				COUNT( IF( MONTH(tgl_spd) = 11 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_11,
				SUM( IF( MONTH(tgl_spd) = 12 AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS bln_desember,
				COUNT( IF( MONTH(tgl_spd) = 12 AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_12,
				
				COUNT(id) AS jml_trx,
				SUM( total_bayar ) AS total_trx
			FROM spd
			WHERE nip_pegawai = $nip_pegawai";
		} elseif ($jenis == 2) {
			if ($dipa == 13) {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_januari,
					COUNT( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1,
					SUM( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_februari,
					COUNT( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_2,
					SUM( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_maret,
					COUNT( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_3,
					SUM( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_april,
					COUNT( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_4,
					SUM( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_mei,
					COUNT( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_5,
					SUM( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juni,
					COUNT( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_6,
					SUM( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juli,
					COUNT( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_7,
					SUM( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_agustus,
					COUNT( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_8,
					SUM( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_september,
					COUNT( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_9,
					SUM( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_oktober,
					COUNT( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_10,
					SUM( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_november,
					COUNT( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_11,
					SUM( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_desember,
					COUNT( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_12,
					
					COUNT(id) AS jml_trx,
					SUM( total_bayar ) AS total_trx
				FROM spd
				WHERE nip_pegawai = $nip_pegawai AND status = 4";
			} else {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_januari,
					COUNT( IF( MONTH(tgl_bayar) = 1 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1,
					SUM( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_februari,
					COUNT( IF( MONTH(tgl_bayar) = 2 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_2,
					SUM( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_maret,
					COUNT( IF( MONTH(tgl_bayar) = 3 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_3,
					SUM( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_april,
					COUNT( IF( MONTH(tgl_bayar) = 4 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_4,
					SUM( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_mei,
					COUNT( IF( MONTH(tgl_bayar) = 5 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_5,
					SUM( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juni,
					COUNT( IF( MONTH(tgl_bayar) = 6 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_6,
					SUM( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_juli,
					COUNT( IF( MONTH(tgl_bayar) = 7 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_7,
					SUM( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_agustus,
					COUNT( IF( MONTH(tgl_bayar) = 8 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_8,
					SUM( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_september,
					COUNT( IF( MONTH(tgl_bayar) = 9 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_9,
					SUM( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_oktober,
					COUNT( IF( MONTH(tgl_bayar) = 10 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_10,
					SUM( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_november,
					COUNT( IF( MONTH(tgl_bayar) = 11 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_11,
					SUM( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS bln_desember,
					COUNT( IF( MONTH(tgl_bayar) = 12 AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_12,
					
					COUNT(id) AS jml_trx,
					SUM( total_bayar ) AS total_trx
				FROM spd
				WHERE nip_pegawai = $nip_pegawai AND status = 4 AND dipa = $dipa";
			}
		}
	}

} else {
	if ($bulan == 1) {
		$bln = 'bln_januari';
	} elseif ($bulan == 2) {
		$bln = 'bln_februari';
	} elseif ($bulan == 3) {
		$bln = 'bln_maret';
	} elseif ($bulan == 4) {
		$bln = 'bln_april';
	} elseif ($bulan == 5) {
		$bln = 'bln_mei';
	} elseif ($bulan == 6) {
		$bln = 'bln_juni';
	} elseif ($bulan == 7) {
		$bln = 'bln_juli';
	} elseif ($bulan == 8) {
		$bln = 'bln_agustus';
	} elseif ($bulan == 9) {
		$bln = 'bln_september';
	} elseif ($bulan == 10) {
		$bln = 'bln_oktober';
	} elseif ($bulan == 11) {
		$bln = 'bln_november';
	} elseif ($bulan == 12) {
		$bln = 'bln_desember';
	}

	if ($nip_pegawai == 13) {
		if ($jenis == 1) {
			$sql = "
			SELECT  
				IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
				
				SUM( IF( MONTH(tgl_spd) = $bulan AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS $bln,
				COUNT( IF( MONTH(tgl_spd) = $bulan AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_1
			FROM spd
			WHERE sort = $sort
			GROUP BY nip_pegawai
			WITH ROLLUP";	
		} elseif ($jenis == 2) {
			if ($dipa == 13) {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS $bln,
					COUNT( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1
				FROM spd
				WHERE status = 4 AND sort = $sort
				GROUP BY nip_pegawai
				WITH ROLLUP";	
			} else {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS $bln,
					COUNT( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1
				FROM spd
				WHERE status = 4 AND dipa = $dipa AND sort = $sort
				GROUP BY nip_pegawai
				WITH ROLLUP";	
			}
		}	
	} else {
		if ($jenis == 1) {
			$sql = "
			SELECT  
				IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
				
				SUM( IF( MONTH(tgl_spd) = $bulan AND YEAR(tgl_spd) = $tahun, total_bayar, 0) ) AS $bln,
				COUNT( IF( MONTH(tgl_spd) = $bulan AND YEAR(tgl_spd) = $tahun, id, NULL) ) AS trx_1
			FROM spd
			WHERE nip_pegawai = $nip_pegawai";	
		} elseif ($jenis == 2) {
			if ($dipa == 13) {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS $bln,
					COUNT( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1
				FROM spd
				WHERE nip_pegawai = $nip_pegawai AND status = 4";	
			} else {
				$sql = "
				SELECT  
					IFNULL( nip_pegawai, 'TOTAL' ) AS pegawai,
					
					SUM( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, total_bayar, 0) ) AS $bln,
					COUNT( IF( MONTH(tgl_bayar) = $bulan AND YEAR(tgl_bayar) = $tahun, id, NULL) ) AS trx_1
				FROM spd
				WHERE nip_pegawai = $nip_pegawai AND status = 4 AND dipa = $dipa";
			}
		}
	}
}

$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);
$hit = count($result);

echo '<html>
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<title>Pivot Table Dengan PHP dan MySQL</title>
			<style>
				body {font-family:"open sans", "segoe ui", tahoma, arial}
				table {border-collapse: collapse}
	
				
				.total td {background-color: #f5f5f5 !important;}
				.right{text-align: right}
				table tr:nth-child(odd) td {
					background-color: #fbfbfb;
					border-bottom: 1px solid #efefef;
					border-top: 1px solid #ececec;
				}
				table th {
					color: #616161;
					margin: 0;
					padding: 10px 10px;
					border: 1px solid #e4e4e4;
					text-align: center;
					font-size: 14px;
					text-transform: uppercase;
					background: #efefef;
				}
				table td {
					border-right: 1px solid #ececec;
					border-left: 1px solid #ececec;
					padding: 7px 15px;
					color: #676767;
					font-size: 14px;
				}
				table td:nth-child(n+3) {
					text-align: right;
				}
			</style>
		</head>
		<body>';

$header_row1 = $header_row2 = '';
if ($hit == 0) {
	foreach ($result as $key => $val)
	{
		if (strpos($key, 'bln_') !== false)
		{
			$bln = explode('_', $key);
			$header_row1 .= '<th colspan="2">' . $bln[1] . '</th>';
			$header_row2 .= '<th>Total Byr ' . ucfirst(mb_strimwidth($bln[1],0,3)) . '</th>
						<th>Jml SPD ' . ucfirst(mb_strimwidth($bln[1],0,3)) . '</th>';
		}
	}
} else {
	foreach ($result[0] as $key => $val)
	{
		if (strpos($key, 'bln_') !== false)
		{
			$bln = explode('_', $key);
			$header_row1 .= '<th colspan="2">' . $bln[1] . '</th>';
			$header_row2 .= '<th>Total Byr ' . ucfirst(mb_strimwidth($bln[1],0,3)) . '</th>
						<th>Jml SPD ' . ucfirst(mb_strimwidth($bln[1],0,3)) . '</th>';
		}
	}
}
 ?>
<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header">
        <!-- <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0 text-dark">Hasil Pencarian</h2>
                </div> 
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Rekap</a></li>
                        <li class="breadcrumb-item active">Hasil Pencarian</li>
                    </ol>
                </div> 
            </div> 
        </div>  -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Rekap <?= $jenis == 1 ? 'Pembuatan' : 'Pembayaran' ?> SPD</h3>
                        <div style="float: right">
                            <a href="<?= site_url('rekap') ?>" class="btn btn-sm btn-success">
                                <i class="fa fa-user-undo"></i> Back
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
					
	<!-- <table id="example23" class="table table-responsive"> -->
	<table id="example23" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Pegawai</th>
				<?= $header_row1 ?>
				<?php if($bulan == 13) { ?>
				<th rowspan="2">Total SPD</th>
				<th rowspan="2">Total Bayar Seluruh</th>
				<?php } ?>
			</tr>
			<tr>
				<?= $header_row2 ?>
			</tr>
		</thead>
		<tbody>
<?php
$no = 1;		
foreach ($result as $array)
{
	$class = '';
	$print_no = $no;
	
	if ($array['pegawai'] == 'TOTAL') {
		$class = ' class="total"';
		$print_no =  $no;
	} else {
		$no++;
	}
	
	echo  '<tr'.$class.'>
			<td>' . $print_no . '</td>';
		
	foreach ($array as $key => $val)
	{
		if ($key !== 'pegawai')
		{
			$val = number_format($val, '0', ',', '.');
		}

		if ($key == 'pegawai')
		{
			if ($val != 'TOTAL') {
				$query = $this->db->query("SELECT nama FROM pegawai WHERE nip=$val");
				foreach ($query->result() as $keys) {
					$val = $keys->nama;
				}
			}
		}
		
		echo '<td>' . $val . '</td>';
		
	}
	echo '</tr>';
}

echo '
	</tbody>
</table>
</div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>';