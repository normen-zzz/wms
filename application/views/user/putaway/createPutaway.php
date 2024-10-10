<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= $title ?></title>

	<link rel="shortcut icon" href="<?= base_url() . '/' ?>assets/compiled/svg/favicon.svg" type="image/x-icon" />
	<link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png" />

	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/app.css" />
	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/app-dark.css" />
	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/iconly.css" />
	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.min.css">
	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/table-datatable-jquery.css">


	<style>
		.table-responsive {
			overflow-x: auto;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
		}

		.table th,
		.table td {
			padding: 8px;
			text-align: center;
		}

		@media (max-width: 768px) {
			.table {
				display: block;
			}

			.table thead {
				display: none;
			}

			.table tr {
				display: flex;
				flex-direction: column;
				border: 1px solid #ccc;
				margin-bottom: 10px;
			}

			.table td {
				display: flex;
				justify-content: space-between;
				padding: 10px;
				border-bottom: 1px solid #ccc;
			}

			.table td::before {
				content: attr(data-label);
				font-weight: bold;
				margin-right: 10px;
			}

			 ul.recommendations-list li {
					flex-direction: column; 
					align-items: flex-start; 
					padding: 15px;
			}

			ul.recommendations-list li span {
					font-weight: bold;
					margin-bottom: 5px;
			}

			ul.recommendations-list li::before {
					content: attr(data-label);
					font-weight: bold;
					display: block;
					margin-bottom: 5px;
			}

			.no-recommendations {
					text-align: center;
					padding: 10px;
			}
		}

		ul.recommendations-list {
				list-style-type: none; 
				padding: 0; 
				margin: 0;
		}

		ul.recommendations-list li {
				background-color: #f8f9fa; 
				border: 1px solid #dee2e6; 
				padding: 10px;
				margin-bottom: 8px; 
				border-radius: 4px; 
				transition: background-color 0.3s ease; 
		}

		ul.recommendations-list li:hover {
				background-color: #e2e6ea;
				cursor: pointer; 
		}

		ul.recommendations-list li span {
				font-weight: bold;
		}

		.no-recommendations {
				color: #dc3545; 
				font-style: italic; 
		}

		table#choosenRack {
				width: 100%;
				border-collapse: collapse;
		}

		table#choosenRack th, table#choosenRack td {
				padding: 10px;
				border: 1px solid #dee2e6; 
				text-align: center;
				vertical-align: middle;
		}

		table#choosenRack th {
				background-color: #f8f9fa; 
				font-weight: bold;
		}

		table#choosenRack .form-control {
				width: 100%;
				box-sizing: border-box;
		}

		table#choosenRack tfoot {
				background-color: #fff;
		}

		table#choosenRack .add-row, table#choosenRack .remove-row {
				margin: 5px;
				transition: background-color 0.3s ease;
		}
	</style>
</head>

<body>
	<script src="<?= base_url() . '/' ?>assets/static/js/initTheme.js"></script>
	<div id="app">
		<div id="main" class="layout-horizontal">
			<header class="mb-5">
				<?php $this->load->view('templates/header') ?>
				<?php $this->load->view('templates/navbar') ?>
			</header>

			<div class="content-wrapper container">
				<div class="page-heading">
					<h3><?= $subtitle ?></h3>
				</div>
				<div class="page-content">
					<!-- Basic Vertical form layout section start -->
					<section id="basic-vertical-layouts">
						<div class="row match-height">

							<div class="col">
								<!-- Minimal jQuery Datatable end -->
								<!-- Basic Tables start -->

								<div class="card">
									<div class="card-header">
										<h5 class="card-title">
											<?= $subtitle2 ?>
										</h5>

									</div>

									<div class="card-body">
										<!-- <label for="customer">NO Inbound</label> -->
										<!-- <input type="text" class="form-control mb-4" value="<?= $get_id_inbound->no_inbound ?>" disabled> -->
										<div class="table-responsive">
											<form id="putawayForm" method="POST">
												<table class="table" id="table">
													<thead>
														<tr>
															<th style="width: 10%;">SKU</th>
															<th style="width: 10%;">Nama Barang</th>
															<th style="width: 10%;">Batch</th>
															<th style="width: 10%;">Qty (Good)</th>
															<th style="width: 15%;">Existing Rack</th>
															<th style="width: 15%;">Recommended Rack</th>
															<th style="width: 60%;">Chosen Rack</th>
															<th style="width: 10%;">Action</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($data_putaway as $dtl) { ?>
														  <?php if ( $dtl['status_putaway'] == 0 ) : ?>
															<tr>
																<td data-label="SKU"><?= $dtl['sku'] ?></td>
																<td data-label="Nama Barang"><?= $dtl['nama_barang'] ?></td>
																<td data-label="Batch"><?= $dtl['batchnumber'] ?></td> <!-- Display batchnumber -->
																<td data-label="Qty (Good)"><?= $dtl['good_qty'] ?></td>
																<td data-label="Existing Rack">
																	<?php if (!empty($dtl['existing_racks'])) : ?>
																		<?php foreach ($dtl['existing_racks'] as $rack) : ?>
																			<p>SLOC: <?= $rack['sloc'] ?></p>
																		<?php endforeach; ?>
																	<?php else : ?>
																		<p>Not assigned</p>
																	<?php endif; ?>
																</td>
																<td data-label="Recommended Rack">
																	<button type="button" class="btn btn-sm btn-primary get-recommendations" data-id-barang="<?= $dtl['id_barang'] ?>" data-quantity="<?= $dtl['good_qty'] ?>">
																		Get Recommendations
																	</button>
																	<div class="recommendations-list" style="display:none;"></div>
																</td>
																<td data-label="Chosen Rack">
																	<table class="table mt-3" id="choosenRack">
																		<thead>
																			<tr>
																				<th>Rack</th>
																				<th>Quantity</th>
																				<th>Action</th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td><input type="text" name="putaway_field[<?= $dtl['id_barang'] ?>][id_rack][]" class="form-control" placeholder="Enter Rack"></td>
																				<td><input type="text" name="putaway_field[<?= $dtl['id_barang'] ?>][quantity][]" class="form-control" placeholder="Enter Quantity"></td>
																				<td>
																					<button type="button" class="btn btn-sm btn-danger remove-row">Remove</button>
																				</td>
																			</tr>
																		</tbody>
																		<tfoot>
																			<tr>
																				<td colspan="3" class="text-right">
																					<button type="button" class="btn btn-sm btn-primary btn-block add-row">Add Row</button>
																				</td>
																			</tr>
																		</tfoot>
																	</table>
																</td>
																<td data-label="Action">
																	<button type="button" class="btn btn-sm btn-primary submitPutawayData" data-id-barang="<?= $dtl['id_barang'] ?>" data-quantity="<?= $dtl['good_qty'] ?>" data-batch-id="<?= $dtl['batch_id'] ?>">
																		Submit
																	</button>
																	<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][id_barang]" value="<?= $dtl['id_barang'] ?>">
																	<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][batch_id]" value="<?= $dtl['batch_id'] ?>">
																	<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][id_inbound]" value="<?= $dtl['id_inbound'] ?>">
																	<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][id_data_inbound]" value="<?= $dtl['id_data_inbound'] ?>">
																	<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][id_putaway]" value="<?= $dtl['id_putaway'] ?>">
																</td>
															</tr>
															<?php endif; ?>
															<?php } ?>
														</tbody>
													</table>
													<input type="hidden" name="id_putaway" value="<?= $dtl['id_putaway'] ?>">
													<button type="button" id="finishPutaway" class="btn btn-success">Finish Putaway</button>
											</form>
										</div>
									</div>
									<!-- Basic Tables end -->
								</div>
							</div>
					</section>
					<!-- // Basic Vertical form layout section end -->
				</div>
			</div>

			<?php $this->load->view('templates/footer') ?>
		</div>
	</div>



	<script src="<?= base_url() . '/' ?>assets/static/js/components/dark.js"></script>
	<script src="<?= base_url() . '/' ?>assets/static/js/pages/horizontal-layout.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<script src="<?= base_url() . '/' ?>assets/compiled/js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/static/js/pages/datatables.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


	<script>
		$(document).ready(function() {
			$('.get-recommendations').on('click', function(e) {
				e.preventDefault();
				var button = $(this);
				var id_barang = button.data('id-barang');
				var quantity = button.data('quantity');
				var batch_id = button.data('batch-id');
				var recommendationsList = button.siblings('.recommendations-list');

				recommendationsList.html('<p>Loading recommendations...</p>').show();

				$.ajax({
					url: '<?= base_url("user/putaway/get_rack_recommendations") ?>',
					method: 'POST',
					data: {
						id_barang: id_barang,
						quantity: quantity
					},
					dataType: 'json',
					success: function(response) {
						recommendationsList.empty();
						if (response.length > 0) {
									var ul = $('<ul class="recommendations-list">'); 
									response.forEach(function(rack) {
											var li = $('<li class="mt-2">').text('SLOC: ' + rack.sloc);
											ul.append(li);
									});
									recommendationsList.append(ul);
							} else {
									recommendationsList.text('No recommendations available').addClass('no-recommendations'); 
							}
					}
				});
			});

		
		
    $(document).on('click', '.submitPutawayData', function() {
        // show loading swal
        Swal.fire({
            title: 'Loading',
            text: 'Please wait...',
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });
        
        let button = $(this);
        let id_barang = button.data('id-barang');
        let good_qty = button.data('quantity');
        let batch_id = button.data('batch-id');

        let rack_ids = [];
        let quantities = [];
        let totalQuantity = 0;

        let currentRow = button.closest('tr');

        currentRow.find(`input[name="putaway_field[${id_barang}][id_rack][]"]`).each(function() {
            let rack_id = $(this).val();
            if (rack_id) {
                rack_ids.push(rack_id);
            }
        });

        currentRow.find(`input[name="putaway_field[${id_barang}][quantity][]"]`).each(function() {
            let quantity = parseInt($(this).val()) || 0;
            if (quantity > 0) {
                quantities.push(quantity);
                totalQuantity += quantity;
            }
        });

        if (totalQuantity < good_qty) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `Total quantity (${totalQuantity}) is less than required (${good_qty}).`
            });
            return;
        }

        if (totalQuantity > good_qty) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `Total quantity (${totalQuantity}) exceeds the required amount (${good_qty}).`
            });
            return;
        }

        let data = {
            'putaway_field': {
                [id_barang]: {
                    'id_barang': id_barang,
                    'batch_id': batch_id,
                    'id_inbound': currentRow.find(`input[name="putaway_field[${id_barang}][id_inbound]"]`).val(),
                    'id_putaway': currentRow.find(`input[name="putaway_field[${id_barang}][id_putaway]"]`).val(),
                    'id_data_inbound': currentRow.find(`input[name="putaway_field[${id_barang}][id_data_inbound]"]`).val(),
                    'rack_ids': rack_ids,
                    'quantities': quantities
                }
            }
        };

        $.ajax({
            url: '<?= site_url('user/putaway/create_putaway') ?>',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Putaway successfully submitted!'
                });
                currentRow.remove();
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'There was a problem saving the data. Please try again.'
                });
            }
        });
    });


		$('#finishPutaway').on('click', function(e) {
				e.preventDefault(); 

				Swal.fire({
						title: 'Are you sure?',
						text: "This will finish the putaway process.",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Yes, finish it!'
				}).then((result) => {
						if (result.isConfirmed) {
								$.ajax({
										url: "<?= base_url('user/putaway/finishPutaway') ?>",
										type: "POST",
										data: { id_putaway: $('input[name="id_putaway"]').val() },
										success: function(response) {
												Swal.fire('Finished!', response.message, 'success');
											 	if (result.isConfirmed) {
														window.location.href = '<?= base_url('user/putaway') ?>';
												}
										},
										error: function() {
												Swal.fire('Error', 'Something went wrong.', 'error');
										}
								});
						}
				});
			});


			$(document).on('click', '.add-row', function() {
					var $table = $(this).closest('table');
					var id_barang = $table.closest('tr').find('input[name^="putaway_field"]').attr('name').match(/\[(.*?)\]/)[1]; 
					var newRow = '<tr>' +
							'<td><input type="text" name="putaway_field[' + id_barang + '][id_rack][]" class="form-control" placeholder="Enter Rack"></td>' +
							'<td><input type="text" name="putaway_field[' + id_barang + '][quantity][]" class="form-control" placeholder="Enter Quantity"></td>' +
							'<td><button type="button" class="btn btn-sm btn-danger remove-row">Remove</button></td>' +
							'</tr>';
					$table.find('tbody').append(newRow);
			});

			$(document).on('click', '.remove-row', function() {
					$(this).closest('tr').remove();
			});

			$('#table').on('input', '.quantity-input', function() {
				calculateTotalQuantity();
			});


			function calculateTotalQuantity() {
				let totalQuantity = 0;
				let good_qty = $('.submitPutawayData').data('quantity');


				$('input[name^="putaway_field"][name$="[quantity][]"]').each(function() {
					totalQuantity += parseInt($(this).val()) || 0;
				});

				if (totalQuantity < good_qty) {
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: `Total quantity yang diinputkan (${totalQuantity}) kurang dari jumlah yang dibutuhkan (${good_qty}).`
					});
				}

				if (totalQuantity > good_qty) {
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: `Total quantity yang diinputkan (${totalQuantity}) lebih dari jumlah yang dibutuhkan (${good_qty}).`
					});
				}
			}
		});
	</script>
</body>

</html>
