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
							<h4 class="card-title">Users</h4>
						</div>
						<div>
							<a href="<?= ADMIN_URL . 'Users/add_user' ?>" class="btn btn-primary">Add New User</a>
						</div>
					</div>
					<hr>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone Number</th>
									<th>QR Code</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($users)) {
									foreach ($users as $user) {
								?>
										<tr>
											<td>
												<img src="<?= GET_PROFILE . $user->photo ?>" style="border-radius:50%" class="img-responsive" alt="Image">
											</td>
											<td><?= $user->name ?></td>
											<td><?= $user->email ?></td>
											<td><?= $user->phone ?></td>
											<td>
												<a href="javascript:void(0)" data-qr_name="<?= $user->qr ?>" class="btn btn-success show_qr_btn">View QR Code</a>
											</td>
											<td>
												<a href="" class="btn btn-warning">Edit</a>
												<a href="" class="btn btn-danger">Delete</a>
											</td>
										</tr>
								<?php
									}
								} else {
									echo '<tr><td align="center" colspan="9">No Users Found</td></tr>';
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
<!-- Modal -->
<div class="modal fade" id="qr_modal" tabindex="-1" role="dialog" aria-labelledby="jobinvoiceLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<img class="img-fluid" src="" id="show_qr" alt="">
			</div>
		</div>
	</div>
</div>
<script>
$('.show_qr_btn').click(function() {
    var name = $(this).data('qr_name');
    var path = '<?= GET_QR ?>' + name;
    $('#show_qr').attr('src', path).on('load', function() {
        $('#qr_modal').modal('show');
    });
});
</script>
