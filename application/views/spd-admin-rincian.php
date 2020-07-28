<?php error_reporting(0); ?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Print SPD Admin</title>
</head>
<body onload="window.print()">         
<?php foreach ($row->result() as $key => $data) : ?>
<div style="font-family: Arial, Helvetica, sans-serif;" class="page">
<table border="0" cellpadding="5" width="100%" align="center" style="border-collapse: collapse; font-size: 9pt;">
    <tr>
        <td valign="top" align='center' colspan='3' style="font-size: 11pt;"><b>RINCIAN BIAYA PERJALANAN DINAS</b></td>
    </tr>
    <tr>
        <td valign="top" width="22%">Lampiran SPD Nomor</td>
        <td valign="top">:</td>
        <td valign="top"><?= $data->no_spd; ?></td>
    </tr>
    <tr>
        <td valign="top" width="22%">Tanggal</td>
        <td valign="top">:</td>
        <td valign="top"><?= tgl_ind($data->tgl_spd) ?></td>
    </tr>
</table>
<table border="1" cellpadding="5" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
    <tr>
        <td valign="top" align='center'><b>No</b></td>
        <td valign="top" align='center' colspan='2'><b>PERINCIAN BIAYA</b></td>
        <td valign="top" align='center' colspan='2'><b>JUMLAH</b></td>
        <td valign="top" align='center'><b>KETERANGAN</b></td>
    </tr>
    <tr>
        <td valign="top" align='center' width="1%" style="border-bottom: 0 !important;">1</td>
        <td valign="top" width="20%" style="border-right: 0 !important; border-bottom: 0 !important;">Uang harian <br>
        Perjalanan Dinas ke <br>
        dari  tanggal <br>
        selama </td>
        <td valign="top" style="border-left: 0 !important; border-bottom: 0 !important;"><br><?= getCityById($data->tujuan1) ?><?php if($data->tujuan2 != '') echo ", "; ?> <?= getCityById($data->tujuan2) ?><?php if($data->tujuan3 != '') echo ", "; ?> <?= getCityById($data->tujuan3) ?><?php if($data->tujuan4 != '') echo ", "; ?> <?= getCityById($data->tujuan4) ?> <br>
        <?= tgl_ind($data->tgl_berangkat) ?> s/d <?= tgl_ind($data->tgl_selesai) ?> <br>
        <?= $data->lamanya ?> hari
        </td>
        <td valign="top" width="1%" style="border-right: 0 !important; border-bottom: 0 !important;"><br><br>Rp.</td>
        <td valign="top" width="10%" align='right' style="border-bottom: 0 !important; border-left: 0 !important; padding-right: 10pt;"><br><br><?= number_format($data->grand_total_uh) ?></td>
        <td valign="top" width="1%" style="border-bottom: 0 !important;"><br><br>80% Satuan</td>
    </tr>
    <tr>
        <td valign="top" align='center' style="border-bottom: 0 !important; border-top: 0 !important;">2</td>
        <td valign="top" style="border-right: 0 !important; border-bottom: 0 !important; border-top: 0 !important;">Biaya transportasi pegawai <br>
        Angkutan Darat <br>
        Gorontalo <br>
        PP. &nbsp; Rp.  </td>
        <td valign="top" style="border-left: 0 !important; border-bottom: 0 !important; border-top: 0 !important;"><br><br> - 
        <?php 
        $query_tujuan1 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan1");
        foreach ($query_tujuan1->result() as $t) { 
            echo $t->city_type; echo ' '; echo $t->name;
        } ?><?php if($data->tujuan2 != '') echo ", "; ?> 
        <?php 
        if($data->tujuan2 != '') {
        $query_tujuan2 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan2");
        foreach ($query_tujuan2->result() as $t) { 
            echo $t->city_type; echo ' '; echo $t->name;
        } }?><?php if($data->tujuan3 != '') echo ", "; ?> 
        <?php 
        if($data->tujuan3 != '') {
        $query_tujuan3 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan3");
        foreach ($query_tujuan3->result() as $t) { 
            echo $t->city_type; echo ' '; echo $t->name;
        } }?><?php if($data->tujuan4 != '') echo ", "; ?> 
        <?php 
        if($data->tujuan4 != '') {
        $query_tujuan4 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan4");
        foreach ($query_tujuan4->result() as $t) { 
            echo $t->city_type; echo ' '; echo $t->name;
        } }?> 
        <br>
        <?= number_format($data->total_by_transportasi) ?></td>
        <td valign="top" style="border-right: 0 !important; border-bottom: 0 !important; border-top: 0 !important;"><br><br>Rp.</td>
        <td valign="top" align='right' style="border-bottom: 0 !important; border-top: 0 !important; border-left: 0 !important; padding-right: 10pt;"><br><br><?= number_format($data->total_by_transportasi) ?></td>
        <td valign="top" style="border-bottom: 0 !important; border-top: 0 !important;"></td>
    </tr>
    <tr>
        <td valign="top" align='center' style="border-bottom: 0 !important; border-top: 0 !important;">3</td>
        <td valign="top" style="border-right: 0 !important; border-bottom: 0 !important; border-top: 0 !important;">Biaya Pengeluaran Riil</td>
        <td valign="top" style="border-left: 0 !important; border-bottom: 0 !important; border-top: 0 !important;"></td>
        <td valign="top" style="border-right: 0 !important; border-bottom: 0 !important; border-top: 0 !important;">Rp. </td>
        <td valign="top" align='right' style="border-bottom: 0 !important; border-top: 0 !important; border-left: 0 !important; padding-right: 10pt;"><?= number_format($data->pengeluaran_riil) ?></td>
        <td valign="top" style="border-bottom: 0 !important; border-top: 0 !important;"></td>
    </tr>
    <tr>
        <td valign="top" align='center' style="border-top: 0 !important;">4</td>
        <td valign="top" style="border-right: 0 !important; border-top: 0 !important;">Biaya Penginapan <br>
        - dari  tanggal  <br>
        &nbsp;&nbsp;selama</td>
        <td valign="top" style="border-left: 0 !important; border-top: 0 !important;"><br><?= tgl_ind($data->tgl_berangkat) ?> s/d <?= tgl_ind($data->tgl_selesai) ?> <br>
        <?php 
        // $querys = $this->db->query("SELECT spd_penginapan.* FROM spd_penginapan WHERE id_spd=$data->id");
        // foreach ($querys->result() as $key) {
        //     echo '1'; echo '&nbsp;&nbsp;&nbsp; Malam'; echo '&nbsp;&nbsp;&nbsp; @ Rp. &nbsp;&nbsp;&nbsp;'; echo number_format($key->tarif_penginapan); echo '<br>'; } ?>
        <?= $data->durasi_menginap; ?>&nbsp;&nbsp;&nbsp; Malam &nbsp;&nbsp;&nbsp; @ Rp. &nbsp;&nbsp;&nbsp; <?= number_format($data->tarif_penginapan); ?> <br>
        <?php if ($data->tarif_penginapan2 != '0') { ?>
        <?= $data->durasi_menginap2; ?>&nbsp;&nbsp;&nbsp; Malam &nbsp;&nbsp;&nbsp; @ Rp. &nbsp;&nbsp;&nbsp; <?= number_format($data->tarif_penginapan2); ?> <br>
        <?php } elseif ($data->tarif_penginapan3 != '0') { ?>
        <?= $data->durasi_menginap3; ?>&nbsp;&nbsp;&nbsp; Malam &nbsp;&nbsp;&nbsp; @ Rp. &nbsp;&nbsp;&nbsp; <?= number_format($data->tarif_penginapan3); ?> <br>
        <?php } ?>
        </td>
        <td valign="top" style="border-right: 0 !important; border-top: 0 !important;"><br> Rp. </td>
        <td valign="top" align='right' style="border-top: 0 !important; border-left: 0 !important; padding-right: 10pt;"><br><?= number_format($data->total_by_penginapan) ?></td>
        <td valign="top" style="border-top: 0 !important;"></td>
    </tr>
    <tr>
        <td valign="top" style="border-right: 0 !important;"></td>
        <td valign="top" style="border-right: 0 !important; border-left: 0 !important;" colspan='2'>JUMLAH</td>
        <td valign="top" style="border-right: 0 !important; border-left: 0 !important;">Rp. </td>
        <td valign="top" align='right' style="border-left: 0 !important; border-right: 0 !important; padding-right: 10pt;"><?= number_format($data->grand_total) ?></td>
        <td valign="top" style="border-left: 0 !important;"></td>
    </tr>
    <!-- <tr>
        <td valign="top" colspan='6'>&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top" style="border-right: 0 !important;">Terbilang  :</td>
        <td valign="top" style="border-left: 0 !important;" colspan='4'><?//= ucwords(terbilang($data->total_bayar)) ?> Rupiah</td>
    </tr> -->
</table><br>
<table border="0" cellpadding="5" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
    <tr style="border-bottom: 1pt solid black;">
        <td valign="top" width="70%"><br>Telah dibayar sejumlah <br>
        &nbsp;Rp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($data->grand_total) ?> 
        <p align='center' style='padding-right:25pt;'>Bendahara Pengeluaran <br><br><br><br><br><br>
        <?php 
        $querys = $this->db->query("SELECT nama FROM pegawai WHERE nip=$data->nip_bendahara");
        foreach ($querys->result() as $key) {
            echo $key->nama;
        }
        ?> <br>
        NIP <?= $data->nip_bendahara ?></p></td>
        <td valign="top" width="30%">Gorontalo, <br>
        Telah menerima jumlah uang sebesar <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rp. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($data->grand_total) ?> 
        <p align='center' style='padding-right:25pt;'>Yang menerima <br><br><br><br><br><br>
        <?= $data->nama ?> <br>
        NIP <?= $data->nip_pegawai ?></p></td>
    </tr>
</table><br>
<table border="0" cellpadding="5" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
    <tr>
        <td valign="top" align='center' colspan='5' style="font-size: 11pt;"><b>PERHITUNGAN SPD RAMPUNG</b></td>
    </tr>
    <tr>
        <td valign="top" width="22%">Ditetapkan sejumlah <br>
		Uang Muka <br>
		Pembayaran dengan Kartu Kredit </td>
        <td valign="top" width="5%" style="border-bottom: 1pt solid black;">: Rp  <br>
		: Rp <br>
		: Rp </td>
        <td valign="top" align='right' width="15%" style="border-bottom: 1pt solid black;"><?= number_format($data->grand_total) ?><br>
		<?= number_format($data->uang_muka) ?><br>
		<?= number_format($data->kredit) ?> </td>
        <td valign="top" width="24%"></td>
        <td valign="top"></td>
    </tr>
    <tr>
        <td valign="top"><b>Sisa kurang / ( lebih ) Bayar</b></td>
        <td valign="top"><b>: Rp </b></td>
        <td valign="top" align='right'><b><?= number_format($data->total_bayar) ?></b></td>
        <td valign="top"></td>
        <td valign="top"></td>
    </tr>
    <tr>
        <td colspan='3'></td>
        <td valign="top"></td>
        <td valign="top">Pejabat Pembuat Komitmen <br><br><br><br><br><br>
        <b><?php 
        $query = $this->db->query("SELECT nama FROM pegawai WHERE nip=$data->nip_ppk");
        foreach ($query->result() as $keys) {
            echo $keys->nama;
        }
        ?> <br>
        NIP <?= $data->nip_ppk ?></b></td>
    </tr>
</table>
</div>
<?php endforeach ?>
</body>
</html>
