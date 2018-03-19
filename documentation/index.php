<?php 
	require_once '../core/init.php';
	include '../includes/header.php';

	$user = new User();

	if ($user->isLoggedIn()) {
		if (!$user->hasPermission('admin')) {
			Redirect::to(Config::get('root/root').'home');
		}
	} else {
		Redirect::to(Config::get('root/root').'home');
	}
?>


<?php include '../includes/footer.php'; ?>