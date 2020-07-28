<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Pagu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Pagu</li>
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
							<h3 class="card-title">Data Pagu</h3>
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
										<th>Dipa Pagu</th>
										<th>Pagu</th>
										<th>Kantor</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($row->result() as $key => $data) : ?>
										<tr>
											<td width="5%"><?= $no++ ?></td>
											<td><?= $data->dipa_pagu ?></td>
											<td><?= indo_currency($data->pagu) ?></td>
											<td><?= $data->kodekantor == 1 ? 'KP2KP Limboto' : ($data->kodekantor == 2 ? 'KP2KP Tilamuta' : ($data->kodekantor == 3 ? 'KP2KP Marissa' : 'KPP Pratama Gorontalo')) ?></td>
											<td width="20%" align="center">
												<button class="btn btn-sm bg-lightblue" data-toggle="modal" data-target="#update<?= $data->id_pagu ?>"><i class="fa fa-pen"></i> Edit</button>
												<a href="<?= site_url('pagu/delete/' . $data->id_pagu) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
											</td>
										</tr>
										<div class="modal fade" id="update<?= $data->id_pagu ?>">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-body">
														<form action="<?= site_url('pagu/update') ?>" method="POST">
															<div class="form-group">
																<label>Dipa Pagu</label>
																<input type="hidden" name="id_pagu" class="form-control" value="<?= $data->id_pagu ?>" required>
																<input type="text" name="dipa_pagu" class="form-control" value="<?= $data->dipa_pagu ?>" required>
															</div>
															<div class="form-group">
																<label>Pagu</label>
																<input type="text" name="pagu" class="form-control" value="<?= $data->pagu ?>" required>
															</div>
															<div class="form-group">
																<label>Kode Kantor</label>
																<select class="form-control" name="kodekantor" required>
																    <option value="">-- Pilih Kantor --</option>
																    <option value="0" <?= $data->kodekantor == 0 ? 'selected' : '' ?>>KPP Pratama Gorontalo</option>
																    <option value="1" <?= $data->kodekantor == 1 ? 'selected' : '' ?>>KP2KP Limboto</option>
																    <option value="2" <?= $data->kodekantor == 2 ? 'selected' : '' ?>>KP2KP Tilamuta</option>
																    <option value="3" <?= $data->kodekantor == 3 ? 'selected' : '' ?>>KP2KP Marissa</option>
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
				<form action="<?= site_url('pagu/add') ?>" method="POST">
					<div class="form-group">
						<label>Dipa Pagu</label>
						<input type="text" name="dipa_pagu" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Pagu</label>
						<input type="text" name="pagu" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Kode Kantor</label>
						<select class="form-control" name="kodekantor" required>
						    <option value="">-- Pilih Kantor --</option>
						    <option value="0">KPP Pratama Gorontalo</option>
						    <option value="1">KP2KP Limboto</option>
						    <option value="2">KP2KP Tilamuta</option>
						    <option value="3">KP2KP Marissa</option>
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
