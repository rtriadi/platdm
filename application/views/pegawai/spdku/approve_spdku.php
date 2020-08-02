<?php error_reporting(0) ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Approve SPD</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Approve SPD</li>
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
							<h3 class="card-title">Approve SPD</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive">
							<table id="example1" class="table table-bordered">
								<thead>
									<tr>
										<th>No.</th>
										<th>Tgl SPD</th>
										<th>No. SPD</th>
										<th>Maksud</th>
										<th width="13% !important">Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $num = 1;
									foreach ($row->result() as $key => $data) : ?>
										<tr>
											<td><?= $num++ ?></td>
											<td><?= indo_date($data->tgl_spd) ?></td>
											<td><?= $data->no_spd ?></td>
											<td><?= $data->maksud ?></td>
											<td>
												<?php if ($data->status == '0') { ?>
													<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" disabled>
													<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
													<br>
													<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" disabled>
													<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
													<br>
													<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" disabled>
													<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
												<?php } elseif ($data->status == '1') { ?>
													<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked disabled>
													<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
													<br>
													<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" disabled>
													<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
													<br>
													<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" disabled>
													<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
												<?php } elseif ($data->status == '2') { ?>
													<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked disabled>
													<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
													<br>
													<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked disabled>
													<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
													<br>
													<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" disabled>
													<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
												<?php } elseif ($data->status == '3') { ?>
													<input type="checkbox" name="toggle4" id="toggle4_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked disabled>
													<small><label for="toggle4_<?php echo $data->id; ?>">Berkas Diterima</label></small>
													<br>
													<input type="checkbox" name="toggle5" id="toggle5_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" checked disabled>
													<small><label for="toggle5_<?php echo $data->id; ?>">OK</label></small>
													<br>
													<input type="checkbox" name="toggle7" id="toggle7_<?php echo $data->id; ?>" value="<?php echo $data->id; ?>" data-toggle="toggle" data-off="Disabled" data-on="Enabled" disabled>
													<small><label for="toggle7_<?php echo $data->id; ?>">Telah Bayar</label></small>
												<?php } elseif ($data->status == '4') { ?>
													<label><i class="badge badge-success"><?= $data->ls ?> <br> <?= indo_date($data->tgl_bayar) ?> <br> <?= $data->dipa ?></i></label>
												<?php } else {
													echo '<label><i class="badge badge-danger">SPD Dibatalkan</i></label>';
												} ?>
											</td>
											<td align="center">
												<div class="btn-group">
													<a id="set_dtl" class="btn btn-sm btn-default" rel="tooltip" data-placement="top" title="Detail SPD" data-toggle="modal" data-target="#modal-detail<?= $data->id ?>" data-nama_ppk="<?= getNamaByNip($data->nip_ppk) ?>" data-nip_ppk="<?= $data->nip_ppk ?>" data-nama_bendahara="<?= getNamaByNip($data->nip_bendahara) ?>" data-nip_bendahara="<?= $data->nip_bendahara ?>" data-no_spd="<?= $data->no_spd ?>" data-tgl_spd="<?= indo_date($data->tgl_spd) ?>" data-maksud="<?= $data->maksud ?>" data-kendaraan="<?= $data->kendaraan ?>" data-lamanya="<?= $data->lamanya . ' Hari' ?>" data-tgl_berangkat="<?= tgl_ind($data->tgl_berangkat) ?>" data-tujuan1="<?= $data->tujuan1 != '' ? getCityById($data->tujuan1) : null ?>" data-tujuan2="<?= $data->tujuan2 != '' ? getCityById($data->tujuan2) : null ?>" data-tujuan3="<?= $data->tujuan3 != '' ? getCityById($data->tujuan3) : null ?>" data-tujuan4="<?= $data->tujuan4 != '' ? getCityById($data->tujuan4) : null ?>" data-tgl_selesai="<?= tgl_ind($data->tgl_selesai) ?>" data-no_st="<?= $format->format_awal ?><?= sprintf('%04d', $data->no_st); ?><?= $format->format_akhir ?>" data-tgl_st="<?= indo_date($data->tgl_st) ?>" data-uang_harian="<?= indo_currency($data->uang_harian) ?>" data-jlh_hari="<?= $data->jlh_hari ?>" data-total_uh="<?= indo_currency($data->total_uh) ?>" data-penyesuaian_uh="<?= $data->penyesuaian_uh ?>%" data-uang_harian2="<?= indo_currency($data->uang_harian2) ?>" data-jlh_hari2="<?= $data->jlh_hari2 ?>" data-total_uh2="<?= indo_currency($data->total_uh2) ?>" data-penyesuaian_uh2="<?= $data->penyesuaian_uh2 ?>%" data-grand_total_uh="<?= indo_currency($data->grand_total_uh) ?>" data-by_transportasi_berangkat="<?= indo_currency($data->by_transportasi_berangkat) ?>" data-by_transportasi_pulang="<?= indo_currency($data->by_transportasi_pulang) ?>" data-total_by_transportasi="<?= indo_currency($data->total_by_transportasi) ?>" data-durasi_menginap="<?= $data->durasi_menginap ?>" data-menginap_dari="<?= indo_date($data->menginap_dari) ?>" data-menginap_sampai="<?= indo_date($data->menginap_sampai) ?>" data-tarif_penginapan="<?= indo_currency($data->tarif_penginapan) ?>" data-durasi_menginap2="<?= $data->durasi_menginap2 ?>" data-menginap_dari2="<?= indo_date($data->menginap_dari2) ?>" data-menginap_sampai2="<?= indo_date($data->menginap_sampai2) ?>" data-tarif_penginapan2="<?= indo_currency($data->tarif_penginapan2) ?>" data-durasi_menginap3="<?= $data->durasi_menginap3 ?>" data-menginap_dari3="<?= indo_date($data->menginap_dari3) ?>" data-menginap_sampai3="<?= indo_date($data->menginap_sampai3) ?>" data-tarif_penginapan3="<?= indo_currency($data->tarif_penginapan3) ?>" data-total_by_penginapan="<?= indo_currency($data->total_by_penginapan) ?>" data-pengeluaran_riil="<?= indo_currency($data->pengeluaran_riil) ?>" data-total_biaya_spd="<?= indo_currency($data->total_biaya_spd) ?>" data-grand_total="<?= indo_currency($data->grand_total) ?>" data-uang_muka="<?= indo_currency($data->uang_muka) ?>" data-kredit="<?= indo_currency($data->kredit) ?>" data-total_bayar="<?= indo_currency($data->total_bayar) ?>" data-kurang_lebih_bayar="<?= indo_currency($data->kurang_lebih_bayar) ?>" data-status="<?= $data->status ?>" data-ket="<?= $data->ket ?>" data-dipa="<?= $data->dipa ?>" data-isi_laporan="<?= strip_tags($data->isi_laporan) ?>">
														<i class="fa fa-info-circle"></i>
													</a>
													<form action="" method="post">
														<input type="hidden" name="id" value="<?= $data->id ?>">
														<button type="submit" class="btn btn-sm btn-success" name="approve" rel="tooltip" data-placement="top" title="Approve SPD" onclick="return confirm('Approve data ini?')"><i class="fa fa-check"></i></button>
													</form>
												</div>
												<div class="modal fade" id="modal-detail<?= $data->id ?>">
													<div class="modal-dialog modal-xl" style="overflow-y: initial">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Detail SPD</h4>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body table-responsive" style="height: 500px; overflow-y: auto;">

																<table id="example1" class="table table-condensed">
																	<tr align="center">
																		<th colspan="3">RINCIAN BIAYA PERJALANAN DINAS</th>
																	</tr>
																	<tr>
																		<td width="20%">Lampiran SPD Nomor</td>
																		<td colspan="2">: <span><?= $data->no_spd ?></span></td>
																	</tr>
																	<tr>
																		<td>Tanggal</td>
																		<td colspan="2">: <span><?= tgl_ind($data->tgl_spd) ?></span></td>
																	</tr>
																</table>
																<table id="example1" class="table table-condensed">
																	<thead align="center">
																		<th>NO</th>
																		<th colspan="2">PERINCIAN BIAYA</th>
																		<th>NOMINAL YANG DIAJUKAN</th>
																		<th>NOMINAL YANG DISETUJUI</th>
																		<th>KETERANGAN</th>
																	</thead>
																	<tbody>
																		<tr>
																			<td align="center">1</td>
																			<td width="20%">
																				Uang Harian<br>
																				Perjalanan Dinas ke<br>
																				dari tanggal<br>
																				selama
																			</td>
																			<td>
																				<br>
																				<span><?= getCityById($data->tujuan1) ?></span>
																				<span><?= $data->tujuan2 != null ? ', ' . getCityById($data->tujuan2) : '' ?></span>
																				<span><?= $data->tujuan3 != null ? ', ' . getCityById($data->tujuan3) : '' ?></span>
																				<span><?= $data->tujuan4 != null ? ', ' . getCityById($data->tujuan4) : '' ?></span>
																				<br>
																				<span id="tgl_berangkat"><?= tgl_ind($data->tgl_berangkat) ?></span> s/d <span id="tgl_selesai"><?= tgl_ind($data->tgl_selesai) ?></span><br>
																				<span id="lamanya"><?= $data->lamanya . ' Hari' ?></span>
																			</td>
																			<td><span><?= getSPDpegawaiById($data->id)->grand_total_uh != null ? indo_currency(getSPDpegawaiById($data->id)->grand_total_uh) : '' ?></span></td>
																			<td><span id="grand_total_uh"><?= indo_currency($data->grand_total_uh) ?></span></td>
																			<td></td>
																		</tr>
																		<tr>
																			<td align="center">2</td>
																			<td>
																				Biaya transportasi pegawai<br>
																				Angkutan Darat<br>
																				Gorontalo<br>
																				PP.<br>
																			</td>
																			<td>
																				<br><br>
																				- <span><?= getCityById($data->tujuan1) ?></span>
																				<span><?= $data->tujuan2 != null ? ', ' . getCityById($data->tujuan2) : '' ?></span>
																				<span><?= $data->tujuan3 != null ? ', ' . getCityById($data->tujuan3) : '' ?></span>
																				<span><?= $data->tujuan4 != null ? ', ' . getCityById($data->tujuan4) : '' ?></span>
																				<br>
																				<span><?= $data->total_by_transportasi != null ? indo_currency($data->total_by_transportasi) : '' ?></span>
																			</td>
																			<td><span><?= getSPDpegawaiById($data->id)->total_by_transportasi != null ? indo_currency(getSPDpegawaiById($data->id)->total_by_transportasi) : '' ?></span></td>
																			<td><span id="total_by_transportasi"><?= indo_currency($data->total_by_transportasi) ?></span></td>
																			<td></td>
																		</tr>
																		<tr>
																			<td align="center">3</td>
																			<td>
																				Biaya Pengeluaran Riil
																			</td>
																			<td></td>
																			<td><span><?= getSPDpegawaiById($data->id)->pengeluaran_riil != null ? indo_currency(getSPDpegawaiById($data->id)->pengeluaran_riil) : '' ?></span></td>
																			<td><span id="pengeluaran_riil"><?= indo_currency($data->pengeluaran_riil) ?></span></td>
																			<td></td>
																		</tr>
																		<tr>
																			<td align="center">4</td>
																			<td>
																				Biaya Penginapan<br>
																				- dari tanggal<br>
																				selama
																			</td>
																			<td>
																				<br>
																				<span><?= $data->menginap_dari != null ? tgl_ind($data->menginap_dari) : '' ?></span> s/d <span><?= $data->menginap_sampai != null ? tgl_ind($data->menginap_sampai) : '' ?></span>
																				<br>
																				<span id="durasi_menginap"></span> Malam @ <span id="tarif_penginapan"></span><br>
																				<?= $data->durasi_menginap2 != null ? $data->durasi_menginap2 . ' Malam @ ' . indo_currency($data->tarif_penginapan2) : '' ?></span>
																				<br>
																				<?= $data->durasi_menginap3 != null ? $data->durasi_menginap3 . ' Malam @ ' . indo_currency($data->tarif_penginapan3) : '' ?></span>
																				<br>
																			</td>
																			<td>
																				<br>
																				<span><?= getSPDpegawaiById($data->id)->total_by_penginapan != null ? indo_currency(getSPDpegawaiById($data->id)->total_by_penginapan) : '' ?></span>
																			</td>
																			<td>
																				<br>
																				<span id="total_by_penginapan"><?= indo_currency($data->total_by_penginapan) ?></span>
																			</td>
																			<td></td>
																		</tr>
																		<tr>
																			<td align="center">5</td>
																			<td>Uang Muka</td>
																			<td></td>
																			<td><span><?= getSPDpegawaiById($data->id)->uang_muka != null ? indo_currency(getSPDpegawaiById($data->id)->uang_muka) : '' ?></span></td>
																			<td><span id="uang_muka"><?= indo_currency($data->uang_muka) ?></td>
																			<td></td>
																		</tr>
																		<tr>
																			<td align="center">6</td>
																			<td>Kartu Kredit</td>
																			<td></td>
																			<td><span><?= getSPDpegawaiById($data->id)->kredit != null ? indo_currency(getSPDpegawaiById($data->id)->kredit) : '' ?></span></td>
																			<td><span id="kredit"><?= indo_currency($data->kredit) ?></td>
																			<td></td>
																		</tr>
																		<tr>
																			<th colspan="3">JUMLAH (1 + 2 + 3 + 4 - 5 - 6)</th>
																			<th><span><?= getSPDpegawaiById($data->id)->total_bayar != null ? indo_currency(getSPDpegawaiById($data->id)->total_bayar) : '' ?></span></th>
																			<th><span id="total_bayar"><?= indo_currency($data->total_bayar) ?></span></th>
																			<td></td>
																		</tr>
																	</tbody>
																</table>
																<table class="table table-condensed">
																	<tr>
																		<th>LAPORAN PELAKSANAAN TUGAS</th>
																	</tr>
																	<tr>
																		<td><?= $data->isi_laporan ?></td>
																	</tr>
																</table>
															</div>
														</div>
														<!-- /.modal-content -->
													</div>
													<!-- /.modal-dialog -->
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