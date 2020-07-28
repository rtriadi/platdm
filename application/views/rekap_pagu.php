<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Rekap Pagu</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Rekap Pagu</a></li>
						<li class="breadcrumb-item active">Rekap</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<!--<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Rekap SPD Outstanding</h3>
					</div>
					<div class="card-body">
						<table id="example" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>KET</th>
									<th>PAGU</th>
									<th>OUTSTANDING</th>
									<th>SISA PAGU</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Total</td>
									<td>
										<?php
										$this->db->select('SUM(pagu) as total');
										$this->db->from('pagu');
										$outstanding2 = $this->db->get()->row();
										echo number_format($outstanding2->total);
										?>
									</td>
									<td>
										<?php
										$this->db->select('SUM(total_bayar) as outstanding');
										$this->db->from('spd');
										$this->db->where('total_bayar >= 0');
										    $this->db->where("sort = '0'");
										$this->db->where('status < 4');
										$outstanding1 = $this->db->get()->row();
										echo number_format($outstanding1->outstanding);
										?>
									</td>
									<td>
										<?php
										$sisa_pagu1 = $outstanding2->total - $outstanding1->outstanding;
										echo number_format($sisa_pagu1);
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Rekap SPD Telah Dibayar</h3>
					</div>
					<div class="card-body">
						<table id="example" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>KET/DIPA</th>
									<th>PAGU</th>
									<th>TELAH DIBAYAR</th>
									<th>SISA PAGU</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($telah_dibayar->result() as $key => $data2) : ?>
									<tr>
										<td><?= $data2->dipa_pagu ?></td>
										<td><?= number_format($data2->pagu) ?></td>
										<td>
											<?php
											$this->db->select('SUM(total_bayar) as telah_dibayar');
											$this->db->from('spd');
											$this->db->where('total_bayar >= 0');
										    $this->db->where("sort = '0'");
											$this->db->where('status', 4);
											$this->db->where('dipa', $data2->dipa_pagu);
											$telah_dibayar1 = $this->db->get()->row();
											echo number_format($telah_dibayar1->telah_dibayar);
											?>
										</td>
										<td>
											<?php
											$sisa_pagu2 = $data2->pagu - $telah_dibayar1->telah_dibayar;
											echo number_format($sisa_pagu2);
											?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<th>
										Total
									</th>
									<th>
										<?php
										$this->db->select('SUM(pagu) as total');
										$this->db->from('pagu');
										$telah_dibayar2 = $this->db->get()->row();
										echo number_format($telah_dibayar2->total);
										?>
									</th>
									<th>
										<?php
										$this->db->select('SUM(total_bayar) as telah_dibayar');
										$this->db->from('spd');
										$this->db->where('total_bayar >= 0');
										$this->db->where("sort = '0'");
										$this->db->where('status', 4);
										$this->db->where('dipa', 501);
										$result5 = $this->db->get()->row();

										$this->db->select('SUM(total_bayar) as telah_dibayar');
										$this->db->from('spd');
										$this->db->where('total_bayar >= 0');
										$this->db->where("sort = '0'");
										$this->db->where('status', 4);
										$this->db->where('dipa', 994);
										$result6 = $this->db->get()->row();
										echo number_format($result6->telah_dibayar + $result5->telah_dibayar);
										?>
									</th>
									<th>
										<?php
										$this->db->select('pagu');
										$this->db->from('pagu');
										$this->db->where('dipa_pagu', 501);
										$pagu3 = $this->db->get()->row();
										$this->db->select('pagu');
										$this->db->from('pagu');
										$this->db->where('dipa_pagu', 994);
										$pagu4 = $this->db->get()->row();
										echo number_format(($pagu3->pagu - $result5->telah_dibayar) + ($pagu4->pagu - $result6->telah_dibayar));
										?>
									</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>-->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Rekap PAGU</h3>
					</div>
					<div class="card-body">
						<table id="example" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>KETERANGAN</th>
									<th>KODE DIPA</th>
									<th>PAGU</th>
									<th>REALISASI</th>
									<th>SISA PAGU</th>
									<!--<th>SPD OUTSTANDING</th>-->
								</tr>
							</thead>
							<tbody>
								<tr>
									<td rowspan="3">KPP Pratama Gorontalo</td>
									<td>501</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 0);
    										$this->db->where('dipa_pagu', 501);
    										$pagu0g = $this->db->get()->row();
    										echo number_format($pagu0g->total);
										?>
										</p>
									</td>
									<td>
									    Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 0);
    										$this->db->where('dipa', 501);
    										$this->db->where('status', 4);
    										$realisasi0g = $this->db->get()->row();
    										echo number_format($realisasi0g->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu0g->total - $realisasi0g->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 0);
    										$this->db->where('dipa', 501);
    										$this->db->where('status < 4');
    										$this->db->where('total_bayar >= 0');
    										$outstanding0g = $this->db->get()->row();
    										echo number_format($outstanding0g->total);
										?>
									</td>-->
								</tr>
								<tr>
								    <td>994</td>
									<td>Rp.
									    <p style="float: right; display: inline">
    									<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 0);
    										$this->db->where('dipa_pagu', 994);
    										$pagu1g = $this->db->get()->row();
    										echo number_format($pagu1g->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 0);
    										$this->db->where('dipa', 994);
    										$this->db->where('status', 4);
    										$realisasi1g = $this->db->get()->row();
    										echo number_format($realisasi1g->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu1g->total - $realisasi1g->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 0);
    										$this->db->where('dipa', 994);
    										$this->db->where('status < 4');
    										$this->db->where('total_bayar >= 0');
    										$outstanding1g = $this->db->get()->row();
    										echo number_format($outstanding1g->total);
										?>
									</td>-->
								</tr>	
								<tr>
								    <td>Total</td>
									<td>
									    Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($pagu0g->total + $pagu1g->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($realisasi0g->total + $realisasi1g->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format(($pagu0g->total - $realisasi0g->total) + ($pagu1g->total - $realisasi1g->total));
										?>
										</p>
									</td>
									<!--<td></td>-->
								</tr>
								<tr>
									<td rowspan="3">KP2KP Limboto</td>
									<td>501</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 1);
    										$this->db->where('dipa_pagu', 501);
    										$pagu0l = $this->db->get()->row();
    										echo number_format($pagu0l->total);
										?>
										</p>
									</td>
									<td>
									    Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 1);
    										$this->db->where('dipa', 501);
    										$this->db->where('status', 4);
    										$realisasi0l = $this->db->get()->row();
    										echo number_format($realisasi0l->total);
										?>
										</p>
									</td>
									<td>
									    Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu0l->total - $realisasi0l->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 1);
    										$this->db->where('dipa', 501);
    										$this->db->where('status < 4');
    										$this->db->where('total_bayar >= 0');
    										$outstanding0l = $this->db->get()->row();
    										echo number_format($outstanding0l->total);
										?>
									</td>-->
								</tr>
								<tr>
								    <td>994</td>
									<td>Rp.
									    <p style="float: right; display: inline">
    									<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 1);
    										$this->db->where('dipa_pagu', 994);
    										$pagu1l = $this->db->get()->row();
    										echo number_format($pagu1l->total);
										?>
										</p>
									</td>
									<td>
									    Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 1);
    										$this->db->where('dipa', 994);
    										$this->db->where('status', 4);
    										$realisasi1l = $this->db->get()->row();
    										echo number_format($realisasi1l->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu1l->total - $realisasi1l->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 1);
    										$this->db->where('dipa', 994);
    										$this->db->where('status < 4');
    										$this->db->where('total_bayar >= 0');
    										$outstanding1l = $this->db->get()->row();
    										echo number_format($outstanding1l->total);
										?>
									</td>-->
								</tr>	
								<tr>
								    <td>Total</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($pagu0l->total + $pagu1l->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($realisasi0l->total + $realisasi1l->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format(($pagu0l->total - $realisasi0l->total) + ($pagu1l->total - $realisasi1l->total));
										?>
										</p>
									</td>
									<!--<td></td>-->
								</tr>
								<tr>
									<td rowspan="3">KP2KP Marissa</td>
									<td>501</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 3);
    										$this->db->where('dipa_pagu', 501);
    										$pagu0m = $this->db->get()->row();
    										echo number_format($pagu0m->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 3);
    										$this->db->where('dipa', 501);
    										$this->db->where('status', 4);
    										$realisasi0m = $this->db->get()->row();
    										echo number_format($realisasi0m->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu0m->total - $realisasi0m->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 3);
    										$this->db->where('dipa', 501);
    										$this->db->where('status < 4');
    										$outstanding0m = $this->db->get()->row();
    										echo number_format($outstanding0m->total);
										?>
									</td>-->
								</tr>
								<tr>
								    <td>994</td>
									<td>Rp.
									    <p style="float: right; display: inline">
    									<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 3);
    										$this->db->where('dipa_pagu', 994);
    										$pagu1m = $this->db->get()->row();
    										echo number_format($pagu1m->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 3);
    										$this->db->where('dipa', 994);
    										$this->db->where('status', 4);
    										$realisasi1m = $this->db->get()->row();
    										echo number_format($realisasi1m->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu1m->total - $realisasi1m->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 3);
    										$this->db->where('dipa', 994);
    										$this->db->where('status < 4');
    										$outstanding1m = $this->db->get()->row();
    										echo number_format($outstanding1m->total);
										?>
									</td>-->
								</tr>	
								<tr>
								    <td>Total</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($pagu0m->total + $pagu1m->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($realisasi0m->total + $realisasi1m->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format(($pagu0m->total - $realisasi0m->total) + ($pagu1m->total - $realisasi1m->total));
										?>
										</p>
									</td>
									<!--<td></td>-->
								</tr>
								<tr>
									<td rowspan="3">KP2KP Tilamuta</td>
									<td>501</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 2);
    										$this->db->where('dipa_pagu', 501);
    										$pagu0t = $this->db->get()->row();
    										echo number_format($pagu0t->total);
										?>
										</p>
									</td>
								    <td>Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 2);
    										$this->db->where('dipa', 501);
    										$this->db->where('status', 4);
    										$realisasi0t = $this->db->get()->row();
    										echo number_format($realisasi0t->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu0t->total - $realisasi0t->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 2);
    										$this->db->where('dipa', 501);
    										$this->db->where('status < 4');
    										$outstanding0t = $this->db->get()->row();
    										echo number_format($outstanding0t->total);
										?>
									</td>-->
								</tr>
								<tr>
								    <td>994</td>
									<td>Rp.
									    <p style="float: right; display: inline">
    									<?php
    										$this->db->select('pagu as total');
    										$this->db->from('pagu');
    										$this->db->where('kodekantor', 2);
    										$this->db->where('dipa_pagu', 994);
    										$pagu1t = $this->db->get()->row();
    										echo number_format($pagu1t->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
    										$this->db->select('SUM(grand_total) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 2);
    										$this->db->where('dipa', 994);
    										$this->db->where('status', 4);
    										$realisasi1t = $this->db->get()->row();
    										echo number_format($realisasi1t->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu1t->total - $realisasi1t->total);
									    ?>
									    </p>
									</td>
									<!--<td>
									    <?php
    										$this->db->select('SUM(total_bayar) as total');
    										$this->db->from('spd');
    										$this->db->where('sort', 2);
    										$this->db->where('dipa', 994);
    										$this->db->where('status < 4');
    										$outstanding1t = $this->db->get()->row();
    										echo number_format($outstanding1t->total);
										?>
									</td>-->
								</tr>	
								<tr>
								    <td>Total</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($pagu0t->total + $pagu1t->total);
										?>
										</p>
									</td>
									<td>
									    Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format($realisasi0t->total + $realisasi1t->total);
										?>
										</p>
									</td>
									<td>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format(($pagu0t->total - $realisasi0t->total) + ($pagu1t->total - $realisasi1t->total));
										?>
										</p>
									</td>
									<!--<td></td>-->
								</tr>
								
								<tr>
									<td rowspan="3"></td>
									<td><b>GRAND TOTAL</b></td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
										<?php
										    echo number_format(($pagu0g->total + $pagu1g->total) + ($pagu0l->total + $pagu1l->total) + ($pagu0t->total + $pagu1t->total) + ($pagu0m->total + $pagu1m->total));
										?></p></b>
									</td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php $total_realisasi = $this->db->query('SELECT SUM(grand_total) as grand_total FROM spd WHERE status = 4')->row()->grand_total; echo number_format($total_realisasi); ?></p></b>
									</td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php
										    echo number_format(($pagu0g->total + $pagu1g->total) + ($pagu0l->total + $pagu1l->total) + ($pagu0t->total + $pagu1t->total) + ($pagu0m->total + $pagu1m->total) - $total_realisasi);
										?></p></b>
									</td>
									<!--<td><b>
									    <?php $total_outstanding = $this->db->query('SELECT SUM(total_bayar) as total_bayar FROM spd WHERE status < 4')->row()->total_bayar; echo number_format($total_outstanding); ?></b>
									</td>-->
								</tr>
								<tr>
								    <td><b>TOTAL 501</b></td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu0g->total + $pagu0l->total + $pagu0t->total + $pagu0m->total);
									    ?></p></b>
									</td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php $total_realisasi501 = $this->db->query('SELECT SUM(grand_total) as grand_total FROM spd WHERE status = 4 AND dipa = "501" ')->row()->grand_total; echo number_format($total_realisasi501); ?></p></b>
									</td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format(($pagu0g->total + $pagu0l->total + $pagu0t->total + $pagu0m->total) - $total_realisasi501);
									    ?></p></b>
									</td>
									<!--<td><b>
									    <?php $total_outstanding501 = $this->db->query('SELECT SUM(total_bayar) as total_bayar FROM spd WHERE status < 4 AND dipa = "501"')->row()->total_bayar; echo number_format($total_outstanding501); ?></b>
									</td>-->
								</tr>	
								<tr>
								    <td><b>TOTAL 994</b></td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format($pagu1g->total + $pagu1l->total + $pagu1t->total + $pagu1m->total);
									    ?></p></b>
									</td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php $total_realisasi994 = $this->db->query('SELECT SUM(grand_total) as grand_total FROM spd WHERE status = 4 AND dipa = "994" ')->row()->grand_total; echo number_format($total_realisasi994); ?></p></b>
									</td>
									<td><b>Rp.
									    <p style="float: right; display: inline">
									    <?php
									        echo number_format(($pagu1g->total + $pagu1l->total + $pagu1t->total + $pagu1m->total) - $total_realisasi994);
									    ?></p></b>
									</td>
									<!--<td><b>
									    <?php $total_outstanding994 = $this->db->query('SELECT SUM(total_bayar) as total_bayar FROM spd WHERE status < 4 AND dipa = "994"')->row()->total_bayar; echo number_format($total_outstanding994); ?></b>
									</td>-->
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
