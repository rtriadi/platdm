<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
            
			<?php if(($this->fungsi->user_login()->level == 1) OR ($this->fungsi->user_login()->level == 2)) { ?>
				<?php 
				if ($this->fungsi->user_login()->kantor == 'KP2KP Limboto') {
					$sort = '1';
				} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Tilamuta') {
					$sort = '2';
				} elseif ($this->fungsi->user_login()->kantor == 'KP2KP Marissa') {
					$sort = '3';
				} 
				?>
			<div class="row">
				<div class="col-lg-2">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?php 
							if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='5'");
							} else {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='5' AND sort=$sort");
							}
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>SPD Batal</p>
						</div>
						<a href="<?= site_url('spd_admin/spd_batal') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2">
					<div class="small-box bg-maroon">
						<div class="inner">
							<h3><?php 
							if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='0'");
							} else {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='0' AND sort=$sort");
							}
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>Belum Input Rincian</p>
						</div>
						<a href="<?= site_url('spd_admin/belum_input') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2">
					<div class="small-box bg-warning">
						<div class="inner">
							<h3><?php 
							if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='1'");
							} else {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='1' AND sort=$sort");
							}
							
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>Berkas Diterima</p>
						</div>
						<a href="<?= site_url('spd_admin/berkas_diterima') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2">
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php 
							if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='2'");
							} else {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='2' AND sort=$sort");
							}
							
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>Status OK</p>
						</div>
						<a href="<?= site_url('spd_admin/ok') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2">
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?php 
							if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='4'");
							} else {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE status='4' AND sort=$sort");
							}
							
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>Telah Bayar</p>
						</div>
						<a href="<?= site_url('spd_admin/telah_bayar') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-2">
					<div class="small-box bg-primary">
						<div class="inner">
							<h3><?php 
							if ($this->fungsi->user_login()->kantor == 'KPP Pratama Gorontalo') {
								$query = $this->db->query("SELECT count(id) as cid FROM spd");
							} else {
								$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE sort=$sort");
							}
							
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>Total Semua SPD</p>
						</div>
						<a href="<?= site_url('spd_admin/semua') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<?php } elseif($this->fungsi->user_login()->level == 4) { ?>
			<div class="row">
				<div class="col-lg-6">
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?php 
							$nip = $this->fungsi->user_login()->nip;
							$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE nip_pegawai=$nip AND status<'4' AND tujuan1!=''");
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>SPD Belum Dibayar</p>
						</div>
						<a href="<?= site_url('spdku') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?php 
							$nip = $this->fungsi->user_login()->nip;
							$query = $this->db->query("SELECT count(id) as cid FROM spd WHERE nip_pegawai=$nip AND status='4'");
							foreach($query->result() as $key) {
								echo $key->cid;
							}
							?></h3>
							<p>SPD Telah Dibayar</p>
						</div>
						<a href="<?= site_url('spdku') ?>" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<?php } ?>
			<div class="row">
				<div class="col-lg-12">
					<?php if(($this->fungsi->user_login()->level == 1) OR ($this->fungsi->user_login()->level == 2)) { ?>
					<div class="card">
						<div class="card-body">
							<h2>Selamat Datang, <b><?= $this->fungsi->user_login()->nama ?></b></h2>
							<hr>
							<table class="table table-bordered">
								<tr>
									<th width="15%">Menu Home</th>
									<td> Melihat Statistik SPD.</td>
								</tr>
								<tr>
									<th>Menu SPD</th>
									<td> Mengelola SPD Pegawai.</td>
								</tr>
								<tr>
									<th>Menu Rekap SPD</th>
									<td> Melihat Rekap SPD Yang Dibuat.</td>
								</tr>
								<tr>
									<th>Menu Pegawai</th>
									<td> Mengelola Akun Pegawai.</td>
								</tr>
								<tr>
									<th>Menu Data Master</th>
									<td> Mengelola Data Master Pegawai dan Data Referensi SPD.</td>
								</tr>
								<tr>
									<th>Menu Setting</th>
									<td> Mengubah Format Nomor SPD & ST, Role Pegawai dan Mengelola Akun User.</td>
								</tr>
								<tr>
									<th>Menu Akun</th>
									<td> Mengubah Data User.</td>
								</tr>
							</table>
						</div>
					</div>
					<?php } elseif ($this->fungsi->user_login()->level == 3) { ?>
					<div class="card">
						<div class="card-body">
							<h2>Selamat Datang, <b><?= $this->fungsi->user_login()->nama ?></b></h2>
							<hr>
							<table class="table table-bordered">
								<tr>
									<th width="15%">Menu Keuangan</th>
									<td> Mengelola Data Keuangan Pegawai.</td>
								</tr>
								<tr>
									<th>Menu Akun</th>
									<td> Mengubah data user.</td>
								</tr>
							</table>
						</div>
					</div>
					<?php } elseif ($this->fungsi->user_login()->level == 4) { ?>
					<div class="card">
						<div class="card-body">
							<h2>Selamat Datang, <b><?= $this->fungsi->user_login()->nama ?></b></h2>
							<hr>
							<table class="table table-bordered">
								<tr>
									<th width="15%">Menu SPD</th>
									<td> Mengelola SPD Yang Telah Terbit.</td>
								</tr>
								<tr>
									<th>Menu Keuangan</th>
									<td> Melihat Slip Gaji.</td>
								</tr>
								<tr>
									<th>Menu Akun</th>
									<td> Mengubah data user.</td>
								</tr>
							</table>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->