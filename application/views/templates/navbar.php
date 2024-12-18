<nav class="main-navbar">
	<div class="container">
		<ul>
			<li class="menu-item">
				<div class="theme-toggle d-flex gap-2  align-items-center mt-2">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
						<g fill="white" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
							<path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
							<g transform="translate(-210 -1)">
								<path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
								<circle cx="220.5" cy="11.5" r="4"></circle>
								<path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
							</g>
						</g>
					</svg>
					<div class="form-check form-switch fs-6">
						<input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
						<label class="form-check-label"></label>
					</div>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
						<path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
						</path>
					</svg>
				</div>
			</li>

			<!-- <li class="menu-item  ">
				<a href="<?= base_url('dashboard') ?>" class='menu-link'>
					<span><i class="bi bi-grid-fill"></i> Dashboard</span>
				</a>
			</li> -->

			<!-- DATABASE role super Admin 1  dan admin 6  -->
			<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-database-fill"></i> DATABASE</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">

								<li class="submenu-item">
									<a href="<?= base_url('barang') ?>" class='submenu-link'>BARANG</a>


								</li>

								<li class="submenu-item">
									<a href="<?= base_url('rack') ?>" class='submenu-link'>RACK</a>


								</li>

								<li class="submenu-item">
									<a href="<?= base_url('customer') ?>" class='submenu-link'>CUSTOMER</a>


								</li>

								<li class="submenu-item">
									<a href="<?= base_url('user/Log') ?>" class='submenu-link'>LOG</a>
								</li>

								<!-- stock opname  -->
								<li class="submenu-item">
									<a href="<?= base_url('user/adjuststock') ?>" class='submenu-link'>ADJUST STOCK</a>
								</li>

							</ul>


						</div>
					</div>
				</li>
			<?php endif; ?>


			<!-- INBOUND  -->
			<!-- untuk role admin 6 dan superadmin 1 -->
			<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-file-earmark-medical-fill"></i> INBOUND</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">

								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>Picklist</a>
									<!-- 3 Level Submenu PICKLIST -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('picklist/add') ?>" class="subsubmenu-link">Add
												Picklist</a>
										</li>

										<li class="subsubmenu-item ">
											<a href="<?= base_url('picklist') ?>" class="subsubmenu-link">Data
												Picklist</a>
										</li>
									</ul>

								</li>

								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>Receiving Inbound</a>
									<!-- 3 Level Submenu PICKLIST -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('inbound') ?>" class="subsubmenu-link">Data
												Inbound</a>
										</li>
									</ul>

								</li>

								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>PUTAWAY</a>
									<!-- 3 Level Submenu PICKLIST -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('putaway') ?>" class="subsubmenu-link">Data Putaway</a>
										</li>
									</ul>

								</li>
							</ul>


						</div>
					</div>
				</li>
			<?php endif; ?>

			<!-- untuk role inbound 2 -->
			<?php if ($this->session->userdata('role_id') == 2) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-file-earmark-medical-fill"></i> INBOUND</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">
								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>Picklist</a>
									<!-- 3 Level Submenu PICKLIST -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('picklist') ?>" class="subsubmenu-link">Data
												Picklist</a>
										</li>
									</ul>

								</li>
								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>Receiving Inbound</a>
									<!-- 3 Level Submenu PICKLIST -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('inbound') ?>" class="subsubmenu-link">Data
												Inbound</a>
										</li>
									</ul>

								</li>


							</ul>


						</div>
					</div>
				</li>
			<?php endif; ?>

			<!-- untuk role pick & put 4 -->
			<?php if ($this->session->userdata('role_id') == 4) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-file-earmark-medical-fill"></i> INBOUND</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">
							<ul class="submenu-group">
								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>PUTAWAY</a>
									<!-- 3 Level Submenu PICKLIST -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('putaway') ?>" class="subsubmenu-link">Data Putaway</a>
										</li>
									</ul>

								</li>
							</ul>


						</div>
					</div>
				</li>
			<?php endif; ?>

			<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) : ?>
				<li class="menu-item  ">
					<a href="<?= base_url('user/stocktransfer') ?>" class='menu-link'>
						<span><i class="bi bi-arrow-down-up"></i>STOCK TRANSFER</span>
					</a>
				</li>
			<?php endif; ?>


			<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 6) : ?>

				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-box-fill"></i>PRODUCTION</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">

								<li class="submenu-item">
									<a href="<?= base_url('user/Production') ?>" class='submenu-link'>BUNDLING</a>


								</li>

								<li class="submenu-item">
									<a href="<?= base_url('user/Production/listBundlingMaterial') ?>" class='submenu-link'>MATERIAL BUNDLING</a>


								</li>



							</ul>


						</div>
					</div>
				</li>

			<?php endif; ?>

			<?php if ($this->session->userdata('role_id') == 4) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-box-fill"></i>PRODUCTION</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">

								<li class="submenu-item">
									<a href="<?= base_url('user/Production') ?>" class='submenu-link'>BUNDLING</a>


								</li>

								



							</ul>


						</div>
					</div>
				</li>
			<?php endif; ?>



			<li class="menu-item  ">
				<a href="<?= base_url('inventory') ?>" class='menu-link'>
					<span><i class="bi bi-archive-fill"></i>INVENTORY</span>
				</a>
			</li>


			<!-- OUTBOND  -->
			<!-- OUTBOND Admin 6 dan superadmin 1 -->
			<?php if ($this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 1) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-file-earmark-medical-fill"></i> OUTBOND</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">
								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>Purchase Order</a>


									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('purchaseorder/add') ?>" class="subsubmenu-link">Add Purchase
												Order</a>
										</li>

										<li class="subsubmenu-item ">
											<a href="<?= base_url('purchaseorder') ?>" class="subsubmenu-link">Data Purchase
												Order</a>
										</li>

									</ul>

								</li>

								<!-- <li class="submenu-item  has-sub">
								<a href="#" class='submenu-link'>Goods Order</a>


								3 Level Submenu
								<ul class="subsubmenu">
									<li class="subsubmenu-item ">
										<a href="<?= base_url('goodsorder/add') ?>" class="subsubmenu-link">Add Goods
											Order</a>
									</li>

									<li class="subsubmenu-item ">
										<a href="<?= base_url('goodsorder') ?>" class="subsubmenu-link">Data Goods
											Order</a>
									</li>

								</ul>

							</li> -->
								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>PICKING SLIP</a>
									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('pickingslip') ?>" class="subsubmenu-link">Data Picking
												Slip</a>
										</li>

									</ul>

								</li>
								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>PACKING</a>
									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">


										<li class="subsubmenu-item ">
											<a href="<?= base_url('packing') ?>" class="subsubmenu-link">Data Packing</a>
										</li>

									</ul>

								</li>

								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>Delivery Order</a>
									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">


										<li class="subsubmenu-item ">
											<a href="<?= base_url('user/deliveryorder') ?>" class="subsubmenu-link">Data
												DO</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</li>
			<?php endif; ?>

			<!-- outbond role pick & put 4 -->
			<?php if ($this->session->userdata('role_id') == 4) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-file-earmark-medical-fill"></i> OUTBOND</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">

								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>PICKING SLIP</a>
									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('pickingslip') ?>" class="subsubmenu-link">Data Picking
												Slip</a>
										</li>

									</ul>

								</li>



							</ul>
						</div>
					</div>
				</li>
			<?php endif; ?>

			<!-- users role superadmin 1 -->
			<?php if ($this->session->userdata('role_id') == 1) : ?>
				<li class="menu-item  ">
					<a href="<?= base_url('users') ?>" class='menu-link'>
						<span><i class="bi bi-person-fill"></i>USERS</span>
					</a>
				</li>
			<?php endif; ?>

			<!-- outbond role outbond  -->
			<?php if ($this->session->userdata('role_id') == 3) : ?>
				<li class="menu-item  has-sub">
					<a href="#" class='menu-link'>
						<span><i class="bi bi-file-earmark-medical-fill"></i> OUTBOND</span>
					</a>
					<div class="submenu ">
						<!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
						<div class="submenu-group-wrapper">


							<ul class="submenu-group">

								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>PICKING SLIP</a>
									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">
										<li class="subsubmenu-item ">
											<a href="<?= base_url('pickingslip') ?>" class="subsubmenu-link">Data Picking
												Slip</a>
										</li>

									</ul>

								</li>
								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>PACKING</a>
									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">


										<li class="subsubmenu-item ">
											<a href="<?= base_url('packing') ?>" class="subsubmenu-link">Data Packing</a>
										</li>

									</ul>

								</li>

								<li class="submenu-item  has-sub">
									<a href="#" class='submenu-link'>Delivery Order</a>
									<!-- 3 Level Submenu -->
									<ul class="subsubmenu">


										<li class="subsubmenu-item ">
											<a href="<?= base_url('user/deliveryorder') ?>" class="subsubmenu-link">Data
												DO</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</li>
			<?php endif; ?>

			<?php if ($this->session->userdata('role_id') == 1) : ?>
				<li class="menu-item  ">
					<a href="<?= base_url('settings') ?>" class='menu-link'>
						<span><i class="bi bi-gear"></i>SETTING</span>
					</a>
				</li>
			<?php endif; ?>


		</ul>
	</div>
</nav>