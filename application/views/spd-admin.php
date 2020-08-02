<?php error_reporting(0); ?>
<!-- Content Header (Page header) -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">SPD Admin <?= $this->fungsi->user_login()->kantor; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">SPD</a></li>
						<li class="breadcrumb-item active"><?= $page ?></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success">
						<?= $this->session->flashdata('success'); ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span>
						</button>
					</div>
				<?php endif; ?>
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><?= $page ?> <b>(Total : Rp. <?php foreach ($total->result() as $key => $datass) {
																				echo number_format($datass->total_bayar);
																			} ?>)</b></h3>
						<a href="<?= site_url('spd_admin/export_excel') ?>" class="btn btn-sm btn-primary" style="float: right; margin-left: 2px"><i class="fas fa-download"></i> Excel </a>
						<button type="button" class="btn btn-sm btn-success" style="float: right; margin-left: 2px" data-toggle="modal" data-target="#import"><i class="fa fa-upload"></i> Import</button>
						<a href="<?= site_url('spd_admin/add') ?>" class="btn btn-sm btn-info" style="float: right;"><i class="fas fa-plus"></i> Tambah </a>
					</div>
					<div class="modal fade" id="import">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Import SPD</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form id="form1" method="POST" action="<?= site_url('controller_pegawai/import_rincian_spd'); ?>" enctype="multipart/form-data" novalidate>
										<div class="col-sm-12">
											<div class="form-group">
												<div class="form-line">
													<input type="file" class="form-control" name="insertFile" placeholder="File ekstensi : xlsx, xls" required><br>
													<small><b>Ketentuan Import SPD : </b><br>
														1. Silahkan menggunakan Format Excel SPD 2020 yang sudah berisikan data. Download contoh Format Import SPD <a href="<?= base_url() ?>uploads/format/import_spd_newest.xlsx">disini</a>. <br>
														2. Untuk kolom tujuan silahkan menggunakan ID KOTA bisa dilihat <a href="<?= base_url() ?>uploads/format/ID_KOTA.xlsx">disini</a> untuk format ID Kota. Gunakan tanda koma (,) untuk memisahkan tujuan 1, 2, 3, dan 4. <br>
														3. Sheet "Data" dipindahkan menjadi sheet paling awal atau sheet pertama. <br>
														4. Format Cells menjadi General mulai dari kolom UANG HARIAN sampai kolom KURANG/LEBIH BYR hingga tampilan angka yang muncul tidak lagi memiliki koma (,) <br>
														5. Untuk pegawai yang tidak punya NIP silahkan dibuatkan NIP sementara terlebih dahulu di Menu Pegawai, NIP dapat berupa angka atau huruf yg dikombinasikan ataupun tidak. Ini dikarenakan SPD menggunakan NIP sebagai Link (penghubung data pegawai dan data SPD) sehingga jika pegawai tidak mempunyai NIP maka SPDnya tidak akan tampil. <br>
														6. Ada beberapa data yang masih perlu di isikan lagi melalui aplikasi, diantaranya : <br>
														a) Data Rincian Pengeluaran Riil (Belum ada Rincian Pengeluaran Riil di Format Excel SPD 2020) <br>
														b) Data Laporan Pelaksanaan ST dan Atasan
													</small>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input type="submit" class="btn btn-primary" name="import" value="Import" form="form1" />
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<form method="POST" action="<?= site_url('spd_admin/update_status') ?>" id="form-update">
							<div class="d-flex no-block align-items-center">
								<div class="mb-3 ml-auto"><button type="button" class="btn btn-sm btn-info pull-right collapsed" id="btn-update">Update</button></div>
							</div>
							<div class="modal fade" id="modal-status">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Update Status</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label>Status</label>
												<select class="form-control" name="pilih_status" required>
													<option value="">-Pilih Status-</option>
													<option value="1">Berkas Diterima</option>
													<option value="2">Ok</option>
													<!--<option value="5">SPD Batal</option>-->
												</select>
											</div>
											<div class="form-group">
												<button id="confirm" type="button" class="btn btn-info">Update</button>
											</div>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
						</form>
						<table id="example1" class="table table-sm table-bordered" style="width: 100%;">
							<thead class="thead-light">
								<tr>
									<th><input type="checkbox" id="check-all"><label for="check-all"> </label></th>
									<!--<th>No</th>-->
									<th>Aksi</th>
									<th>Nomor SPD</th>
									<th>Tanggal SPD</th>
									<th>Nama Pegawai</th>
									<th>Kantor</th>
									<th>Total Bayar</th>
									<th>Rincian</th>
									<th>Status PPK</th>
									<th width="15% !important">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($row->result() as $key => $data) : ?>
									<tr>
										<td><input type="checkbox" class="check-item" name="id[]" value="<?= $data->id ?>" id="check<?= $data->id ?>"> <label for="check<?= $data->id ?>"> </label></td>
										<!--<td><?= $no++ ?></td>-->
										<td>
											<div class="input-group-prepend">
												<button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-info-circle"></i> Aksi
												</button>
												<div class="dropdown-menu">
													<a id="set_dtl" class="dropdown-item" data-toggle="modal" data-target="#modal-detail" data-nama_ppk="<?= getNamaByNip($data->nip_ppk) ?>" data-nip_ppk="<?= $data->nip_ppk ?>" data-nama_bendahara="<?= getNamaByNip($data->nip_bendahara) ?>" data-nip_bendahara="<?= $data->nip_bendahara ?>" data-no_spd="<?= $data->no_spd ?>" data-tgl_spd="<?= indo_date($data->tgl_spd) ?>" data-maksud="<?= $data->maksud ?>" data-kendaraan="<?= $data->kendaraan ?>" data-lamanya="<?= $data->lamanya . ' Hari' ?>" data-tgl_berangkat="<?= indo_date($data->tgl_berangkat) ?>" data-tujuan1="<?= $data->tujuan1 != '' ? getCityById($data->tujuan1) : null ?>" data-tujuan2="<?= $data->tujuan2 != '' ? getCityById($data->tujuan2) : null ?>" data-tujuan3="<?= $data->tujuan3 != '' ? getCityById($data->tujuan3) : null ?>" data-tujuan4="<?= $data->tujuan4 != '' ? getCityById($data->tujuan4) : null ?>" data-tgl_selesai="<?= indo_date($data->tgl_selesai) ?>" data-no_st="<?= sprintf('%04d', $data->no_st); ?>" data-tgl_st="<?= indo_date($data->tgl_st) ?>" data-uang_harian="<?= indo_currency($data->uang_harian) ?>" data-jlh_hari="<?= $data->jlh_hari ?>" data-total_uh="<?= indo_currency($data->total_uh) ?>" data-penyesuaian_uh="<?= $data->penyesuaian_uh ?>%" data-uang_harian2="<?= indo_currency($data->uang_harian2) ?>" data-jlh_hari2="<?= $data->jlh_hari2 ?>" data-total_uh2="<?= indo_currency($data->total_uh2) ?>" data-penyesuaian_uh2="<?= $data->penyesuaian_uh2 ?>%" data-grand_total_uh="<?= indo_currency($data->grand_total_uh) ?>" data-by_transportasi_berangkat="<?= indo_currency($data->by_transportasi_berangkat) ?>" data-by_transportasi_pulang="<?= indo_currency($data->by_transportasi_pulang) ?>" data-total_by_transportasi="<?= indo_currency($data->total_by_transportasi) ?>" data-durasi_menginap="<?= $data->durasi_menginap ?>" data-menginap_dari="<?= indo_date($data->menginap_dari) ?>" data-menginap_sampai="<?= indo_date($data->menginap_sampai) ?>" data-tarif_penginapan="<?= indo_currency($data->tarif_penginapan) ?>" data-durasi_menginap2="<?= $data->durasi_menginap2 ?>" data-menginap_dari2="<?= indo_date($data->menginap_dari2) ?>" data-menginap_sampai2="<?= indo_date($data->menginap_sampai2) ?>" data-tarif_penginapan2="<?= indo_currency($data->tarif_penginapan2) ?>" data-durasi_menginap3="<?= $data->durasi_menginap3 ?>" data-menginap_dari3="<?= indo_date($data->menginap_dari3) ?>" data-menginap_sampai3="<?= indo_date($data->menginap_sampai3) ?>" data-tarif_penginapan3="<?= indo_currency($data->tarif_penginapan3) ?>" data-total_by_penginapan="<?= indo_currency($data->total_by_penginapan) ?>" data-pengeluaran_riil="<?= indo_currency($data->pengeluaran_riil) ?>" data-total_biaya_spd="<?= indo_currency($data->total_biaya_spd) ?>" data-grand_total="<?= indo_currency($data->grand_total) ?>" data-uang_muka="<?= indo_currency($data->uang_muka) ?>" data-kredit="<?= indo_currency($data->kredit) ?>" data-total_bayar="<?= indo_currency($data->total_bayar) ?>" data-kurang_lebih_bayar="<?= indo_currency($data->kurang_lebih_bayar) ?>" data-status="<?= $data->status ?>" data-ket="<?= $data->ket ?>" data-dipa="<?= $data->dipa ?>" data-isi_laporan="<?= strip_tags($data->isi_laporan) ?>">
														Detail SPD
													</a>
													<?php if ($data->status < '4') { ?>
														<a class="dropdown-item" href="<?= site_url('spd_admin/edit/') ?><?= $data->id ?>">Edit SPD</a>
														<a class="dropdown-item" href="<?= site_url('spd_admin/batal/') ?><?= $data->id ?>" onclick="return confirm('Yakin batalkan SPD ini?');">Batalkan SPD</a>
													<?php } ?>
													<?php if ($data->status < 5) : ?>
														<?php if ($data->tujuan1 != '') { ?>
															<div class="dropdown-divider"></div>
															<a class="dropdown-item" href="<?= site_url('spd_admin/print_spd/') ?><?= $data->id ?>" target="_blank">Cetak SPD</a>
															<a class="dropdown-item" href="<?= site_url('spd_admin/print_lampiran/') ?><?= $data->id ?>" target="_blank">Cetak Lampiran</a>
														<?php } ?>
													<?php endif ?>
												</div>
											</div><br>
											<?php if ($data->status == '4') { ?>
												<label><i class="badge badge-success"><?= $data->ls ?> <br> <?= indo_date($data->tgl_bayar) ?> <br> <?= $data->dipa ?></i></label>
											<?php } ?>

										</td>
										<td><?= $data->no_spd ?> </td>
										<td><?= tgl_ind($data->tgl_spd) ?></td>
										<td><?= $data->nama ?></td>

										<td><?php
											if ($data->sort == '1') {
												echo $sort = 'KP2KP Limboto';
											} elseif ($data->sort == '2') {
												echo $sort = 'KP2KP Tilamuta';
											} elseif ($data->sort == '3') {
												echo $sort = 'KP2KP Marissa';
											} else {
												echo $sort = 'KPP Pratama Gorontalo';
											}
											?></td>
										<td><?= ($data->total_bayar >= 0) ? number_format($data->total_bayar) : '0' ?></td>
										<td><?php
											// if ($data->by_transportasi_berangkat == NULL || $data->uang_harian == NULL) {
											// 	echo '<label><i class="badge badge-warning">On Progress</i></label>';
											// } else { 
											?>
											<?php if ($data->status < 5) : ?>
												<?php if ($data->status != '4') { ?>
													<?php if ($data->tujuan1 != '') { ?>
														<a href="<?= site_url('spdku/rincian/' . $data->id) ?>" class="btn btn-xs bg-teal" data-toggle="tooltip" data-placement="top" title="Rincian SPD">
															<i class="fa fa-envelope-open-text"></i>
														</a>
													<?php } else { ?>
														<a class="btn btn-xs bg-teal" data-toggle="tooltip" data-placement="top" title="Rincian SPD" onclick="alert('Tujuan masih kosong, silahkan input tujuan di menu edit spd')">
															<i class="fa fa-envelope-open-text"></i>
														</a>
													<?php } ?>
												<?php } ?>
												<a href="<?= site_url('spd_admin/print_rincian/') ?><?= $data->id ?>" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="bottom" title="Cetak Rincian" target="_blank"><i class="fas fa-print"></i> </a>
												<a href="<?= site_url('spdku/laporan/pengeluaran_riil/' . $data->id) ?>" target="_blank" class="btn btn-xs bg-lightblue" data-toggle="tooltip" data-placement="top" title="Laporan Pengeluaran Riil">
													<i class="fa fa-file-word"></i>
												</a>
												<a href="<?= site_url('spdku/laporan/pelaksanaan_st/' . $data->id) ?>" target="_blank" class="btn btn-xs bg-pink" data-toggle="tooltip" data-placement="top" title="Laporan Pelaksanaan ST">
													<i class="fa fa-file-signature"></i>
												</a>
												<?php if ($data->kuitansi != null || $data->kuitansi != '') : ?>
													<!--<a href="<?= site_url('uploads/kuitansi/' . $data->kuitansi) ?>" class="btn btn-xs btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Lihat Kuitansi" target="_blank"><i class="fas fa-file"></i> </a>-->
												<?php endif ?>
											<?php endif ?>
											<?php //} 
											?></td>
										<td>
											<input type="checkbox" data-toggle="toggle" data-off="Disabled" data-on="Enabled" <?= $data->status_ppk == 1 ? 'checked' : '' ?> disabled>
											<small><label>Approved SPD oleh PPK</label></small>
											<br>
										</td>
										<td>
											<?php if ($data->status == '0') { ?>
												<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
												<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
												<br>
												<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
												<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
												<br>
												<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
												<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
											<?php } elseif ($data->status == '1') { ?>
												<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
												<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
												<br>
												<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
												<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
												<br>
												<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
												<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
											<?php } elseif ($data->status == '2') { ?>
												<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
												<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
												<br>
												<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
												<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
												<br>
												<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
												<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
											<?php } elseif ($data->status == '3') { ?>
												<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
												<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
												<br>
												<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
												<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
												<br>
												<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled">
												<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
											<?php } elseif ($data->status == '4') { ?>
												<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked disabled>
												<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
												<br>
												<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked disabled>
												<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
												<br>
												<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked>
												<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
											<?php } else {
												echo '<label><i class="badge badge-danger">SPD Dibatalkan</i></label>';
											} ?>
										</td>
									</tr>
									<!-- Modal Bayar -->
									<div class="modal fade" id="bayar<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi Pembayaran</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form action="<?= site_url('spd_admin/process') ?>" method="POST">
													<div class="modal-body">
														<input type="hidden" name="id" value="<?= $data->id ?>">
														<input type="hidden" name="status" value="4">
														<label>Ket. LS <sup class="text-danger">*</sup></label>
														<select name="ls" class="form-control" required>
															<option value="">-- Pilih --</option>
															<option value="LS BEND">LS BEND</option>
															<option value="LS KPPN">LS KPPN</option>
														</select><br>
														<label>Tanggal Pembayaran <sup class="text-danger">*</sup></label>
														<input type="date" name="tgl_bayar" class="form-control" required><br>
														<label>Ket. DIPA <sup class="text-danger">*</sup></label>
														<select name="dipa" class="form-control" required>
															<option value="">-- Pilih --</option>
															<option value="501">501</option>
															<option value="994">994</option>
														</select>
													</div>
													<div class="modal-footer">
														<button type="reset" class="btn btn-sm btn-secondary">Reset</button>
														<button type="submit" name="Bayar" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Simpan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modal-detail">
	<div class="modal-dialog modal-xl" style="overflow-y: initial !important">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail SPD</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body table-responsive" style="height: 450px;overflow-y: auto;">
				<table class="table table-bordered no-margin">
					<tbody>
						<tr>
							<th style="width: 25%">Nama PPK - Nip</th>
							<td colspan="3"><span id="nama_ppk"></span> - <span id="nip_ppk"></span> </td>
						</tr>
						<tr>
							<th>Nama Bendahara - Nip</th>
							<td colspan="3"><span id="nama_bendahara"></span> - <span id="nip_bendahara"></span></td>
						</tr>
						<tr>
							<th>No. SPD - Tgl SPD</th>
							<td colspan="3"><span id="no_spd"></span> - <span id="tgl_spd"></span></td>
						</tr>
						<tr>
							<th>Maksud</th>
							<td colspan="3"><span id="maksud"></span></td>
						</tr>
						<tr>
							<th>Kendaraan</th>
							<td colspan="3"><span id="kendaraan"></span></td>
						</tr>
						<tr>
							<th>Lamanya</th>
							<td colspan="3"><span id="lamanya"></span></td>
						</tr>
						<tr>
							<th>Tgl Berangkat - Tgl Selesai</th>
							<td colspan="3"><span id="tgl_berangkat"></span> - <span id="tgl_selesai"></span></td>
						</tr>
						<tr>
							<th>Tujuan</th>
							<td colspan="3">
								1. <span id="tujuan1"></span><br>
								2. <span id="tujuan2"></span><br>
								3. <span id="tujuan3"></span><br>
								4. <span id="tujuan4"></span>
							</td>
						</tr>
						<tr>
							<th>No. ST - Tgl ST</th>
							<td colspan="3"><span id="no_st"></span> - <span id="tgl_st"></span></td>
						</tr>
						<tr>
							<th>Uang Harian</th>
							<th>Jlh Hari</th>
							<th>Total Uang Harian</th>
							<th>Penyesuaian Uang Harian</th>
						</tr>
						<tr>
							<td>
								<span id="uang_harian"></span>
							</td>
							<td>
								<span id="jlh_hari"></span>
							</td>
							<td>
								<span id="total_uh"></span>
							</td>
							<td>
								<span id="penyesuaian_uh"></span>
							</td>
						</tr>
						<tr>
							<th>Uang Harian <sup>2</sup></th>
							<th>Jlh Hari <sup>2</sup></th>
							<th>Total Uang Harian <sup>2</sup></th>
							<th>Penyesuaian Uang Harian <sup>2</sup></th>
						</tr>
						<tr>
							<td>
								<span id="uang_harian2"></span>
							</td>
							<td>
								<span id="jlh_hari2"></span>
							</td>
							<td>
								<span id="total_uh2"></span>
							</td>
							<td>
								<span id="penyesuaian_uh2"></span>
							</td>
						</tr>
						<tr>
							<th>Grand Total Uang Harian</th>
							<td colspan="3"><span id="grand_total_uh"></span></td>
						</tr>
						<tr>
							<th>Biaya Transportasi Berangkat</th>
							<th>Biaya Transportasi Pulang</th>
							<th colspan="2">Total Biaya Transportasi</th>
						</tr>
						<tr>
							<td>
								<span id="by_transportasi_berangkat"></span>
							</td>
							<td>
								<span id="by_transportasi_pulang"></span>
							</td>
							<td colspan="2">
								<span id="total_by_transportasi"></span>
							</td>
						</tr>
						<tr>
							<th>Durasi Menginap</th>
							<th>Menginap Dari</th>
							<th>Menginap Sampai</th>
							<th>Tarif Penginapan</th>
						</tr>
						<tr>
							<td>
								<span id="durasi_menginap"></span>
							</td>
							<td>
								<span id="menginap_dari"></span>
							</td>
							<td>
								<span id="menginap_sampai"></span>
							</td>
							<td>
								<span id="tarif_penginapan"></span>
							</td>
						</tr>
						<tr>
							<th>Durasi Menginap <sup>2</sup></th>
							<th>Menginap Dari <sup>2</sup></th>
							<th>Menginap Sampai <sup>2</sup></th>
							<th>Tarif Penginapan <sup>2</sup></th>
						</tr>
						<tr>
							<td>
								<span id="durasi_menginap2"></span>
							</td>
							<td>
								<span id="menginap_dari2"></span>
							</td>
							<td>
								<span id="menginap_sampai2"></span>
							</td>
							<td>
								<span id="tarif_penginapan2"></span>
							</td>
						</tr>
						<tr>
							<th>Durasi Menginap <sup>3</sup></th>
							<th>Menginap Dari <sup>3</sup></th>
							<th>Menginap Sampai <sup>3</sup></th>
							<th>Tarif Penginapan <sup>3</sup></th>
						</tr>
						<tr>
							<td>
								<span id="durasi_menginap3"></span>
							</td>
							<td>
								<span id="menginap_dari3"></span>
							</td>
							<td>
								<span id="menginap_sampai3"></span>
							</td>
							<td>
								<span id="tarif_penginapan3"></span>
							</td>
						</tr>
						<tr>
							<th>Total Biaya Penginapan</th>
							<td colspan="3">
								<span id="total_by_penginapan"></span>
							</td>
						</tr>
						<tr>
							<th>Pengeluaran Riil</th>
							<td colspan="3">
								<span id="pengeluaran_riil"></span>
							</td>
						</tr>
						<tr>
							<th>Grand Total</th>
							<td colspan="3">
								<span id="grand_total"></span>
							</td>
						</tr>
						<tr>
							<th>Uang Muka</th>
							<td colspan="3">
								<span id="uang_muka"></span>
							</td>
						</tr>
						<tr>
							<th>Kartu Kredit</th>
							<td colspan="3">
								<span id="kredit"></span>
							</td>
						</tr>
						<tr>
							<th>Total Bayar</th>
							<td colspan="3">
								<span id="total_bayar"></span>
							</td>
						</tr>
						<tr>
							<th>Kurang/Lebih Bayar</th>
							<td colspan="3">
								<span id="kurang_lebih_bayar"></span>
							</td>
						</tr>
						<tr>
							<th>Laporan Pelaksanaan ST</th>
							<td colspan="3">
								<span id="isi_laporan"></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>