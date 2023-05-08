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
					<div class="d-flex justify-content-between">
						<div>
							<h4 class="card-title">Meals</h4>
						</div>
						<div>
							<a href="<?= ADMIN_URL . 'Meals/add_meal' ?>" class="btn btn-primary">Add New Meal</a>
						</div>
					</div>
					<hr>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Price</th>
									<th>From</th>
									<th>To</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($meals)) {
									foreach ($meals as $meal) {
								?>
										<tr>
											<td><?= $meal->name ?></td>
											<td><?= $meal->price ?></td>
											<td><?= $meal->time[0] ?></td>
											<td><?= $meal->time[1] ?></td>
											<td>
												<a href="<?= ADMIN_URL ?>meal/edit/<?= $meal->id ?>" class="btn btn-warning">Edit</a>
												<a href="<?= ADMIN_URL ?>meal/delete/<?= $meal->id ?>" class="btn btn-danger">Delete</a>
											</td>
										</tr>
								<?php
									}
								} else {
									echo '<tr><td align="center" colspan="9">No Meals Found</td></tr>';
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
