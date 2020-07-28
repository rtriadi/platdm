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
						<li class="breadcrumb-item active">Setting</li>
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
							<h3 class="card-title">Setting</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Nama Pegawai</th>
										<th>Jabatan</th>
										<th width="10%">PPK</th>
										<th width="10%">Bendahara</th>
										<th width="10%">Kepala Kantor</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($row->result() as $key => $data) : ?>
										<tr>
											<td><?= $data->nama ?></td>
											<td><?= $data->jabatan ?></td>
											<td class="text-center">
												<div class="icheck-primary d-inline">
													<?php if ($data->ppk == '0') {
													?>
														<input type="checkbox" name="toggle1" id="toggle1_<?php echo $data->id_pegawai; ?>" value="<?php echo $data->id_pegawai; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
														<label for="toggle1_<?php echo $data->id_pegawai; ?>"></label>
													<?php
													} ?>
													<?php if ($data->ppk == '1') {
													?>
														<input type="checkbox" name="toggle1" id="toggle1_<?php echo $data->id_pegawai; ?>" value="<?php echo $data->id_pegawai; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
														<label for="toggle1_<?php echo $data->id_pegawai; ?>"></label>
													<?php
													} ?>
												</div>
											</td>
											<td class="text-center">
												<div class="icheck-primary d-inline">
													<?php if ($data->bendahara == '0') {
													?>
														<input type="checkbox" name="toggle2" id="toggle2_<?php echo $data->id_pegawai; ?>" value="<?php echo $data->id_pegawai; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
														<label for="toggle2_<?php echo $data->id_pegawai; ?>"></label>
													<?php
													} ?>
													<?php if ($data->bendahara == '1') {
													?>
														<input type="checkbox" name="toggle2" id="toggle2_<?php echo $data->id_pegawai; ?>" value="<?php echo $data->id_pegawai; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
														<label for="toggle2_<?php echo $data->id_pegawai; ?>"></label>
													<?php
													} ?>
												</div>
											</td>
											<td class="text-center">
												<div class="icheck-primary d-inline">
													<?php if ($data->kepala_kantor == '0') {
													?>
														<input type="checkbox" name="toggle3" id="toggle3_<?php echo $data->id_pegawai; ?>" value="<?php echo $data->id_pegawai; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
														<label for="toggle3_<?php echo $data->id_pegawai; ?>"></label>
													<?php
													} ?>
													<?php if ($data->kepala_kantor == '1') {
													?>
														<input type="checkbox" name="toggle3" id="toggle3_<?php echo $data->id_pegawai; ?>" value="<?php echo $data->id_pegawai; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
														<label for="toggle3_<?php echo $data->id_pegawai; ?>"></label>
													<?php
													} ?>
												</div>
											</td>
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
