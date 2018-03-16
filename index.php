<?php
	
	require_once 'core/init.php';
	include 'includes/header.php';
	
	if (Session::exists('success')) {
		echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				'. Session::flash('success') .'
		</div>';
	}
	$user = new User();
	if ($user->isLoggedIn() && isset( $_GET['show'] ) && $_GET['show'] != 'all') { // Use GET show = all to override and see all jobs if logged in
		// Show them their own jobs
		$job = new Job();
		$jobs = $job->getUserJobs($user->data()->id);
		$title = 'Your Jobs';
	} else {
		// Show all jobs
		$job = new Job();
		$jobs = $job->getAllJobs();
		$title = 'All Jobs';
	}
?>
<h2><?= $title; ?></h2>
<img src="public/images/loading.gif" class="img-responsive loading" width="200">
<div class="row">
	<table class="table table-hover table-responsive" id="jobs" style="display: none;width: 100%;">
		<thead>
			<tr>
				<th> Job Title </th>
				<th> Job Description </th>
				<th> Industry/Trade </th>
				<th> Location </th>
				<th> Date Required </th>
				<th> Date Posted </th>
				<th> Posed By </th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($jobs->results() as $key => $value) {
				$value->job_description = strip_tags($value->job_description);
				if(strlen($value->job_description) > 140) {
					$jobDesc = substr($value->job_description, 0, 140);
					$jobDesc .= '...';
				} else {
					$jobDesc = $value->job_description;
				}
			?>
			<tr data-id="<?= $value->jobId; ?>" class="data-row">
				<td> <a href="job.php?id=<?= $value->jobId; ?>"><?= ($value->urgent == 1?'<b> <span style="color: red"> URGENT: </span> </b>':'') ?><?= $value->job_title; ?></a></td>
				<td> <?= strip_tags($jobDesc); ?> </td>
				<td> <?= $value->name; ?> </td>
				<td> <?= $value->region; ?> </td>
				<td> <?= date('d/m/Y', strtotime($value->date_required)); ?> </td>
				<td> <?= date('d/m/Y', strtotime($value->created_at)); ?> </td>
				<td> <?= $value->company_name; ?> </td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php 
		
	if ($user->hasPermission('admin')) {
		echo 'You are an admin';
	}

?>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
	$(function(){
		console.log($(window).outerWidth());
		if($(window).outerWidth() > 840) {
			$('#jobs .data-row').on('click',  function(event) {
				event.preventDefault();
				console.log($(this).attr('data-id'));
				window.location = 'job.php?id='+$(this).attr('data-id');
			});
		}
	});
</script>