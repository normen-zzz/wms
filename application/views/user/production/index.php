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

											<!-- add production -->
										</h5>
										<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) { ?>
											<a href="<?= base_url('user/production/add') ?>" class="btn btn-primary btn-sm">Add
												Production</a>
										<?php } ?>


									</div>

									<div class="card-body">
										<!-- show flashdata  -->
										<?php if ($this->session->flashdata('success')) : ?>
											<div class="alert alert-success" role="alert">
												<?= $this->session->flashdata('success') ?>
											</div>
										<?php endif; ?>
										<?php if ($this->session->flashdata('error')) : ?>
											<div class="alert alert-danger" role="alert">
												<?= $this->session->flashdata('error') ?>
											</div>
										<?php endif; ?>
										<div class="table-responsive">
											<table class="table" id="tblproduction">
												<thead>
													<tr>
														<th>No</th>
														<th>No Production</th>
														<th>SKU</th>
														<th>Batch</th>
														<th>Expired Date</th>
														<th>Qty</th>
														<th>Created At</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$index = 1;
													foreach ($productions as $production) :
														$log = $this->db->query('SELECT * FROM wms_log WHERE no_document = "' . $production->no_production . '" AND `condition` = "in" AND qty = 0');
													?>
														<tr>
															<td><?= $index++; ?></td>
															<td><?= $production->no_production; ?></td>
															<td><?= $production->sku_bundling; ?></td>
															<td><?= $production->batch_bundling; ?></td>
															<td><?= $production->ed_bundling; ?></td>
															<td><?= $production->qty_bundling; ?></td>
															<td><?= date('d-m-Y H:i:s', strtotime($production->dibuat))  ?></td>
															<td><?= getStatusProduction($production->status, $production->pick_by) ?></td>
															<td>
																<a href="<?= base_url('user/production/detail/' . $production->id_production) ?>" class="btn btn-sm btn-primary text-white">Detail</a>
																<?php if ($production->status == 0) { ?>
																	<?php if ($this->session->userdata('role_id') == 1 ||  $this->session->userdata('role_id') == 6) { ?>
																		<a href="<?= base_url('user/production/assign/' . $production->id_production) ?>" class="btn btn-sm btn-primary text-white">Assign Picker</a>
																	<?php } ?>
																<?php } ?>

																<?php if ($production->status == 1) { ?>
																	<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 4 || $this->session->userdata('role_id') == 6) { ?>
																		<a href="<?= base_url('user/production/pick/' . $production->id_production) ?>" class="btn btn-sm btn-warning text-black">Pick</a>
																<?php }
																} ?>

																<?php if ($production->status == 2) { ?>
																	<?php if ($this->session->userdata('role_id') == 1 ||  $this->session->userdata('role_id') == 6) { ?>

																		<a href="<?= base_url('user/production/finish/' . $production->id_production) ?>" class="btn btn-sm btn-warning text-black">Finish</a>
																<?php }
																} ?>

																<!-- <?php if ($production->status == 3) { ?>
																	<button class="btn btn-primary" id="voidProduction" data-id_production="<?= $production->id_production ?>">Void Production</button>
																<?php } ?> -->
															</td>
														</tr>
													<?php endforeach; ?>

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
	<script src="<?= base_url() . '/' ?>assets/static/js/pages/datatables.js"></script>
	<script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>

	<script>
		// datatable tblproduction
		$(document).ready(function() {
			$('#tblproduction').DataTable();
		});

		// onclick deleteData
		function deleteData(id) {
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?= base_url('picklist / delete ') ?>',
						type: 'POST',
						data: {
							id_picklist: id
						},
						success: function(data) {
							Swal.fire(
								'Deleted!',
								'Your data has been deleted.',
								'success'
							).then((result) => {
								location.reload();
							});
						}
					});
				}
			})
		}

		function editData(id) {
			$.ajax({
				url: '<?= base_url('picklist / get_picklist_details ') ?>',
				type: 'GET',
				data: {
					id_picklist: id
				},
				success: function(data) {
					var picklist = JSON.parse(data);

					$('#id_picklist').val(picklist.id_picklist);
					$('#no_picklist').val(picklist.no_picklist);
					$('#batch').val(picklist.batch);
					$('#qty').val(picklist.qty);
					$('#status').val(picklist.status);


					$('#editModal').modal('show');
				}
			});
		}

		$('#editForm').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= base_url('picklist / update ') ?>',
				type: 'POST',
				data: $(this).serialize(),
				success: function(response) {
					Swal.fire(
						'Updated!',
						'Your data has been updated.',
						'success'
					).then((result) => {
						location.reload();
					});
				}
			});
		});
	</script>

	<script>
		// voidProduction
		$(document).on('click', '#voidProduction', function() {
			var id_production = $(this).data('id_production');
			Swal.fire({
				title: 'Are you sure?',
				text: "You want to void this production?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, void it!'
			}).then((result) => {
				if (result.isConfirmed) {
					// swal fire loading 
					Swal.fire({
						title: 'Void',
						text: 'Please wait...',
						allowOutsideClick: false,
						showConfirmButton: false,
						willOpen: () => {
							Swal.showLoading();
						}
					});
					$.ajax({
						url: '<?= base_url('user/production/voidProduction') ?>',
						type: 'POST',
						data: {
							id_production: id_production
						},
						success: function(data) {
							response = JSON.parse(data);
							if (response.status == 'success') {
								Swal.fire(
									'Verified!',
									'Your production has been void.',
									'success'
								).then((result) => {
									Swal.fire({
										title: 'Void',
										text: 'Please wait...',
										allowOutsideClick: false,
										showConfirmButton: false,
										willOpen: () => {
											Swal.showLoading();
										}
									});
									location.reload();
								});
							} else {
								Swal.fire(
									'Error!',
									'Your production not been void. ' + response.message,
									'error'
								).then((result) => {
									Swal.fire({
										title: 'Void',
										text: 'Please wait...',
										allowOutsideClick: false,
										showConfirmButton: false,
										willOpen: () => {
											Swal.showLoading();
										}
									});
									location.reload();
								});
							}
						}
					});
				}
			})
		});
	</script>


</body>

</html>