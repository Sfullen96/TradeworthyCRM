<?php
	require_once 'core/init.php';
	include 'includes/header.php';
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				// Rules array
				'fname' => array(
					'name' => 'First Name',
					'required' => true,
					'min' => 2,
					'max' => 200
				),
				'lname' => array(
					'name' => 'Last Name',
					'required' => true,
					'min' => 2,
					'max' => 200
				),
				'password' => array(
					'name' => 'Password',
					'required' => true,
					'min' => 4,
					'max' => 50
				),
				'password_confirm' => array(
					'name' => 'Password Confirmation',
					'required' => true,
					'min' => 4,
					'matches' => 'password'
				),
				'email' => array(
					'name' => 'Email',
					'required' => true,
					'min' => 4,
					'max' => 300,
					'unique' => 'users'
				),
				'phone' => array(
					'name' => 'Phone Number',
					'required' => true,
					'min' => '8',
					'max' => '20'
				),
				'company_name' => array(
					'name' => 'Company Name',
					'required' => true
				),
				'address_1' => array(
					'name' => 'Address Line 1',
					'required' => true
				),
				'address_3' => array(
					'name' => 'Address Line 3',
					'required' => true
				),
				'postcode' => array(
					'name' => 'Postcode',
					'required' => true
				),
				'town' => array(
					'name' => 'Town',
					'required' => true
				),
				// 'regions[]' => array(
				// 	'name' =>'An area of operation',
				// 	'required' => true
				// )
			));

			$imageValidate = $validate->validateImage($_FILES, array(
				'image' => array(
					'name' => 'Profile Picture',
					'image' => true
				)
			));			

			if ($validation->passed() && $imageValidate) {
			 	
				// Register User
				$user = new User();
				$salt = Hash::salt(32);

				$x = 1;
				$regions = '';
				
				$image = $imageValidate;

				// Get regions ticked
				foreach (Input::get('regions') as $key => $value) {			
					$regions .= $key;		
					if ($x < count(Input::get('regions'))) {
						$regions.= ', ';
					}
					$x++;
				}
				

				try {
					$user->create(array(
						'fname' 		=> Input::get('fname'),
						'lname'		 	=> Input::get('lname'),
						'password'		=> Hash::make(Input::get('password'), $salt),
						'salt'			=> $salt,
						'company_name' 	=> Input::get('company_name'),
						'email' 		=> Input::get('email'),
						'phone' 		=> Input::get('phone'),
						'trade_id' 		=> Input::get('industry'),
						'logo'			=> $image,
						'areas_covered' => $regions,
						'user_group' 	=> 1 // Standard user
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

					Session::flash('success', 'You have registered successfully. You may now <a href="login.php"> login </a>');
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
	<legend> Register </legend>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="fname"> First Name </label>
				<input type="text" required="required" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?= escape(Input::get('fname')); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="lname"> Last Name </label>
				<input type="text" required="required" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?= escape(Input::get('lname')); ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="password"> Password </label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="password_confirm"> Password Confirmation </label>
				<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="company_name"> Company Name </label>
				<input type="text" required="required" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?= escape(Input::get('company_name')); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="email"> Email Address </label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= escape(Input::get('email')); ?>">
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="email"> Phone Number </label>
				<input type="text" required="required" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?= escape(Input::get('phone')); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="industry"> Select an industry </label>
				<select class="form-control" id="industry" name="industry">
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
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="address_1"> Address Line 1 </label>
				<input type="text" required="required" class="form-control" id="address_1" name="address_1" placeholder="Address Line 1" value="<?= escape(Input::get('address_1')); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="address_2"> Address Line 2 </label>
				<input type="text" required="required" class="form-control" id="address_2" name="address_2" placeholder="Address Line 2" value="<?= escape(Input::get('address_2')); ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="address_3"> Address Line 3 </label>
				<input type="text" required="required" class="form-control" id="address_3" name="address_3" placeholder="Address Line 3" value="<?= escape(Input::get('address_3')); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="postcode"> Postcode </label>
				<input type="text" required="required" class="form-control" id="postcode" name="postcode" placeholder="Postcode" value="<?= escape(Input::get('postcode')); ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="town"> Town </label>
				<input type="text" required="required" class="form-control" id="town" name="town" placeholder="Town/City" value="<?= escape(Input::get('town')); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
			<label class="control-label"> Upload a profile picture </label>
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
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<label> Please select the regions in which you operate: </label>
			<?php
				$regionObj = new Region();

				$regions = $regionObj->getAll('id ASC');

				echo '<div class="row">';
				foreach ($regions->results() as $region) {
					echo '<div class="col-xs-6 col-sm-4 col-md-4"><label class="checkbox-inline noselect"><input type="checkbox" name="regions['. $region->id .']" value="'. $region->id .'">'. $region->region .'</label></div>';
				}
				echo '</div>';
			?>
		</div>
	</div>
	<input type="hidden" name="token" value="<?= Token::generate(); ?>">
	<button type="submit" class="btn btn-primary"> Register </button>
</form>
<?php include 'includes/footer.php'; ?>