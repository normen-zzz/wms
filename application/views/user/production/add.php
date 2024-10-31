<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?= $title ?></title>

	<link rel="shortcut icon" href="<?= base_url() . '/' ?>assets/compiled/svg/favicon.svg" type="image/x-icon" />
	<link rel="shortcut icon"
		href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
		type="image/png" />

	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/app.css" />
	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/app-dark.css" />
	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/iconly.css" />
	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.min.css">
	<link rel="stylesheet"
		href="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
	<!-- select2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/table-datatable-jquery.css">
	<style>
		.select2-container {
			width: 100% !important;
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
									<div class="card-header d-flex justify-content-between align-items-center">
										<h5 class="card-title mb-0">
											<?= $subtitle2 ?>
										</h5>
									</div>

									<div class="card-body">
										<form id="production-form">
											<!-- Description -->
											<div class="form-group mb-3">
												<label for="sku_bundling" class="form-label">SKU Bundling</label>
												<select id="sku_bundling" class="form-control select-sku-bundling">
													<option value="">Select SKU Bundling</option>
													<?php foreach ($sku_bundling->result() as $row) : ?>
													<option value="<?= $row->sku ?>"><?= $row->sku ?> || <?= $row->nama_barang ?></option>
													<?php endforeach; ?>
												</select>
												<label for="batch_bundling">Batch Bundling</label>
												<input type="text" class="form-control" id="batch_bundling" name="batch_bundling"
													placeholder="Batch Bundling">
												<!-- quantity  -->
												<label for="quantity_bundling">Quantity</label>
												<input type="number" class="form-control" id="quantity_bundling" name="quantity_bundling"
													placeholder="Quantity">

												<!-- ed_bundling -->
												<label for="ed_bundling">Expired Date</label>
												<input type="date" class="form-control" id="ed_bundling" name="ed_bundling"
													placeholder="Expired Date">


												<button type="button" id="search-bundling" class="btn btn-primary mt-2">Search</button>
											</div>

											<!-- Materials Section -->
											<h2>Materials</h2>
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead class="table-light">
														<tr>
															<th>SKU</th>
															<th>Description</th>
															<th>Base qty</th>
															<th>Need Qty</th>
															<th>Batch Selection</th>

														</tr>
													</thead>
													<tbody id="material-rows">

													</tbody>
													<tfoot>
														<tr>
															<td colspan="6" class="text-end">
																<!-- <button type="button" id="add-material-btn" class="btn btn-secondary">Add
																	Material</button> -->
																<button type="submit" class="btn btn-primary">Save</button>
															</td>
														</tr>
													</tfoot>
												</table>
											</div>
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

			<!-- Modal Inbound -->
			<?php $this->load->view('templates/footer') ?>
		</div>
	</div>



	<script src="<?= base_url() . '/' ?>assets/static/js/components/dark.js"></script>
	<script src="<?= base_url() . '/' ?>assets/static/js/pages/horizontal-layout.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<script src="<?= base_url() . '/' ?>assets/compiled/js/app.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/jquery/jquery.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
	<!-- select2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>



	<!-- select 2 select-sku-bundling -->
	<script>
		$(document).ready(function () {
			$('.select-sku-bundling').select2();
		});

	</script>
	<!-- show material on table material-rows from value select-sku-bundling after click search-bundling -->
	<script>
		$(document).ready(function () {
			$('#search-bundling').click(function () {
				var sku = $('#sku_bundling').val();
				var quantity_bundling = $('#quantity_bundling').val();
				$.ajax({
					url: '<?= base_url() ?>user/production/get_materials',
					type: 'post',
					data: {
						sku: sku
					},
					success: function (response) {
						$('#material-rows').html('');
						var data = JSON.parse(response);

						data.forEach(function (item) {
							$.ajax({
								url: '<?= base_url() ?>user/production/getBatchMaterial',
								type: 'post',
								data: {
									sku: item.sku_material
								},
								success: function (batchResponse) {
									var batches = JSON.parse(batchResponse);
									var batchOptions = '';

									batches.forEach(function (batch) {
										batchOptions +=
											`<option value="${batch.id_batch}">${batch.batchnumber}</option>`;
									});

									$('#material-rows').append(`
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" value="${item.sku_material}" name="sku_material[]" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="${item.nama_material}" name="nama_material[]" readonly>
                                    </td>
                                    <td>
                                        ${item.qty}
                                    </td>
                                    <td>
                                        ${item.qty * quantity_bundling}
                                    </td>
                                    <td>
                                        <table class="tableBatch">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="batch[]" class="form-control batchMaterial">
                                                            <option value="">Select Batch</option>
                                                            ${batchOptions}
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="qtyBatch[]" placeholder="Qty">
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-primary addRowBatchMaterial">Add Batch</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>
                            `);
									$('.batchMaterial').select2();
								}
							});
						});
					}
				});
			});

			function getRequiredQuantity($materialRow) {
				var baseQty = parseFloat($materialRow.find('td:eq(2)').text()) || 0;
				var bundlingQty = parseFloat($('#quantity_bundling').val()) || 0;
				return baseQty * bundlingQty;
			}

			$(document).on('click', '.addRowBatchMaterial', function () {
				var batchOptions = $(this).closest('table').find('select.batchMaterial').html();
				var $tbody = $(this).closest('table').find('tbody');

				$tbody.append(`
            <tr>
                <td>
                    <select name="batch[]" class="form-control batchMaterial">
                        ${batchOptions}
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control qtyBatchInput" name="qtyBatch[]" placeholder="Qty">
                </td>
                <td>
                    <button type="button" class="btn btn-danger deleteRowBatchMaterial">Delete</button>
                </td>
            </tr>
        `);
				$('.batchMaterial').select2();

				recalculateTotals($tbody);
			});

			$(document).on('click', '.deleteRowBatchMaterial', function () {
				var $tbody = $(this).closest('tbody');
				$(this).closest('tr').remove();
				recalculateTotals($tbody);
			});

			$(document).on('input', '.qtyBatchInput', function () {
				var $tbody = $(this).closest('tbody');
				recalculateTotals($tbody);
			});

			$('#quantity_bundling').on('input', function () {
				$('.tableBatch tbody').each(function () {
					recalculateTotals($(this));
				});
			});

			function recalculateTotals($tbody) {
					var $materialRow = $tbody.closest('tr');
					var requiredQty = getRequiredQuantity($materialRow);

					if (isNaN(requiredQty) || requiredQty <= 0) {
							console.error('Invalid required quantity:', requiredQty);
							return false;
					}

					var totalBatchQty = 0;

					$tbody.find('input[name="qtyBatch[]"]').each(function () {
							var qty = parseFloat($(this).val()) || 0;
							totalBatchQty += qty;
					});

					if (totalBatchQty > requiredQty) {
							Swal.fire({
									title: 'Error!',
									text: `Jumlah total batch (${totalBatchQty}) melebihi jumlah yang dibutuhkan (${requiredQty})`,
									icon: 'error',
									confirmButtonText: 'OK'
							});

							$tbody.find('input[name="qtyBatch[]"]').last().val('');
							return false;
					}

					return true;
			}

			$('#production-form').submit(function (e) {
				e.preventDefault();

				var formData = {
					sku_bundling: $('#sku_bundling').val(),
					batch_bundling: $('#batch_bundling').val(),
					quantity_bundling: $('#quantity_bundling').val(),
					ed_bundling: $('#ed_bundling').val(),
					materials: []
				};

				var isValid = true;
				var errorMessage = '';

				if (!formData.quantity_bundling || parseFloat(formData.quantity_bundling) <= 0) {
					Swal.fire({
						title: 'Error!',
						text: 'Please enter a valid bundling quantity',
						icon: 'error',
						confirmButtonText: 'OK'
					});
					return;
				}

				$('#material-rows tr').each(function () {
					var $materialRow = $(this);
					var requiredQty = getRequiredQuantity($materialRow);
					var materialBatches = [];
					var totalBatchQty = 0;

					$materialRow.find('.tableBatch tbody tr').each(function () {
						var batchId = $(this).find('select[name="batch[]"]').val();
						var qtyBatch = parseFloat($(this).find('input[name="qtyBatch[]"]').val()) || 0;

						if (batchId && qtyBatch > 0) {
							materialBatches.push({
								batch: batchId,
								qtyBatch: qtyBatch
							});
							totalBatchQty += qtyBatch;
						}
					});

					var difference = Math.abs(totalBatchQty - requiredQty);
					if (difference > 0.01) {
						isValid = false;
						errorMessage =
							`Jumlah material tidak sesuai. Dibutuhkan: ${requiredQty}, Total jumlah batch: ${totalBatchQty}`;
						return false;
					}

					formData.materials.push({
						sku_material: $materialRow.find('input[name="sku_material[]"]').val(),
						batches: materialBatches
					});
				});

				if (!isValid) {
					Swal.fire({
						title: 'Validation Error',
						text: errorMessage,
						icon: 'error',
						confirmButtonText: 'OK'
					});
					return;
				}

				$.ajax({
					url: '<?= base_url() ?>user/production/save_production',
					type: 'post',
					data: formData,
					success: function (response) {
						Swal.fire({
							title: 'Success!',
							text: 'Production saved successfully!',
							icon: 'success',
							confirmButtonText: 'OK'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = '<?= base_url() ?>user/production';
							}
						});
					},
					error: function (xhr) {
						var errorMessage = 'Failed to save production. Please try again.';
						if (xhr.responseJSON && xhr.responseJSON.message) {
							errorMessage = xhr.responseJSON.message;
						}
						Swal.fire({
							title: 'Error!',
							text: errorMessage,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				});
			});

		});

	</script>

</body>

</html>
