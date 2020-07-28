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
                <?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success">
						<?= $this->session->flashdata('success'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span>
						</button>
					</div>
				<?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?= $page ?> <?= $this->fungsi->user_login()->kantor; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width='1%'>No</th>
                                    <th>Format Awal</th>
                                    <th>Format Akhir</th>
                                    <th>Tipe</th>
                                    <th>Kantor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data->format_awal ?></td>
                                        <td><?= $data->format_akhir ?></td>
                                        <td><?php
												if ($data->tipe == '0') {
													echo 'Nomor SPD';
												} elseif ($data->tipe == '1') {
													echo 'Nomor ST';
												}
                                            ?>
                                        </td>
                                        <td><?php
												if ($data->kantor == '1') {
													echo 'KP2KP Limboto';
												} elseif ($data->kantor == '2') {
													echo 'KP2KP Tilamuta';
												} elseif ($data->kantor == '3') {
													echo 'KP2KP Marissa';
												} else {
													echo 'KPP Pratama Gorontalo';
												}
                                            ?>
                                        </td>
                                        <td><span data-toggle="modal" data-target="#edit<?= $data->id_setting ?>">
												<button type="button" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom" title="Edit Format"><i class="fas fa-edit"></i> Edit</button>
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
									<div class="modal fade" id="edit<?= $data->id_setting ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Edit Format Nomor</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form action="<?= site_url('controller_setting/process') ?>" method="POST">
													<div class="modal-body">
														<input type="hidden" name="id_setting" value="<?= $data->id_setting ?>">
														<label>Format Awal <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="format_awal" class="form-control" value="<?= $data->format_awal ?>" required><br>
                                                        <label>Format Akhir <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="format_akhir" class="form-control" value="<?= $data->format_akhir ?>" required><br>
                                                        <label>Tipe Nomor</label>
                                                        <input type="text" class="form-control" value="<?php
                                                            if ($data->tipe == '0') {
                                                                echo 'Nomor SPD';
                                                            } elseif ($data->tipe == '1') {
                                                                echo 'Nomor ST';
                                                            }
                                                        ?>" readonly><br>
                                                        <label>Kantor</label>
                                                        <input type="text" class="form-control" value="<?php
                                                            if ($data->kantor == '1') {
                                                                echo 'KP2KP Limboto';
                                                            } elseif ($data->kantor == '2') {
                                                                echo 'KP2KP Tilamuta';
                                                            } elseif ($data->kantor == '3') {
                                                                echo 'KP2KP Marissa';
                                                            } else {
                                                                echo 'KPP Pratama Gorontalo';
                                                            }
                                                        ?>" readonly>
													</div>
													<div class="modal-footer">
														<button type="reset" class="btn btn-sm btn-secondary">Reset</button>
														<button type="submit" name="Edit" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Simpan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
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