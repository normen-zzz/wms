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
										<label for="customer">NO Inbound</label>
										<input type="text" class="form-control mb-4" value="<?= $get_id_inbound->no_inbound ?>" disabled>
										<div class="table-responsive">
												<form id="putawayForm" method="POST">
														<table class="table" id="table">
																<thead>
																		<tr>
																				<th>SKU</th>
																				<th>Nama Barang</th>
																				<th>Batch</th>
																				<th>Qty</th>
																				<th>Good</th>
																				<th>Bad</th>
																				<th>Existing Rack</th>
																				<th>Recommended Rack</th>
																				<th>QTY to Put</th>
																		</tr>
																</thead>
																<tbody>
																			<?php foreach ($putaway_details as $dtl) { ?>
																			<tr>
																					<td><?= $dtl['sku'] ?></td>
																					<td><?= $dtl['nama_barang'] ?></td>
																					<td><?= $dtl['batch_id'] ?></td>
																					<td><?= $dtl['received_qty'] ?></td>
																					<td><?= $dtl['good_qty'] ?></td>
																					<td><?= $dtl['bad_qty'] ?></td>
																					<td>
																							<?php if (!empty($dtl['sloc'])) { ?>
																									<p>SLOC: <?= $dtl['sloc'] ?></p>
																									<p>Zone: <?= $dtl['zone'] ?></p>
																									<p>Rack: <?= $dtl['rack'] ?></p>
																									<p>Quantity: <?= $dtl['rack_quantity'] ?></p>
																							<?php } else { ?>
																									<p>Not assigned</p>
																							<?php } ?>
																					</td>
																					<td>
																							<button type="button" class="btn btn-sm btn-primary get-recommendations" 
																											data-id-barang="<?= $dtl['id_barang'] ?>" 
																											data-quantity="<?= $dtl['good_qty'] ?>"
																											data-batch-id="<?= $dtl['batch_id'] ?>">
																									Get Recommendations
																							</button>
																							<div class="recommendations-list" style="display:none;"></div>
																					</td>
																					<td>
																							<input type="number" name="putaway_field[<?= $dtl['id_barang'] ?>][quantity]" class="form-control" required>
																					</td>
																					<!-- Add hidden input to store selected rack_id -->
																					<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][id_barang]" value="<?= $dtl['id_barang'] ?>">
																					<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][batch_id]" value="<?= $dtl['batch_id'] ?>">
																					<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][id_rack]" value="">
																					<input type="hidden" name="putaway_field[<?= $dtl['id_barang'] ?>][id_inbound]" value="<?= $dtl['id_inbound'] ?>">
																			</tr>
																			<?php } ?>
																	</tbody>
														</table>
														<button type="button" id="submitPutawayData" class="btn btn-primary mt-2">Submit</button>
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
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
						data: { id_barang: id_barang, quantity: quantity },
						dataType: 'json',
						success: function(response) {
								recommendationsList.empty();
								if (response.length > 0) {
										var ul = $('<ul>');
										response.forEach(function(rack) {
												var li = $('<li>').append(
														$('<button>')
																.addClass('btn btn-sm btn-success choose-rack m-2')
																.text('Choose')
																.data('rack-id', rack.id_rack)
												).append(' SLOC: ' + rack.sloc + ', Rack: ' + rack.rack);
												ul.append(li);
										});
										recommendationsList.append(ul);
								} else {
										recommendationsList.text('No recommendations available');
								}
						}
				});
		});

		$('#submitPutawayData').on('click', function() {
				var formData = $('#putawayForm').serialize();

				$.ajax({
						url: '<?= base_url("user/putaway/create_putaway") ?>',
						method: 'POST',
						data: formData,
						success: function(response) {
								alert('Submitted successfully');
						},
						error: function(xhr, status, error) {
								alert('Error submitting form: ' + error);
						}
				});
		});

    $(document).on('click', '.choose-rack', function() {
        var button = $(this);
        var rackId = button.data('rack-id');
        var idBarang = button.data('id-barang');
        var quantity = button.data('quantity');
        var batchId = button.data('batch-id');

        button.prop('disabled', true).text('Chosen');
      	recommendationsList.siblings('input[name="putaway_field[' + recommendationsList.siblings('.get-recommendations').data('id-barang') + '][id_rack]"]').val(rackId);

        $('<input>').attr({
            type: 'hidden',
            name: 'chosen_rack_id[]',  
            value: rackId
        }).appendTo('#inboundForm');

        $('<input>').attr({
            type: 'hidden',
            name: 'id_barang[]',
            value: idBarang
        }).appendTo('#inboundForm');

        $('<input>').attr({
            type: 'hidden',
            name: 'quantity[]',
            value: quantity
        }).appendTo('#inboundForm');

        $('<input>').attr({
            type: 'hidden',
            name: 'batch_id[]',
            value: batchId
        }).appendTo('#inboundForm');
    });
});
</script>
</body>
</html>
