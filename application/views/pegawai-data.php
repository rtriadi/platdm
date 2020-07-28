<!-- Content Header (Page header) -->
<div class="content-wrapper">
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Pegawai <?= $this->fungsi->user_login()->kantor; ?></h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">Pegawai</li>
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
                	<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                			aria-hidden="true">×</span> </button>
                </div>
                <?php endif; ?>
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Pegawai <?= $this->fungsi->user_login()->kantor; ?></h3>
					<a href="<?= site_url('pegawai/add') ?>" class="btn btn-sm btn-info" style="float: right; margin-left: 2px"><i
							class="fas fa-plus"></i> Tambah </a>
                    <a class="btn btn-sm btn-success" style="float: right;" data-toggle="modal" data-target="#pegawai"><i
							class="fas fa-upload"></i>Import</a>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Aksi</th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Jabatan</th>
								<th>Pangkat/Golongan</th>
								<th>Kantor</th>
								<th>Role</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($row->result() as $key => $data) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><a href="<?= site_url('pegawai/edit/') ?><?= $data->id_pegawai ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i> Edit </a>
									<a href="<?= site_url('pegawai/delete/') ?><?= $data->nip ?>" class="btn btn-xs btn-danger" onclick="return confirm('Yakin hapus data ini?');" ><i class="fas fa-trash"></i> Delete </a>
								</td>
								<td><?= $data->nama ?></td>
								<td><?= $data->nip ?></td>
								<td><?= $data->jabatan ?></td>
								<td><?= $data->pangkat_gol ?></td>
								<td><?= $data->kantor ?></td>
								<td>
                                <?php if($data->level=='1') {
                                    echo "Superadmin";
                                } elseif ($data->level=='2') {
                                    echo "Admin";
                                } else {
                                    echo "Pegawai";
                                } ?>
                                </td>
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

<div class="modal fade" id="pegawai">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Pegawai</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form1" method="POST" action="<?= site_url(); ?>pegawai/import_pegawai" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import Pegawai <a href="<?= base_url() ?>uploads/import/format_import_pegawai.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form1" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
</div>
