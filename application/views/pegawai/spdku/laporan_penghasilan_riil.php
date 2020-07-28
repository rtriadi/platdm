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
	<td align="center"><b>
			DAFTAR PENGELUARAN RIIL</b>
	</td>
</table>
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px">
	<tr>
		<td width="15%"></td>
		<td>
			Yang bertanda tangan dibawah ini :
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>: <?= getNamaByNip($row->nip_pegawai) ?></td>
	</tr>
	<tr>
		<td>NIP</td>
		<td>: <?= $row->nip_pegawai ?>
		<td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>: <?= $row->jabatan ?>
		<td>
	</tr>
</table>
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px; text-align: justify">
	<tr>
		<td colspan="2">Berdasarkan Surat Perjalanan Dinas (SPD) tanggal <?= tgl_ind($row->tgl_spd) ?>
			Nomor <?= $row->no_spd ?>,
			dengan ini kami menyatakan dengan sesungguhnya bahwa :
		</td>
	</tr>
	<tr>
		<td width="5%" align="center" valign="top">1.</td>
		<td> Biaya transport pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti-bukti pengeluarannya, meliputi :</td>
	</tr>
</table>
<br>
<table border="1px" align="center" width="80%" height="25%" cellpadding="5px" style="font-size: 14px; border-collapse: collapse; text-align: justify">
	<tr align="center">
		<td>No.</td>
		<td>Uraian</td>
		<td width="20%">Jumlah</td>
	</tr>
	<tr>
		<td align="center">1.</td>
		<td> Biaya transportasi dari tempat tinggal ke bandara djalaluddin</td>
		<td><?= indo_currency($row->pengeluaran1) ?></td>
	</tr>
	<tr>
		<td align="center">2.</td>
		<td> Biaya transportasi dari bandara kota tujuan ke tempat menginap / tempat tujuan</td>
		<td><?= indo_currency($row->pengeluaran2) ?></td>
	</tr>
	<tr>
		<td align="center">3.</td>
		<td> Biaya transportasi dari tempat menginap / tempat tujuan ke bandara kota tujuan</td>
		<td><?= indo_currency($row->pengeluaran3) ?></td>
	</tr>
	<tr>
		<td align="center">4.</td>
		<td> Biaya transportasi dari bandara djalaluddin ke tempat tinggal</td>
		<td><?= indo_currency($row->pengeluaran4) ?></td>
	</tr>
	<tr>
		<td colspan="2" align="center">Total Pengeluaran Riil</td>
		<td><?= indo_currency($row->pengeluaran_riil) ?></td>
	</tr>
</table>
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px; text-align: justify">
	<tr>
		<td width="5%" align="center" valign="top">2.</td>
		<td> Jumlah uang tersebut pada angka 1 di atas benar-benar dikeluarkan untuk pelaksanaan perjalanan dinas dimaksud dan apabila di kemudian hari terdapat kelebihan atas pembayaran, kami bersedia menyetorkan kelebihan tersebut ke Kas Negara.</td>
	</tr>
</table>
<table border="0px" align="center" width="85%" style="font-size: 14px; text-align: justify">
	<tr>
		<td width="5%"></td>
		<td>Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan</td>
	</tr>
	<tr>
		<td colspan="2">sebagaimana mestinya.</td>
	</tr>
</table>
<br>
<table border="0px" align="center" width="85%" style="font-size: 14px; text-align: justify">
	<tr>
		<td width="65%">Mengetahui/Menyetujui</td>
		<td>Gorontalo, <?= tgl_ind($row->tgl_berangkat) ?></td>
	</tr>
	<tr>
		<td>Pejabat Pembuat Komitmen</td>
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
		<td><u><?= getNamaByNip($row->nip_ppk) ?></u></td>
		<td><u><?= getNamaByNip($row->nip_pegawai) ?></u></td>
	</tr>
	<tr>
		<td>Nip. <?= $row->nip_ppk ?></td>
		<td>Nip. <?= $row->nip_pegawai ?></td>
	</tr>
</table>
