<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Akun</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Akun</li>
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
							<h3 class="card-title">Update Akun-KU</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" action="" method="POST">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Nip</label>
											<input type="hidden" name="id_pegawai" value="<?= $row->id_pegawai ?>">
											<input type="text" class="form-control <?= form_error('nip') ? "is-invalid" : null ?>" name="nip" value="<?= $this->input->post('nip') ?? $row->nip ?>" readonly>
											<?= form_error('nip') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Password</label> <small>(Biarkan kosong jika tidak diganti)</small>
											<input type="password" class="form-control <?= form_error('password') ? "is-invalid" : null ?>" name="password" value="<?= $this->input->post('password') ?>">
											<?= form_error('password') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Password Confirmation</label>
											<input type="password" class="form-control <?= form_error('passconf') ? "is-invalid" : null ?>" name="passconf" value="<?= $this->input->post('passconf') ?>">
											<?= form_error('passconf') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Nama</label>
											<input type="text" class="form-control <?= form_error('nama') ? "is-invalid" : null ?>" name="nama" value="<?= $this->input->post('nama') ?? $row->nama ?>" readonly>
											<?= form_error('nama') ?>
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<div style="float: right">
									<button type="submit" class="btn btn-success" onclick="return confirm('Update Akun ?');">Update Akun</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
