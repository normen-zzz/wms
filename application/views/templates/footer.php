<footer>
	<div class="container">
		<div class="footer clearfix mb-0 text-muted">
			<div class="float-start">
				<p> <?= date('Y') ?> &copy; <?= get_setting('site_name'); ?></p>
			</div>
			<div class="float-end">
				<p>
					Crafted with
					<span class="text-danger"><i class="bi bi-heart"></i></span>
					by <a href="#"><?= get_setting('company_name') ?></a>
				</p>
			</div>
		</div>
	</div>
</footer>
<!-- <script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() . '/' ?>assets/static/js/pages/sweetalert2.js"></script> -->
<script>
	<?= $this->session->flashdata('message') ?>
</script>

