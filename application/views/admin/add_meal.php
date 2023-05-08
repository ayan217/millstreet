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
					<h4 class="card-title">Add New Meal</h4>
					<hr>
					<form class="forms-sample" method="post" action="<?= ADMIN_URL ?><?= !empty($meal_data) ? 'Meals/edit_meal/' . $meal_data->id : 'Meals/add_meal' ?>">
						<div>
							<input required type="hidden" name="photo" class="form-control" value="<?= !empty($meal_data) ? $meal_data->photo : 'user_default.png' ?>">
							<input required type="hidden" name="acc_type" class="form-control" value="0">
							<input required type="hidden" name="<?= !empty($meal_data) ? 'updated_at' : 'created_at' ?>" class="form-control" value="<?= date('Y-m-d H:i:s') ?>">
							<div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input required type="text" name="name" placeholder="Name" class="form-control" value="<?= !empty($meal_data) ? $meal_data->name : '' ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input required type="email" name="email" placeholder="Email" class="form-control" value="<?= !empty($meal_data) ? $meal_data->email : '' ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Phone Number</label>
								<input required type="text" name="phone" placeholder="Phone Number" class="form-control" value="<?= !empty($meal_data) ? $meal_data->phone : '' ?>">
							</div>
						</div>

						<button type="submit" class="btn btn-success"><?= !empty($meal_data) ? 'Update' : 'Add' ?></button>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

