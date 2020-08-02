<!-- Content Header (Page header) -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $page ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Rekap</a></li>
                        <li class="breadcrumb-item active"><?= $page ?></li>
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
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><?= $page ?> <?= $this->fungsi->user_login()->kantor; ?></h3>
                        <div style="float: right">
                            <a href="<?= site_url('rekap') ?>" class="btn btn-sm bg-yellow">
                                <i class="fa fa-user-undo"></i> Back
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example23" class="table table-bordered table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th width='1%'>No</th>
                                    <th>Bulan</th>
                                    <th>Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($bulan->result() as $key => $data) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?php
                                            if ($data->bulan == 1) {
                                                echo "Januari";
                                            } elseif ($data->bulan == 2) {
                                                echo "Februari";
                                            } elseif ($data->bulan == 3) {
                                                echo "Maret";
                                            } elseif ($data->bulan == 4) {
                                                echo "April";
                                            } elseif ($data->bulan == 5) {
                                                echo "Mei";
                                            } elseif ($data->bulan == 6) {
                                                echo "Juni";
                                            } elseif ($data->bulan == 7) {
                                                echo "Juli";
                                            } elseif ($data->bulan == 8) {
                                                echo "Agustus";
                                            } elseif ($data->bulan == 9) {
                                                echo "September";
                                            } elseif ($data->bulan == 10) {
                                                echo "Oktober";
                                            } elseif ($data->bulan == 11) {
                                                echo "November";
                                            } elseif ($data->bulan == 12) {
                                                echo "Desember";
                                            }
                                            ?>
                                        </td>
                                        <td><?= number_format($data->total_bayar, 0, ',', ','); ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
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