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
										</h5>
										<!-- tombol add stock transfer -->
										<a href="<?= base_url('user/adjuststock/add') ?>" class="btn btn-primary">Add Adjust Stock</a>
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdjustStockBulky">
											Adjust Stock Bulky 
										</button>

										<?php if ($this->session->flashdata('error')) {
											echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
										} ?>

									</div>

									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="tableStockTransfer">
												<thead>
													<tr>
														<th>No Adjust Stock</th>
														<th>Status</th>
														<th>Created At</th>
														<th>Created By</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($adjuststock as $s) : ?>
                                                        <tr>
                                                            <td><?= $s->no_adjuststock ?></td>
                                                            <td><?= getStatusAdjuststock($s->status)  ?></td>
                                                            <td><?= $s->created_at ?></td>
															<td><?= $s->nama ?></td>
                                                            <td>
																<?php if ($s->status == 0 && $this->session->userdata('role_id') == 1) : ?>
																	
																	<a href="<?= base_url('user/adjuststock/process/' . $s->uuid) ?>" class="btn btn-primary">Process</a>
																	<?php endif; ?>
                                                                <a href="<?= base_url('user/adjuststock/detail/' . $s->uuid) ?>" class="btn btn-primary">Detail</a>
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
		</div>

		<!-- modalAdjustStockBulky -->
		<div class="modal fade" id="modalAdjustStockBulky" tabindex="-1" aria-labelledby="modalAdjustStockBulkyLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalAdjustStockBulkyLabel">Adjust Stock Bulky</h5><br>
						<!-- button download template adjust stock  -->
						
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<a href="<?= base_url('user/adjuststock/templateAdjustStock') ?>" class="btn btn-primary">Download Template</a>
					<div class="modal-body">
						<form action="<?= base_url('user/adjuststock/importAdjustStock') ?>" method="post" enctype="multipart/form-data">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">File</label>
								<input type="file" class="form-control" id="fileAdjustStock" name="fileAdjustStock" required>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
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
			// tableStockTransfer
			$(document).ready(function() {
				$('#tableStockTransfer').DataTable(
					// order false 
					{
						"order": false
					}
				);
			});
		</script>


</body>

</html>
