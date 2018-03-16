<?php
require_once 'core/init.php';
include 'includes/header.php';

if (Session::exists('success')) {
	echo '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		'. Session::flash('success') .'
	</div>';
}

$job = new Job();
$thisJob = $job->showJob($_GET['id'])->first();

$user = new User();
if ($user->isLoggedIn()) {
	// Check if this is their job 
	if ($user->data()->id == $thisJob->user_id) {
		$usersJob = 1;
	} else {
		$usersJob = 0;
	}
}

if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'price' => array(
				'name' => 'Price',
				'required' => true
			),
			'message' => array(
				'name' => 'A message',
				'required' => true
			)
		));

		if ($validation->passed()) {
			$job->addQuote(array(
				'job_id' => $thisJob->jobId,
				'price' => Input::get('price'),
				'message' => Input::get('message')
			));

			Session::flash('success', 'Your quote was posted successfully.');
			Redirect::to('job.php?id='.$thisJob->jobId);
		} else {
				// Validation failed
				echo '
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Please correct the following issues: <br></strong>
					<ul>';
						foreach ($validation->errors() as $error) {
							echo '<li>'. $error .'</li>';
						}
					echo '</ul>
				</div>';
			}
	}
}
?>
<div class="row">
    <?php if ( isset( $thisJob->logo ) ) { ?>
	<div class="col-xs-12 col-sm-2 col-md-2">
		<img src="<?= $thisJob->logo; ?>" class="img-responsive companyLogo">
	</div>
    <?php } ?>
	<div class="col-xs-12 <?php isset( $thisJob->logo ) ? "col-sm-10 col-md-10" : "col-sm-12 col-md-12" ?>">
		<h2><?= ($thisJob->urgent == 1?'<span style="color: red"> <b>URGENT:</b> </span>':'') ?><?= $thisJob->job_title; ?></h2>
		<h4> Trade Required: <?= $thisJob->name; ?></h4>
		<h4> Location: <?= $thisJob->region ?></h4>
		<h4> Required: <?= date('d/m/Y', strtotime($thisJob->date_required)); ?></h4>
	</div>
</div>
<div class="jobDescription">
<?= $thisJob->job_description; ?>
</div>
<?php if($thisJob->job_image) { ?>
	<img src="<?= $thisJob->job_image; ?>" class="img-responsive jobImage">
<?php } ?>

<!-- Not the logged in users job, show quote form -->
<?php if($usersJob == 0) { ?>
<div class="quoteContainer">
	<form action="" method="POST" role="form">
		<legend>Leave a quote for this job</legend>
	
		<div class="form-group">
			<label for="price"> Price </label>
			<div class="input-group">
	      		<div class="input-group-addon">&pound;</div>
		      	<input type="text" class="form-control" id="price" name="price" placeholder="Leave a quote for this job">
		      	<div class="input-group-addon">.00</div>
		    </div>
	  	</div>
		<label class="quoteMessage"> Leave a Message: </label>
		<textarea class="noMce form-control " rows="5" name="message" placeholder="Leave a Message..."></textarea>
		</div>
		<input type="hidden" name="token" value="<?= Token::generate(uniqid()); ?>">
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
<!-- else show the quotes that have been posted -->
<?php } else { 
echo '<div class="quoteContainer usersQuotes">
<h2> Quotes for this job: </h2>';
$quotes = $job->getQuotes($thisJob->jobId);
	if($quotes->count() > 0) {
		foreach ($quotes->results() as $key => $value) {
			echo '
			<div class="quote">
				<h4> '. date('d/m/Y H:i', strtotime($value->posted_at)) .' | &pound;'. $value->price .'</h4>
				<p>'. $value->message .'</p>
			</div>
			';
		}
	} else {
		echo '<h4> There have been no quotes for this job yet. </h4>';
	}
	echo '</div>';
} ?>
<?php
include 'includes/footer.php';
?>