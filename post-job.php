<?php
	require_once 'core/init.php';
	include 'includes/header.php';
	$user = new User();
	if (!$user->isLoggedIn()) {
		Redirect::to('index.php');
	}
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				// Rules array
				'title' => array(
					'name' => 'Job Title',
					'required' => true,
					'min' => 2,
					'max' => 300
				),
				'desc' => array(
					'name' => 'Job Description',
					'required' => true,
					'min' => 2
				),
				'date' => array(
					'name' => 'Date Required',
					'required' => true
				)
			));
			$imageValidate = $validate->validateImage($_FILES, array(
				'image' => array(
					'name' => 'Job Image',
					'image' => true
				)
			), 'public/images/jobs/');
			if ($validation->passed() && $imageValidate) {
				
				// Register User
				$job = new Job();
				$x = 1;
				$date = date('Y-m-d', strtotime(Input::get('date')));
				$date .= ' 12:00:00';
				$image = $imageValidate;
				
				if (Input::get('urgent')) {
					$urgent = 1;
				} else {
					$urgent = 0;
				}
				try {
					$job->create(array(
						'user_id' 			=> $user->data()->id,
						'job_title' 		=> Input::get('title'),
						'trade_required'	=> Input::get('trade_required'),
						'job_image'			=> $image,
						'job_description' 	=> Input::get('desc'),
						'date_required' 	=> $date,
						'urgent' 			=> $urgent,
						'job_location'		=> Input::get('location')
					));
					// Get last insert ID
					$user_id = DB::getInstance()->lastInsertId();
					
					$user->createAddress(array(
						'user_id' => $user_id,
						'line_1' => Input::get('address_1'),
						'line_2' => Input::get('address_2'),
						'line_3' => Input::get('address_3'),
						'postcode' => Input::get('postcode'),
						'region' => Input::get('town')
					));
					Session::flash('success', 'Your job was posted successfully.');
					Redirect::to('index.php');
				} catch (Exception $e) {
					die($e->getMessage());
				}
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
<form action="" method="POST" role="form" enctype="multipart/form-data">
	<legend> Post a Job </legend>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="title"> Job Title </label>
				<input type="text" required="required" class="form-control" id="title" name="title" placeholder="Job Title" value="<?= escape(Input::get('title')); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="trade_required"> Select the trade your require: </label>
				<select class="form-control" id="trade_required" name="trade_required">
					<?php
						$industry = new Industry;
						$industries = $industry->getAll('name ASC');
						if($industries->count()) {
							foreach ($industries->results()	as $industry) {
								
								echo '<option value="'. $industry->id .'">'. $industry->name .'</option>';
									
							}
						} else {
							echo 'Industries not found';
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<label for="desc"> Job Description </label>
	<textarea class="form-control mce" name="desc" id="desc" placeholder="Job Description" rows="8" style="margin-bottom: 20px;"></textarea>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="location"> Select the location of the job: </label>
				<select class="form-control" id="location" name="location">
				<?php 

					$getRegions = DB::getInstance()
						->select('regions')
						->orderBy('region ASC')
						->get();

					if($getRegions->count()) {
						foreach ($getRegions->results()	as $region) {
							echo '<option value="'. $region->id .'">'. $region->region .'</option>';
						}
					} else {
						echo 'Regions not found';
					}


				?>
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="date"> Date Required </label>
				<input type="text" readonly class="form-control datepicker" id="date" name="date" placeholder="Date Required">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Job Image</label>
		<div class="">
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="input-append">
					<div class="uneditable-input" style="position: relative;">
						<i class="fa fa-file fileupload-exists"></i>
						<span class="fileupload-preview"></span>
					</div>
					<span class="btn btn-default btn-file">
						<span class="fileupload-exists">Change</span>
						<span class="fileupload-new">Select file</span>
						<input type="file" />
						<input type="file" name="image" id="image">
					</span>
					<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<label class="checkbox noselect urgentJob"><input type="checkbox" name="urgent"> Urgent? </label>
		</div>
	</div>
	<input type="hidden" name="token" value="<?= Token::generate(); ?>">
	<button type="submit" class="btn btn-primary"> Post Job </button>
</form>
<?php include 'includes/footer.php'; ?>