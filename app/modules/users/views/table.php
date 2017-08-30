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

        			<h4>Reservation History</h4>

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
				"targets": [],
				"orderable": false,
			},
			],

		});

	})

</script>