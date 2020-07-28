<html>
<head>
	<title>Cetak SPD Admin</title>
</head>
<body onload="window.print()">  
<?php foreach ($row->result() as $key => $data) : ?>
        <?php $this->load->model('model_setting');
        $query_format = $this->model_setting->getSetting($data->sort, '1');
        foreach ($query_format->result() as $keysss) { 
            $awal  = $keysss->format_awal;
            $akhir = $keysss->format_akhir;
        } ?>
<div style="font-family: Arial, Helvetica, sans-serif;" class="page">
<table border="0" cellpadding="5" width="100%" align="center" style="border-collapse: collapse; font-size: 9pt;">
    <tr>
        <td valign="top"><p align="center">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA <br>			
        DIREKTORAT JENDERAL PAJAK <br>			
        KANTOR WILAYAH  DJP SULUTTENGGO DAN MALUT <br>			
        KANTOR PELAYANAN PAJAK PRATAMA GORONTALO</p>			
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td valign="top">Lembar Ke <br>
        Kode No <br>
        Nomor
        </td>
        <td valign="top">:<br> :<br> : 
        <?= $data->no_spd ?>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="center"><br><b>SURAT PERJALANAN DINAS (SPD)</b></td>
    </tr>
</table>
<table border="1" cellpadding="5" width="100%" align="center" style="border-collapse: collapse; font-size: 9pt;">
    <tr>
        <td valign="top" width="55%">1. Pejabat Pembuat Komitmen</td>
        <td valign="top" width="45%" colspan="2">
        <?php 
        $querys = $this->db->query("SELECT nama FROM pegawai WHERE nip=$data->nip_ppk");
        foreach ($querys->result() as $key) {
            echo $key->nama;
        }
        ?>
        </td>
    </tr>
    <tr>
        <td valign="top" width="55%">2. Nama / NIP pegawai yang melaksanakan perjalanan dinas</td>
        <td valign="top" width="45%" colspan="2"><?= $data->nama ?> <br> NIP <?= $data->nip_pegawai ?></td>
    </tr>
    <tr>
        <td valign="top" width="55%">3. a. Pangkat dan Golongan <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;b. Jabatan / Instansi <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;c. Tingkat Biaya Perjalanan Dinas
        </td>
        <td valign="top" width="45%" colspan="2">a. <?= $data->pangkat_gol ?> <br>
        b. <?= $data->jabatan ?> <br>
        c. C
        </td>
    </tr>
    <tr>
        <td valign="top" width="55%">4. Maksud Perjalanan Dinas</td>
        <td valign="top" width="45%" colspan="2"><?= $data->maksud ?></td>
    </tr>
    <tr>
        <td valign="top" width="55%">5. Alat angkutan yang dipergunakan</td>
        <td valign="top" width="45%" colspan="2">a. <?= $data->kendaraan ?> <br>
        b. Angkutan Darat </td>
    </tr>
    <tr>
        <td valign="top" width="55%">6. a. Tempat Berangkat <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;b. Tempat Tujuan 
        </td>
        <td valign="top" width="45%" colspan="2">a. Gorontalo <br>
        b. 
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
        </td>
    </tr>
    <tr>
        <td valign="top" width="55%">7. a. Lamanya Perjalanan Dinas <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;b. Tanggal Berangkat <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;c. Tanggal harus kembali / tiba di tempat baru
        </td>
        <td valign="top" width="45%" colspan="2">a. <?= $data->lamanya ?> 
        <?php 
        if ($data->lamanya == '1') {
            echo "(Satu)";
        } elseif ($data->lamanya == '2') {
            echo "(Dua)";
        } elseif ($data->lamanya == '3') {
            echo "(Tiga)";
        } elseif ($data->lamanya == '4') {
            echo "(Empat)";
        } elseif ($data->lamanya == '5') {
            echo "(Lima)";
        } elseif ($data->lamanya == '6') {
            echo "(Enam)";
        } elseif ($data->lamanya == '7') {
            echo "(Tujuh)";
        } elseif ($data->lamanya == '8') {
            echo "(Delapan)";
        } elseif ($data->lamanya == '9') {
            echo "(Sembilan)";
        } elseif ($data->lamanya == '10') {
            echo "(Sepuluh)";
        } elseif ($data->lamanya == '11') {
            echo "(Sebelas)";
        } elseif ($data->lamanya == '12') {
            echo "(Dua Belas)";
        } elseif ($data->lamanya == '13') {
            echo "(Tiga Belas)";
        } elseif ($data->lamanya == '14') {
            echo "(Empat Belas)";
        } elseif ($data->lamanya == '15') {
            echo "(Lima Belas)";
        } else {
            echo " ";
        }
        ?> hari
        <br>
        b. <?= tgl_ind($data->tgl_berangkat) ?> <br>
        c. <?= tgl_ind($data->tgl_selesai) ?>
        </td>
    </tr>
    <tr>
        <td valign="top" width="55%">8. Pengikut &nbsp;&nbsp;&nbsp;: Nama <br>
        &nbsp;&nbsp;&nbsp;&nbsp;1. <br> &nbsp;&nbsp;&nbsp;&nbsp;2. <br> &nbsp;&nbsp;&nbsp;&nbsp;3. <br> &nbsp;&nbsp;&nbsp;&nbsp;4. <br> &nbsp;&nbsp;&nbsp;&nbsp;5. </td>
        <td valign="top" width="25%">Tanggal Lahir</td>
        <td valign="top" width="20%">Keterangan</td>
    </tr>
    <tr>
        <td valign="top" width="55%">9. Pembebanan Anggaran <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;a. Instansi <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;b. Akun
        </td>
        <td valign="top" width="45%" colspan="2"> <br>
        a. Kantor Pelayanan Pajak Pratama Gorontalo  <br>
        b. M.A.K. 524111
        </td>
    </tr>
    <tr>
        <td valign="top" width="55%">10. Keterangan lain-lain</td>
        <td valign="top" width="45%" colspan="2">Sesuai <?= $awal ?><?= sprintf('%04d', $data->no_st); ?><?= $akhir ?> tanggal <?= tgl_ind($data->tgl_st) ?></td>
    </tr>
</table><br>
<table border="0" cellpadding="5" width="100%" align="center" style="border-collapse: collapse; font-size: 9pt;">
    <tr>
        <td valign="top" width="55%">&nbsp;</td>
        <td valign="top" width="45%">Dikeluarkan di&nbsp;&nbsp;: Gorontalo <br>
        Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= tgl_ind($data->tgl_spd) ?> <br>
        Pejabat Pembuat Komitmen <br><br><br><br>
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