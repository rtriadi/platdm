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
					<li class="breadcrumb-item"><a href="#">Pegawai</a></li>
					<li class="breadcrumb-item active">Tambah</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<!-- DataTales Example -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">
							<?= ucfirst($page) ?> Pegawai <?= $this->fungsi->user_login()->kantor; ?></h3>
						<div style="float: right">
							<a href="<?= site_url('pegawai') ?>" class="btn btn-sm btn-success">
								<i class="fa fa-user-undo"></i> Back
							</a>
						</div>
					</div>
					<div class="card-body">
						<form action="<?= site_url('pegawai/process') ?>" method="POST">
							<div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>NIP <sup class="text-danger">*</sup></label>
                                        <input type="hidden" name="id_pegawai" value="<?= $row->id_pegawai ?>">
                                        <input type="text" name="nip" value="<?= $row->nip ?>" class="form-control" placeholder="Masukkan NIP" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Pegawai <sup class="text-danger">*</sup></label>
                                        <input type="text" name="nama" value="<?= $row->nama ?>" class="form-control" placeholder="Masukkan Nama Pegawai" required>
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Pangkat / Golongan <sup class="text-danger">*</sup></label>
                                        <input type="text" name="pangkat_gol" value="<?= $row->pangkat_gol ?>" class="form-control" placeholder="Masukkan Pangkat/Golongan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Jabatan <sup class="text-danger">*</sup></label>
                                        <input type="text" name="jabatan" value="<?= $row->jabatan ?>" class="form-control" placeholder="Masukkan Nama Jabatan" required>
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kantor <sup class="text-danger">*</sup></label>
                                        <select name="kantor" class="form-control" required>
                                            <option value="">- Pilih Kantor -</option>
                                            <option value="KPP Pratama Gorontalo" <?= "KPP Pratama Gorontalo" == $row->kantor ? "selected" : null?>>KPP Pratama Gorontalo</option>
                                            <option value="KP2KP Limboto" <?= "KP2KP Limboto" == $row->kantor ? "selected" : null?>>KP2KP Limboto</option>
                                            <option value="KP2KP Tilamuta" <?= "KP2KP Tilamuta" == $row->kantor ? "selected" : null?>>KP2KP Tilamuta</option>
                                            <option value="KP2KP Marissa" <?= "KP2KP Marissa" == $row->kantor ? "selected" : null?>>KP2KP Marissa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Role <sup class="text-danger">*</sup></label>
                                        <select name="level" class="form-control" required>
                                            <option value="">- Pilih Role -</option>
                                            <!-- <option value="1" <?//= "1" == $row->level ? "selected" : null?>>Superadmin</option>
                                            <option value="2" <?//= "2" == $row->level ? "selected" : null?>>Admin SPD</option>
                                            <option value="3" <?//= "3" == $row->level ? "selected" : null?>>Admin Keuangan</option> -->
                                            <option value="4" <?= "4" == $row->level ? "selected" : null?>>Pegawai</option>
                                        </select>
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Password <sup class="text-danger">*</sup></label>
                                        <input type="password" name="password" class="form-control">
                                        <!-- <small>*Biarkan kosong jika tidak diganti.</small>  -->
                                    </div>
                                </div>
							</div>
							<div class="form-group">
								<button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
									<i class="fa fa-paper-plane"></i> Simpan</button>
								<button type="reset" class="btn btn-flat btn-secondary">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
