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
													<!-- Options will be populated by AJAX -->
												</select>
											</div>

											<!-- Materials Section -->
											<h2>Materials</h2>
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead class="table-light">
														<tr>
															<th>SKU</th>
															<th>Description</th>
															<th>Qty</th>
															<th>UoM</th>
															<th>Batch Selection</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody id="material-rows">
														<tr>
															<td>
																<select class="form-control select-sku" name="sku[]">
																	<option value="">Select SKU</option>
																</select>
															</td>
															<td>
																<input type="text" class="form-control description" name="description[]"
																	placeholder="Description">
															</td>
															<td>
																<input type="number" class="form-control" name="quantity[]" value="1">
															</td>
															<td>
																<input type="text" class="form-control uom" name="uom[]" placeholder="UoM">
															</td>
															<td>
																<select class="form-control select-batch" name="batch[]">
																	<option value="">Select Batch</option>
																</select>
															</td>
															<td class="text-center">
																<button type="button" class="btn btn-danger btn-sm delete-row">Delete row</button>
															</td>
														</tr>
													</tbody>
													<tfoot>
														<tr>
															<td colspan="6" class="text-end">
																<button type="button" id="add-material-btn" class="btn btn-secondary">Add
																	Material</button>
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

	<script>
		$(document).ready(function () {
			function loadSKUBundlingOptions($select) {
				$.ajax({
					url: "<?= base_url('user/production/get_all_bundling_skus') ?>",
					method: "GET",
					dataType: "json",
					success: function (data) {
						$select.empty();
						$select.append('<option value="">Select SKU Bundling</option>');
						$.each(data, function (index, item) {
							$select.append('<option value="' + item.id_bundling + '">' + item.sku + '</option>');
						});
						$select.select2();
					}
				});
			}

			$('.select-sku-bundling').each(function () {
				loadSKUBundlingOptions($(this));
			});

			function loadSKUOptions($select) {
				$.ajax({
					url: "<?= base_url('user/production/get_all_barang') ?>",
					method: "GET",
					dataType: "json",
					success: function (data) {
						$select.empty();
						$select.append('<option value="">Select SKU</option>');
						$.each(data, function (index, item) {
							$select.append('<option value="' + item.id_barang + '" data-uom="' + item.uom +
								'" data-description="' + item.nama_barang + '">' + item.sku + '</option>');
						});

						$select.select2();
					}
				});
			}

			$('.select-sku').each(function () {
				loadSKUOptions($(this));
			});

			$('#add-material-btn').click(function () {
				var newRow = `
							<tr>
									<td>
											<select class="form-control select-sku" name="sku[]">
													<option value="">Select SKU</option>
											</select>
									</td>
									<td>
											<input type="text" class="form-control description" name="description[]" placeholder="Description">
									</td>
									<td>
											<input type="number" class="form-control" name="quantity[]" value="1">
									</td>
									<td>
											<input type="text" class="form-control uom" name="uom[]" placeholder="UoM">
									</td>
									<td>
											<select class="form-control select-batch" name="batch[]">
													<option value="">Select Batch</option>
											</select>
									</td>
									<td class="text-center">
											<button type="button" class="btn btn-danger btn-sm delete-row">Delete row</button>
									</td>
							</tr>
					`;

				$('#material-rows').append(newRow);
				loadSKUOptions($('#material-rows').find('.select-sku').last());
			});

			$(document).on('change', '.select-sku', function () {
				var $row = $(this).closest('tr');
				var selectedOption = $(this).find('option:selected');
				var description = selectedOption.data('description');
				var uom = selectedOption.data('uom');

				$row.find('.description').val(description);
				$row.find('.uom').val(uom);

				var sku = $(this).val();

				if (sku) {
					$.ajax({
						url: "<?= base_url('user/production/get_batches') ?>",
						method: "POST",
						data: {
							sku: sku
						},
						dataType: 'json',
						success: function (data) {
							console.log('Response data:', data);
							var $batchSelect = $row.find('.select-batch');

							$batchSelect.empty().append('<option value="">Select Batch</option>');

							if (data && Array.isArray(data) && data.length > 0) {
								data.forEach(function (batch) {
									var option = $('<option></option>')
										.val(batch.id_batch)
										.text(batch.batchnumber + ' (Qty: ' + batch.quantity + ', Exp: ' + batch
											.expiration_date + ')');
									$batchSelect.append(option);
								});
							} else {
								$batchSelect.append('<option value="">No available batches</option>');
							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							console.error('AJAX error:', textStatus, errorThrown);
							console.error('Response:', jqXHR.responseText);
						}
					});
				} else {
					$row.find('.select-batch').empty().append('<option value="">Select Batch</option>');
				}
			});

			$(document).on('click', '.delete-row', function () {
				$(this).closest('tr').remove();
			});

			document.addEventListener('click', function (event) {
				if (event.target.classList.contains('delete-row')) {
					event.target.closest('tr').remove();
				}
			});


			// submit
			$('#production-form').submit(function (e) {
				e.preventDefault();

				// Create FormData object
				var formData = new FormData(this);

				// Convert FormData to array for debugging
				var object = {};
				formData.forEach((value, key) => {
					if (!object[key]) {
						object[key] = [];
					}
					object[key].push(value);
				});
				console.log('Form data:', object);

				$.ajax({
					url: "<?= base_url('user/production/submit_bundling') ?>",
					method: "POST",
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {
						console.log('Response:', data);
						try {
							var response = JSON.parse(data);
							if (response.success) {
								Swal.fire({
									title: 'Success',
									text: response.message,
									icon: 'success'
								}).then((result) => {
									if (result.isConfirmed) {
										window.location.href = '<?= base_url('user/production') ?>';
									}
								});
							} else {
								Swal.fire({
									title: 'Error',
									text: response.message,
									icon: 'error'
								});
							}
						} catch (e) {
							console.error('Error parsing response:', e);
							Swal.fire({
								title: 'Error',
								text: 'An error occurred while processing the response',
								icon: 'error'
							});
						}
					},
					error: function (xhr, status, error) {
						console.error('AJAX Error:', status, error);
						Swal.fire({
							title: 'Error',
							text: 'An error occurred while submitting the form',
							icon: 'error'
						});
					}
				});
			});
		});

	</script>




</body>

</html>
