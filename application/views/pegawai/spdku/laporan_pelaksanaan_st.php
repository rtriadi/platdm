<script>
	window.print()
</script>
<table border="0px" align="center" width="85%" style="font-size: 14px">
	<tr>
		<td width="23%"><img src="<?= site_url('assets/img/logo.png') ?>" class="img img-responsive mt-3" width="100%"></td>
		<td align="center"><b>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA <br>
				DIREKTORAT JENDERAL PAJAK <br>
				KANTOR WILAYAH DJP SULAWESI UTARA, TENGAH, <br>
				GORONTALO DAN MALUKU UTARA <br>
				KANTOR PELAYANAN PAJAK PRATAMA GORONTALO </b><br>
			<small style="font-size: 10px">JALAN ARIF RAHMAN HAKIM NO. 34, GORONTALO 96128 <br>
				TELEPON (0435) 830010; FAKSIMILE (0435) 830009; SITUS www.pajak.go.id <br>
				LAYANAN INFORMASI DAN KELUHAN KRING PAJAK (021) 1500200; <br>
				EMAIL pengaduan@pajak.go.id</small>
		</td>
		<td width="10%"></td>
	</tr>
</table>
<hr style="border: 1px solid black;" width="85%">
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px">
	<td align="center"><b><u>
				LAPORAN PELAKSANAAN SURAT TUGAS</u></b>
	</td>
</table>
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px">
	<tr>
		<td width="25%">No. Surat Tugas</td>
		<td>: <?= $format->format_awal ?><?= sprintf('%04d', $row->no_st); ?><?= $format->format_akhir ?>
		</td>
	</tr>
	<tr>
		<td>Tanggal Surat Tugas</td>
		<td>: <?= tgl_ind($row->tgl_st) ?>
		<td>
	</tr>
	<tr>
		<td>Tanggal Pelaksanaan</td>
		<td>: <?= tgl_ind($row->tgl_berangkat) ?>
		<td>
	</tr>
</table>
<br>
<table border="1px" align="center" width="85%" height="45%" cellpadding="10px" style="font-size: 14px; border-collapse: collapse; text-align: justify">
	<tr align="center" height="5%">
		<td>Uraian Pelaksanaan Tugas</td>
	</tr>
	<tr align="justify" valign="top">
		<td><?= $row->isi_laporan ?></td>
	</tr>
</table>
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px">
	<tr>
	</tr>
</table>
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px; text-align: justify">
	<tr>
		<td width="65%">Mengetahui/Menyetujui</td>
		<td>Gorontalo, <?= tgl_ind($row->tgl_berangkat) ?></td>
	</tr>
	<tr>
		<td>Atasan langsung,</td>
		<td>Pegawai Negeri yang melakukan</td>
	</tr>
	<tr>
		<td></td>
		<td>Perjalanan dinas,</td>
	</tr>
	<tr height="60px">
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td><u><?= getNamaByNip($row->nip_atasan) ?></u></td>
		<td><u><?= getNamaByNip($row->nip_pegawai) ?></u></td>
	</tr>
	<tr>
		<td>Nip. <?= $row->nip_atasan ?></td>
		<td>Nip. <?= $row->nip_pegawai ?></td>
	</tr>
</table>
