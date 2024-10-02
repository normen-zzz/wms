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
</head>



<body>
	<script src="<?= base_url() . '/' ?>assets/static/js/initTheme.js"></script>
	<div id="app">
		<div id="main" class="layout-horizontal">
			<header class="mb-5">
				<?php $this->load->view('templates/header') ?>
				<?php $this->load->view('templates/navbar') ?>
			</header>
			<style>
				/* Default width for desktop screens */
				.addRackRow {
					width: 200px;
					/* adjust this value to your liking */
				}

				#availableRacks {
					width: 200px;
				}

				/* For tablet screens */
				@media only screen and (max-width: 768px) {
					.addRackRow {
						width: 200px;
						/* adjust this value to your liking */
					}

					#availableRacks {
						width: 200px;
					}
				}

				/* For mobile screens */
				@media only screen and (max-width: 480px) {
					.addRackRow {
						width: 200px;
						/* adjust this value to your liking */
					}

					#availableRacks {
						width: 200px;
					}
				}
			</style>

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

										<form action="<?= base_url('user/Pickingslip/finishPickingSlip/' . $uuid) ?>" method="POST">

											<button id="buttonFinishPickingslip" type="submit" class="btn btn-success">Finish Picking</button>
											<span class="text-danger">*Pastikan sudah terpick semua jika ingin menyelesaikan</span>

										</form>

									</div>

									<div class="card-body">
										<h1>Picking Slip: <?= $picking_slip['no_pickingslip'] ?></h1>
										<div class="table-responsive mt-4">
											<table class="table table-striped" id="inboundDetailsTable">
												<thead>
													<tr>
														<th>SKU</th>
														<th>Item Name</th>
														<th>Batch</th>
														<th>Qty</th>
														<th id="availableRacks">Available Racks</th>
														<th>Rack & qty</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($items as $item) : ?>

														<tr>
															<td><?= $item['sku'] ?></td>
															<td><?= $item['nama_barang'] ?>
																<input type="number" hidden name="id_barang" value="<?= $item['id_barang'] ?>">
																<input type="number" hidden name="id_datapurchaseorder" hidden value="<?= $item['id_datapurchaseorder'] ?>">
															</td>


															<td><?= $item['batchnumber'] ?><input type="number" hidden name="id_batch" value="<?= $item['id_batch'] ?>"></td>

															<td><?= $item['qty'] ?> <input hidden type="number" name="requiredQty" value="<?= $item['qty'] ?>"></td>
															<td>
																<button type="button" class="btn btn-sm btn-primary get-recommendations" data-id-barang="<?= $item['id_barang'] ?>" data-id_batch="<?= $item['id_batch'] ?>">
																	Get Available On Rack
																</button>
																<div class="recommendations-list" style="display:none;"></div>
															</td>
															<td>

																<table class="addRackRow">
																	<thead>
																		<tr>
																			<th>Rack</th>
																			<th>Qty</th>
																		</tr>
																	</thead>

																	<tbody>
																		<tr>
																			<td><input type="text" name="rack[]" id="rack" class="form-control rack"></td>
																			<td><input type="number" name="qty[]" id="qty" class="form-control qty">
																				<input type="number" name="id_batch" hidden value="<?= $item['id_batch'] ?>">
																				<input type="number" name="id_barang" hidden value="<?= $item['id_barang'] ?>">
																			</td>
																		</tr>
																	</tbody>


																	<tfoot>
																		<tr>
																			<td colspan="2"><button class="addRowRackBtn btn btn-primary">Add Row</button></td>
																		</tr>
																	</tfoot>
																</table>


															</td>
															<td><button type="button" id="submitRow" class="submitRow btn btn-primary">Submit</button></td>
														</tr>

													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!-- create view form -->



								<!-- Basic Tables end -->
							</div>
						</div>
					</section>
					<!-- // Basic Vertical form layout section end -->
				</div>
			</div>
			<!-- Modal Edit -->
			<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editModalLabel">Edit Picklist</h5>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="editForm">
								<input type="hidden" id="id_picklist" name="id_picklist">
								<div class="form-group">
									<label for="no_picklist">No Picklist</label>
									<input type="text" class="form-control" id="no_picklist" name="no_picklist" required>
								</div>
								<div class="form-group">
									<label for="batch">Batch</label>
									<input type="text" class="form-control" id="batch" name="batch" required>
								</div>
								<div class="form-group">
									<label for="qty">Quantity</label>
									<input type="text" class="form-control" id="qty" name="qty" required>
								</div>
								<div class="form-group">
									<label for="status">Status</label>
									<select class="form-control" id="status" name="status">
										<option value="0">Created</option>
										<option value="1">Completed</option>
									</select>
								</div>
								<button type="submit" class="btn btn-primary">Save Changes</button>
							</form>
						</div>
					</div>
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
			$('.assignPicker').select2();
			checkQtyOnRack();

			$('#buttonFinishPickingslip').on('click', function(e) {
				e.preventDefault();
				Swal.fire({
					title: 'Confirm',
					text: 'Are you sure you want to finish this picking slip?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes',
					cancelButtonText: 'No',
				}).then((result) => {
					if (result.isConfirmed) {
						$(this).closest('form').submit();
					}
				});
			});
		});
	</script>


	<script>
		$('.addRowRackBtn').on('click', function() {
			var newRow = `
    <tr>
      <td><input type="text" name="rack[]" id="rack" class="form-control rack"></td>
      <td><input type="number" name="qty[]" id="qty" class="form-control qty"></td>
      <td><button class="deleteRowBtn btn btn-danger">Hapus</button></td>
    </tr>
  `;
			$(this).closest('table').find('tbody').append(newRow);
			checkQtyOnRack();
		});

		$(document).on('click', '.deleteRowBtn', function() {
			$(this).closest('tr').remove();
		});
	</script>

	<script>
		$('#inboundForm').on('submit', function(e) {
			e.preventDefault();

			var $submitBtn = $(this).find('button[type="submit"]');
			$submitBtn.prop('disabled', true);

			$.ajax({
				url: "<?= base_url('user/inbound/process/' . $uuid) ?>",
				type: "POST",
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response) {
					Swal.fire({
						title: response.status === 'success' ? 'Success' : 'Error',
						text: response.message,
						icon: response.status === 'success' ? 'success' : 'error',
						confirmButtonText: 'OK'
					}).then(() => {
						if (response.status === 'success') {
							window.location.href = "<?= base_url('user/inbound') ?>";
						}
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {
					Swal.fire({
						title: 'Error',
						text: 'Something went wrong: ' + textStatus,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			});
		});
	</script>



	<script>
		$('.submitRow').on('click', function() {


			var data = [];
			var row = $(this).closest('tr');
			var id_datapurchaseorder = $(this).closest('tr').find('input[name="id_datapurchaseorder"]').val();
			var id_barang = $(this).closest('tr').find('input[name="id_barang"]').val();
			var id_batch = $(this).closest('tr').find('input[name="id_batch"]').val();
			var requiredQty = $(this).closest('tr').find('input[name="requiredQty"]').val();

			var totalQty = 0;
			$(this).closest('td').prev('td').find('table.addRackRow').find('tbody tr').each(function() {
				var row = $(this);
				var rack = row.find('input[name="rack[]"]').val();
				var qty = row.find('input[name="qty[]"]').val();
				totalQty += parseInt(qty);
				data.push({
					id_datapurchaseorder: id_datapurchaseorder,
					id_barang: id_barang,
					id_batch: id_batch,
					rack: rack,
					qty: qty
				});
			});

			if (totalQty < requiredQty) {
				alert('Total qty tidak mencukupi');
				return false;
			} else if (totalQty > requiredQty) {
				alert('Total qty melebihi yang dibutuhkan');
				return false;
			}
			Swal.fire({
				title: 'Loading',
				text: 'Please wait...',
				icon: 'info',
				showCancelButton: false,
				showConfirmButton: false,
			});

			console.log(data);

			//Post the data using jQuery
			$.ajax({
				type: 'POST',
				url: '<?= base_url('user/Pickingslip/pickFromRackProcess/' . $uuid) ?>',
				data: {
					data: data
				},
				dataType: 'json',
				success: function(response) {


					Swal.fire({
						title: response.status === 'success' ? 'Success' : 'Error',
						text: response.message,
						icon: response.status === 'success' ? 'success' : 'error',
						confirmButtonText: 'OK'
					}).then(() => {
						if (response.status === 'success') {

							row.remove();
						}
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {
					Swal.fire({
						title: 'Error',
						text: 'Something went wrong: ' + textStatus,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			});
		});
	</script>



	<script>
		$(document).ready(function() {
			$('.clickable-row').on('click', function() {
				// Get the data from the row
				var sku = $(this).find('td:eq(0)').text();
				var nama_barang = $(this).find('td:eq(1)').text();
				var batchnumber = $(this).find('td:eq(2)').text();

				// Open the modal
				$('#editModal').modal('show');

				// Set the modal title and body
				$('#editModalLabel').text('Edit Picklist: ' + sku);
				$('#no_picklist').val(sku);
				$('#batch').val(batchnumber);
				$('#qty').val(''); // Set the quantity field to empty
				$('#status').val('0'); // Set the status field to "Created"
			});
		});
	</script>

	<script>
		$('.get-recommendations').on('click', function(e) {
			e.preventDefault();
			var button = $(this);
			var id_barang = button.data('id-barang');

			var id_batch = button.data('id_batch');
			var recommendationsList = button.siblings('.recommendations-list');

			recommendationsList.html('<p>Loading Available...</p>').show();

			$.ajax({
				url: '<?= base_url("user/Pickingslip/getAvailableRack") ?>',
				method: 'POST',
				data: {
					id_barang: id_barang,
					id_batch: id_batch
				},
				dataType: 'json',
				success: function(response) {
					recommendationsList.empty();
					if (response.length > 0) {
						var ul = $('<ul>');
						response.forEach(function(rack) {
							var li = $('<li class="mt-2">').text('(' + rack.sloc + ') =' + rack.quantity + ' pcs');
							ul.append(li);
						});
						recommendationsList.append(ul);
					} else {
						recommendationsList.text('No recommendations available');
					}
				}
			});
		});
	</script>

	<script>
		function checkQtyOnRack() {
			$('table.addRackRow tbody').off('keyup', 'input[name="qty[]"]').on('keyup', 'input[name="qty[]"]', function() {
				var rack = $(this).closest('tr').find('input[name="rack[]"]').val();
				var qty = parseInt($(this).val());
				var id_barang = $(this).closest('tr').parent().find('input[name="id_barang"]').val();
				var id_batch = $(this).closest('tr').parent().find('input[name="id_batch"]').val();
				var inputQty = $(this); // Simpan referensi ke input qty[]
				console.log(id_barang, id_batch, rack, qty);

				$.ajax({
					url: '<?= base_url("user/Pickingslip/getQuantityRackItems") ?>',
					method: 'POST',
					data: {
						id_barang: id_barang,
						id_batch: id_batch,
						rack: rack
					},
					dataType: 'json',
					success: function(response) {
						console.log(qty, response);
						if (qty > response) {

							inputQty.val(response); // Gunakan variabel inputQty untuk mengakses input qty[]
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {

						inputQty.val('');
					}
				});
			});
		}
	</script>





</body>

</html>