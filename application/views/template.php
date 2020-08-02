<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/logo-dm.png">

	<title>PLATDM KPP Pratama Gorontalo | <?= ucfirst($this->uri->segment(1)) ?></title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- summernote -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernote/summernote-bs4.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<?php if ($this->fungsi->user_login()->level == 4) : ?>
					<!-- Notifications Dropdown Menu -->
					<?php
					$nip = $this->fungsi->user_login()->nip;
					$sql = $this->db->query("SELECT count(status) as notif FROM spd WHERE status = 0 AND nip_pegawai = $nip");
					if ($sql->num_rows() > 0) {
						$notif = $sql->row()->notif;
					} else {
						$notif = '0';
					}
					?>
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<i class="far fa-bell"></i>
							<?php if ($notif != '0' || $notif != null) : ?>
								<span class="badge badge-primary navbar-badge"><?= $notif ?></span>
							<?php else : ?>
								<span></span>
							<?php endif; ?>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<span class="dropdown-item dropdown-header">Notifications</span>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<?php if ($notif != '0' || $notif != null) : ?>
									<i class="fas fa-book mr-2"></i>
									<?= $notif ?> rincian spd belum di input
								<?php else : ?>
									<div align="center" style="font-style: italic">-</div>
								<?php endif ?>
								<span class="float-right text-muted text-sm"></span>
							</a>
							<div class="dropdown-divider"></div>
							<a href="<?= site_url('spdku') ?>" class="dropdown-item dropdown-footer">Lihat SPD</a>
						</div>
					</li>
				<?php endif ?>
				<li class="nav-item">
					<a href="<?= site_url('auth/logout') ?>" class="nav-link">
						<i class="nav-icon fas fa-power-off"></i>
						Logout
					</a>
					<!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a> -->
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-light-primary elevation-4">
			<!-- Brand Logo -->
			<a href="<?= site_url('dashboard') ?>" class="brand-link">
				<img src="<?= base_url(); ?>assets/img/logo-dm.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">PLATDM <?= $this->fungsi->user_login()->level != 4 ? 'Admin' : 'Pegawai' ?></span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?= base_url() ?>assets/img/user.png" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a data-toggle="modal" <?= $this->fungsi->user_login()->level != 2 ? 'data-target="#modal-profil"' : '' ?>><?= ucwords(strtolower($this->fungsi->user_login()->nama)) ?></a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?= site_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard' ? 'active' : null ?>">
								<i class="nav-icon fas fa-home"></i>
								<p>
									Home
								</p>
							</a>
						</li>
						<?php if (($this->fungsi->user_login()->level == 1) or ($this->fungsi->user_login()->level == 2)) : ?>
							<!-- <li class="nav-item">
								<a href="<? //= base_url() 
											?>spd_admin" class="nav-link <? //= $this->uri->segment(1) == 'spd_admin' ? 'active' : '' 
																			?>">
									<i class="nav-icon fas fa-book"></i>
									<p>
										SPD
									</p>
								</a>
							</li> -->
							<li class="nav-item has-treeview <?= $this->uri->segment(1) == 'spd_admin' ? 'menu-open' : '' ?>">
								<a href="#" class="nav-link <?= $this->uri->segment(1) == 'spd_admin' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-book"></i>
									<p>
										SPD
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= site_url('spd_admin/semua') ?>" class="nav-link <?= $this->uri->segment(2) == 'semua' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Semua SPD</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('spd_admin/belum_input') ?>" class="nav-link <?= $this->uri->segment(2) == 'belum_input' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Belum Input Rincian</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('spd_admin/berkas_diterima') ?>" class="nav-link <?= $this->uri->segment(2) == 'berkas_diterima' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Berkas Diterima</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('spd_admin/ok') ?>" class="nav-link <?= $this->uri->segment(2) == 'ok' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Status OK</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('spd_admin/approved') ?>" class="nav-link <?= $this->uri->segment(2) == 'approved' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Approved oleh PPK</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('spd_admin/telah_bayar') ?>" class="nav-link <?= $this->uri->segment(2) == 'telah_bayar' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Telah Bayar</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('spd_admin/spd_batal') ?>" class="nav-link <?= $this->uri->segment(2) == 'spd_batal' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>SPD Batal</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>rekap" class="nav-link <?= $this->uri->segment(1) == 'rekap' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-file"></i>
									<p>
										Rekap SPD
									</p>
								</a>
							</li>
							<li class="nav-item has-treeview <?= $this->uri->segment(1) == 'pagu' ? 'menu-open' : '' ?>">
								<a href="#" class="nav-link <?= $this->uri->segment(1) == 'pagu' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-archive"></i>
									<p>
										Rekap Pagu
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= site_url('pagu/rekap_pagu') ?>" class="nav-link <?= $this->uri->segment(2) == 'rekap_pagu' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Rekap</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('pagu') ?>" class="nav-link <?= $this->uri->segment(2) == '' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Pagu</p>
										</a>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>pegawai" class="nav-link <?= $this->uri->segment(1) == 'pegawai' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-users"></i>
									<p>
										Pegawai
									</p>
								</a>
							</li>
							<?php if ($this->fungsi->user_login()->level == 1) { ?>
								<li class="nav-item has-treeview <?= $this->uri->segment(1) == 'controller_datamaster' ? 'menu-open' : '' ?>">
									<a href="#" class="nav-link <?= $this->uri->segment(1) == 'controller_datamaster' ? 'active' : '' ?>">
										<i class="nav-icon fas fa-database"></i>
										<p>
											Data Master
											<i class="right fas fa-angle-left"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<a href="<?= site_url('controller_datamaster/kategori_pangkat_gol') ?>" class="nav-link <?= $this->uri->segment(2) == 'kategori_pangkat_gol' ? 'active' : '' ?>">
												<i class="far fa-circle nav-icon"></i>
												<p>Kategori Pangkat Golongan</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?= site_url('controller_datamaster/pangkat_gol') ?>" class="nav-link <?= $this->uri->segment(2) == 'pangkat_gol' ? 'active' : '' ?>">
												<i class="far fa-circle nav-icon"></i>
												<p>Pangkat Golongan</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?= site_url('controller_datamaster/ref_penginapan') ?>" class="nav-link <?= $this->uri->segment(2) == 'ref_penginapan' ? 'active' : '' ?>">
												<i class="far fa-circle nav-icon"></i>
												<p>Referensi Penginapan</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="<?= site_url('controller_datamaster/ref_biaya_taxi') ?>" class="nav-link <?= $this->uri->segment(2) == 'ref_biaya_taxi' ? 'active' : '' ?>">
												<i class="far fa-circle nav-icon"></i>
												<p>Referensi Biaya Taksi</p>
											</a>
										</li>
									</ul>
								</li>
							<?php } ?>
							<li class="nav-item has-treeview <?= $this->uri->segment(1) == 'controller_setting' ? 'menu-open' : '' ?>">
								<a href="#" class="nav-link <?= $this->uri->segment(1) == 'controller_setting' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-cogs"></i>
									<p>
										Setting
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?= site_url('controller_setting/setting_nomor') ?>" class="nav-link <?= $this->uri->segment(2) == 'setting_nomor' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Setting Nomor</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?= site_url('controller_setting') ?>" class="nav-link <?= $this->uri->segment(2) == '' ? 'active' : '' ?>">
											<i class="far fa-circle nav-icon"></i>
											<p>Setting Pegawai</p>
										</a>
									</li>
									<?php if ($this->fungsi->user_login()->level == 1) { ?>
										<li class="nav-item">
											<a href="<?= site_url('controller_setting/user') ?>" class="nav-link <?= $this->uri->segment(2) == 'user' ? 'active' : '' ?>">
												<i class="far fa-circle nav-icon"></i>
												<p>Setting User</p>
											</a>
										</li>
									<?php } ?>
								</ul>
							</li>
						<?php endif ?>
						<?php if ($this->fungsi->user_login()->level == 3) : ?>
							<li class="nav-item">
								<a href="<?= site_url('controller_keuangan') ?>" class="nav-link <?= $this->uri->segment(1) == 'controller_keuangan' || $this->uri->segment(1) == 'slipgajiku' ? 'active' : null ?>">
									<i class="nav-icon fas fa-wallet"></i>
									<p>
										Keuangan
									</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>pegawai" class="nav-link <?= $this->uri->segment(1) == 'pegawai' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-users"></i>
									<p>
										Pegawai
									</p>
								</a>
							</li>
						<?php endif ?>
						<?php if ($this->fungsi->user_login()->level == 4) : ?>
							<?php if ($this->fungsi->user_login()->ppk == 1) : ?>
								<li class="nav-item">
									<a href="<?= base_url() ?>rekap" class="nav-link <?= $this->uri->segment(1) == 'rekap' ? 'active' : '' ?>">
										<i class="nav-icon fas fa-file"></i>
										<p>
											Rekap SPD
										</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= site_url('spdku/approve_spdku') ?>" class="nav-link <?= $this->uri->segment(2) == 'approve_spdku' ? 'active' : null ?>">
										<i class="nav-icon fas fa-clipboard-check"></i>
										<p>
											Approve SPD
										</p>
									</a>
								</li>
							<?php endif ?>
							<li class="nav-item">
								<a href="<?= site_url('spdku') ?>" class="nav-link <?= $this->uri->segment(1) == 'spdku' && $this->uri->segment(2) != 'approve_spdku' ? 'active' : null ?>">
									<i class="nav-icon fas fa-book"></i>
									<p>
										SPD
									</p>
								</a>
							</li>
							
							<?php if ($this->fungsi->user_login()->ppk == 1) : ?>
							<li class="nav-item">
								<a href="<?= site_url('pegawai/approveppk') ?>" class="nav-link <?= $this->uri->segment(2) == 'approveppk' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-check"></i>
									<p>
										Approve RPD
									</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>rekap" class="nav-link <?= $this->uri->segment(1) == 'rekap' ? 'active' : '' ?>">
									<i class="nav-icon fas fa-file"></i>
									<p>
										Rekap SPD
									</p>
								</a>
							</li>
							<?php endif ?>
							<?php if (($this->fungsi->user_login()->ppk == 1) or ($this->fungsi->user_login()->bendahara == 1) or ($this->fungsi->user_login()->kepala_kantor == 1)) : ?>
								<li class="nav-item">
									<a href="<?= site_url('pagu/rekap_pagu') ?>" class="nav-link <?= $this->uri->segment(2) == 'rekap_pagu' ? 'active' : '' ?>">
										<i class="nav-icon fas fa-archive"></i>
										<p>Rekap Pagu</p>
									</a>
								</li>
							<?php endif ?>
							
							<li class="nav-item">
								<a href="<?= site_url('slipgajiku/' . $this->fungsi->user_login()->nip) ?>" class="nav-link <?= $this->uri->segment(1) == 'slipgajiku' ? 'active' : null ?>">
									<i class="nav-icon fas fa-wallet"></i>
									<p>
										Keuangan
									</p>
								</a>
							</li>
						<?php endif ?>
						<li class="nav-item">
							<a href="<?= site_url('akunku') ?>" class="nav-link <?= $this->uri->segment(1) == 'akunku' ? 'active' : null ?>">
								<i class="nav-icon fas fa-user"></i>
								<p>
									Akun
								</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>
		<div class="modal fade" id="modal-profil">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Data Pegawai</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered no-margin">
							<tbody>
								<tr>
									<th style="width: 25%">Nip </th>
									<td><span><?= $this->fungsi->user_login()->nip ?></span></td>
								</tr>
								<tr>
									<th style="width: 25%">Nama </th>
									<td><span><?= $this->fungsi->user_login()->nama ?></span></td>
								</tr>
								<tr>
									<th style="width: 25%">Pangkat/Golongan </th>
									<td><span><?= $this->fungsi->user_login()->pangkat_gol ?></span></td>
								</tr>
								<tr>
									<th style="width: 25%">Jabatan </th>
									<td><span><?= $this->fungsi->user_login()->jabatan ?></span></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- Modal content-->
		<div class="modal fade" tabindex="-1" role="dialog" id="notifShow">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-bold">Ganti Password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Demi menjaga kerahasiaan informasi keuangan Anda, silahkan mengganti password melalui <a href="<?= site_url('/akunku') ?>">Menu Akun</a>.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<?= $contents ?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
			<div class="p-3">
				<h5>Title</h5>
				<p>Sidebar content</p>
			</div>
		</aside>
		<!-- /.control-sidebar -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">
				Platform Doi Masuk
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2020 <a href="#">PLATDM KPP Pratama Gorontalo</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- DataTables -->
	<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
	<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- Select2 -->
	<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
	<!-- start - This is for export functionality only -->
	<script src="<?= base_url(); ?>assets/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url(); ?>assets/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
	<script src="<?= base_url(); ?>assets/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min"></script>
	<script src="<?= base_url(); ?>assets/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min"></script>
	<script src="<?= base_url(); ?>assets/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="<?= base_url(); ?>assets/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="<?= base_url(); ?>assets/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="<?= base_url(); ?>assets/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
	<script src="<?= base_url(); ?>assets/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
	<!-- Summernote -->
	<script src="<?= base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
	<script type="text/javascript" src="http://malsup.github.com/jquery.media.js"></script>

	<?php if ($this->session->flashdata('message') == 'chgpassword') : ?>
		<script>
			$('#notifShow').modal('show')
		</script>
	<?php endif; ?>
	<script>
		$(function() {
			// Summernote
			$('.textarea').summernote({
				height: 300
			})
		})
	</script>
	<script>
		$(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
			$("#btn-update").hide();
			$("#check-all").click(function() { // Ketika user men-cek checkbox all
				if ($(this).is(":checked")) { // Jika checkbox all diceklis
					$(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
					$("#btn-update").show();
				} else { // Jika checkbox all tidak diceklis
					$(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
					$("#btn-update").hide();
				}
			});

			$(".check-item").click(function() { // Ketika user men-cek checkbox all
				if ($(this).is(":checked")) { // Jika checkbox all diceklis
					$("#btn-update").show();
				} else { // Jika checkbox all tidak diceklis
					$("#btn-update").hide();
				}
			});

			$("#btn-update").click(function() { // Ketika user mengklik tombol update
				$("#modal-status").modal('show');
			});

			$("#confirm").click(function() { // Ketika user mengklik tombol update
				var confirm = window.confirm("Update data-data ini?"); // Buat sebuah alert konfirmasi

				if (confirm) { // Jika user mengklik tombol "Ok"
					$("#form-update").submit(); // Submit form
				}
			});
		});
	</script>
	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})

			//Datemask dd/mm/yyyy
			$('#datemask').inputmask('dd/mm/yyyy', {
				'placeholder': 'dd/mm/yyyy'
			})
			//Datemask2 mm/dd/yyyy
			$('#datemask2').inputmask('mm/dd/yyyy', {
				'placeholder': 'mm/dd/yyyy'
			})
			//Money Euro
			$('[data-mask]').inputmask()

			//Date range picker
			$('#reservation').daterangepicker()
			//Date range picker with time picker
			$('#reservationtime').daterangepicker({
				timePicker: true,
				timePickerIncrement: 30,
				locale: {
					format: 'MM/DD/YYYY hh:mm A'
				}
			})
			//Date range as a button
			$('#daterange-btn').daterangepicker({
					ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					startDate: moment().subtract(29, 'days'),
					endDate: moment()
				},
				function(start, end) {
					$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
				}
			)

			//Timepicker
			$('#timepicker').datetimepicker({
				format: 'LT'
			})

			//Bootstrap Duallistbox
			$('.duallistbox').bootstrapDualListbox()

			//Colorpicker
			$('.my-colorpicker1').colorpicker()
			//color picker with addon
			$('.my-colorpicker2').colorpicker()

			$('.my-colorpicker2').on('colorpickerChange', function(event) {
				$('.my-colorpicker2 .fa-square').css('color', event.color.toString());
			});

			$("input[data-bootstrap-switch]").each(function() {
				$(this).bootstrapSwitch('state', $(this).prop('checked'));
			});

		})

		$(function() {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<script>
		$('#example23, #example24').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'excel'
			]
		});
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			$('[rel="tooltip"]').tooltip({
				trigger: "hover"
			});
			// $('#search').hide();
			$('#print').hide();
			$("#thn").bind('change keyup', function() {
				if ($(this).val().length > 3) {
					$('#search').show();
				} else {
					$('#search').hide();
				}
			});

			$('#search').on('click', function() {
				$('#print').show();
				$('#container').load("<?= site_url(); ?>controller_pegawai/showGaji?bln=" + $('#bln').val() + "&thn=" + $('#thn').val() + "&nip=" + $('#nip').val());
			});

			$('#print').on('click', function() {
				$('#print').attr("href", "<?= site_url(); ?>controller_pegawai/gaji_pdf?bln=" + $('#bln').val() + "&thn=" + $('#thn').val() + "&nip=" + $('#nip').val());
			});
		});
	</script>
	<script>
		$('input[name=toggle1]').change(function() {
			var mode = $(this).prop('checked');
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: '<?= site_url('controller_setting/switch_ppk') ?>',
				data: {
					mode: mode,
					id: id
				},
				success: function(data) {
					var data = eval(data);
					message = data.message;
					success = data.success;
					$("#heading").html(success);
					$("#body").html(message);
					window.location = "<?= site_url('controller_setting') ?>";
				}
			});
		});
		$('input[name=toggle2]').change(function() {
			var mode = $(this).prop('checked');
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: '<?= site_url('controller_setting/switch_bendahara') ?>',
				data: {
					mode: mode,
					id: id
				},
				success: function(data) {
					var data = eval(data);
					message = data.message;
					success = data.success;
					$("#heading").html(success);
					$("#body").html(message);
					window.location = "<?= site_url('controller_setting') ?>";
				}
			});
		});
		$('input[name=toggle3]').change(function() {
			var mode = $(this).prop('checked');
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: '<?= site_url('controller_setting/switch_kepala_kantor') ?>',
				data: {
					mode: mode,
					id: id
				},
				success: function(data) {
					var data = eval(data);
					message = data.message;
					success = data.success;
					$("#heading").html(success);
					$("#body").html(message);
					window.location = "<?= site_url('controller_setting') ?>";
				}
			});
		});
		$('input[name=toggle4]').change(function() {
			var mode = $(this).prop('checked');
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: '<?= site_url('spd_admin/ceklis_berkas_diterima') ?>',
				data: {
					mode: mode,
					id: id
				},
				success: function(data) {
					var data = eval(data);
					message = data.message;
					success = data.success;
					$("#heading").html(success);
					$("#body").html(message);
					window.location = "<?= site_url('spd_admin/berkas_diterima') ?>";
				}
			});
		});
		$('input[name=toggle5]').change(function() {
			var mode = $(this).prop('checked');
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: '<?= site_url('spd_admin/ceklis_ok') ?>',
				data: {
					mode: mode,
					id: id
				},
				success: function(data) {
					var data = eval(data);
					message = data.message;
					success = data.success;
					$("#heading").html(success);
					$("#body").html(message);
					window.location = "<?= site_url('spd_admin/ok') ?>";
				}
			});
		});
		$('input[name=toggle6]').change(function() {
			var mode = $(this).prop('checked');
			var id = $(this).val();
			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				url: '<?= site_url('pegawai/ceklis_approved') ?>',
				data: {
					mode: mode,
					id: id
				},
				success: function(data) {
					var data = eval(data);
					message = data.message;
					success = data.success;
					$("#heading").html(success);
					$("#body").html(message);
					window.location = "<?= site_url('pegawai/approveppk') ?>";
				}
			});
		});
		$('input[name=toggle7]').on('change', function(e) {
			var id = $(this).val();
			if (e.target.checked) {
				$('#bayar' + id).modal();
			} else {
				$.ajax({
					type: 'POST',
					dataType: 'JSON',
					url: '<?= site_url('spd_admin/ceklis_reapproved') ?>',
					data: {
						id: id
					},
					success: function(data) {
						var data = eval(data);
						message = data.message;
						success = data.success;
						$("#heading").html(success);
						$("#body").html(message);
						window.location = "<?= site_url('spd_admin/approved') ?>";
					}
				});
			}
		});
	</script>
	<script>
		$(document).ready(function() {
			$(document).on('click', '#set_dtl', function() {
				var nama_ppk = $(this).data('nama_ppk');
				var nip_ppk = $(this).data('nip_ppk');
				var nama_bendahara = $(this).data('nama_bendahara');
				var nip_bendahara = $(this).data('nip_bendahara');
				var no_spd = $(this).data('no_spd');
				var tgl_spd = $(this).data('tgl_spd');
				var maksud = $(this).data('maksud');
				var kendaraan = $(this).data('kendaraan');
				var lamanya = $(this).data('lamanya');
				var tgl_berangkat = $(this).data('tgl_berangkat');
				var tujuan1 = $(this).data('tujuan1');
				var tujuan2 = $(this).data('tujuan2');
				var tujuan3 = $(this).data('tujuan3');
				var tujuan4 = $(this).data('tujuan4');
				var tgl_selesai = $(this).data('tgl_selesai');
				var no_st = $(this).data('no_st');
				var tgl_st = $(this).data('tgl_st');
				var uang_harian = $(this).data('uang_harian');
				var jlh_hari = $(this).data('jlh_hari');
				var total_uh = $(this).data('total_uh');
				var penyesuaian_uh = $(this).data('penyesuaian_uh');
				var uang_harian2 = $(this).data('uang_harian2');
				var jlh_hari2 = $(this).data('jlh_hari2');
				var total_uh2 = $(this).data('total_uh2');
				var penyesuaian_uh2 = $(this).data('penyesuaian_uh2');
				var grand_total_uh = $(this).data('grand_total_uh');
				var by_transportasi_berangkat = $(this).data('by_transportasi_berangkat');
				var by_transportasi_pulang = $(this).data('by_transportasi_pulang');
				var total_by_transportasi = $(this).data('total_by_transportasi');
				var durasi_menginap = $(this).data('durasi_menginap');
				var menginap_dari = $(this).data('menginap_dari');
				var menginap_sampai = $(this).data('menginap_sampai');
				var tarif_penginapan = $(this).data('tarif_penginapan');
				var durasi_menginap2 = $(this).data('durasi_menginap2');
				var menginap_dari2 = $(this).data('menginap_dari2');
				var menginap_sampai2 = $(this).data('menginap_sampai2');
				var tarif_penginapan2 = $(this).data('tarif_penginapan2');
				var durasi_menginap3 = $(this).data('durasi_menginap3');
				var menginap_dari3 = $(this).data('menginap_dari3');
				var menginap_sampai3 = $(this).data('menginap_sampai3');
				var tarif_penginapan3 = $(this).data('tarif_penginapan3');
				var total_by_penginapan = $(this).data('total_by_penginapan');
				var pengeluaran_riil = $(this).data('pengeluaran_riil');
				var grand_total = $(this).data('grand_total');
				var uang_muka = $(this).data('uang_muka');
				var kredit = $(this).data('kredit');
				var total_bayar = $(this).data('total_bayar');
				var kurang_lebih_bayar = $(this).data('kurang_lebih_bayar');
				var isi_laporan = $(this).data('isi_laporan');

				$('#nama_ppk').text(nama_ppk);
				$('#nip_ppk').text(nip_ppk);
				$('#nama_bendahara').text(nama_bendahara);
				$('#nip_bendahara').text(nip_bendahara);
				$('#no_spd').text(no_spd);
				$('#tgl_spd').text(tgl_spd);
				$('#maksud').text(maksud);
				$('#kendaraan').text(kendaraan);
				$('#lamanya').text(lamanya);
				$('#tgl_berangkat').text(tgl_berangkat);
				$('#tujuan1').text(tujuan1);
				$('#tujuan2').text(tujuan2);
				$('#tujuan3').text(tujuan3);
				$('#tujuan4').text(tujuan4);
				$('#tgl_selesai').text(tgl_selesai);
				$('#no_st').text(no_st);
				$('#tgl_st').text(tgl_st);
				$('#uang_harian').text(uang_harian);
				$('#jlh_hari').text(jlh_hari);
				$('#total_uh').text(total_uh);
				$('#penyesuaian_uh').text(penyesuaian_uh);
				$('#uang_harian2').text(uang_harian2);
				$('#jlh_hari2').text(jlh_hari2);
				$('#total_uh2').text(total_uh2);
				$('#penyesuaian_uh2').text(penyesuaian_uh2);
				$('#grand_total_uh').text(grand_total_uh);
				$('#by_transportasi_berangkat').text(by_transportasi_berangkat);
				$('#by_transportasi_pulang').text(by_transportasi_pulang);
				$('#total_by_transportasi').text(total_by_transportasi);
				$('#durasi_menginap').text(durasi_menginap);
				$('#menginap_dari').text(menginap_dari);
				$('#menginap_sampai').text(menginap_sampai);
				$('#tarif_penginapan').text(tarif_penginapan);
				$('#durasi_menginap2').text(durasi_menginap2);
				$('#menginap_dari2').text(menginap_dari2);
				$('#menginap_sampai2').text(menginap_sampai2);
				$('#tarif_penginapan2').text(tarif_penginapan2);
				$('#durasi_menginap3').text(durasi_menginap3);
				$('#menginap_dari3').text(menginap_dari3);
				$('#menginap_sampai3').text(menginap_sampai3);
				$('#tarif_penginapan3').text(tarif_penginapan3);
				$('#total_by_penginapan').text(total_by_penginapan);
				$('#pengeluaran_riil').text(pengeluaran_riil);
				$('#grand_total').text(grand_total);
				$('#uang_muka').text(uang_muka);
				$('#kredit').text(kredit);
				$('#total_bayar').text(total_bayar);
				$('#kurang_lebih_bayar').text(kurang_lebih_bayar);
				$('#isi_laporan').text(isi_laporan);
			})
		})
	</script>
	<script>
		$(document).ready(function() {
			$("#by_transportasi_berangkat, #by_transportasi_pulang, #uang_harian, #jlh_hari, #total_uh, #penyesuaian_uh, #uang_harian2, #jlh_hari2, #total_uh2, #penyesuaian_uh2, #grand_total_uh, #total_by_transportasi, #durasi_menginap, #tarif_penginapan, #durasi_menginap2, #tarif_penginapan2, #durasi_menginap3, #tarif_penginapan3, #total_by_penginapan, #pengeluaran1, #pengeluaran2, #pengeluaran3, #pengeluaran4, #pengeluaran_riil, #grand_total, #uang_muka, #kredit").bind("focusout", function(e) {

				var max_pengeluaran1 = parseInt($('#pengeluaran1').attr('max'));
				var val_pengeluaran1 = parseInt($('#pengeluaran1').val());
				var max_pengeluaran2 = parseInt($('#pengeluaran2').attr('max'));
				var val_pengeluaran2 = parseInt($('#pengeluaran2').val());
				var max_pengeluaran3 = parseInt($('#pengeluaran3').attr('max'));
				var val_pengeluaran3 = parseInt($('#pengeluaran3').val());
				var max_pengeluaran4 = parseInt($('#pengeluaran4').attr('max'));
				var val_pengeluaran4 = parseInt($('#pengeluaran4').val());
				if (val_pengeluaran1 > max_pengeluaran1) {
					$('#pengeluaran1').val(max_pengeluaran1);
				}
				if (val_pengeluaran2 > max_pengeluaran2) {
					$('#pengeluaran2').val(max_pengeluaran2);
				}
				if (val_pengeluaran3 > max_pengeluaran3) {
					$('#pengeluaran3').val(max_pengeluaran3);
				}
				if (val_pengeluaran4 > max_pengeluaran4) {
					$('#pengeluaran4').val(max_pengeluaran4);
				}

				var max_tarif_penginapan = parseInt($('#tarif_penginapan').attr('max'));
				var val_tarif_penginapan = parseInt($('#tarif_penginapan').val());
				var max_tarif_penginapan2 = parseInt($('#tarif_penginapan2').attr('max'));
				var val_tarif_penginapan2 = parseInt($('#tarif_penginapan2').val());
				var max_tarif_penginapan3 = parseInt($('#tarif_penginapan3').attr('max'));
				var val_tarif_penginapan3 = parseInt($('#tarif_penginapan3').val());

				if (val_tarif_penginapan > max_tarif_penginapan) {
					$('#tarif_penginapan').val(max_tarif_penginapan);
				}
				if (val_tarif_penginapan2 > max_tarif_penginapan2) {
					$('#tarif_penginapan2').val(max_tarif_penginapan2);
				}
				if (val_tarif_penginapan3 > max_tarif_penginapan3) {
					$('#tarif_penginapan3').val(max_tarif_penginapan3);
				}

				var jlh_hari = $('#jlh_hari').val();
				var uang_harian = $('#uang_harian').val();
				var total_uh = Number(jlh_hari) * Number(uang_harian);
				$('#total_uh').val(total_uh);

				var jlh_hari2 = $('#jlh_hari2').val();
				var uang_harian2 = $('#uang_harian2').val();
				var total_uh2 = Number(jlh_hari2) * Number(uang_harian2);
				$('#total_uh2').val(total_uh2);

				var by_transportasi_berangkat = $('#by_transportasi_berangkat').val();
				var by_transportasi_pulang = $('#by_transportasi_pulang').val();
				var total_by_transportasi = Number(by_transportasi_berangkat) + Number(by_transportasi_pulang);
				$('#total_by_transportasi').val(total_by_transportasi);

				var durasi_menginap = $('#durasi_menginap').val();
				var tarif_penginapan = $('#tarif_penginapan').val();
				var durasi_menginap2 = $('#durasi_menginap2').val();
				var tarif_penginapan2 = $('#tarif_penginapan2').val();
				var durasi_menginap3 = $('#durasi_menginap3').val();
				var tarif_penginapan3 = $('#tarif_penginapan3').val();
				var total_by_penginapan = (Number(durasi_menginap) * Number(tarif_penginapan)) + (Number(durasi_menginap2) * Number(tarif_penginapan2)) + (Number(durasi_menginap3) * Number(tarif_penginapan3));
				$('#total_by_penginapan').val(total_by_penginapan);

				var pengeluaran1 = $('#pengeluaran1').val();
				var pengeluaran2 = $('#pengeluaran2').val();
				var pengeluaran3 = $('#pengeluaran3').val();
				var pengeluaran4 = $('#pengeluaran4').val();
				var pengeluaran_riil = Number(pengeluaran1) + Number(pengeluaran2) + Number(pengeluaran3) + Number(pengeluaran4);
				$('#pengeluaran_riil').val(pengeluaran_riil);

				var total_uh = $('#total_uh').val();
				var penyesuaian_uh = $('#penyesuaian_uh').val();
				var persen = Number(penyesuaian_uh) / 100;
				var temp = Number(total_uh) * Number(persen);
				var total_uh2 = $('#total_uh2').val();
				var penyesuaian_uh2 = $('#penyesuaian_uh2').val();
				var persen2 = Number(penyesuaian_uh2) / 100;
				var temp2 = Number(total_uh2) * Number(persen2);
				var grand_total_uh = ((Number(total_uh) - Number(temp)) + (Number(total_uh2) - Number(temp2)));
				$('#grand_total_uh').val(grand_total_uh);

				var grand_total_uh = $('#grand_total_uh').val();
				var total_by_transportasi = $('#total_by_transportasi').val();
				var total_by_penginapan = $('#total_by_penginapan').val();
				var pengeluaran_riil = $('#pengeluaran_riil').val();
				<?php /*if ($this->fungsi->user_login()->level == 1) :*/ ?>
				var grand_total = Number(grand_total_uh) + Number(total_by_transportasi) + Number(total_by_penginapan) + Number(pengeluaran_riil);
				<?php /*else :*/ ?>
				/*var grand_total = Number(total_by_transportasi) + Number(total_by_penginapan) + Number(pengeluaran_riil);*/
				<?php /*endif*/ ?>
				$('#grand_total').val(grand_total);

				var grand_total = $('#grand_total').val();
				var uang_muka = $('#uang_muka').val();
				var kredit = $('#kredit').val();
				var total_bayar = Number(grand_total) - Number(uang_muka) - Number(kredit);
				$('#total_bayar').val(total_bayar);

			});
		});
	</script>
</body>

</html>