<div class="card">
	<div class="card-body">
		<?php if ($gaji->num_rows() > 0) : ?>
			<div class="row">
				<div class="col-md-1">

				</div>
				<div class="col-md-10 table-responsive">
					<table class="" align="center">
						<tr align="center">
							<td width="15%"><img src="<?= site_url('assets/img/logo.png') ?>" class="img img-responsive mt-3" width="100%"></td>
							<td>
								<b><h6>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h6>
								<h6>DIREKTORAT JENDERAL PAJAK</h6>
								<h6>KANTOR WILAYAH DJP SULAWESI UTARA, TENGAH, GORONTALO DAN MALUKU UTARA</h6>
								<h5>KANTOR PELAYANAN PAJAK PRATAMA GORONTALO</h5>
								<small>JALAN ARIF RAHMAN HAKIM NO.34, GORONTALO, </small><br>
								<small>TELEPON (0435) 830010, FAKSIMILE (0435) 830009, WEBSITE : www.pajak.go.id</small></b>
							</td>
							<td width="10%"></td>
						</tr>
					</table>
				</div>
				<div class="col-md-1">

				</div>
			</div>
			<hr style="border: 1px solid black;" width="83%">
			<div class="row">
				<div class="col-md-1">

				</div>
				<div class="col-md-10 table-responsive">
					<table class="table table-borderless" align="center">
						<tr align="center">
							<td>
								<h5><b>RINCIAN PENGHASILAN</b></h5>
								<h5><b>BULAN <?= strtoupper($bln) ?></b></h5>
								<h5><b>TAHUN <?= $thn ?></b></h5>
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-1">

				</div>
			</div>
			<div class="row">
				<div class="col-md-1">

				</div>
				<div class="col-md-10 table-responsive">
					<table class="table table-condensed" border="0px" width="100%" align="center">
						<tr>
							<td width="30%" colspan="5"><b>NAMA</b></td>
							<td width="1px"><b>:</b> </td>
							<td><b><?= strtoupper($gaji->row()->nama) ?></b></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="5"><b>NIP</b></td>
							<td><b>:</b> </td>
							<td><b><?= $gaji->row()->nip ?></b></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="5"><b>GRADE</b></td>
							<td><b>:</b> </td>
							<td><b><?= $potongan_tukin != null ? $potongan_tukin->grade : '-' ?></b></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="5"><b>PERSENTASE PEMBERIAN TUKIN</b></td>
							<td><b>:</b> </td>
							<td><b><?= $potongan_tukin != null ? $potongan_tukin->persentase_pemberian_tukin : '0' ?>%</b></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2" align="center">I. </td>
							<td colspan="3">GAJI BERSIH</td>
							<td>: </td>
							<td></td>
							<td><b><?= indo_currency($gaji->row()->gaji) ?></b></td>
						</tr>
						<tr>
							<td colspan="2" align="center">II. </td>
							<td colspan="3">TUKIN</td>
							<td colspan="3">: </td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>1. </td>
							<td colspan="2">Tukin Kotor</td>
							<td>: </td>
							<td id="tukin_kotor"><?= $potongan_tukin != null ? indo_currency($potongan_tukin->tukin_kotor) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>2. </td>
							<td colspan="2">Tambahan Lain<small> (1)</small></td>
							<td>: </td>
							<td id="tambahan_lain"><?= $potongan_tukin != null ? indo_currency($potongan_tukin->tambahan_lain) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>3. </td>
							<td colspan="2">Potongan-Potongan</td>
							<td colspan="3">: </td>
						</tr>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->absensi != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Absensi</td>
									<td>: </td>
									<td id="absensi"><?= $potongan_tukin->absensi != '' ? indo_currency($potongan_tukin->absensi) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->tinelo != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Tinelo</td>
									<td>: </td>
									<td id="tinelo"><?= $potongan_tukin->tinelo != '' ? indo_currency($potongan_tukin->tinelo) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->asuransi_kolektif != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Asuransi</td>
									<td>: </td>
									<td id="asuransi_kolektif"><?= $potongan_tukin->asuransi_kolektif != '' ? indo_currency($potongan_tukin->asuransi_kolektif) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->futsal != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Futsal</td>
									<td>: </td>
									<td id="futsal"><?= $potongan_tukin->futsal != '' ? indo_currency($potongan_tukin->futsal) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->prodip_manado != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Prodip Manado</td>
									<td>: </td>
									<td id="prodip_manado"><?= $potongan_tukin->prodip_manado != '' ? indo_currency($potongan_tukin->prodip_manado) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->panti != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Panti</td>
									<td>: </td>
									<td id="panti"><?= $potongan_tukin->panti != '' ? indo_currency($potongan_tukin->panti) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->yayasan != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Yayasan</td>
									<td>: </td>
									<td id="yayasan"><?= $potongan_tukin->yayasan != '' ? indo_currency($potongan_tukin->yayasan) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->pinogu != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Pinogu</td>
									<td>: </td>
									<td id="pinogu"><?= $potongan_tukin->pinogu != '' ? indo_currency($potongan_tukin->pinogu) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->forum_ar != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Forum AR</td>
									<td>: </td>
									<td id="forum_ar"><?= $potongan_tukin->forum_ar != '' ? indo_currency($potongan_tukin->forum_ar) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->uang_makan_forum_ar != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Uang Makan Forum AR</td>
									<td>: </td>
									<td id="uang_makan_forum_ar"><?= $potongan_tukin->uang_makan_forum_ar != '' ? indo_currency($potongan_tukin->uang_makan_forum_ar) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->pas != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>PAS</td>
									<td>: </td>
									<td id="pas"><?= $potongan_tukin->pas != '' ? indo_currency($potongan_tukin->pas) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->cbb != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>CBB</td>
									<td>: </td>
									<td id="cbb"><?= $potongan_tukin->cbb != '' ? indo_currency($potongan_tukin->cbb) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_oikumene != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Oikumene</td>
									<td>: </td>
									<td id="iuran_oikumene"><?= $potongan_tukin->iuran_oikumene != '' ? indo_currency($potongan_tukin->iuran_oikumene) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_kasi != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Iuran Kepala Seksi</td>
									<td>: </td>
									<td id="iuran_kasi"><?= $potongan_tukin->iuran_kasi != '' ? indo_currency($potongan_tukin->iuran_kasi) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->mushola != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Musholla</td>
									<td>: </td>
									<td id="mushola"><?= $potongan_tukin->mushola != '' ? indo_currency($potongan_tukin->mushola) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->kurban != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Kurban</td>
									<td>: </td>
									<td id="kurban"><?= $potongan_tukin->kurban != '' ? indo_currency($potongan_tukin->kurban) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->rumah_dinas != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Rumah Dinas</td>
									<td>: </td>
									<td id="rumah_dinas"><?= $potongan_tukin->rumah_dinas != '' ? indo_currency($potongan_tukin->rumah_dinas) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->mess_inul_vista != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Mess Inul Vista</td>
									<td>: </td>
									<td id="mess_inul_vista"><?= $potongan_tukin->mess_inul_vista != '' ? indo_currency($potongan_tukin->mess_inul_vista) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->mess_cinta != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Mess Karsa</td>
									<td>: </td>
									<td id="mess_cinta"><?= $potongan_tukin->mess_cinta != '' ? indo_currency($potongan_tukin->mess_cinta) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->suki != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>SUKI</td>
									<td>: </td>
									<td id="suki"><?= $potongan_tukin->suki != '' ? indo_currency($potongan_tukin->suki) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->pdi != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>PDI</td>
									<td>: </td>
									<td id="pdi"><?= $potongan_tukin->pdi != '' ? indo_currency($potongan_tukin->pdi) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_waskon_1 != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Waskon I</td>
									<td>: </td>
									<td id="iuran_seksi_waskon_1"><?= $potongan_tukin->iuran_seksi_waskon_1 != '' ? indo_currency($potongan_tukin->iuran_seksi_waskon_1) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_waskon_2 != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Waskon II</td>
									<td>: </td>
									<td id="iuran_seksi_waskon_2"><?= $potongan_tukin->iuran_seksi_waskon_2 != '' ? indo_currency($potongan_tukin->iuran_seksi_waskon_2) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_waskon_3 != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Waskon III</td>
									<td>: </td>
									<td id="iuran_seksi_waskon_3"><?= $potongan_tukin->iuran_seksi_waskon_3 != '' ? indo_currency($potongan_tukin->iuran_seksi_waskon_3) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_waskon_4 != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Waskon IV</td>
									<td>: </td>
									<td id="iuran_seksi_waskon_4"><?= $potongan_tukin->iuran_seksi_waskon_4 != '' ? indo_currency($potongan_tukin->iuran_seksi_waskon_4) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_penagihan != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Penagihan</td>
									<td>: </td>
									<td id="iuran_seksi_penagihan"><?= $potongan_tukin->iuran_seksi_penagihan != '' ? indo_currency($potongan_tukin->iuran_seksi_penagihan) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_pemeriksaan != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Pemeriksaan</td>
									<td>: </td>
									<td id="iuran_seksi_pemeriksaan"><?= $potongan_tukin->iuran_seksi_pemeriksaan != '' ? indo_currency($potongan_tukin->iuran_seksi_pemeriksaan) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_ekstensifikasi != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Ekstensifikasi</td>
									<td>: </td>
									<td id="iuran_seksi_ekstensifikasi"><?= $potongan_tukin->iuran_seksi_ekstensifikasi != '' ? indo_currency($potongan_tukin->iuran_seksi_ekstensifikasi) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->iuran_seksi_pelayanan != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Pelayanan</td>
									<td>: </td>
									<td id="iuran_seksi_pelayanan"><?= $potongan_tukin->iuran_seksi_pelayanan != '' ? indo_currency($potongan_tukin->iuran_seksi_pelayanan) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<?php if ($potongan_tukin != null) : ?>
							<?php if ($potongan_tukin->lain_lain != '') : ?>
								<tr>
									<td colspan="3"></td>
									<td>*</td>
									<td>Lain-lain<small> (2)</small></td>
									<td>: </td>
									<td id="lain_lain"><?= $potongan_tukin->lain_lain != '' ? indo_currency($potongan_tukin->lain_lain) : '-' ?></td>
									<td></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
						<tr>
							<td colspan="3"></td>
							<td></td>
							<td>Jumlah Potongan</td>
							<td>: </td>
							<td id="jumlah_potongan"><?= indo_currency($jumlah_potongan) ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>4. </td>
							<td colspan="2" width="35%">Tukin Bersih</td>
							<td>: </td>
							<td></td>
							<td id="tukin_bersih"><b><?= indo_currency($tukin_bersih) ?></b></td>
						</tr>
						<tr>
							<td colspan="2" align="center">III. </td>
							<td colspan="3">PENGHASILAN LAIN</td>
							<td colspan="3">: </td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>1. </td>
							<td colspan="2">Uang Makan</td>
							<td>: </td>
							<td id="uang_makan"><?= $uang_makan != 0 ? indo_currency($uang_makan) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>2. </td>
							<td colspan="2">Gaji 13</td>
							<td>: </td>
							<td id="gaji13"><?= $gaji13 != 0 ? indo_currency($gaji13) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>3. </td>
							<td colspan="2">Gaji THR</td>
							<td>: </td>
							<td id="thr"><?= $thr != 0 ? indo_currency($thr) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>4. </td>
							<td colspan="2">Kekurangan Gaji<small> (3)</small></td>
							<td>: </td>
							<td id="kekurangan_gaji"><?= $kekurangan_gaji != 0 ? indo_currency($kekurangan_gaji) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>5. </td>
							<td colspan="2">Uang Lembur</td>
							<td>: </td>
							<td id="uang_lembur"><?= $uang_lembur != 0 ? indo_currency($uang_lembur) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>6. </td>
							<td colspan="2">Tukin 13</td>
							<td>: </td>
							<td id="tukin_13"><?= $tukin_13 != 0 ? indo_currency($tukin_13) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>7. </td>
							<td colspan="2">Tukin THR</td>
							<td>: </td>
							<td id="tukin_thr"><?= $tukin_thr != 0 ? indo_currency($tukin_thr) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>8. </td>
							<td colspan="2">Kekurangan Tukin<small> (4)</small></td>
							<td>: </td>
							<td id="kekurangan_tukin"><?= $kekurangan_tukin != 0 ? indo_currency($kekurangan_tukin) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>9. </td>
							<td colspan="2">Tukin Tambahan bagi Plt./Plh.<small> (5)</small></td>
							<td>: </td>
							<td id="tukin_plt"><?= $tukin_plt != 0 ? indo_currency($tukin_plt) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>10. </td>
							<td colspan="2">Insentif Pegawai</td>
							<td>: </td>
							<td id="insentif"><?= $insentif != 0 ? indo_currency($insentif) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>11. </td>
							<td colspan="2">Honorarium<small> (6)</small></td>
							<td>: </td>
							<td id="honor"><?= $honor != 0 ? indo_currency($honor) : '-' ?></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>12. </td>
							<td colspan="2">Jumlah Penghasilan Lain</td>
							<td>: </td>
							<td></td>
							<td id="jumlah_penghasilan_lain"><b><?= indo_currency($jumlah_penghasilan_lain) ?></b></td>
						</tr>
						<tr>
							<td colspan="2" align="center">IV. </td>
							<td colspan="3">Total Penghasilan Masuk Rekening</td>
							<td>:</td>
							<td></td>
							<td><b><?= indo_currency($jumlah) ?></b></td>
						</tr>
						<tr>
							<td colspan="2" align="center">Keterangan </td>
							<td colspan="3"></td>
							<td>: </td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">(1) </td>
							<td colspan="6">: <?= $potongan_tukin != null && $potongan_tukin->tambahan_lain != '' ? $potongan_tukin->ket : '-' ?></td>
						</tr>
						<tr>
							<td colspan="2" align="center">(2) </td>
							<td colspan="6">: <?= $potongan_tukin != null && $potongan_tukin->lain_lain != '' ? $potongan_tukin->keterangan : '-' ?></td>
						</tr>
						<tr>
							<td colspan="2" align="center">(3) </td>
							<td colspan="6">: <?= $kekurangan_gaji != 0 ? $kekurangan_gaji_ket : '-' ?></td>
						</tr>
						<tr>
							<td colspan="2" align="center">(4) </td>
							<td colspan="6">: <?= $kekurangan_tukin != 0 ? $kekurangan_tukin_ket : '-' ?></td>
						</tr>
						<tr>
							<td colspan="2" align="center">(5) </td>
							<td colspan="6">: <?= $tukin_plt != 0 ? $tukin_plt_ket : '-' ?></td>
						</tr>
						<tr>
							<td colspan="2" align="center">(6) </td>
							<td colspan="6">: <?= $honor != 0 ? $honor_ket : '-' ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-1">

				</div>
				<br/>
			</div>
            <div class="row">
                <div class="col-sm-12 justify-content-center">
                    <p class="text-right" style="margin-right:90px;">Bendahara Pengeluaran</p>
                    <br/>
                    <br/>
                    <br/>
                    <p class="text-right" style="margin-right:103px;">Rifza Hanif Nugraha</p>
                </div>
            </div>
		<?php else : ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<i class="icon fa fa-ban"></i> Data tidak ditemukan.
			</div>
		<?php endif ?>
	</div>
</div>
