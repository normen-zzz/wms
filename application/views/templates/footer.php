<footer>
	<div class="container">
		<div class="footer clearfix mb-0 text-muted">
			<div class="float-start">
				<p>2023 &copy; Mazer</p>
			</div>
			<div class="float-end">
				<p>
					Crafted with
					<span class="text-danger"><i class="bi bi-heart"></i></span>
					by <a href="https://saugi.me">Saugi</a>
				</p>
			</div>
		</div>
	</div>
</footer>
<script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() . '/' ?>assets/static/js/pages/sweetalert2.js"></script>
<script>
	<?= $this->session->flashdata('message') ?>
</script>

<script>
	const submitButtons = document.querySelectorAll('button[type="submit"]');

	submitButtons.forEach(button => {
		button.addEventListener('click', function() {
			this.disabled = true;
		});
	});
</script>

<script>
	const modalContainer = document.querySelector('.modal-container'); // or whatever class/ID your modal container has

	modalContainer.addEventListener('click', function(event) {
		if (event.target.tagName === 'BUTTON' && event.target.type === 'submit') {
			event.target.disabled = true;
		}
	});
</script>