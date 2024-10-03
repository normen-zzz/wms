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
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
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
										<div class="table-responsive">
											<table class="table" id="userTable">
												<thead>
													<tr>
														<th>ID</th>
														<th>Username</th>
														<th>Name</th>
														<th>Role</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
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

			<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addUserModalLabel">Add User</h5>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="addUserForm">
								<div class="form-group">
									<label for="email">Username</label>
									<input type="text" class="form-control" id="username" name="username" required>
								</div>
								<div class="form-group">
									<label for="nama">Nama</label>
									<input type="text" class="form-control" id="nama" name="nama" required>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="password" name="password" required>
										<div class="input-group-append">
											<button type="button" class="btn btn-outline-secondary" id="togglePassword">
												<i class="bi bi-eye"></i>
											</button>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="confirm_password">Confirm Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
										<div class="input-group-append">
											<button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
												<i class="bi bi-eye"></i>
											</button>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="edit_role_id">Role</label>
									<select class="form-control" name="role_id" required>
										<?php foreach ($roles as $roles1) { ?>
											<option value="<?= $roles1['id'] ?>"><?= $roles1['name'] ?></option>
										<?php } ?>
									</select>
								</div>
								<!-- More form fields -->
								<button type="submti" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
							<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="editUserForm" method="POST">
							<div class="modal-body">
								<input type="hidden" name="id" id="editUserId">
								<div class="form-group">
									<label for="edit_username">Username</label>
									<input type="text" class="form-control" name="username" id="edit_username" readonly required>
								</div>
								<div class="form-group">
									<label for="edit_nama">Name</label>
									<input type="text" class="form-control" name="nama" id="edit_nama" required>
								</div>
								
								
								<!-- password -->
								<div class="form-group">
									<label for="edit_password">Password <span class="text-danger">*isi jika ingin  mengubah password</span></label>
									<div class="input-group">
										<input type="password" class="form-control" name="password" id="edit_password">
										<div class="input-group-append">
											<button type="button" class="btn btn-outline-secondary" id="toggleEditPassword">
												<i class="bi bi-eye"></i>
											</button>
										</div>
									</div>
								<div class="form-group">
									<label for="edit_role_id">Role</label>
									<select class="form-control" name="role_id" id="edit_role_id">
										<?php foreach ($roles as $roles1) { ?>

											<option value="<?= $roles1['id'] ?>"><?= $roles1['name'] ?></option>

										<?php } ?>

									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Update User</button>
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

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const togglePassword = document.getElementById('togglePassword');
			const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
			const passwordField = document.getElementById('password');
			const confirmPasswordField = document.getElementById('confirm_password');

			togglePassword.addEventListener('click', function() {
				const type = passwordField.type === 'password' ? 'text' : 'password';
				passwordField.type = type;
				this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
			});

			toggleConfirmPassword.addEventListener('click', function() {
				const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
				confirmPasswordField.type = type;
				this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
			});
		});

		$(document).ready(function() {
			$('#addUserForm').submit(function(e) {
				e.preventDefault();

				var formData = $(this).serialize();

				$.ajax({
					url: '<?= site_url('users/create') ?>',
					type: 'POST',
					data: formData,
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							$('#addUserModal').modal('hide');
							$('#addUserForm').trigger('reset');
							Swal.fire('Success', 'User added successfully!', 'success');
							loadUsers();
						} else {
							Swal.fire('Error', response.message, 'error');
						}
					},
					error: function() {
						Swal.fire('Error', 'Failed to add user', 'error');
					}
				});
			});

			function loadUsers() {
				$.ajax({
					url: '<?= site_url('users/get_all_users') ?>',
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						var tbody = $('#userTable tbody');
						tbody.empty();
						$.each(response, function(i, user) {
							tbody.append(`
							<tr>
								<td>${ i + 1 }</td>
								<td>${user.username}</td>
								<td>${user.nama}</td>
								<td>${user.role_name}</td>
								<td>
									<button class="btn btn-warning btn-sm edit-user" data-id="${user.id_users}">Edit</button>
									<button class="btn btn-danger btn-sm delete-user" data-id="${user.id_users}">Delete</button>
								</td>
							</tr>
						`);
						});
					},
					error: function() {
						Swal.fire('Error', 'Failed to load users', 'error');
					}
				});
			}

			loadUsers();


			$(document).on('click', '.edit-user', function() {
				var id = $(this).data('id');
				$.ajax({
					url: '<?= site_url('users/get_user/') ?>' + id,
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						$('#editUserId').val(response.id_users);
						$('#edit_nama').val(response.nama);
						$('#edit_username').val(response.username);
						$('#edit_role_id').val(response.role_id);
						$('#editUserModal').modal('show');
					},
					error: function() {
						Swal.fire('Error', 'Failed to load user details', 'error');
					}
				});
			});

			$('#editUserForm').submit(function(e) {
				e.preventDefault();
				var id = $('#editUserId').val();
				$.ajax({
					url: '<?= site_url('users/edit/') ?>' + id,
					type: 'POST',
					data: $(this).serialize(),
					dataType: 'json',
					success: function(response) {
						$('#editUserModal').modal('hide');
						Swal.fire('Success', 'User updated successfully!', 'success');
						loadUsers();
					},
					error: function() {
						Swal.fire('Error', 'Failed to update user', 'error');
					}
				});
			});

			$(document).on('click', '.delete-user', function() {
				var id = $(this).data('id');
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
							url: '<?= site_url('users/delete/') ?>' + id,
							type: 'POST',
							dataType: 'json',
							success: function(response) {
								Swal.fire('Deleted!', 'User has been deleted.', 'success');
								loadUsers();
							},
							error: function() {
								Swal.fire('Error', 'Failed to delete user', 'error');
							}
						});
					}
				});
			});
		});
	</script>


</body>

</html>