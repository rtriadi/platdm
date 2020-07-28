<html>
<head>
	<title>Cetak Lampiran Admin</title>
</head>
<body onload="window.print()"> 
<?php foreach ($row->result() as $key => $data) : ?>
<div style="font-family: Arial, Helvetica, sans-serif;" class="page">
<table border="1" cellpadding="2" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
    <tr>
        <td valign="top" width="50%"></td>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">I. Berangkat dari <br> &nbsp;&nbsp;&nbsp;(Tempat Kedudukan)</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%">Gorontalo</td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Ke</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
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
                <tr style="border-bottom: 1pt solid black;">
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?= tgl_ind($data->tgl_berangkat) ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;Kepala Kantor <br><br><br><br>
                    &nbsp;&nbsp;&nbsp;<b><?php 
                    $kantor = $this->fungsi->user_login()->kantor;
                    $query = $this->db->query("SELECT nama, nip FROM pegawai WHERE kantor='$kantor' AND kepala_kantor='1'");
                    foreach ($query->result() as $keys) {
                        echo $keys->nama;
                        echo '<br>';
                        echo '&nbsp;&nbsp;&nbsp;NIP '; 
                        echo $keys->nip;
                    }
                    ?> 
                    </b></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">II. &nbsp;Tiba di</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    $query_tujuan1 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan1");
                    foreach ($query_tujuan1->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } ?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala</td>
                    <td valign="top" width="5%">&nbsp;</td>
                    <td valign="top" width="55%">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" colspan="3"> <br><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Berangkat dari</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    $query_tujuan1 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan1");
                    foreach ($query_tujuan1->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } ?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Ke</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;Kepala <br><br><br>
                    &nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">III. Tiba di</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    if($data->tujuan2 != '') {
                    $query_tujuan2 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan2");
                    foreach ($query_tujuan2->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } }?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala</td>
                    <td valign="top" width="5%">&nbsp;</td>
                    <td valign="top" width="55%">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" colspan="3"> <br><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Berangkat dari</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    if($data->tujuan2 != '') {
                    $query_tujuan2 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan2");
                    foreach ($query_tujuan2->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } }?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Ke</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;Kepala <br><br><br>
                    &nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">IV. Tiba di</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    if($data->tujuan3 != '') {
                    $query_tujuan3 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan3");
                    foreach ($query_tujuan3->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } }?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala</td>
                    <td valign="top" width="5%">&nbsp;</td>
                    <td valign="top" width="55%">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" colspan="3"> <br><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Berangkat dari</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    if($data->tujuan3 != '') {
                    $query_tujuan3 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan3");
                    foreach ($query_tujuan3->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } }?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Ke</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;Kepala <br><br><br>
                    &nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">V. &nbsp;Tiba di</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    if($data->tujuan4 != '') {
                    $query_tujuan4 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan4");
                    foreach ($query_tujuan4->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } }?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala</td>
                    <td valign="top" width="5%">&nbsp;</td>
                    <td valign="top" width="55%">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" colspan="3"> <br><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Berangkat dari</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?php 
                    if($data->tujuan4 != '') {
                    $query_tujuan4 = $this->db->query("SELECT name, city_type FROM city WHERE id=$data->tujuan4");
                    foreach ($query_tujuan4->result() as $t) { 
                        echo $t->city_type; echo ' '; echo $t->name;
                    } }?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Ke</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"></td>
                </tr>
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;Kepala <br><br><br>
                    &nbsp;&nbsp;&nbsp;(........................................) <br>
                    &nbsp;&nbsp;&nbsp;NIP. </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" width="40%">VI. Tiba di <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Tempat Kedudukan)</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%">Gorontalo</td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pada Tanggal</td>
                    <td valign="top" width="5%">:</td>
                    <td valign="top" width="55%"><?= tgl_ind($data->tgl_selesai) ?></td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;</td>
                    <td valign="top" width="5%">&nbsp;</td>
                    <td valign="top" width="55%">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pejabat Pembuat Komitmen<br><br><br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php 
                    $query = $this->db->query("SELECT nama FROM pegawai WHERE nip=$data->nip_ppk");
                    foreach ($query->result() as $keys) {
                        echo $keys->nama;
                    }
                    ?> <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. <?= $data->nip_ppk ?></b></td>
                </tr>
            </table>
        </td>
        <td valign="top" width="50%">
            <table border="0" cellpadding="1" width="100%" align="center" style="border-collapse: collapse; font-size: 8pt;">
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas <br>
                    &nbsp;&nbsp;&nbsp;perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu <br>
                    &nbsp;&nbsp;&nbsp;yang sesingkat-singkatnya.</td>
                </tr>
                <tr>
                    <td valign="top" width="40%">&nbsp;</td>
                    <td valign="top" width="5%">&nbsp;</td>
                    <td valign="top" width="55%">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" colspan="3">&nbsp;&nbsp;&nbsp;Pejabat Pembuat Komitmen<br><br><br><br>
                    &nbsp;&nbsp;&nbsp;<b><?php 
                    $query = $this->db->query("SELECT nama FROM pegawai WHERE nip=$data->nip_ppk");
                    foreach ($query->result() as $keys) {
                        echo $keys->nama;
                    }
                    ?> <br>
                    &nbsp;&nbsp;&nbsp;NIP. <?= $data->nip_ppk ?></b></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top">VII. CATATAN LAIN - LAIN : <br><br></td>
    </tr>
    <tr>
        <td colspan="2" valign="top">VIII. <b>PERHATIAN : </b> <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PPK yang menerbitkan SPD, pegawai yang melakukan perjalan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara apabila Negara menderita rugi akibat <br> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;kesalahan, kelalaian, dan kealpaannya.
        </td>
    </tr>
</table>
</div>
<?php endforeach ?>
</body>
</html>