<div class="content-wrapper">
	<?php
	if ($this->session->flashdata('log_suc')) {
	?>
		<button type="button" class="cpy-alert btn btn-inverse-success btn-fw mb-2 w-100"><?= $this->session->flashdata('log_suc') ?></button>
	<?php
	} elseif ($this->session->flashdata('log_err')) {
	?>
		<button type="button" class="cpy-alert btn btn-inverse-danger btn-fw mb-2 w-100"><?= $this->session->flashdata('log_err') ?></button>
	<?php
	}
	?>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Add New User</h4>
					<hr>
					<form class="forms-sample" method="post" action="<?= ADMIN_URL . 'Users/add_user' ?>">
						<div>
							<div class="form-group">
								<label for="exampleInputEmail1">Image</label>
								<?php
								if (!empty($user_data)) {
								} else {
								?>
									<input required type="file" name="image" class="form-control">
								<?php
								}
								?>

							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input required type="text" name="name" placeholder="Name" class="form-control" value="<?= !empty($user_data) ? $user_data->name : '' ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input required type="email" name="email" placeholder="Email" class="form-control" value="<?= !empty($user_data) ? $user_data->email : '' ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Phone Number</label>
								<input required type="text" name="phone" placeholder="Phone Number" class="form-control" value="<?= !empty($user_data) ? $user_data->phone : '' ?>">
							</div>
						</div>

						<button type="submit" class="btn btn-success">Add</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
