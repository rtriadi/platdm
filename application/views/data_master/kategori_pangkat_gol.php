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
						<li class="breadcrumb-item active">Kategori Pangkat Golongan</li>
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
							<h3 class="card-title">Kategori Pangkat Golongan</h3>
							<div style="float: right">
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
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($row->result() as $key => $data) : ?>
										<tr>
											<td width="5%"><?= $no++ ?></td>
											<td><?= $data->nama ?></td>
											<td width="20%" align="center">
												<button class="btn btn-sm bg-lightblue" data-toggle="modal" data-target="#update<?= $data->id ?>"><i class="fa fa-pen"></i> Edit</button>
												<a href="<?= site_url('controller_datamaster/delete_kategori_pangkat_gol') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
											</td>
										</tr>
										<div class="modal fade" id="update<?= $data->id ?>">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-body">
														<form action="<?= site_url('controller_datamaster/update_kategori_pangkat_gol') ?>" method="POST">
															<div class="form-group">
																<label>Nama Kategori</label>
																<input type="hidden" name="id" class="form-control" value="<?= $data->id ?>" required>
																<input type="text" name="nama" class="form-control" value="<?= $data->nama ?>" required>
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
<div class="modal fade" id="add">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<form action="<?= site_url('controller_datamaster/add_kategori_pangkat_gol') ?>" method="POST">
					<div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<button class="btn btn-sm bg-teal" name="tambah">Tambah</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
