<!-- Content Header (Page header) -->
<?php error_reporting(0); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">SPD Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">SPD</a></li>
                        <li class="breadcrumb-item active">SPD Admin</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Export Excel SPD Admin <?= $this->fungsi->user_login()->kantor; ?></h3>
                        <div style="float: right">
                            <a href="<?= site_url('spd_admin') ?>" class="btn btn-sm btn-success">
                                <i class="fa fa-user-undo"></i> Back
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example23" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>NIP</th>
                                    <th>PANGKAT</th>
                                    <th>JABATAN</th>
                                    <th>TKT P.DNS</th>
                                    <th>NOMOR SPD</th>
                                    <th>TANGGAL SPPD</th>
                                    <th>MAKSUD</th>
                                    <th>KENDARAAN</th>
                                    <th>TEMPAT</th>
                                    <th>TANGGAL BERANGKAT</th>
                                    <th>TUJUAN</th>
                                    <th>TANGGAL SELESAI</th>
                                    <th>LAMANYA</th>
                                    <th>KET. LAMANYA</th>
                                    <th>NOMOR SURAT TUGAS</th>
                                    <th>Tanggal ST</th>
                                    <th>UANG HARIAN</th>
                                    <th>UH 2</th>
                                    <th>TOTAL UH</th>
                                    <th>PENYESUAIAN UH</th>
                                    <th>UH SETELAH PENYESUAIAN</th>
                                    <th>BY. TRANSPORT</th>
                                    <th>TARIF PENGINAPAN / MALAM</th>
                                    <th>DURASI MENGINAP</th>
                                    <th>KET. DURASI</th>
                                    <th>MENGINAP DARI</th>
                                    <th>MENGINAP SAMPAI</th>
                                    <th>BY. PENGINAPAN LAINNYA</th>
                                    <th>TOTAL BY. PENGINAPAN</th>
                                    <th>PENGELUARAN RIIL</th>
                                    <th>GRAND TOTAL</th>
                                    <th>UANG MUKA</th>
                                    <th>KARTU KREDIT</th>
                                    <th>TOTAL BYR</th>
                                    <th>KURANG/LEBIH BYR</th>
                                    <th>Status PPK</th>
                                    <th>Status Bayar</th>
                                    <th>KET. DIPA</th>
                                    <th>BULAN SPD</th>
                                    <th>BULAN BAYAR</th>
                                    <th>KANTOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) : ?>
                                    <?php $this->load->model('model_setting');
                                    $query_format = $this->model_setting->getSetting($data->sort, '1');
                                    foreach ($query_format->result() as $keysss) { 
                                        $awal  = $keysss->format_awal;
                                        $akhir = $keysss->format_akhir;
                                    } ?>

                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data->nama ?></td>
                                        <td>NIP <?= $data->nip ?></td>
                                        <td><?= $data->pangkat_gol ?></td>
                                        <td><?= $data->jabatan ?></td>
                                        <td>C</td>
                                        <td><?= $data->no_spd ?></td>
                                        <td><?= tgl_ind($data->tgl_spd) ?></td>
                                        <td><?= $data->maksud ?></td>
                                        <td><?= $data->kendaraan ?></td>
                                        <td>Gorontalo</td>
                                        <td><?= tgl_ind($data->tgl_berangkat) ?></td>
                                        
                                        <td><?php 
                                        echo $data->tujuan1;
                                        if($data->tujuan2 != '') echo ", ";
                                        echo $data->tujuan2;
                                        if($data->tujuan3 != '') echo ", ";
                                        echo $data->tujuan3;
                                        if($data->tujuan4 != '') echo ", ";
                                        echo $data->tujuan4;
                                        
                                        ?></td>
                                        <td><?= tgl_ind($data->tgl_selesai) ?></td>
                                        <td><?= $data->lamanya ?></td>
                                        <td><?php
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
                                        </td>
                                        <td><?= $awal ?><?= sprintf('%04d', $data->no_st); ?><?//= $akhir ?></td>
                                        <td><?= tgl_ind($data->tgl_st) ?></td>
                                        <td><?= $data->uang_harian ?></td>
                                        <td><?= $data->uang_harian2 ?></td>
                                        <td><?= $data->total_uh ?></td>
                                        <td><?php 
                                        $diskon = ($data->total_uh*$data->penyesuaian_uh/100);
                                        echo $diskon
                                        ?></td>
                                        <td><?= $data->grand_total_uh ?></td>
                                        <td><?= ($data->total_by_transportasi != NULL) ? $data->total_by_transportasi : '0'; ?></td>
                                        <td><?= ($data->tarif_penginapan != NULL) ? $data->tarif_penginapan : '0'; ?></td>
                                        <td><?= ($data->durasi_menginap)+($data->durasi_menginap2)+($data->durasi_menginap3) ?></td>
                                        <td><?php $durasi = ($data->durasi_menginap)+($data->durasi_menginap2)+($data->durasi_menginap3);
                                            if ($durasi == '1') {
                                                echo "(Satu)";
                                            } elseif ($durasi == '2') {
                                                echo "(Dua)";
                                            } elseif ($durasi == '3') {
                                                echo "(Tiga)";
                                            } elseif ($durasi == '4') {
                                                echo "(Empat)";
                                            } elseif ($durasi == '5') {
                                                echo "(Lima)";
                                            } elseif ($durasi == '6') {
                                                echo "(Enam)";
                                            } elseif ($durasi == '7') {
                                                echo "(Tujuh)";
                                            } elseif ($durasi == '8') {
                                                echo "(Delapan)";
                                            } elseif ($durasi == '9') {
                                                echo "(Sembilan)";
                                            } elseif ($durasi == '10') {
                                                echo "(Sepuluh)";
                                            } elseif ($durasi == '11') {
                                                echo "(Sebelas)";
                                            } elseif ($durasi == '12') {
                                                echo "(Dua Belas)";
                                            } elseif ($durasi == '13') {
                                                echo "(Tiga Belas)";
                                            } elseif ($durasi == '14') {
                                                echo "(Empat Belas)";
                                            } elseif ($durasi == '15') {
                                                echo "(Lima Belas)";
                                            } else {
                                                echo " ";
                                            }
                                            ?> <?= $data->durasi_menginap != NULL ? 'malam' : '' ?>
                                        </td>
                                        <td><?= $data->menginap_dari != NULL ? tgl_ind($data->menginap_dari) : '' ?></td>
                                        <td><?= $data->menginap_sampai != NULL ? tgl_ind($data->menginap_sampai) : '' ?></td>
                                        <td><?= ($data->tarif_penginapan2)+($data->tarif_penginapan3) ?></td>
                                        <td><?= $data->total_by_penginapan ?></td>
                                        <td><?= ($data->pengeluaran_riil != NULL) ? $data->pengeluaran_riil : '0'; ?></td>
                                        <td><?= $data->grand_total ?></td>
                                        <td><?= ($data->uang_muka != NULL) ? $data->uang_muka : '0'; ?></td>
                                        <td><?= ($data->kredit != NULL) ? $data->kredit : '0'; ?></td>
                                        <td><?= $data->total_bayar ?></td>
                                        <td>-</td>
                                        <td><?php 
											if ($data->status == '0') {
												echo '';
											} elseif ($data->status == '1') { 
												echo 'BERKAS DITERIMA';
											} elseif ($data->status == '2') { 
												echo 'OK';
											} elseif ($data->status == '3') { 
												echo 'APPROVED';
											} elseif ($data->status == '4') { 
												echo 'TELAH BAYAR';
											} elseif ($data->status == '5') { 
												echo 'SPD DIBATALKAN';
											}
										    ?>	
                                        </td>
                                        <td><?= $data->status == 4 ? $data->ls.'<br> '.indo_date($data->tgl_bayar) : 'Belum Bayar' ?></td>
                                        <td><?= $data->dipa ?></td>
                                        <td><?= strtoupper(bulan_ind($data->tgl_spd)) ?></td>
                                        <td><?= $data->status == 4 ? strtoupper(bulan_ind($data->tgl_bayar)) : '' ?></td>
                                        <td><?= $data->sort ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <!-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> -->
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>