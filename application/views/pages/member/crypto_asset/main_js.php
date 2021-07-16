<script>
	$(document).ready(function() {
		$('.bond_tooltip').tooltip({
			boundary: 'window'
		})

		$("#table_data").DataTable({
			// "scrollX": "300px",
			// "scrollY": "300px",
			order: [
				[0, 'asc']
			],
			responsive: true,
			lengthChange: false,
			autoWidth: false,
			buttons: ["copy", "csv", "excel", "pdf"],
			columnDefs: [{
				targets: [7],
				orderable: false
			}]
		}).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');

		$('#form_extend').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= site_url('trade_manager/update_extend'); ?>',
				method: 'post',
				dataType: 'json',
				data: $('#form_extend').serialize(),
				beforeSend: function() {
					$.blockUI();
				}
			}).always(function(e) {
				$.unblockUI();
			}).fail(function(e) {
				console.log(e);
				if (e.responseText != '') {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.responseText,
					});
				}
			}).done(function(e) {
				console.log(e);
				if (e.code == 500 || e.code == 400) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				} else if (e.code == 200) {
					Swal.fire({
						icon: 'success',
						title: 'Success...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				}
			});
		});
	});

	function showDetail(invoice) {
		$.ajax({
			url: '<?= site_url('trade_manager/detail'); ?>',
			method: 'get',
			dataType: 'json',
			data: {
				invoice: invoice,
			},
			beforeSend: function() {
				$.blockUI();
			}
		}).always(function(e) {
			$.unblockUI();
		}).fail(function(e) {
			console.log(e);
			if (e.responseText != '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					html: e.responseText,
				});
			}
		}).done(function(e) {
			console.log(e);
			if (e.code == 500) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: e.status_text,
				});
			} else if (e.code == 200) {
				$('#package').html(e.result.package);
				$('#amount').html(e.result.amount);
				$('#created_at').html(e.result.created_at);
				$('#expired_at').html(`${e.result.expired_at} 00:00:00`);
				$('#state').html(e.result.state.toUpperCase());
				$('#is_extend').html(e.result.is_extend.toUpperCase());

				let profit_montly_text = `${e.result.profit_montly_value} <small>USDT</small> (15 %)`;
				let profit_daily_text = `${e.result.profit_per_day} <small>USDT</small> (0.5 %)`;
				let profit_self_text = `${e.result.profit_self_value} <small>USDT</small> (${e.result.profit_self_percentage} %)`;
				let profit_upline_text = `${e.result.profit_upline_value} <small>USDT</small> (${e.result.profit_upline_percentage} %)`;
				let profit_company_text = `${e.result.profit_upline_value} <small>USDT</small> (${e.result.profit_company_percentage} %)`;
				let payment_text = `${e.result.payment_method.toUpperCase()} - ${e.result.txn_id}<br/>Amount Transfer ${e.result.amount_transfer} <small>USDT</small>`;

				$('#profit_monthly').html(profit_montly_text);
				$('#profit_daily').html(profit_daily_text);
				$('#profit_self').html(profit_self_text);
				$('#profit_upline').html(profit_upline_text);
				$('#profit_company').html(profit_company_text);
				$('#payment').html(payment_text);
				$('#modal_detail').modal('show');
			}
		});
	}

	function showExtend(invoice, package, is_extend) {
		$('#package_extend').text(package);
		$('#invoice_extend').val(invoice);
		$('#is_extend_mode').val(is_extend);
		$('#modal_extend').modal('show');
	}
</script>
