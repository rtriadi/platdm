<!-- Content Header (Page header) -->
<div class="content-wrapper">
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">SPD Admin</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">SPD Admin</a></li>
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
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">
							<?= ucfirst($page) ?> SPD Admin <?= $kantor ?></h3>
						<div style="float: right">
							<a href="<?= site_url('spd_admin') ?>" class="btn btn-sm bg-yellow">
								<i class="fa fa-user-undo"></i> Back
							</a>
						</div>
					</div>
					<div class="card-body">
                        <form action="<?= site_url('spd_admin/process') ?>" method="POST">
                            <?php if($page == "Tambah") { ?>  <!-- Jika Tambah SPD -->
                                <?php $this->load->model('model_setting');
                                $query_format = $this->model_setting->getSetting($sort, '0');
                                foreach ($query_format->result() as $keysss) { 
                                    $awal = $keysss->format_awal;  
                                    $akhir = $keysss->format_akhir;  
                                } 
                            } ?>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Nomor SPD <sup class="text-danger">*</sup></label>
                                        <input type="hidden" name="id" value="<?= $row->id ?>">
                                        <input type="hidden" name="status" value="<?= $row->status ?>">
                                        <?php if($page == "Tambah") { ?>
                                        <input type="hidden" name="sort" value="<?= $sort ?>">
                                        <?php } else { ?>
                                            <input type="hidden" name="sort" value="<?= $row->sort ?>">
                                        <?php } ?>
                                        
                                    <?php if($page == "Tambah") { ?>  <!-- Jika Tambah SPD -->
                                        <?php $this->load->model('spd_admin_m');
                                        $query_num = $this->spd_admin_m->getLastSPD($sort); // Cek Data SPD terakhir

                                        if($query_num->num_rows() < 1) { ?> <!-- Jika Belum ada data SPD -->
                                            <input type="hidden" name="no_spd" value="<?= $awal ?><?= sprintf('%04d', 1); ?><?= $akhir ?>">
                                            <input type="text" value="<?= $awal ?><?= sprintf('%04d', 1); ?><?= $akhir ?>" class="form-control" readonly>
                                        <?php }

                                        foreach ($query_num->result() as $keys) { 
                                            $pecah1 = explode('/',$keys->no_spd); // Memecah Nomor SPD
                                            $nospd = substr($pecah1[0], 4); // Memotong kalimat awal SPD-
                                        ?>
                                            <input type="hidden" name="no_spd" value="<?= $awal ?><?= sprintf('%04d', ($nospd)+1); ?><?= $akhir ?>">
                                            <input type="text" value="<?= $awal ?><?= sprintf('%04d', ($nospd)+1); ?><?= $akhir ?>" class="form-control" readonly>
                                        <?php } ?>

                                    <?php } else { ?> <!-- Jika Edit SPD -->
                                        <!-- <input type="hidden" name="no_spd" value="<?//= $row->no_spd ?>"> -->
                                        <input type="text" name="no_spd" value="<?= $row->no_spd ?>" class="form-control">
                                    <?php } ?>

                                    </div>
                                    <div class="col-md-3">
                                        <label>Tanggal SPD <sup class="text-danger">*</sup></label>
                                        <input type="date" name="tgl_spd" value="<?= $row->tgl_spd ?>" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Nomor ST <sup class="text-danger">*</sup></label>
                                        <input type="text" name="no_st" value="<?= $row->no_st ?>" class="form-control" placeholder="Nomor Surat Tugas" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tanggal ST <sup class="text-danger">*</sup></label>
                                        <input type="date" name="tgl_st" value="<?= $row->tgl_st ?>" class="form-control"
                                            required>
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Pegawai <sup class="text-danger">*</sup></label>
                                        <select name="nip_pegawai" class="form-control select2" required>
                                            <option value="">- Pilih Pegawai -</option>
                                            <?php foreach($peg->result() as $key => $data) : ?>
                                            <option value="<?=$data->nip?>" <?=$data->nip == $row->nip_pegawai ? "selected" : null?>><?=$data->nama?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Kendaraan <sup class="text-danger">*</sup></label>
                                        <select name="kendaraan" class="form-control" required>
                                            <option value="">- Pilih Kendaraan -</option>
                                            <option value="Angkutan Darat" <?= "Angkutan Darat" == $row->kendaraan ? "selected" : null?>>Angkutan Darat</option>
                                            <option value="Angkutan Udara" <?= "Angkutan Udara" == $row->kendaraan ? "selected" : null?>>Angkutan Udara</option>
                                        </select>
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Maksud Perjalanan Dinas <sup class="text-danger">*</sup></label>
                                        <textarea name="maksud" cols="10" rows="6" class="form-control"><?= $row->maksud ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tempat Tujuan <sup class="text-danger">*</sup></label>
                                        <select name="tujuan1" class="form-control select2" required>
                                            <option value="">- Pilih Kota -</option>
                                            <?php foreach($city->result() as $key => $data) : ?>
                                            <option value="<?=$data->id?>" <?=$data->id == $row->tujuan1 ? "selected" : null?>><?=$data->city_type?> <?=$data->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="tujuan2" class="form-control select2">
                                            <option value="">- Pilih Kota -</option>
                                            <?php foreach($city->result() as $key => $data) : ?>
                                            <option value="<?=$data->id?>" <?=$data->id == $row->tujuan2 ? "selected" : null?>><?=$data->city_type?> <?=$data->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="tujuan3" class="form-control select2">
                                            <option value="">- Pilih Kota -</option>
                                            <?php foreach($city->result() as $key => $data) : ?>
                                            <option value="<?=$data->id?>" <?=$data->id == $row->tujuan3 ? "selected" : null?>><?=$data->city_type?> <?=$data->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="tujuan4" class="form-control select2">
                                            <option value="">- Pilih Kota -</option>
                                            <?php foreach($city->result() as $key => $data) : ?>
                                            <option value="<?=$data->id?>" <?=$data->id == $row->tujuan4 ? "selected" : null?>><?=$data->city_type?> <?=$data->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <input type="text" name="tujuan1" value="<?//= $row->tujuan1 ?>" class="form-control" placeholder="Tujuan Pertama" required>
                                        <input type="text" name="tujuan2" value="<?//= $row->tujuan2 ?>" class="form-control" placeholder="Tujuan Kedua">
                                        <input type="text" name="tujuan3" value="<?//= $row->tujuan3 ?>" class="form-control" placeholder="Tujuan Ketiga">
                                        <input type="text" name="tujuan4" value="<?//= $row->tujuan4 ?>" class="form-control" placeholder="Tujuan Keempat"> -->
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Lamanya Perjalanan <sup class="text-danger">*</sup></label>
                                        <input type="number" name="lamanya" value="<?= $row->lamanya ?>" class="form-control" placeholder="Lamanya Perjalanan" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tanggal Berangkat <sup class="text-danger">*</sup></label>
                                        <input type="date" name="tgl_berangkat" value="<?= $row->tgl_berangkat ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Tanggal Selesai <sup class="text-danger">*</sup></label>
                                        <input type="date" name="tgl_selesai" value="<?= $row->tgl_selesai ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Uang Muka</label>
                                        <input type="number" name="uang_muka" value="<?= $row->uang_muka ?>" class="form-control" placeholder="Uang Muka">
                                        <!--<small>*Kosongkan jika tidak ada</small>-->
                                    </div>
                                </div>
							</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Pejabat Pembuat Komitmen <sup class="text-danger">*</sup></label>
                                        <select name="nip_ppk" class="form-control select2" required>
                                            <option value="">- Pilih Pegawai -</option>
                                            <?php foreach($ppk->result() as $key => $data) : ?>
                                            <option value="<?=$data->nip?>" <?=$data->nip == $row->nip_ppk ? "selected" : null?>><?=$data->nama?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Bendahara <sup class="text-danger">*</sup></label>
                                        <select name="nip_bendahara" class="form-control select2" required>
                                            <option value="">- Pilih Pegawai -</option>
                                            <?php foreach($ben->result() as $key => $data) : ?>
                                            <option value="<?=$data->nip?>" <?=$data->nip == $row->nip_bendahara ? "selected" : null?>><?=$data->nama?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
							</div>
							<div class="form-group">
								<button type="reset" class="btn btn-md btn-secondary">Reset</button>
								<button type="submit" name="<?= $page ?>" class="btn btn-success btn-md"><i class="fa fa-paper-plane"></i> Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
