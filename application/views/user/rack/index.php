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
										<button type="button" data-bs-toggle="modal" data-bs-target="#modalAddRack"
											class="btn btn-primary">Add <?= $subtitle ?></button>
										<!-- button add rack bulky modal -->
										<button type="button" data-bs-toggle="modal" data-bs-target="#modalAddRackBulky"
											class="btn btn-primary">Add <?= $subtitle ?> Bulky</button>

									</div>

									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="table1">
												<thead>
													<tr>
														<th>Sloc</th>
														<th>Zone</th>
														<th>Rack</th>
														<th>Row</th>
														<th>Column</th>
														<th>Max QTY</th>
														<th>UOM</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($rack->result_array() as $rack1) { ?>
													<tr>
														<td><?= $rack1['sloc'] ?></td>
														<td><?= $rack1['zone'] ?></td>
														<td><?= $rack1['rack'] ?></td>
														<td><?= $rack1['row'] ?></td>
														<td><?= $rack1['column_rack'] ?></td>
														<td><?= $rack1['max_qty'] ?></td>
														<td><?= $rack1['uom'] ?></td>
														<td><?= getStatusRack($rack1['is_deleted']) ?></td>
														<td>
															<!-- a print qr code  -->
															<a target="_blank" href="<?= base_url('user/rack/print_slocrack/' . $rack1['id_rack']) ?>"
																class="btn btn-sm btn-primary">Print QR Code</a>

															<!-- <a target="_blank" href="<?= base_url('user/rack/print_sloc/' . $rack1['sloc']) ?>" class="btn btn-sm btn-secondary">Print Items QR Code</a> -->


															<!-- tag a print items qr code  -->
															<a target="_blank" href="<?= base_url('user/rack/print_items_qr/' . $rack1['sloc']) ?>"
																class="btn btn-sm btn-primary">Print Items QR Code</a>
															<!-- activated dan nonactivated -->
															<?php if ($rack1['is_deleted'] == 1) { ?>
															<button class="btn btn-sm btn-success activate-rack"
																data-id="<?= $rack1['id_rack'] ?>">Activate</button>
															<?php } else { ?>
															<button class="btn btn-sm btn-danger deactivate-rack"
																data-id="<?= $rack1['id_rack'] ?>">Deactivate</button>
															<?php } ?>
														</td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
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

	<!--login form Modal -->
	<div class="modal fade text-left" id="modalAddRack" tabindex="-1" role="dialog" aria-labelledby="modalAddRack"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel33">Add Rack Form</h4>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<form id="addRack">
					<div class="modal-body">
						<label for="sloc">Sloc</label>
						<div class="form-group">
							<input id="sloc" type="text" placeholder="Sloc" name="sloc" class="form-control">
						</div>
						<label for="zone">Zone</label>
						<div class="form-group">
							<input id="zone" type="text" placeholder="Zone" name="zone" class="form-control">
						</div>

						<label for="rack">Rack</label>
						<div class="form-group">
							<input id="rack" type="text" placeholder="rack" name="rack" class="form-control">
						</div>

						<label for="row">Row</label>
						<div class="form-group">
							<input id="row" type="text" placeholder="Row" name="row" class="form-control">
						</div>

						<label for="column">Column</label>
						<div class="form-group">
							<input id="column" type="text" placeholder="Column" name="column" class="form-control">
						</div>

						<label for="maxqty">Max QTY</label>
						<div class="form-group">
							<input id="maxqty" type="text" placeholder="MAX QTY" name="maxqty" class="form-control">
						</div>

						<label for="uom">Uom</label>
						<div class="form-group">
							<input id="uom" type="text" placeholder="Uom" name="uom" class="form-control">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">

							Close
						</button>
						<button type="submit" class="btn btn-primary ms-1" id="addRackButton">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- modal add rack bulky -->
	<div class="modal fade text-left" id="modalAddRackBulky" tabindex="-1" role="dialog"
		aria-labelledby="modalAddRackBulky" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel33">Add Rack Bulky Form</h4>
					<!-- button download template from controller  -->
					<a href="<?= base_url('user/Rack/download_template') ?>" class="btn btn-primary">Download Template</a>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<i data-feather="x"></i>
					</button>
				</div>
				<form id="formAddRackBulky">
					<div class="modal-body">
						<!-- input file khusus excel  -->
						<div class="form-group">
							<label for="rackBulky">Upload File Excel</label>
							<input type="file" class="form-control" id="rackBulky" name="rackBulky" accept=".xls, .xlsx">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary ms-1" id="addRackBulkyButton">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Rack</h5>
					<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<input type="hidden" id="editrack_id" name="rack_id">
						<div class="form-group">
							<label for="sloc">Sloc</label>
							<input type="text" id="editsloc" name="sloc" class="form-control">
						</div>
						<div class="form-group">
							<label for="zone">Zone</label>
							<input type="text" id="editzone" name="zone" class="form-control">
						</div>
						<label for="rack">Rack</label>
						<div class="form-group">
							<input type="text" id="editrack" name="rack" class="form-control">
						</div>

						<label for="row">Row</label>
						<div class="form-group">
							<input type="text" id="editrow" name="row" class="form-control">
						</div>

						<label for="column">Column</label>
						<div class="form-group">
							<input type="text" id="editcolumn" name="column" class="form-control">
						</div>

						<label for="maxqty">Max QTY</label>
						<div class="form-group">
							<input type="text" id="editmaxqty" name="maxqty" class="form-control">
						</div>

						<label for="uom">Uom</label>
						<div class="form-group">
							<input type="text" id="edituom" name="uom" class="form-control">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
				</div>
			</div>
		</div>
	</div>


	<script src="<?= base_url() . '/' ?>assets/static/js/components/dark.js"></script>
	<script src="<?= base_url() . '/' ?>assets/static/js/pages/horizontal-layout.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<script src="<?= base_url() . '/' ?>assets/compiled/js/app.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/jquery/jquery.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
	<script src="<?= base_url() . '/' ?>assets/static/js/pages/datatables.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>

	<script>
		$('.edit-btn').click(function () {
			var id = $(this).data('id');

			$.ajax({
				url: '<?= base_url("rack/get_rack") ?>/' + id,
				type: 'GET',
				dataType: 'json',
				success: function (data) {
					console.log(data);
					if (data) {
						$('#editrack_id').val(data.id_rack);
						$('#editsloc').val(data.sloc);
						$('#editzone').val(data.zone);
						$('#editrack').val(data.rack);
						$('#editrow').val(data.row);
						$('#editcolumn').val(data.column_rack);
						$('#editmaxqty').val(data.max_qty);
						$('#edituom').val(data.uom);

						$('#editModal').modal('show');
					} else {
						Swal.fire({
							title: 'Error!',
							text: 'Data not found!',
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				},
				error: function (xhr) {
					Swal.fire({
						title: 'Error!',
						text: 'An error occurred while fetching the rack data.',
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			});
		});

		$('#saveChanges').click(function () {
			$.ajax({
				url: '<?= base_url("rack/update_rack") ?>',
				type: 'POST',
				data: $('#editForm').serialize(),
				success: function (response) {
					Swal.fire({
						title: 'Updated!',
						text: 'Rack data has been updated.',
						icon: 'success',
						confirmButtonText: 'OK'
					}).then((result) => {
						if (result.isConfirmed) {
							location.reload();
						}
					});
				},
				error: function (xhr) {
					Swal.fire({
						title: 'Error!',
						text: 'An error occurred while updating the rack.',
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			});
		});

		$('#addRack').on('submit', function (e) {
			e.preventDefault();
			$.ajax({
				url: "<?= base_url('user/rack/processaddrack') ?>",
				type: "POST",
				data: $(this).serialize(),
				dataType: 'json',
				success: function (response) {
					Swal.fire({
						title: response.status === 'success' ? 'Success' : 'Error',
						text: response.message,
						icon: response.status === 'success' ? 'success' : 'error',
						confirmButtonText: 'OK'
					}).then(() => {
						if (response.status === 'success') {

							window.location.href = "<?= base_url('user/rack') ?>";
						}
					});
				},
				error: function (jqXHR, textStatus, errorThrown) {
					Swal.fire({
						title: 'Error',
						text: 'Something went wrong: ' + textStatus,
						icon: 'error',
						confirmButtonText: 'OK'
					});
					window.location.href = "<?= base_url('user/rack') ?>";
				}
			});
		});

		$('.delete-btn').click(function () {
			var id = $(this).data('id');

			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url("rack/delete_rack") ?>/' + id,
						type: 'POST',
						success: function (response) {
							Swal.fire({
								title: 'Deleted!',
								text: 'Rack data has been deleted.',
								icon: 'success',
								confirmButtonText: 'OK'
							}).then((result) => {
								if (result.isConfirmed) {
									location.reload();
								}
							});
						},
						error: function (xhr) {
							Swal.fire({
								title: 'Error!',
								text: 'An error occurred while deleting the rack.',
								icon: 'error',
								confirmButtonText: 'OK'
							});
						}
					});
				}
			});
		});

		// get ready document
		$(document).ready(function () {
			$('.print-sloc-barcode-items').click(function () {
				const sloc = $(this).data('sloc');

				$.ajax({
					url: 'user/rack/get_items_by_sloc',
					method: 'POST',
					data: {
						sloc: sloc
					},
					dataType: 'json',
					success: function (response) {
						console.log('Response:', response);

						if (response && response.status === 'success' && Array.isArray(response.items)) {
							const itemsData = response.items;
							const qrCodeUrl =
								`https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(`${sloc}`)}&size=300x300`;
							const qrCodeImage = new Image();
							qrCodeImage.src = qrCodeUrl;

							qrCodeImage.onload = function () {
									const printWindow = window.open('', '_blank');
									printWindow.document.write(`
											<html>
													<head>
															<title>Print QR Code with Items</title>
															<style>
																	@media print {
																			@page {
																					size: portrait; 
																			}
																	}
																	body {
																			justify-content: center;
																			align-items: center;
																			height: 100vh;
																			text-align: center;
																			margin: 0;
																	}
																	.content {
																			display: inline-block;
																			text-align: center;
																			font-size: 20px;
																	}
																	h3 {
																			margin-top: 10px;
																	}
																	ul {
																			list-style-type: none;
																			padding: 0;
																	}
																	li {
																			margin-bottom: 5px;
																			text-align: left;
																	}
															</style>
													</head>
													<body>
															<div class="content">
																	<h3>SLOC: ${sloc}</h3>
																	<img src="${qrCodeImage.src}" alt="QR Code" class="mb-5">
																	<table border="1" style="width: 100%; border-collapse: collapse;margin-top:5px">
																			<tr>
																					<th>SKU</th>
																					<th>Batch</th>
																					<th>Total Quantity</th>
																			</tr>
									`);
									if (itemsData.length > 0) {
											itemsData.forEach(function (item) {
													printWindow.document.write(`
															<tr>
																	<td>${item.sku}</td>
																	<td>${item.batchnumber}</td>
																	<td>${item.total_quantity}</td>
															</tr>
													`);
											});
											printWindow.document.write('</table></div></body></html>');
									} else {
											printWindow.document.write('<p>No items found for this SLOC.</p>');
									}

									printWindow.document.write('</div></body></html>');
									printWindow.document.close();

									// Menunda panggilan print selama 500ms
									setTimeout(function () {
											printWindow.print();
									}, 500);
							};

							qrCodeImage.onerror = function () {
								alert('Error generating QR code. Please check the SLOC value.');
							};
						} else {
							alert('Data not found');
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.error('AJAX error:', textStatus, errorThrown);
						alert('Error fetching item data. Please try again.');
					}
				});
			});
		});

	</script>


	<!-- post jquery form formAddRackBulky upload file with loading  -->
	<script>
		//add barang bulky form submit jquery with loading
		$('#formAddRackBulky').submit(function (e) {
			e.preventDefault();

			// show loading  swal tanpa confirm
			Swal.fire({
				title: 'Loading...',
				allowOutsideClick: false,
				showConfirmButton: false,
				onBeforeOpen: () => {
					Swal.showLoading();
				}
			});

			var formData = new FormData(this);

			$.ajax({
				url: '<?= base_url("user/Rack/import_rack") ?>',
				type: 'POST',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (response) {
					$('#modalAddRackBulky').modal('hide');
					Swal.fire({
						title: 'Success!',
						text: 'Data Rack berhasil ditambahkan!',
						icon: 'success',
						confirmButtonText: 'OK'
					}).then((result) => {
						if (result.isConfirmed) {
							location.reload();
						}
					});
				},
				error: function (xhr) {
					// swal error 
					Swal.fire({
						title: 'Error!',
						text: 'An error occurred while adding the item.',
						icon: 'error',
						confirmButtonText: 'OK'
					}).then((result) => {
						if (result.isConfirmed) {
							location.reload();
						}
					});

				}
			});
		});

		// ajax activate-rack
		$('.activate-rack').click(function () {
			const id = $(this).data('id');

			Swal.fire({
				title: 'Are you sure?',
				text: "You want to activate this rack?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, activate it!',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url("user/rack/activate_rack") ?>',
						type: 'POST',
						data: {
							id: id
						},
						success: function (response) {
							Swal.fire({
								title: 'Activated!',
								text: 'Rack has been activated.',
								icon: 'success',
								confirmButtonText: 'OK'
							}).then((result) => {
								if (result.isConfirmed) {
									location.reload();
								}
							});
						},
						error: function (xhr) {
							Swal.fire({
								title: 'Error!',
								text: 'An error occurred while activating the rack.',
								icon: 'error',
								confirmButtonText: 'OK'
							});
						}
					});
				}
			});
		});

		// deactibvate rack
		$('.deactivate-rack').click(function () {
			const id = $(this).data('id');

			Swal.fire({
				title: 'Are you sure?',
				text: "You want to deactivate this rack?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, deactivate it!',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url("user/rack/deactivate_rack") ?>',
						type: 'POST',
						data: {
							id: id
						},
						success: function (response) {
							Swal.fire({
								title: 'Deactivated!',
								text: 'Rack has been deactivated.',
								icon: 'success',
								confirmButtonText: 'OK'
							}).then((result) => {
								if (result.isConfirmed) {
									location.reload();
								}
							});
						},
						error: function (xhr) {
							Swal.fire({
								title: 'Error!',
								text: 'An error occurred while deactivating the rack.',
								icon: 'error',
								confirmButtonText: 'OK'
							});
						}
					});
				}
			});
		});

	</script>
</body>

</html>
