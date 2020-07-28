<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Keuangan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url() ?>">Home</a></li>
						<li class="breadcrumb-item active">Keuangan</li>
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
							<h3 class="card-title">Data Pegawai</h3>
							<div class="input-group-prepend" style="float: right">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									Import
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" data-toggle="modal" data-target="#gaji">Import Gaji</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#uang_makan">Import Uang Makan</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#gaji13">Import Gaji 13</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#thr">Import Gaji THR</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#kekurangan_gaji">Import Kekurangan Gaji</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#uang_lembur">Import Uang Lembur</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#insentif">Import Insentif</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#honor">Import Honor</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#tukin_13">Import Tukin 13</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#tukin_thr">Import Tukin THR</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#potongan_tukin">Potongan Tukin</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#kekurangan_tukin">Kekurangan Tukin</a>
									<a class="dropdown-item" data-toggle="modal" data-target="#tukin_plt">Tukin Plt</a>
								</div>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No.</th>
										<th>Nip</th>
										<th>Nama</th>
										<th>Pangkat / Gol.</th>
										<th>Jabatan</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($row->result() as $key => $data) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $data->nip ?></td>
											<td><?= $data->nama ?></td>
											<td><?= $data->pangkat_gol ?></td>
											<td><?= $data->jabatan ?></td>
											<td><a href="<?= site_url('slipgajiku/'. $data->nip)?>" target="_BLANK"class="btn btn-sm btn-default"><i class="fa fa-eye"></i></a></td>
										</tr>
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
<div class="modal fade" id="gaji">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Gaji</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form1" method="POST" action="<?= site_url(); ?>controller_keuangan/import_gaji" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/gaji.xlsx">disini</a>.</small>
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
<div class="modal fade" id="uang_makan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Uang Makan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form2" method="POST" action="<?= site_url(); ?>controller_keuangan/import_uang_makan" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/uang_makan.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form2" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="gaji13">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Gaji 13</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form3" method="POST" action="<?= site_url(); ?>controller_keuangan/import_gaji13" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/gaji13.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form3" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="thr">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Gaji THR</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form4" method="POST" action="<?= site_url(); ?>controller_keuangan/import_thr" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/thr.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form4" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="kekurangan_gaji">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Kekurangan Gaji</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form5" method="POST" action="<?= site_url(); ?>controller_keuangan/import_kekurangan_gaji" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/kekurangan_gaji.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form5" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="uang_lembur">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Uang Lembur</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form6" method="POST" action="<?= site_url(); ?>controller_keuangan/import_uang_lembur" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/uang_lembur.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form6" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="insentif">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Insentif</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form7" method="POST" action="<?= site_url(); ?>controller_keuangan/import_insentif" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/insentif.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form7" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="honor">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Honor</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form8" method="POST" action="<?= site_url(); ?>controller_keuangan/import_honor" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/honor.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form8" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="tukin_13">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Tukin 13</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form9" method="POST" action="<?= site_url(); ?>controller_keuangan/import_tukin_13" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/tukin13.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form9" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="tukin_thr">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Tukin THR</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form10" method="POST" action="<?= site_url(); ?>controller_keuangan/import_tukin_thr" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/tukin_thr.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form10" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="potongan_tukin">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Potongan Tukin</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form11" method="POST" action="<?= site_url(); ?>controller_keuangan/import_potongan_tukin" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/potongan_tukin_new.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form11" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="kekurangan_tukin">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Kekurangan Tukin</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form12" method="POST" action="<?= site_url(); ?>controller_keuangan/import_kekurangan_tukin" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/kekurangan_tukin.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form12" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="tukin_plt">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import Tukin Plt</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form13" method="POST" action="<?= site_url(); ?>controller_keuangan/import_tukin_plt" enctype="multipart/form-data" novalidate>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required>
								<small>Download contoh Format Import <a href="<?= base_url() ?>uploads/format/tukin_plt.xlsx">disini</a>.</small>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" name="iimport" value="Import" form="form13" />
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
