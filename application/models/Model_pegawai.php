<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pegawai extends CI_Model
{
	public function getPegawai()
	{
		$this->db->select('pegawai.nip, pegawai.nama, pegawai.jabatan');
		$this->db->from('pegawai');
		$this->db->where('pegawai.level', '4');
		$this->db->order_by('pegawai.nama', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function getSPDbyNip($nip = null, $id = null)
	{
		$this->db->select('spd.*, pegawai.*, city.name as city_name, province.name as province_name');
		$this->db->from('spd');
		$this->db->join('pegawai', 'pegawai.nip = spd.nip_pegawai');
		$this->db->join('city', 'city.id = spd.tujuan1');
		$this->db->join('province', 'province.id = city.province_id');
		$this->db->where('spd.status_ppk', '1');
		if ($nip != null) {
			$this->db->where('spd.nip_pegawai', $nip);
		}
		if ($id != null) {
			$this->db->where('spd.id', $id);
		}
		$this->db->order_by('spd.tgl_spd', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function getApproveSPDbyNip($nip = null, $id = null)
	{
		$this->db->select('spd.*, pegawai.*, city.name as city_name, province.name as province_name');
		$this->db->from('spd');
		$this->db->join('pegawai', 'pegawai.nip = spd.nip_pegawai');
		$this->db->join('city', 'city.id = spd.tujuan1');
		$this->db->join('province', 'province.id = city.province_id');
		$this->db->where('spd.status_ppk', '0');
		if ($nip != null) {
			$this->db->where('spd.nip_pegawai', $nip);
		}
		if ($id != null) {
			$this->db->where('spd.id', $id);
		}
		$this->db->order_by('spd.tgl_spd', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function cek_penginapan($provinsi, $pangakt_gol)
	{
		$this->db->select('ref_penginapan.*');
		$this->db->from('ref_penginapan');
		$this->db->join('kategori_pangkat_gol', 'kategori_pangkat_gol.id = ref_penginapan.id_kategori_pangkat_gol');
		$this->db->join('pangkat_gol', 'pangkat_gol.id_kategori_pangkat_gol = kategori_pangkat_gol.id');
		$this->db->where_in('ref_penginapan.provinsi', $provinsi);
		$this->db->where('pangkat_gol.nama', $pangakt_gol);
		$query = $this->db->get();
		return $query;
	}

	public function cek_biaya_taxi($provinsi)
	{
		$this->db->select('besaran');
		$this->db->from('ref_biaya_taxi');
		$this->db->where_in('provinsi', $provinsi);
		$query = $this->db->get();
		return $query;
	}

	public function spdkuEdit($post)
	{
		if ($this->fungsi->user_login()->level == 1) {
			if ($post['kuitansi'] != null) {
				$params = array(
					'tgl_berangkat' => $post['tgl_berangkat'],
					'tgl_selesai' => $post['tgl_selesai'],
					'nip_atasan' => $post['nip_atasan'],
					'uang_harian' => $post['uang_harian'],
					'jlh_hari' => $post['jlh_hari'],
					'total_uh' => $post['total_uh'],
					'penyesuaian_uh' => $post['penyesuaian_uh'],
					'uang_harian2' => $post['uang_harian2'],
					'jlh_hari2' => $post['jlh_hari2'],
					'total_uh2' => $post['total_uh2'],
					'penyesuaian_uh2' => $post['penyesuaian_uh2'],
					'grand_total_uh' => $post['grand_total_uh'],
					'by_transportasi_berangkat' => $post['by_transportasi_berangkat'],
					'by_transportasi_pulang' => $post['by_transportasi_pulang'],
					'total_by_transportasi' => $post['total_by_transportasi'],
					'durasi_menginap' => $post['durasi_menginap'],
					'menginap_dari' => $post['menginap_dari'],
					'menginap_sampai' => $post['menginap_sampai'],
					'tarif_penginapan' => $post['tarif_penginapan'],
					'durasi_menginap2' => $post['durasi_menginap2'],
					'menginap_dari2' => $post['menginap_dari2'],
					'menginap_sampai2' => $post['menginap_sampai2'],
					'tarif_penginapan2' => $post['tarif_penginapan2'],
					'durasi_menginap3' => $post['durasi_menginap3'],
					'menginap_dari3' => $post['menginap_dari3'],
					'menginap_sampai3' => $post['menginap_sampai3'],
					'tarif_penginapan3' => $post['tarif_penginapan3'],
					'total_by_penginapan' => $post['total_by_penginapan'],
					'pengeluaran1' => $post['pengeluaran1'],
					'pengeluaran2' => $post['pengeluaran2'],
					'pengeluaran3' => $post['pengeluaran3'],
					'pengeluaran4' => $post['pengeluaran4'],
					'pengeluaran_riil' => $post['pengeluaran_riil'],
					'grand_total' => $post['grand_total'],
					'uang_muka' => $post['uang_muka'],
					'kredit' => $post['kredit'],
					'total_bayar' => $post['total_bayar'],
					'kuitansi' => $post['kuitansi'],
					'isi_laporan' => $post['isi_laporan']
				);
				$this->db->where('id', $post['id']);
				$this->db->update('spd', $params);
			} else {
				$params = array(
					'tgl_berangkat' => $post['tgl_berangkat'],
					'tgl_selesai' => $post['tgl_selesai'],
					'nip_atasan' => $post['nip_atasan'],
					'uang_harian' => $post['uang_harian'],
					'jlh_hari' => $post['jlh_hari'],
					'total_uh' => $post['total_uh'],
					'penyesuaian_uh' => $post['penyesuaian_uh'],
					'uang_harian2' => $post['uang_harian2'],
					'jlh_hari2' => $post['jlh_hari2'],
					'total_uh2' => $post['total_uh2'],
					'penyesuaian_uh2' => $post['penyesuaian_uh2'],
					'grand_total_uh' => $post['grand_total_uh'],
					'by_transportasi_berangkat' => $post['by_transportasi_berangkat'],
					'by_transportasi_pulang' => $post['by_transportasi_pulang'],
					'total_by_transportasi' => $post['total_by_transportasi'],
					'durasi_menginap' => $post['durasi_menginap'],
					'menginap_dari' => $post['menginap_dari'],
					'menginap_sampai' => $post['menginap_sampai'],
					'tarif_penginapan' => $post['tarif_penginapan'],
					'durasi_menginap2' => $post['durasi_menginap2'],
					'menginap_dari2' => $post['menginap_dari2'],
					'menginap_sampai2' => $post['menginap_sampai2'],
					'tarif_penginapan2' => $post['tarif_penginapan2'],
					'durasi_menginap3' => $post['durasi_menginap3'],
					'menginap_dari3' => $post['menginap_dari3'],
					'menginap_sampai3' => $post['menginap_sampai3'],
					'tarif_penginapan3' => $post['tarif_penginapan3'],
					'total_by_penginapan' => $post['total_by_penginapan'],
					'pengeluaran1' => $post['pengeluaran1'],
					'pengeluaran2' => $post['pengeluaran2'],
					'pengeluaran3' => $post['pengeluaran3'],
					'pengeluaran4' => $post['pengeluaran4'],
					'pengeluaran_riil' => $post['pengeluaran_riil'],
					'grand_total' => $post['grand_total'],
					'uang_muka' => $post['uang_muka'],
					'kredit' => $post['kredit'],
					'total_bayar' => $post['total_bayar'],
					'isi_laporan' => $post['isi_laporan']
				);
				$this->db->where('id', $post['id']);
				$this->db->update('spd', $params);
			}
		} else {
			if ($post['kuitansi'] != null) {
				$params = array(
					'tgl_berangkat' => $post['tgl_berangkat'],
					'tgl_selesai' => $post['tgl_selesai'],
					'nip_atasan' => $post['nip_atasan'],
					'by_transportasi_berangkat' => $post['by_transportasi_berangkat'],
					'by_transportasi_pulang' => $post['by_transportasi_pulang'],
					'total_by_transportasi' => $post['total_by_transportasi'],
					'durasi_menginap' => $post['durasi_menginap'],
					'menginap_dari' => $post['menginap_dari'],
					'menginap_sampai' => $post['menginap_sampai'],
					'tarif_penginapan' => $post['tarif_penginapan'],
					'durasi_menginap2' => $post['durasi_menginap2'],
					'menginap_dari2' => $post['menginap_dari2'],
					'menginap_sampai2' => $post['menginap_sampai2'],
					'tarif_penginapan2' => $post['tarif_penginapan2'],
					'durasi_menginap3' => $post['durasi_menginap3'],
					'menginap_dari3' => $post['menginap_dari3'],
					'menginap_sampai3' => $post['menginap_sampai3'],
					'tarif_penginapan3' => $post['tarif_penginapan3'],
					'total_by_penginapan' => $post['total_by_penginapan'],
					'pengeluaran1' => $post['pengeluaran1'],
					'pengeluaran2' => $post['pengeluaran2'],
					'pengeluaran3' => $post['pengeluaran3'],
					'pengeluaran4' => $post['pengeluaran4'],
					'pengeluaran_riil' => $post['pengeluaran_riil'],
					'grand_total' => $post['grand_total'],
					'uang_muka' => $post['uang_muka'],
					'kredit' => $post['kredit'],
					'total_bayar' => $post['total_bayar'],
					'kuitansi' => $post['kuitansi'],
					'isi_laporan' => $post['isi_laporan']
				);
				$this->db->where('id', $post['id']);
				$this->db->update('spd', $params);
				$this->db->where('id', $post['id']);
				$this->db->update('spd_pegawai', $params);
			} else {
				$params = array(
					'tgl_berangkat' => $post['tgl_berangkat'],
					'tgl_selesai' => $post['tgl_selesai'],
					'nip_atasan' => $post['nip_atasan'],
					'by_transportasi_berangkat' => $post['by_transportasi_berangkat'],
					'by_transportasi_pulang' => $post['by_transportasi_pulang'],
					'total_by_transportasi' => $post['total_by_transportasi'],
					'durasi_menginap' => $post['durasi_menginap'],
					'menginap_dari' => $post['menginap_dari'],
					'menginap_sampai' => $post['menginap_sampai'],
					'tarif_penginapan' => $post['tarif_penginapan'],
					'durasi_menginap2' => $post['durasi_menginap2'],
					'menginap_dari2' => $post['menginap_dari2'],
					'menginap_sampai2' => $post['menginap_sampai2'],
					'tarif_penginapan2' => $post['tarif_penginapan2'],
					'durasi_menginap3' => $post['durasi_menginap3'],
					'menginap_dari3' => $post['menginap_dari3'],
					'menginap_sampai3' => $post['menginap_sampai3'],
					'tarif_penginapan3' => $post['tarif_penginapan3'],
					'total_by_penginapan' => $post['total_by_penginapan'],
					'pengeluaran1' => $post['pengeluaran1'],
					'pengeluaran2' => $post['pengeluaran2'],
					'pengeluaran3' => $post['pengeluaran3'],
					'pengeluaran4' => $post['pengeluaran4'],
					'pengeluaran_riil' => $post['pengeluaran_riil'],
					'grand_total' => $post['grand_total'],
					'uang_muka' => $post['uang_muka'],
					'kredit' => $post['kredit'],
					'total_bayar' => $post['total_bayar'],
					'isi_laporan' => $post['isi_laporan']
				);
				$this->db->where('id', $post['id']);
				$this->db->update('spd', $params);
				$this->db->where('id', $post['id']);
				$this->db->update('spd_pegawai', $params);
			}
		}
	}

	public function getSlipGajiByNipAndBulan($bln, $nip)
	{
		$this->db->select('gaji.gaji, uang_makan.uang_makan');
		$this->db->from('pegawai');
		$this->db->join('gaji', 'pegawai.nip = gaji.nip');
		$this->db->join('uang_makan', 'pegawai.nip = uang_makan.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->like('gaji.bulan_tahun', $bln);
		$this->db->like('uang_makan.bulan_tahun', $bln);
		$query = $this->db->get();
		return $query;
	}

	public function gaji($bln_thn, $nip)
	{
		$this->db->select('pegawai.nip, pegawai.nama, gaji.gaji');
		$this->db->from('pegawai');
		$this->db->join('gaji', 'gaji.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('gaji.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function gaji13($bln_thn, $nip)
	{
		$this->db->select('gaji13.gaji13');
		$this->db->from('pegawai');
		$this->db->join('gaji13', 'gaji13.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('gaji13.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function honor($bln_thn, $nip)
	{
		$this->db->select('honor.*');
		$this->db->from('pegawai');
		$this->db->join('honor', 'honor.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('honor.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function insentif($bln_thn, $nip)
	{
		$this->db->select('insentif.insentif');
		$this->db->from('pegawai');
		$this->db->join('insentif', 'insentif.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('insentif.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function kekurangan_gaji($bln_thn, $nip)
	{
		$this->db->select('kekurangan_gaji.*');
		$this->db->from('pegawai');
		$this->db->join('kekurangan_gaji', 'kekurangan_gaji.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('kekurangan_gaji.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function thr($bln_thn, $nip)
	{
		$this->db->select('thr.thr');
		$this->db->from('pegawai');
		$this->db->join('thr', 'thr.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('thr.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function tukin_13($bln_thn, $nip)
	{
		$this->db->select('tukin_13.tukin_13');
		$this->db->from('pegawai');
		$this->db->join('tukin_13', 'tukin_13.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('tukin_13.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function tukin_thr($bln_thn, $nip)
	{
		$this->db->select('tukin_thr.tukin_thr');
		$this->db->from('pegawai');
		$this->db->join('tukin_thr', 'tukin_thr.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('tukin_thr.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function uang_lembur($bln_thn, $nip)
	{
		$this->db->select('uang_lembur.uang_lembur');
		$this->db->from('pegawai');
		$this->db->join('uang_lembur', 'uang_lembur.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('uang_lembur.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function uang_makan($bln_thn, $nip)
	{
		$this->db->select('uang_makan.uang_makan');
		$this->db->from('pegawai');
		$this->db->join('uang_makan', 'uang_makan.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('uang_makan.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function potongan_tukin($bln_thn, $nip)
	{
		$this->db->select('potongan_tukin.*');
		$this->db->from('pegawai');
		$this->db->join('potongan_tukin', 'potongan_tukin.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('potongan_tukin.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function kekurangan_tukin($bln_thn, $nip)
	{
		$this->db->select('kekurangan_tukin.*');
		$this->db->from('pegawai');
		$this->db->join('kekurangan_tukin', 'kekurangan_tukin.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('kekurangan_tukin.bulan_tahun', $bln_thn);

		$query = $this->db->get();
		return $query;
	}

	public function tukin_plt($bln_thn, $nip)
	{
		$this->db->select('tukin_plt.*');
		$this->db->from('pegawai');
		$this->db->join('tukin_plt', 'tukin_plt.nip = pegawai.nip');
		$this->db->where('pegawai.nip', $nip);
		$this->db->where('tukin_plt.bulan_tahun', $bln_thn);

		$query = $this->db->get();
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
