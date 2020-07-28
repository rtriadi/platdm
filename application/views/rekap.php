<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Rekap SPD <?= $this->fungsi->user_login()->kantor; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Rekap SPD</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rekap SPD <?= $this->fungsi->user_login()->kantor; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <form action="<?= site_url('rekap/rekapSPD') ?>" method="POST">
                                            <?php 
                                            if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
                                                $sort = '1';
                                            } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
                                                $sort = '2';
                                            } elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
                                                $sort = '3';
                                            } else {
                                                $sort = '0';
                                            }
                                            ?>
                                            <input type='hidden' name='sort' value='<?= $sort ?>'>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>TAHUN</label>
                                                    <select name="tahun" class="form-control" required>
                                                        <option value="">- Pilih Tahun -</option>
                                                        <?php
                                                        for($i=date('Y'); $i>=date('Y')-2; $i-=1){
                                                        echo "<option value='$i'> $i </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>BULAN</label>
                                                    <select name="bulan" class="form-control" required>
                                                        <option value="">- Pilih Bulan -</option>
                                                        <option value="1">Januari</option>
                                                        <option value="2">Februari</option>
                                                        <option value="3">Maret</option>
                                                        <option value="4">April</option>
                                                        <option value="5">Mei</option>
                                                        <option value="6">Juni</option>
                                                        <option value="7">Juli</option>
                                                        <option value="8">Agustus</option>
                                                        <option value="9">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                        <option value="13">Semua Bulan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>PEGAWAI</label>
                                                    <select name="nip_pegawai" class="form-control select2" required>
                                                        <option value="">- Pilih Pegawai -</option>
                                                        <option value="13">Semua Pegawai</option>
                                                        <?php foreach ($peg->result() as $key => $data) : ?>
                                                            <option value="<?= $data->nip ?>"><?= $data->nama ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>JENIS</label>
                                                    <select name="jenis" class="form-control" required>
                                                        <option value="">- Pilih Jenis -</option>
                                                        <option value="1">Pembuatan SPD</option>
                                                        <option value="2">Pembayaran SPD</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>DIPA <sup class="text-secondary">*</sup></label>
                                                    <select name="dipa" class="form-control" required>
                                                        <option value="13">Tanpa DIPA</option>
                                                        <option value="501">501</option>
                                                        <option value="994">994</option>
                                                    </select>
                                                    <small><sup class="text-secondary">*</sup>Utk Jenis Pembayaran SPD</small>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>CARI</label><br>
                                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->