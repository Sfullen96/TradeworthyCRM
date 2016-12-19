<?php
require_once 'core/init.php';
include 'includes/header.php';
$user = new User();
if (!$user->isLoggedIn()) {
	Redirect::to('index.php');
}
if (Session::exists('success')) {
	echo' <div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		'. Session::flash('success') .'
	</div>';
}


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
				// 'password' => array(
				// 	'name' => 'Password',
				// 	'required' => true,
				// 	'min' => 4,
				// 	'max' => 50
				// ),
				// 'password_confirm' => array(
				// 	'name' => 'Password Confirmation',
				// 	'required' => true,
				// 	'min' => 4,
				// 	'matches' => 'password'
				// ),
				'email' => array(
					'name' => 'Email',
					'required' => true,
					'min' => 4,
					'max' => 300
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
				)
			));
			if ($validation->passed()) {
				// Update User
				try {
					$user->update(array(
						'fname' => Input::get('fname'),
						'lname' => Input::get('lname'),
						'company_name' => Input::get('company_name'),
						'email' => Input::get('email'),
						'phone' => Input::get('phone'),
						'trade_id' => Input::get('industry')
					));

					Session::flash('success', 'Your details have been updated');
					Redirect::to('settings.php');

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
<form action="" method="POST" role="form">
	<legend>Update your details:</legend>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="fname"> First Name </label>
				<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?= escape($user->data()->fname); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="lname"> Last Name </label>
				<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?= escape($user->data()->lname); ?>">
			</div>
		</div>
	</div>
<!-- 	<div class="row">
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
	</div> -->
	<div class="form-group">
		<label for="company_name"> Company Name </label>
		<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?= escape($user->data()->company_name); ?>">
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="email"> Email Address </label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= escape($user->data()->email); ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="email"> Phone Number </label>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?= escape($user->data()->phone); ?>">
			</div>
		</div>
	</div>
		<div class="form-group">
	  	<label for="industry"> Select an industry </label>
	  	<select class="form-control" id="industry" name="industry">
		<?php 
			$industry = new Industry;
			$industries = $industry->getAll('name ASC');

			if($industries->count()) {
				foreach ($industries->results()	as $industry) {
					if($industry->id == $user->data()->trade_id) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
					echo '<option '. $selected .' value="'. $industry->id .'">'. $industry->name .'</option>';
						  
				}
			} else {
				echo 'Industries not found';
			}
		?>
		</select>
	</div>
	<input type="hidden" name="token" value="<?= Token::generate(); ?>">
	<button type="submit" class="btn btn-primary">Update</button>
</form>
<?php
include 'includes/footer.php';
?>