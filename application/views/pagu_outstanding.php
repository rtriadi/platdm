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
						<li class="breadcrumb-item active">Rekap SPD Outstanding</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Rekap SPD Outstanding</h3>
					</div>
					<div class="card-body">
						<table id="example23" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>KET/DIPA</th>
									<th>PAGU</th>
									<th>BERKAS DITERIMA</th>
									<th>BERKAS OK</th>
									<th>SISA PAGU</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($row->result() as $key => $data) : ?>
									<tr>
										<td><?= $data->dipa_pagu ?></td>
										<td><?= indo_currency($data->pagu) ?></td>
										<td>
											<?php
											$this->db->select('SUM(total_bayar) as berkas_diterima');
											$this->db->from('spd');
											$this->db->where('status', 1);
											$this->db->where('dipa', $data->dipa_pagu);
											$row1 = $this->db->get()->row();
											echo indo_currency($row1->berkas_diterima);
											?>
										</td>
										<td>
											<?php
											$this->db->select('SUM(total_bayar) as ok');
											$this->db->from('spd');
											$this->db->where('status', 2);
											$this->db->where('dipa', $data->dipa_pagu);
											$row2 = $this->db->get()->row();
											echo indo_currency($row2->ok);
											?>
										</td>
										<td>
											<?php
											$sisa_pagu = $data->pagu - ($row1->berkas_diterima + $row2->ok);
											echo indo_currency($sisa_pagu);
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
										$row2 = $this->db->get()->row();
										echo indo_currency($row2->total);
										?>
									</th>
									<th>
									    <?php
											$this->db->select('SUM(total_bayar) as berkas_diterima');
											$this->db->from('spd');
											$this->db->where('status', 1);
											$this->db->where('dipa', 501);
											$result1 = $this->db->get()->row();
											$this->db->select('SUM(total_bayar) as berkas_diterima');
											$this->db->from('spd');
											$this->db->where('status', 1);
											$this->db->where('dipa', 994);
											$result2 = $this->db->get()->row();
											echo indo_currency($result2->berkas_diterima + $result1->berkas_diterima);
											?>
									</th>
									<th>
									    <?php
											$this->db->select('SUM(total_bayar) as ok');
											$this->db->from('spd');
											$this->db->where('status', 2);
											$this->db->where('dipa', 501);
											$result3 = $this->db->get()->row();
											$this->db->select('SUM(total_bayar) as ok');
											$this->db->from('spd');
											$this->db->where('status', 2);
											$this->db->where('dipa', 994);
											$result4 = $this->db->get()->row();
											echo indo_currency($result4->ok + $result3->ok);
											?>
									</th>
									<th>
									    	<?php
											$this->db->select('pagu');
										$this->db->from('pagu');
											$this->db->where('dipa_pagu', 501);
										$pagu1 = $this->db->get()->row();
										$this->db->select('pagu');
										$this->db->from('pagu');
											$this->db->where('dipa_pagu', 994);
										$pagu2 = $this->db->get()->row();
										echo indo_currency(($pagu1->pagu-($result1->berkas_diterima+$result3->ok)) + ($pagu2->pagu-($result2->berkas_diterima+$result4->ok)));
											?>
									</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
