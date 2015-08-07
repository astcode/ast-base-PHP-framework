<?php
require 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Session::flash('danger', 'You must be logged in and/or have an account to change your password!');
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true,
				'min' => 6),
			'password_new' => array(
				'required' => true,
				'min' => 6),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new')
		));

		if($validation->passed()) {
			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
				echo 'Your current password is wrong.';
			} else {
				try {

					$salt = Hash::salt(32);

					$user->update(array(
						'password' => Hash::make(Input::get('password_new'), $salt),
						'salt' => $salt
					));

					Session::flash('home', 'Your password has been changed!');
					Redirect::to('index.php');

				} catch(Exception $e) {
					die($e->getMessage());
				}
			}
		} else {
			foreach($validate->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
?>

<?php require_once 'template/constants/header.php'; ?>


<?php require_once 'template/constants/navigation.php'; ?>


	<?php require_once 'template/body/user_pages/change_password.php'; ?>


<?php require_once 'template/constants/footer.php'; ?>