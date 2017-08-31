<?php $this->load->view('ui/header') ?>

		<!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>My Account</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url(); ?>">Home</a></li>
					<li class="active">My Account</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

        <!-- Content
        ============================================= -->
        <section id="content">

        	<div class="content-wrap">

        		<div class="container clearfix">
        			<span style='color: red'>*</span><strong> Note:</strong> You can only book 3 consecutive reservation.
        			<h4>Reservation History</h4>
        			<?php echo $this->general->flash_message(); ?>
        			<table id="table" class="table table-bordered">
        				<thead>
        					<tr>
        						<th>No.</th>
        						<th>Branch</th>
        						<th>Field Name</th>
        						<th>Date</th>
        						<th>Start</th>
        						<th>End</th>
        						<th>Amount</th>
        						<th>Status</th>
        						<th>Action</th>
        					</tr>
        				</thead>
        			</table>

        		</div>

        	</div>

        </section><!-- #content end -->

<?php $this->load->view('ui/footer') ?>

<script type="text/javascript">
	
	var table;

	$(function() {

		table = $('#table').DataTable({

			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": base_url + "/users",
				"type": "POST",
			},

			"columnDefs": [
			{ 
				"targets": [  0, 2, 4, 5, 6 ],
				"orderable": false,
			},
			],

		});

		$(document).on('click', '#editReservation', function () {

			var id = $(this).data('id');
			swal({
				title: "Are you sure?",
				text: "You're about to cancel this reservation.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#C02942",
				confirmButtonText: "Yes, cancel it!",
				closeOnConfirm: false
			},
			function (isConfirm) {
				if (!isConfirm) return;

				$.ajax({
					type: 'POST',
					url: base_url + 'users/cancel_reservation',
					data: { id: id },
					dataType: 'JSON',
					success: function(data)
					{
						table.ajax.reload(null,false);
						swal({
							title: "Success!",
							text: "Your Reservation has been cancelled!",
							type: "success",
							confirmButtonColor: '#444',
						});
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						swal("Error deleting!", "Please try again", "error");
					}
				});

			});

		});

	})

</script>