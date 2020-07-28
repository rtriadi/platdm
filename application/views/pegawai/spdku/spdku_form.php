<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">SPD</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= site_url('spdku') ?>">SPD</a></li>
						<li class="breadcrumb-item active">Rincian SPD</li>
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
							<h3 class="card-title">Data SPD-KU</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" action="" method="POST" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama</label>
											<h6><?= $row->nama ?> - <?= $row->nip ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Pangkat/Gol</label>
											<h6><?= $row->pangkat_gol ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Jabatan</label>
											<h6><?= $row->jabatan ?></h6>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama PPK</label>
											<h6><?= getNamaByNip($row->nip_ppk) ?> - <?= $row->nip_ppk ?></h6>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama Bendahara</label>
											<h6><?= getNamaByNip($row->nip_bendahara) ?> - <?= $row->nip_bendahara ?></h6>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>No. SPD</label>
											<h6><?= $row->no_spd ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tgl SPD</label>
											<h6><?= indo_date($row->tgl_spd) ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>No. Surat Tugas</label>
											<h6>
												<?= $format->format_awal ?><?= sprintf('%04d', $row->no_st); ?><?= $format->format_akhir ?>
											</h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tgl Surat Tugas</label>
											<h6><?= indo_date($row->tgl_st) ?></h6>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Maksud</label>
											<h6><?= $row->maksud ?></h6>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Kendaraan</label>
											<h6><?= $row->kendaraan ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Lamanya</label>
											<h6 id="lamanya"><?= $row->lamanya . ' Hari' ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tgl Berangkat</label><sup class='text-danger'>*</sup>
											<!-- <h6><?= indo_date($row->tgl_berangkat) ?></h6> -->
											<input id="tgl_berangkat" type="date" class="form-control <?= form_error('tgl_berangkat') ? "is-invalid" : null ?>" name="tgl_berangkat" value="<?= $this->input->post('tgl_berangkat') ?? $row->tgl_berangkat ?>" required>
											<?= form_error('tgl_berangkat') ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tgl Selesai</label><sup class='text-danger'>*</sup>
											<!-- <h6><?= indo_date($row->tgl_selesai) ?></h6> -->
											<input id="tgl_selesai" type="date" class="form-control <?= form_error('tgl_selesai') ? "is-invalid" : null ?>" name="tgl_selesai" value="<?= $this->input->post('tgl_selesai') ?? $row->tgl_selesai ?>" required>
											<?= form_error('tgl_selesai') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Tujuan 1</label>
											<h6><?= $row->tujuan1 != '' ? getCityById($row->tujuan1) : null ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tujuan 2</label>
											<h6><?= $row->tujuan2 != '' ? getCityById($row->tujuan2) : null ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tujuan 3</label>
											<h6><?= $row->tujuan3 != '' ? getCityById($row->tujuan3) : null ?></h6>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Tujuan 4</label>
											<h6><?= $row->tujuan4 != '' ? getCityById($row->tujuan4) : null ?></h6>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h2 class="card-title">Form Rincian SPD-KU</h2>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Uang Harian</label><sup class='text-danger'>*</sup>
											<input id="uang_harian" type="number" min=0 class="form-control <?= form_error('uang_harian') ? "is-invalid" : null ?>" name="uang_harian" value="<?= $this->input->post('uang_harian') ?? $row->uang_harian ?>" <?= $this->fungsi->user_login()->level != 1 ? 'readonly' : null ?>>
											<?= form_error('uang_harian') ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Jlh Hari</label><sup class='text-danger'>*</sup>
											<input id="jlh_hari" type="number" min=0 class="form-control <?= form_error('jlh_hari') ? "is-invalid" : null ?>" name="jlh_hari" value="<?= $this->input->post('jlh_hari') ?? $row->jlh_hari ?>" <?= $this->fungsi->user_login()->level != 1 ? 'readonly' : null ?>>
											<?= form_error('jlh_hari') ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Total UH</label><sup class='text-danger'>*</sup>
											<input id="total_uh" type="number" min=0 class="form-control <?= form_error('total_uh') ? "is-invalid" : null ?>" name="total_uh" value="<?= $this->input->post('total_uh') ?? $row->total_uh ?>" readonly>
											<?= form_error('total_uh') ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Penyesuaian UH (%)</label>
											<input id="penyesuaian_uh" type="number" min=0 class="form-control <?= form_error('penyesuaian_uh') ? "is-invalid" : null ?>" name="penyesuaian_uh" value="<?= $this->input->post('penyesuaian_uh') ?? $row->penyesuaian_uh ?>" <?= $this->fungsi->user_login()->level != 1 ? 'readonly' : null ?>>
											<?= form_error('penyesuaian_uh') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Uang Harian <sup>2</sup></label>
											<input id="uang_harian2" type="number" min=0 class="form-control <?= form_error('uang_harian2') ? "is-invalid" : null ?>" name="uang_harian2" value="<?= $this->input->post('uang_harian2') ?? $row->uang_harian2 ?>" <?= $this->fungsi->user_login()->level != 1 ? 'readonly' : null ?>>
											<?= form_error('uang_harian2') ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Jlh Hari <sup>2</sup></label>
											<input id="jlh_hari2" type="number" min=0 class="form-control <?= form_error('jlh_hari2') ? "is-invalid" : null ?>" name="jlh_hari2" value="<?= $this->input->post('jlh_hari2') ?? $row->jlh_hari2 ?>" <?= $this->fungsi->user_login()->level != 1 ? 'readonly' : null ?>>
											<?= form_error('jlh_hari2') ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Total UH <sup>2</sup></label>
											<input id="total_uh2" type="number" min=0 class="form-control <?= form_error('total_uh2') ? "is-invalid" : null ?>" name="total_uh2" value="<?= $this->input->post('total_uh2') ?? $row->total_uh2 ?>" readonly>
											<?= form_error('total_uh2') ?>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Penyesuaian UH <sup>2</sup> (%)</label>
											<input id="penyesuaian_uh2" type="number" min=0 class="form-control <?= form_error('penyesuaian_uh2') ? "is-invalid" : null ?>" name="penyesuaian_uh2" value="<?= $this->input->post('penyesuaian_uh2') ?? $row->penyesuaian_uh2 ?>" <?= $this->fungsi->user_login()->level != 1 ? 'readonly' : null ?>>
											<?= form_error('penyesuaian_uh2') ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Grand Total UH</label>
											<input id="grand_total_uh" type="number" min=0 class="form-control <?= form_error('grand_total_uh') ? "is-invalid" : null ?>" name="grand_total_uh" value="<?= $this->input->post('grand_total_uh') ?? $row->grand_total_uh ?>" readonly>
											<?= form_error('grand_total_uh') ?>
										</div>
									</div>
								</div>
								
							<div class="row">
							    <div class="col-md-12">
							        <hr>
							        <h5 class="text-bold">Biaya Transport</h5>
							    </div>
								<div class="col-md-4 mt-2">
									<div class="form-group">
										<label>Biaya Transportasi Berangkat</label>
										<input type="hidden" class="form-control" name="id" value="<?= $row->id ?>" required>
										<input id="by_transportasi_berangkat" type="number" min=0 class="form-control <?= form_error('by_transportasi_berangkat') ? "is-invalid" : null ?>" name="by_transportasi_berangkat" value="<?= $this->input->post('by_transportasi_berangkat') ?? $row->by_transportasi_berangkat ?>">
										<?= form_error('by_transportasi_berangkat') ?>
									</div>
								</div>
								<div class="col-md-4 mt-2">
									<div class="form-group">
										<label>Biaya Transportasi Pulang</label>
										<input id="by_transportasi_pulang" type="number" min=0 class="form-control <?= form_error('by_transportasi_pulang') ? "is-invalid" : null ?>" name="by_transportasi_pulang" value="<?= $this->input->post('by_transportasi_pulang') ?? $row->by_transportasi_pulang ?>">
										<?= form_error('by_transportasi_pulang') ?>
									</div>
								</div>
								<div class="col-md-4 mt-2">
									<div class="form-group">
										<label>Total Biaya Transportasi</label>
										<input id="total_by_transportasi" type="number" min=0 class="form-control <?= form_error('total_by_transportasi') ? "is-invalid" : null ?>" name="total_by_transportasi" value="<?= $this->input->post('total_by_transportasi') ?? $row->total_by_transportasi ?>" readonly>
										<?= form_error('total_by_transportasi') ?>
									</div>
								</div>
							</div>
							<div class="row">
							    <div class="col-md-12 mt-2">
							        <hr>
							        <h5 class="text-bold">Biaya Penginapan</h5>
							    </div>
								<div class="col-md-3 mt-2">
									<div class="form-group">
										<label>Durasi Menginap</label>
										<input id="durasi_menginap" type="number" min=0 class="form-control <?= form_error('durasi_menginap') ? "is-invalid" : null ?>" name="durasi_menginap" value="<?= $this->input->post('durasi_menginap') ?? $row->durasi_menginap ?>">
										<?= form_error('durasi_menginap') ?>
									</div>
								</div>
								<div class="col-md-3 mt-2">
									<div class="form-group">
										<label>Menginap Dari</label>
										<input id="menginap_dari" type="date" class="form-control <?= form_error('menginap_dari') ? "is-invalid" : null ?>" name="menginap_dari" value="<?= $this->input->post('menginap_dari') ?? $row->menginap_dari ?>">
										<?= form_error('menginap_dari') ?>
									</div>
								</div>
								<div class="col-md-3 mt-2">
									<div class="form-group">
										<label>Menginap Sampai</label>
										<input id="menginap_sampai" type="date" class="form-control <?= form_error('menginap_sampai') ? "is-invalid" : null ?>" name="menginap_sampai" value="<?= $this->input->post('menginap_sampai') ?? $row->menginap_sampai ?>">
										<?= form_error('menginap_sampai') ?>
									</div>
								</div>
								<div class="col-md-3 mt-2">
									<div class="form-group">
										<label>Tarif Penginapan</label>
										<input id="tarif_penginapan" type="number" min=0 max="<?= $cek_penginapan != null ? $cek_penginapan->nominal : null ?>" class="form-control <?= form_error('tarif_penginapan') ? "is-invalid" : null ?>" name="tarif_penginapan" value="<?= $this->input->post('tarif_penginapan') ?? $row->tarif_penginapan ?>">
										<?= form_error('tarif_penginapan') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Durasi Menginap <sup>2</sup></label>
										<input id="durasi_menginap2" type="number" min=0 class="form-control <?= form_error('durasi_menginap2') ? "is-invalid" : null ?>" name="durasi_menginap2" value="<?= $this->input->post('durasi_menginap2') ?? $row->durasi_menginap2 ?>">
										<?= form_error('durasi_menginap2') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Menginap Dari <sup>2</sup></label>
										<input id="menginap_dari2" type="date" class="form-control <?= form_error('menginap_dari2') ? "is-invalid" : null ?>" name="menginap_dari2" value="<?= $this->input->post('menginap_dari2') ?? $row->menginap_dari2 ?>">
										<?= form_error('menginap_dari2') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Menginap Sampai <sup>2</sup></label>
										<input id="menginap_sampai2" type="date" class="form-control <?= form_error('menginap_sampai2') ? "is-invalid" : null ?>" name="menginap_sampai2" value="<?= $this->input->post('menginap_sampai2') ?? $row->menginap_sampai2 ?>">
										<?= form_error('menginap_sampai2') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Tarif Penginapan <sup>2</sup></label>
										<input id="tarif_penginapan2" type="number" min=0 max="<?= $cek_penginapan != null ? $cek_penginapan->nominal : null ?>" class="form-control <?= form_error('tarif_penginapan2') ? "is-invalid" : null ?>" name="tarif_penginapan2" value="<?= $this->input->post('tarif_penginapan2') ?? $row->tarif_penginapan2 ?>">
										<?= form_error('tarif_penginapan2') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Durasi Menginap <sup>3</sup></label>
										<input id="durasi_menginap3" type="number" min=0 class="form-control <?= form_error('durasi_menginap3') ? "is-invalid" : null ?>" name="durasi_menginap3" value="<?= $this->input->post('durasi_menginap3') ?? $row->durasi_menginap3 ?>">
										<?= form_error('durasi_menginap3') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Menginap Dari <sup>3</sup></label>
										<input id="menginap_dari3" type="date" class="form-control <?= form_error('menginap_dari3') ? "is-invalid" : null ?>" name="menginap_dari3" value="<?= $this->input->post('menginap_dari3') ?? $row->menginap_dari3 ?>">
										<?= form_error('menginap_dari3') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Menginap Sampai <sup>3</sup></label>
										<input id="menginap_sampai3" type="date" class="form-control <?= form_error('menginap_sampai3') ? "is-invalid" : null ?>" name="menginap_sampai3" value="<?= $this->input->post('menginap_sampai3') ?? $row->menginap_sampai3 ?>">
										<?= form_error('menginap_sampai3') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Tarif Penginapan <sup>3</sup></label>
										<input id="tarif_penginapan3" type="number" min=0 max="<?= $cek_penginapan != null ? $cek_penginapan->nominal : null ?>" class="form-control <?= form_error('tarif_penginapan3') ? "is-invalid" : null ?>" name="tarif_penginapan3" value="<?= $this->input->post('tarif_penginapan3') ?? $row->tarif_penginapan3 ?>">
										<?= form_error('tarif_penginapan3') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Total Biaya Penginapan</label>
										<input id="total_by_penginapan" type="number" min=0 class="form-control <?= form_error('total_by_penginapan') ? "is-invalid" : null ?>" name="total_by_penginapan" value="<?= $this->input->post('total_by_penginapan') ?? $row->total_by_penginapan ?>" readonly>
										<?= form_error('total_by_penginapan') ?>
									</div>
								</div>
							</div>
							<div class="row">
							    <div class="col-md-12 mt-2">
							        <hr>
							        <h5 class="text-bold">Biaya Pengeluaran Riil</h5>
							    </div>
								<div class="col-md-7 mt-2">
									<div class="form-group">
										<label>Biaya transportasi dari kantor ke bandara djalaluddin</label>
										<input id="pengeluaran1" type="number" min=0 max="150000" class="form-control <?= form_error('pengeluaran1') ? "is-invalid" : null ?>" name="pengeluaran1" value="<?= $this->input->post('pengeluaran1') ?? $row->pengeluaran1 ?>">
										<?= form_error('pengeluaran1') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label>Biaya transportasi dari bandara kota tujuan ke tempat menginap / tempat tujuan</label>
										<input id="pengeluaran2" type="number" min=0 max="<?= $cek_biaya_taxi != null ? $cek_biaya_taxi->besaran : null ?>" class="form-control <?= form_error('pengeluaran2') ? "is-invalid" : null ?>" name="pengeluaran2" value="<?= $this->input->post('pengeluaran2') ?? $row->pengeluaran2 ?>">
										<?= form_error('pengeluaran2') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label>Biaya transportasi dari tempat menginap / tempat tujuan ke bandara kota tujuan</label>
										<input id="pengeluaran3" type="number" min=0 max="<?= $cek_biaya_taxi != null ? $cek_biaya_taxi->besaran : null ?>" class="form-control <?= form_error('pengeluaran3') ? "is-invalid" : null ?>" name="pengeluaran3" value="<?= $this->input->post('pengeluaran3') ?? $row->pengeluaran3 ?>">
										<?= form_error('pengeluaran3') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label>Biaya transportasi dari bandara djalaluddin ke tempat tinggal</label>
										<input id="pengeluaran4" type="number" min=0 max="150000" class="form-control <?= form_error('pengeluaran4') ? "is-invalid" : null ?>" name="pengeluaran4" value="<?= $this->input->post('pengeluaran4') ?? $row->pengeluaran4 ?>">
										<?= form_error('pengeluaran4') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-7">
									<div class="form-group">
										<label>Total Pengeluaran Riil</label>
										<input id="pengeluaran_riil" type="number" min=0 class="form-control <?= form_error('pengeluaran_riil') ? "is-invalid" : null ?>" name="pengeluaran_riil" value="<?= $this->input->post('pengeluaran_riil') ?? $row->pengeluaran_riil ?>" readonly>
										<?= form_error('pengeluaran_riil') ?>
									</div>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-md-3">
									<div class="form-group">
										<label>Grand Total</label>
										<input id="grand_total" type="number" min=0 class="form-control <?= form_error('grand_total') ? "is-invalid" : null ?>" name="grand_total" value="<?= $this->input->post('grand_total') ?? $row->grand_total ?>" readonly>
										<?= form_error('grand_total') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Uang Muka</label>
										<input id="uang_muka" type="number" min=0 class="form-control <?= form_error('uang_muka') ? "is-invalid" : null ?>" name="uang_muka" value="<?= $this->input->post('uang_muka') ?? $row->uang_muka ?>">
										<?= form_error('uang_muka') ?>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Kredit</label>
										<input id="kredit" type="number" min=0 class="form-control <?= form_error('kredit') ? "is-invalid" : null ?>" name="kredit" value="<?= $this->input->post('kredit') ?? $row->kredit ?>">
										<?= form_error('kredit') ?>
										<small class="text-danger">*pertama klik form ini</small>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Total Bayar</label>
										<input id="total_bayar" type="number" min=0 class="form-control <?= form_error('total_bayar') ? "is-invalid" : null ?>" name="total_bayar" value="<?= $this->input->post('total_bayar') ?? $row->total_bayar ?>" readonly>
										<?= form_error('total_bayar') ?>
										<small class="text-danger">*kedua klik form ini</small>
									</div>
								</div>
							</div>
							<!--<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Upload Kuitansi</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" name="kuitansi">-->
												<input type="hidden" class="custom-file-input" name="kuitansi">
												<!--<label class="custom-file-label">Choose File (*pdf)</label>
											</div>
										</div>
										<small class='text-danger'>* Biarkan kosong jika tidak ada</small>
									</div>
								</div>
							</div>-->
							<div class="row">
							    <div class="col-md-12 mt-2">
							        <hr>
							        <h5 class="text-bold">Laporan Pelaksanaan Tugas</h5>
							    </div>
								<div class="col-md-12 mt-2">
									<div class="form-group">
										<label>Atasan</label><sup class='text-danger'>*</sup>
										<select class="form-control select2 <?= form_error('nip_atasan') ? "is-invalid" : null ?>" name="nip_atasan" required>
											<option value="">-Pilih Atasan-</option>
											<?php foreach ($pegawai->result() as $key) : ?>
												<option value="<?= $key->nip ?>" <?= $key->nip == $row->nip_atasan ? 'selected' : '' ?>><?= $key->nama ?> - <?= $key->jabatan ?></option>
											<?php endforeach ?>
										</select>
										<?= form_error('nip_atasan') ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Laporan Pelaksanaan ST</label><sup class='text-danger'>*</sup>
										<textarea id="isi_laporan" class="form-control textarea <?= form_error('isi_laporan') ? "is-invalid" : null ?>" name="isi_laporan" required>
											<?= $this->input->post('isi_laporan') ?? $row->isi_laporan ?>
										</textarea>
										<?= form_error('isi_laporan') ?>
									</div>
								</div>
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
						<hr>
							<div style="float: left">
								<button type="submit" class="btn btn-success" onclick="return confirm('Update SPD ?');">Update SPD</button>
								<small class="text-danger">*agar Total Bayar terupdate, sebelum klik tombol UPDATE SPD, klik terlebih dahulu form Kredit, kemudian klik form Total Bayar</small>
							</div><div style="float: right">
								
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
