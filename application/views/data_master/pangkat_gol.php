<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Data Master</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="#!">Data Master</a></li>
						<li class="breadcrumb-item active">Pangkat Golongan</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<?php $this->view('messages'); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Pangkat Golongan</h3>
							<div style="float: right">
								<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#import"><i class="fa fa-upload"></i> Import</button>
								<button class="btn btn-sm bg-teal" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nama</th>
										<th>Kategori Pangkat Golongan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($row->result() as $key => $data) : ?>
										<tr>
											<td width="5%"><?= $no++ ?></td>
											<td><?= $data->nama ?></td>
											<td><?= $data->kategori_pangkat_gol_nama ?></td>
											<td width="20%" align="center">
												<button class="btn btn-sm bg-lightblue" data-toggle="modal" data-target="#update<?= $data->id ?>"><i class="fa fa-pen"></i> Edit</button>
												<a href="<?= site_url('controller_datamaster/delete_pangkat_gol') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
											</td>
										</tr>
										<div class="modal fade" id="update<?= $data->id ?>">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-body">
														<form action="<?= site_url('controller_datamaster/update_pangkat_gol') ?>" method="POST">
															<div class="form-group">
																<label>Nama</label>
																<input type="hidden" name="id" class="form-control" value="<?= $data->id ?>" required>
																<input type="text" name="nama" class="form-control" value="<?= $data->nama ?>" required>
															</div>
															<div class="form-group">
																<label>Kategori</label>
																<select name="id_kategori_pangkat_gol" class="form-control">
																	<?php foreach ($kategori->result() as $key) : ?>
																		<option value="<?= $key->id ?>" <?= $key->id == $data->id_kategori_pangkat_gol ? 'selected' : '' ?>><?= $key->nama ?></option>
																	<?php endforeach ?>
																</select>
															</div>
															<button class="btn btn-sm bg-lightblue" name="edit">Edit</button>
														</form>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
									<?php endforeach ?>
								</tbody>
							</table>
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
<div class="modal fade" id="import">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<form action="<?= site_url('controller_datamaster/import_pangkat_gol') ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label>File Excel</label>
						<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
						<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/data_master/format_pangkat_gol.xlsx">disini</a>.</small>
					</div>
					<div align="center">
						<button class="btn btn-sm btn-default" name="import"><i class="fa fa-upload"></i> Import</button>
					</div>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="add">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<form action="<?= site_url('controller_datamaster/add_pangkat_gol') ?>" method="POST">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select name="id_kategori_pangkat_gol" class="form-control">
							<?php foreach ($kategori->result() as $key) : ?>
								<option value="<?= $key->id ?>"><?= $key->nama ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<button class="btn btn-sm bg-teal" name="tambah">Tambah</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
