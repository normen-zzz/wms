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
<style>
	@font-face {
		font-family: 'Libre Barcode 128';
		src: url('<?= base_url('assets/fonts/LibreBarcode128-Regular.ttf'); ?>') format('truetype');
	}

	@media (max-width: 768px) {
  #table1 {
    font-size: 0.8rem;
  }
  #table1 th, #table1 td {
    padding: 0.2rem;
  }
}
</style>

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
											<h5 class="card-title"><?= $subtitle2 ?></h5>
											<button type="button" data-bs-toggle="modal" data-bs-target="#modalAddBarang" class="btn btn-primary">Add Barang</button>
											<!-- btn modal add barang bulky with excel -->
											<button type="button" data-bs-toggle="modal" data-bs-target="#modalAddBarangBulky" class="btn btn-primary">Add Barang Bulky</button>
										</div>

										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-sm" id="table1">
													<thead>
														<tr>
															<th>SKU</th>
															<th>Nama Barang</th>
															<th>UOM</th>
															<th>Status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($barang->result_array() as $barang1) { ?>
															<tr>
																<td><?= $barang1['sku'] ?></td>
																<td><?= $barang1['nama_barang'] ?></td>
																<td><?= $barang1['uom'] ?></td>
																<td><?= getStatusBarang($barang1['is_deleted'])  ?></td>
																<td>
																	<?php if ($barang1['is_deleted'] == 0): ?>
																			<button class="btn btn-warning btn-sm edit-btn" data-id_barang="<?= $barang1['id_barang'] ?>">Edit</button>
																			<button class="btn btn-danger btn-sm delete-btn" data-id_barang="<?= $barang1['id_barang'] ?>">Deactivate</button>
																	<?php endif; ?>

																	<?php if ($barang1['is_deleted'] == 1): ?>
																	<button class="btn btn-info text-white btn-sm activated-btn" data-id_barang="<?= $barang1['id_barang'] ?>">Activated</button>
																	<?php endif; ?>	
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

			<!-- Modal Add Barang Bulky -->
			<div class="modal fade text-left" id="modalAddBarangBulky" tabindex="-1" role="dialog" aria-labelledby="modalAddBarangBulky" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel33">Add Barang Bulky Form</h4>
							<!-- button download template  -->
							<a href="<?= base_url('user/Barang/download_template') ?>" class="btn btn-primary">Download Template</a>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<i data-feather="x"></i>
							</button>
							
						</div>
						<form id="addBarangBulky">
							<div class="modal-body">
								<label for="file">File</label>
								<div class="form-group">
									
									<input id="file" type="file" name="file" class="form-control" accept=".xls,.xlsx">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">

									Close
								</button>
								<button type="submit" class="btn btn-primary ms-1">
									Submit
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>

				<!--login form Modal -->
				<div class="modal fade text-left" id="modalAddBarang" tabindex="-1" role="dialog" aria-labelledby="modalAddBarang" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel33">Add Barang Form</h4>
								<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
									<i data-feather="x"></i>
								</button>
							</div>
							<form action="<?= base_url('user/Barang') ?>" method="POST">
								<div class="modal-body">
									<label for="sku">Sku</label>
									<div class="form-group">
										<input id="sku" type="text" placeholder="Sku" name="sku" class="form-control">
									</div>
									<label for="name">Name</label>
									<div class="form-group">
										<input id="name" type="text" placeholder="Name" name="name" class="form-control">
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
									<button type="submit" class="btn btn-primary ms-1">
										Submit
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- ediot barang -->
				<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form id="editForm">
								<div class="modal-header">
									<h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
									<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<input type="hidden" id="editId" name="id_barang">
									<!-- <div class="form-group">
										<label for="sku">SKU</label>
										<input type="text" class="form-control" id="editSku" name="sku" required>
									</div> -->
									<div class="form-group">
										<label for="nama_barang">Nama Barang</label>
										<input type="text" class="form-control" id="editNamaBarang" name="nama_barang" required>
									</div>
									<div class="form-group">
										<label for="uom">UOM</label>
										<input type="text" class="form-control" id="editUom" name="uom" required>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
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
		<script src="<?= base_url() . '/' ?>assets/extensions/jquery/jquery.min.js"></script>
		<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
		<script src="<?= base_url() . '/' ?>assets/static/js/pages/datatables.js"></script>
		<script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>

		<script>
			$('body').on('click', 'button[type="submit"]', function() {
				var button = $(this);
				setTimeout(function() {
					button.prop('disabled', true);
					Swal.fire({
						title: 'Processing...',
						text: 'Please wait while we process your request.',
						icon: 'info',
						timer: 10000,
						timerProgressBar: true,
						showConfirmButton: false
					});
					setTimeout(function() {
						button.prop('disabled', false);
						Swal.fire({
							title: 'Success!',
							text: 'Your request has been processed successfully.',
							icon: 'success',
							confirmButtonText: 'OK'
						});
					}, 10000);
				});
			});

			$('.edit-btn').click(function() {
				var id = $(this).data('id_barang');

				$.ajax({
					url: '<?= base_url("barang/get_barang") ?>/' + id,
					type: 'GET',
					dataType: 'json',
					success: function(data) {
						$('#editId').val(data.id_barang);
						$('#editSku').val(data.sku);
						$('#editNamaBarang').val(data.nama_barang);
						$('#editUom').val(data.uom);
						$('#editModal').modal('show');
					}
				});
			});

			//add barang bulky form submit jquery with loading
			$('#addBarangBulky').submit(function(e) {
				e.preventDefault();

				var formData = new FormData(this);

				$.ajax({
					url: '<?= base_url("user/Barang/import_barang") ?>',
					type: 'POST',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(response) {
						$('#modalAddBarangBulky').modal('hide');
						Swal.fire({
							title: 'Success!',
							text: 'Data barang berhasil ditambahkan!',
							icon: 'success',
							confirmButtonText: 'OK'
						}).then((result) => {
							if (result.isConfirmed) {
								location.reload();
							}
						});
					},
					error: function(xhr) {
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

			

			$('#editForm').submit(function(e) {
				e.preventDefault();

				$.ajax({
					url: '<?= base_url("barang/update_barang") ?>',
					type: 'POST',
					data: $(this).serialize(),
					success: function(response) {
						$('#editModal').modal('hide');
						Swal.fire({
							title: 'Success!',
							text: 'Data barang berhasil diupdate!',
							icon: 'success',
							confirmButtonText: 'OK'
						}).then((result) => {
							if (result.isConfirmed) {
								location.reload();
							}
						});
					},
					error: function(xhr) {
						alert("An error occurred.");
					}
				});
			});

			$('.delete-btn').click(function() {
				var id = $(this).data('id_barang');

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
							url: '<?= base_url("barang/delete_barang") ?>/' + id,
							type: 'POST',
							success: function(response) {
								Swal.fire({
									title: 'Deleted!',
									text: 'Data barang berhasil dinonaktifkan!',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then((result) => {
									if (result.isConfirmed) {
										location.reload();
									}
								});
							},
							error: function(xhr) {
								Swal.fire({
									title: 'Error!',
									text: 'An error occurred while nonactivated the item.',
									icon: 'error',
									confirmButtonText: 'OK'
								});
							}
						});
					}
				});
			});

			$('.activated-btn').click(function() {
				var id = $(this).data('id_barang');

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
							url: '<?= base_url("user/barang/activated") ?>/' + id,
							type: 'POST',
							success: function(response) {
								Swal.fire({
									title: 'Success!',
									text: 'Data barang berhasil diaktifkan!',
									icon: 'success',
									confirmButtonText: 'OK'
								}).then((result) => {
									if (result.isConfirmed) {
										location.reload();
									}
								});
							},
							error: function(xhr) {
								Swal.fire({
									title: 'Error!',
									text: 'An error occurred while activated the item.',
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
