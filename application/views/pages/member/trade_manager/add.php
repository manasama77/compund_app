<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Join Paket Trade Manager</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= site_url('trade_manager/index'); ?>">Trade Manager</a></li>
					<li class="breadcrumb-item active">Join Paket Trade Manager</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">

		<div class="row">

			<?php
			$x = 0;
			foreach ($arr as $key) {
			?>

				<div class="col-sm-12 col-md-6">

					<div class="card bg-<?= $arr_bg_color[$x]; ?> text-white mb-4">
						<div class="card-body">
							<div class="row">
								<div class="col-md-5 text-center">
									<?php
									$url = "#";
									if ($arr_state[$x] == 0) {
										$url = site_url('trade_manager/pick/' . base64_encode(UYAH . $key['id']));
									}
									?>
									<a href="<?= $url; ?>">
										<img src="<?= base_url(); ?>public/img/package_logo/<?= $key['logo']; ?>" class="img-fluid" alt="<?= $key['name']; ?>">
									</a>
									<?php if ($arr_state[$x] == 0) { ?>
										<a href="<?= site_url('trade_manager/pick/' . base64_encode(UYAH . $key['id'])); ?>" class="btn btn-dark btn-flat btn-block font-weight-bold">
											<i class="fas fa-toggle-off fa-fw"></i> Pilih Paket
										</a>
									<?php } elseif ($arr_state[$x] == 1) { ?>
										<span class="btn btn-success btn-flat btn-block font-weight-bold">
											<i class="fas fa-toggle-on fa-fw"></i> Aktif
										</span>
									<?php } else { ?>
										<span class="btn btn-secondary btn-flat btn-block font-weight-bold">
											Tidak Dapat Dipilih<sup>**</sup>
										</span>
									<?php } ?>
								</div>
								<div class="col-md-7">

									<h3 class="mt-3">
										<?= strtoupper($key['name']); ?>
									</h3>
									<p class="card-text">
									<ul style="font-size: 17px;">
										<li>
											Nilai Investasi: <?= ($x == 5) ? "≥" : "";  ?><?= $key['amount']; ?> <small>USDT</small>
										</li>
										<li>
											Profit Per Bulan<sup><strong>*</strong></sup>:<br /><?= $key['profit_per_month_percent']; ?>% (<?= ($x == 5) ? "≥" : "";  ?><?= $key['profit_per_month_value']; ?> <small>USDT</small>)
										</li>
										<li>
											Profit Per Hari<sup><strong>*</strong></sup>:<br /><?= $key['profit_per_day_percentage']; ?>% (<?= ($x == 5) ? "≥" : "";  ?><?= $key['profit_per_day_value']; ?> <small>USDT</small>)
										</li>
										<li>
											Masa Aktif: <?= $key['contract_duration']; ?> Hari
										</li>
									</ul>
									</p>

								</div>
							</div>
						</div>
					</div>

				</div>

			<?php
				$x++;
			}
			?>

		</div>
		<div class="row">
			<div class="col-12">

				<div class="alert alert-warning">
					<i class="fas fa-info-circle"></i> Informasi
					<p>* Nilai tersebut belum termasuk Rasio Profit Sharing Member, Upline dan Perusahaan dan profit dapat dilakukan penarikan setelah 30 hari kemudian</p>
					<p>** Jika telah memilih paket dengan nilai investasi lebih tinggi, maka paket dengan nilai investasi dibawahnya otomatis tidak dapat dipilih</p>
				</div>

			</div>
		</div>
	</div>
</section>
