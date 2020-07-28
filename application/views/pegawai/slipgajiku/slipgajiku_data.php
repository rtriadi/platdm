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
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
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
							<h3 class="card-title">Slip Gaji-KU</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<form action="" method="get">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Pilih Bulan</label>
											<select id="bln" class="form-control" name="bln" required>
												<option value="Januari">Januari</option>
												<option value="Februari">Februari</option>
												<option value="Maret">Maret</option>
												<option value="April">April</option>
												<option value="Mei">Mei</option>
												<option value="Juni">Juni</option>
												<option value="Juli">Juli</option>
												<option value="Agustus">Agustus</option>
												<option value="September">September</option>
												<option value="Oktober">Oktober</option>
												<option value="November">November</option>
												<option value="Desember">Desember</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Input Tahun</label>
											<input type="hidden" id="nip" class="form-control" name="nip" value="<?= $this->fungsi->user_login()->level == '4' ? $this->fungsi->user_login()->nip : $this->uri->segment(2) ?>" required>
											<div class="input-group mb-3">
												<select id="thn" name="thn" class="form-control" required>
													<?php
													for ($i = date('Y'); $i >= date('Y') - 2; $i -= 1) {
														echo "<option value='$i'> $i </option>";
													}
													?>
												</select>
												<!-- <input type="text" id="thn" class="form-control rounded-0" name="thn" maxlength="4" required> -->
												<span class="input-group-append">
													<button id="search" type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
												</span>
												<span class="input-group-append">
													<a id="print" type="button" class="btn btn-default btn-flat" target="_BLANK"><i class="fa fa-file-pdf"></i></a>
												</span>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
					<div id="container">

					</div>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->