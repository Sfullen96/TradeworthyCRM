 <?php 

require_once 'core/init.php';
include 'includes/header.php';

// Get job info

$user = new User();

if ($user->isLoggedIn() && $_GET['show'] != 'all') { // Use GET show = all to override and see all jobs if logged in
	// Show them their own jobs
	$job = new Job();
	$jobs = $job->getUserJobs($user->data()->id);

} else {
	// Show all jobs
	$job = new Job();
	$jobs = $job->getAllJobs();
}

echo '<pre>' .print_r($jobs->results(), TRUE). '</pre>';

?>



<?php include 'includes/footer.php'; ?>