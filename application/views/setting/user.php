<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Setting</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="#!">Setting</a></li>
						<li class="breadcrumb-item active">User</li>
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
							<h3 class="card-title">User</h3>
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
										<th>Username</th>
										<th>Nama</th>
										<th>Kantor</th>
										<th>Level</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($row->result() as $key => $data) : ?>
										<tr>
											<td width="5%"><?= $no++ ?></td>
											<td><?= $data->nip ?></td>
											<td><?= $data->nama ?></td>
											<td><?= $data->kantor ?></td>
											<td>
												<?php if ($data->level == '1') {
													echo "<small class='badge badge-dark'>Superadmin</small>";
												} elseif ($data->level == '2') {
													echo "<small class='badge badge-dark'>Admin SPD</small>";
												} elseif ($data->level == '3') {
													echo "<small class='badge badge-dark'>Admin Keuangan</small>";
												} ?>
											</td>
											<td width="20%" align="center">
												<button class="btn btn-sm bg-lightblue" data-toggle="modal" data-target="#update<?= $data->id_pegawai ?>"><i class="fa fa-pen"></i> Edit</button>
												<a href="<?= site_url('controller_setting/delete_user') ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
											</td>
										</tr>
										<div class="modal fade" id="update<?= $data->id_pegawai ?>">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-body">
														<form action="<?= site_url('controller_setting/update_user') ?>" method="POST">
															<div class="form-group">
																<label>Nama <sup class="text-danger">*</sup></label>
																<input type="text" name="nama" class="form-control" value="<?= $data->nama ?>" required>
															</div>
															<div class="form-group">
																<label>Kantor <sup class="text-danger">*</sup></label>
																<select name="kantor" class="form-control" required>
																	<option value="">- Pilih Kantor -</option>
																	<option value="KPP Pratama Gorontalo" <?= $data->kantor == 'KPP Pratama Gorontalo' ? 'selected' : '' ?>>KPP Pratama Gorontalo</option>
																	<option value="KP2KP Limboto" <?= $data->kantor == 'KP2KP Limboto' ? 'selected' : '' ?>>KP2KP Limboto</option>
																	<option value="KP2KP Tilamuta" <?= $data->kantor == 'KP2KP Tilamuta' ? 'selected' : '' ?>>KP2KP Tilamuta</option>
																	<option value="KP2KP Marissa" <?= $data->kantor == 'KP2KP Marissa' ? 'selected' : '' ?>>KP2KP Marissa</option>
																</select>
															</div>
															<div class="form-group">
																<label>Username <sup class="text-danger">*</sup></label>
																<input type="text" name="username" class="form-control" value="<?= $data->nip ?>" required>
															</div>
															<div class="form-group">
																<label>Password <sup class="text-danger">*</sup></label>
																<input type="text" name="password" class="form-control" required>
															</div>
															<div class="form-group">
																<label>Role <sup class="text-danger">*</sup></label>
																<select name="level" class="form-control" required>
																	<option value="">- Pilih Role -</option>
																	<option value="1" <?= $data->level == '1' ? 'selected' : '' ?>>Superadmin</option>
																	<option value="2" <?= $data->level == '2' ? 'selected' : '' ?>>Admin SPD</option>
																	<option value="3" <?= $data->level == '3' ? 'selected' : '' ?>>Admin Keuangan</option>
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
<div class="modal fade" id="add">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<form action="<?= site_url('controller_setting/add_user') ?>" method="POST">
					<div class="form-group">
						<label>Nama <sup class="text-danger">*</sup></label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Kantor <sup class="text-danger">*</sup></label>
						<select name="kantor" class="form-control" required>
							<option value="">- Pilih Kantor -</option>
							<option value="KPP Pratama Gorontalo">KPP Pratama Gorontalo</option>
							<option value="KP2KP Limboto">KP2KP Limboto</option>
							<option value="KP2KP Tilamuta">KP2KP Tilamuta</option>
							<option value="KP2KP Marissa">KP2KP Marissa</option>
						</select>
					</div>
					<div class="form-group">
						<label>Username <sup class="text-danger">*</sup></label>
						<input type="text" name="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password <sup class="text-danger">*</sup></label>
						<input type="text" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Role <sup class="text-danger">*</sup></label>
						<select name="level" class="form-control" required>
							<option value="">- Pilih Role -</option>
							<option value="1">Superadmin</option>
							<option value="2">Admin SPD</option>
							<option value="3">Admin Keuangan</option>
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
